CREATE OR REPLACE TABLE Ville(
   ID_Ville INT NOT NULL AUTO_INCREMENT,
   NomVille VARCHAR(50),
   CodePostal INT,
   PRIMARY KEY(ID_Ville)
);

CREATE OR REPLACE TABLE Client(
   ID_Client INT NOT NULL AUTO_INCREMENT,
   NomClient VARCHAR(50),
   PrenomClient VARCHAR(50),
   NumTelClient INT,
   AdresseMailClient VARCHAR(50),
   AdresseClient VARCHAR(200),
   aReductionClient BOOLEAN DEFAULT FALSE,
   ID_Ville INT NOT NULL,
   PRIMARY KEY(ID_Client),
   FOREIGN KEY(ID_Ville) REFERENCES Ville(ID_Ville)
);

CREATE OR REPLACE TABLE Caissier(
   ID_Caissier INT NOT NULL AUTO_INCREMENT,
   NomCaissier VARCHAR(50),
   PrenomCaissier VARCHAR(50),
   PRIMARY KEY(ID_Caissier)
);

CREATE OR REPLACE TABLE Livreur(
   ID_Livreur INT NOT NULL AUTO_INCREMENT,
   NomLivreur VARCHAR(50),
   PrenomLivreur VARCHAR(50),
   TypeVehicule VARCHAR(50),
   PRIMARY KEY(ID_Livreur)
);

CREATE OR REPLACE TABLE Ingredient(
   ID_Ingredient INT NOT NULL AUTO_INCREMENT,
   NomIngredient VARCHAR(50),
   QuantiteStock VARCHAR(50),
   SeuilAlerte VARCHAR(50),
   PRIMARY KEY(ID_Ingredient)
);

CREATE OR REPLACE TABLE RecettePizza(
   ID_Pizza INT NOT NULL AUTO_INCREMENT,
   NomPizza VARCHAR(50),
   DescriptionPizza VARCHAR(200),
   PrixBasePizza VARCHAR(50),
   PRIMARY KEY(ID_Pizza)
);

CREATE OR REPLACE TABLE Pizzaiolo(
   ID_Pizzaiolo INT NOT NULL AUTO_INCREMENT,
   NomPizzaiolo VARCHAR(50),
   PrenomPizzaiolo VARCHAR(50),
   PRIMARY KEY(ID_Pizzaiolo)
);

CREATE OR REPLACE TABLE Supplement(
   ID_Supplement INT NOT NULL AUTO_INCREMENT,
   NomSupplement VARCHAR(50),
   PrixSupplement VARCHAR(50),
   PRIMARY KEY(ID_Supplement)
);

CREATE OR REPLACE TABLE Allergene(
   ID_Allergene INT NOT NULL AUTO_INCREMENT,
   NomAllergene VARCHAR(50),
   EffetAllergene VARCHAR(200),
   PRIMARY KEY(ID_Allergene)
);

CREATE OR REPLACE TABLE PizzaFinale(
   ID_PizzaFinale INT NOT NULL AUTO_INCREMENT,
   PrixFinal DECIMAL(15,2),
   DescriptionPizzaFinale VARCHAR(200),
   ID_Pizza INT NOT NULL,
   PRIMARY KEY(ID_PizzaFinale),
   FOREIGN KEY(ID_Pizza) REFERENCES RecettePizza(ID_Pizza)
);

CREATE OR REPLACE TABLE SupplementPizza(
   ID_SupplementPizza INT NOT NULL AUTO_INCREMENT,
   NomSupplementPizza VARCHAR(50),
   PrixSupplementPizza VARCHAR(50),
   ID_Ingredient INT NOT NULL,
   PRIMARY KEY(ID_SupplementPizza),
   FOREIGN KEY(ID_Ingredient) REFERENCES Ingredient(ID_Ingredient)
);

CREATE OR REPLACE TABLE Commande(
   ID_Commande INT NOT NULL AUTO_INCREMENT,
   DateCommande VARCHAR(50),
   HeureCommande TIME,
   TypePaiement VARCHAR(50), //Indique si le paiement est en ligne ou sur place
   StatutPaiement VARCHAR(50), //Indique si la commande est payé, non payé ou en cours
   PrixCommande DECIMAL(15,2),
   heureLivraison TIME,
   ID_Client INT NOT NULL,
   ID_Caissier INT, //Caissier peut être NULL pour les commandes faites en lignes
   ID_Livreur INT, // Livreur peut être NULL pour les commandes consommés sur place
   PRIMARY KEY(ID_Commande),
   FOREIGN KEY(ID_Client) REFERENCES Client(ID_Client),
   FOREIGN KEY(ID_Caissier) REFERENCES Caissier(ID_Caissier),
   FOREIGN KEY(ID_Livreur) REFERENCES Livreur(ID_Livreur)
);

CREATE OR REPLACE TABLE Ligne_Commande(
   ID_LigneCommande INT NOT NULL AUTO_INCREMENT,
   ID_Commande INT NOT NULL,
   Quantite VARCHAR(50),
   PrixUnitaire DECIMAL(15,2),
   ID_Supplement INT,
   ID_PizzaFinale INT,
   PRIMARY KEY(ID_LigneCommande, ID_Commande),
   FOREIGN KEY(ID_Commande) REFERENCES Commande(ID_Commande),
   FOREIGN KEY(ID_Supplement) REFERENCES Supplement(ID_Supplement),
   FOREIGN KEY(ID_PizzaFinale) REFERENCES PizzaFinale(ID_PizzaFinale)
);

CREATE OR REPLACE TABLE AlerteIngredient(
   ID_Alerte INT NOT NULL AUTO_INCREMENT,
   Message VARCHAR(200),
   ID_Ingredient INT NOT NULL,
   PRIMARY KEY(ID_Alerte),
   FOREIGN KEY(ID_Ingredient) REFERENCES Ingredient(ID_Ingredient)
);

CREATE OR REPLACE TABLE AlerteClient(
   ID_AlerteClient INT NOT NULL AUTO_INCREMENT,
   Message VARCHAR(200),
   ID_Client INT NOT NULL,
   PRIMARY KEY(ID_AlerteClient),
   FOREIGN KEY(ID_Client) REFERENCES Client(ID_Client)
);

CREATE OR REPLACE TABLE AlerteLivreur(
   ID_AlerteLivreur INT NOT NULL AUTO_INCREMENT,
   Message VARCHAR(200),
   ID_Livreur INT NOT NULL,
   PRIMARY KEY(ID_AlerteLivreur),
   FOREIGN KEY(ID_Livreur) REFERENCES Livreur(ID_Livreur)
);

CREATE OR REPLACE TABLE comporte(
   ID_Ingredient INT,
   ID_Allergene INT,
   PRIMARY KEY(ID_Ingredient, ID_Allergene),
   FOREIGN KEY(ID_Ingredient) REFERENCES Ingredient(ID_Ingredient),
   FOREIGN KEY(ID_Allergene) REFERENCES Allergene(ID_Allergene)
);

CREATE OR REPLACE TABLE utilise(
   ID_Ingredient INT,
   ID_Pizza INT,
   PRIMARY KEY(ID_Ingredient, ID_Pizza),
   FOREIGN KEY(ID_Ingredient) REFERENCES Ingredient(ID_Ingredient),
   FOREIGN KEY(ID_Pizza) REFERENCES RecettePizza(ID_Pizza)
);

CREATE OR REPLACE TABLE modifie(
   ID_PizzaFinale INT,
   ID_SupplementPizza INT,
   PRIMARY KEY(ID_PizzaFinale, ID_SupplementPizza),
   FOREIGN KEY(ID_PizzaFinale) REFERENCES PizzaFinale(ID_PizzaFinale),
   FOREIGN KEY(ID_SupplementPizza) REFERENCES SupplementPizza(ID_SupplementPizza)
);

CREATE OR REPLACE TABLE prépare(
   ID_Pizzaiolo INT,
   ID_PizzaFinale INT,
   PRIMARY KEY(ID_Pizzaiolo, ID_PizzaFinale),
   FOREIGN KEY(ID_Pizzaiolo) REFERENCES Pizzaiolo(ID_Pizzaiolo),
   FOREIGN KEY(ID_PizzaFinale) REFERENCES PizzaFinale(ID_PizzaFinale)
);
