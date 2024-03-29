/* Test du déclencheur AlerteStock :
Mettez à jour la quantité de stock d'un ingrédient de manière à déclencher l'alerte : */

UPDATE Ingredient SET QuantiteStock = 5 WHERE ID_Ingredient = 1;

/* Test du déclencheur NouveauStatutPaiement :
Mettez à jour le statut de paiement d'une commande : */

UPDATE Commande SET ID_Livreur = 1, StatutPaiement = 'Payé', heureLivraison = NOW() WHERE ID_Commande = 2;

/* Test du déclencheur DisponibiliteLivreur :
Mettez à jour une commande avec un livreur déjà occupé à la même heure : */

UPDATE Commande SET ID_Livreur = 1, StatutPaiement = 'Payé', heureLivraison = NOW() WHERE ID_Commande = 2;

/* Test du déclencheur LivreurDisponible :
Ajoutez une nouvelle commande avec un livreur déjà assigné à une commande à la même heure : */

INSERT INTO Commande (DateCommande, HeureCommande, StatutPaiement, PrixCommande, heureLivraison, ID_Client, ID_Livreur, ID_Paiement) VALUES ('18/12/2023', '12:00', 'Payé', 30.00, '12:30', 1, 1, 1);

/* Test du déclencheur MiseAJourDateLivraison :
Mettez à jour le statut de paiement d'une commande pour déclencher la mise à jour de la date de livraison : */

UPDATE Commande SET StatutPaiement = 'Payé' WHERE ID_Commande = 3;

/* Test du déclencheur MiseAJourPrixCommande :
Insérez une nouvelle ligne de commande pour mettre à jour le prix total de la commande : */

INSERT INTO Ligne_Commande (ID_Commande, Quantite, PrixUnitaire) VALUES (1, 2, 15.00);

/* Test du déclencheur MiseAJourPrixLigneCommande :
Insérez une nouvelle ligne de commande avec une pizza finale pour mettre à jour le prix unitaire : */

INSERT INTO Ligne_Commande (ID_Commande, Quantite, ID_PizzaFinale) VALUES (1, 1, 1);

/* Test du déclencheur LivraisonEnRetard :
Ajoutez une nouvelle commande avec une heure de livraison dépassant la limite : */

INSERT INTO Commande (DateCommande, HeureCommande, StatutPaiement, PrixCommande, heureLivraison, ID_Client, ID_Livreur, ID_Paiement) VALUES ('2023-12-18', '12:00', 'Payé', 30.00, '12:50', 1, 1, 1);

/* Test du déclencheur diminutionStock :
Ajoutez une nouvelle pizza finale pour déclencher la diminution du stock : */

INSERT INTO PizzaFinale (PrixFinal, DescriptionPizzaFinale, ID_Pizza) VALUES (20.00, 'Pizza Hawwaïenne sans fromage, sans tomate, sans viande', 1);