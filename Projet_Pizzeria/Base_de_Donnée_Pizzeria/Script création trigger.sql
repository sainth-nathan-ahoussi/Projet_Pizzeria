/* Trigger stockant un message d'alerte dans la table Alerte quand la nouvelle quantité de stock est inférieure au seuil d'alerte, table alerte qui pourra être consulté par le gestionnaire */

DELIMITER //

CREATE OR REPLACE TRIGGER AlerteStock
BEFORE UPDATE ON Ingredient
FOR EACH ROW
BEGIN
IF NEW.QuantiteStock < NEW.SeuilAlerte THEN
INSERT INTO AlerteIngredient (Message, ID_Ingredient)
VALUES ("Alerte!!! Votre stock est inférieur au seuil d'alerte", NEW.ID_Ingredient);
END IF;
END;
//

/* Mise à jour du statut de paiement après la confirmation de livraison permettant de savoir quand une commande  est livrée et terminée. */

DELIMITER //

CREATE TRIGGER NouveauStatutPaiement
AFTER UPDATE ON Commande
FOR EACH ROW
BEGIN
IF NEW.StatutPaiement = 'Payé' AND NEW.HeureLivraison < NOW() THEN
UPDATE Commande SET StatutPaiement = 'Terminé'
WHERE ID_Commande = NEW.ID_Commande;
END IF;
END;
//

/* Déclencheur pour vérifier la disponibilité d’un livreur avant d’assigner une livraison à une commande afin d'éviter de surboucher la préparation des livraisons  */

DELIMITER //

CREATE TRIGGER DisponibiliteLivreur
BEFORE UPDATE ON Commande
FOR EACH ROW
BEGIN
IF NEW.StatutPaiement = 'Payé' AND NEW.heureLivraison IS NOT NULL THEN
IF (SELECT COUNT(*) FROM Commande WHERE ID_Livreur = NEW.ID_Livreur AND StatutPaiement = 'Payé' AND heureLivraison = NEW.heureLivraison) > 1 THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Livreur indisponible à cette heure';
END IF;
END IF;
END;
//

/* Déclencheur qui renvoie un message quand un livreur est disponible */

DELIMITER //

CREATE TRIGGER LivreurDisponible
BEFORE INSERT ON Commande
FOR EACH ROW
BEGIN
DECLARE livreur_disponible INT;
SELECT COUNT(*) INTO livreur_disponible FROM Commande
WHERE ID_Livreur = NEW.ID_Livreur AND StatutPaiement = 'Payé' AND heureLivraison = NEW.heureLivraison;
IF livreur_disponible = 0 THEN
INSERT INTO AlerteLivreur(Message, ID_Livreur) VALUES ('Le livreur est disponible pour la livraison.', NEW.ID_Livreur);
ELSE SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le livreur est déjà assigné à une commande à cette heure.';
END IF;
END;
//

/* Déclencheur pour mettre à jour automatiquement la date et l’heure de livraison après confirmation de livraison en comparant 
    l'ancien statut de paiement avec le nouveau, ce qui est très utile dans les paiements au moment de la livraison */

DELIMITER //

CREATE TRIGGER MiseAJourDateLivraison
BEFORE UPDATE ON Commande
FOR EACH ROW
BEGIN
IF NEW.StatutPaiement = 'Payé' AND NEW.StatutPaiement <> OLD.StatutPaiement THEN
SET NEW.heureLivraison = CURRENT_TIME();
SET NEW.DateCommande = CURRENT_DATE();
END IF;
END;
//

/* Déclencheur pour mettre à jour le prix total d'une commande après l'ajout d'une nouvelle ligne de commande */

DELIMITER //

CREATE TRIGGER MiseAJourPrixCommande
AFTER INSERT ON Ligne_Commande
FOR EACH ROW
BEGIN
UPDATE Commande SET PrixCommande = (SELECT SUM(PrixUnitaire) FROM Ligne_Commande WHERE ID_Commande = NEW.ID_Commande)
WHERE ID_Commande = NEW.ID_Commande;
END;
//

/* Déclencheur pour mettre à jour le prix total d'une Ligne de commande à l'ajout d'une nouvelle ligne de commande */

DELIMITER //

CREATE TRIGGER MiseAJourPrixLigneCommande
BEFORE INSERT ON Ligne_Commande
FOR EACH ROW
BEGIN
IF NEW.ID_PizzaFinale IS NOT NULL THEN
SET NEW.PrixUnitaire = NEW.Quantite  *(SELECT PrixFinal FROM PizzaFinale p WHERE p.ID_PizzaFinale = NEW.ID_PizzaFinale);* (SELECT PrixSupplement FROM Supplement s WHERE s.ID_Supplement= NEW.ID_Supplement);
END IF;
END;
//

/* trigger qui permet de savoir quand une livraison arrive en retard c'est à dire quand elle n'est pas livrée dans les 45 minutes après la commande, temps au-delà 
    duquel une réduction 50% est offerte au client. cette reduction doit etre stocke dans l'attribut aReductionClient de la Classe Client */

CREATE OR REPLACE TRIGGER LivraisonEnRetard  
BEFORE INSERT ON Commande  
FOR EACH ROW   
BEGIN   
DECLARE heureLimite TIME;   
DECLARE heureComm TIME; 

SET heureComm = NEW.HeureCommande;   
SET heureLimite = ADDTIME(heureComm, '00:45:00'); 

IF NEW.heureLivraison IS NOT NULL AND NEW.heureLivraison > heureLimite THEN   
SET NEW.PrixCommande = NEW.PrixCommande \* 0.5;   
UPDATE Client SET aReductionClient = TRUE WHERE ID_Client = NEW.ID_Client;  
INSERT INTO AlerteClient (Message, ID_Client) VALUES ('Livraison en retard! Réduction de 50% offerte au client.', NEW.ID_Client); END IF; END;

/* trigger qui update la quantité restante d'un ingrédient après fabrication d'une pizza */

CREATE TRIGGER diminutionStock  
BEFORE INSERT ON PizzaFinale  
FOR EACH ROW  
BEGIN  
UPDATE Ingredient i  
JOIN utilise u ON u.ID_Ingredient = i.ID_Ingredient  
SET i.QuantiteStock = i.QuantiteStock - 1  
WHERE u.ID_Pizza = NEW.ID_Pizza;

UPDATE Ingredient i  
JOIN SupplementPizza s ON s.ID_Ingredient = i.ID_Ingredient  
JOIN modifie m ON m.ID_SupplementPizza = s.ID_SupplementPizza  
SET i.QuantiteStock = i.QuantiteStock - 1  
WHERE m.ID_PizzaFinale = NEW.ID_PizzaFinale;  
END;

/*Ce trigger est juste une idée que nous avons eu nous ne l'avons pas implémenter car cela impliquera d'une certaine façon de changer la base.

Mais pour la faire marcher il faudrait créer une table PizzaSuccès permettant de pour avoir ce trigger  pour connaitre la pizza la plus commander et le nombre de fois ou elle est commander

CREATE TABLE IF NOT EXISTS PizzaLaPlusCommandee ( ID_Pizza INT NOT NULL, NombreCommandes INT DEFAULT 0, PRIMARY KEY (ID_Pizza), FOREIGN KEY (ID_Pizza) REFERENCES RecettePizza(ID_Pizza) );

CREATE OR REPLACE TRIGGER MiseAJourStatistiquesPizza  
AFTER INSERT ON Ligne_Commande  
FOR EACH ROW  
BEGIN  
DECLARE pizza_id INT;

SET pizza_id = (SELECT ID_PizzaFinale FROM Ligne_Commande WHERE ID_LigneCommande = NEW.ID_LigneCommande);  
UPDATE PizzaLaPlusCommandee SET NombreCommandes = NombreCommandes + 1 WHERE ID_Pizza = pizza_id;  
IF ROW_COUNT() = 0 THEN  
INSERT INTO PizzaLaPlusCommandee (ID_Pizza, NombreCommandes) VALUES (pizza_id, 1);  
END IF;  
END;

*/