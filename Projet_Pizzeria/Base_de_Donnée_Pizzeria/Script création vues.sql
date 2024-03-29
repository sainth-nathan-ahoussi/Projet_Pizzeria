/* VUES */

/* Voir les ingrédients provoquant des allergeies */
CREATE VIEW AllergieIngredient AS
SELECT NomIngredient, NomAllergene
FROM Ingredient i
JOIN comporte c ON c.ID_Ingredient = i.ID_Ingredient
JOIN Allergene a ON a.ID_Allergene = c.ID_Allergene
GROUP BY NomIngredient;

/* Voir les pizzas de base d'une commande */
CREATE VIEW PizzaDeCommande AS
SELECT c.ID_Commande, lc.ID_LigneCommande, rc.NomPizza
FROM Commande c
JOIN Ligne_Commande lc ON lc.ID_Commande = c.ID_Commande
JOIN PizzaFinale pf ON pf.ID_PizzaFinale = lc.ID_PizzaFinale
JOIN RecettePizza rc ON rc.ID_Pizza = pf.ID_Pizza
GROUP BY c.ID_Commande;

/* Voir les suppléments d'une commande */
CREATE VIEW SupplementDeCommande AS
SELECT c.ID_Commande, lc.ID_LigneCommande, s.NomSupplement
FROM Commande c
JOIN Ligne_Commande lc ON lc.ID_Commande = c.ID_Commande
JOIN Supplement s ON s.ID_Supplement = lc.ID_Supplement
GROUP BY c.ID_Commande;

/* Voir les adresses détaillés des clients */
CREATE VIEW AdresseClientDetaille AS
SELECT NomClient, PrenomClient, AdresseClient, NomVille, CodePostal
FROM Client
INNER JOIN Ville USING (ID_Ville);

/* Voir de quelles commandes se sont occupés quels livreurs aujourd'hui */
CREATE VIEW LivreurCommandeAjd AS
SELECT NomLivreur, PrenomLivreur, ID_Commande, HeureCommande
FROM Livreur l
JOIN Commande c ON c.ID_Livreur = l.ID_Livreur
WHERE DateCommande=CURRENT_DATE()
GROUP BY NomLivreur
ORDER BY HeureCommande;

/* Voir de quelles commandes se sont occupés quels caissiers aujourd'hui */
CREATE VIEW CaissierCommandeAjd AS
SELECT NomCaissier, PrenomCaissier, ID_Commande, HeureCommande
FROM Caissier c
INNER JOIN Commande co ON co.ID_Caissier = c.ID_Caissier
WHERE DateCommande=CURRENT_DATE()
GROUP BY NomCaissier
ORDER BY HeureCommande;

/* Voir les commandes faites en ligne */
CREATE VIEW CommandeEnLigne AS SELECT ID_Commande FROM Commande
WHERE TypePaiement = 'En ligne';

/* Voir les commandes qui n'ont pas de livreur (consommées sur place donc) */
CREATE VIEW ConsommationSurPlace AS SELECT ID_Commande FROM Commande
WHERE ID_Livreur is NULL;