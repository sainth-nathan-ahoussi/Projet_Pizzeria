<?php
require_once("objet.php");

class Ligne_Commande extends objet {
    protected static string $classe = "Ligne_Commande";
    protected $ID_LigneCommande;
    protected $ID_Commande;
    protected $IMGProduit;
    protected $Quantite;
    protected $PrixUnitaire;
    protected $ID_Supplement;
    protected $ID_PizzaFinale;
    protected $ID_Client;

    public function __construct($ID_LigneCommande = NULL, $ID_Commande = NULL, $IMGProduit = NULL, $Quantite = NULL, $PrixUnitaire = NULL, $ID_Supplement = NULL, $ID_PizzaFinale = NULL,$ID_Client = NULL) {
        if (!is_null($ID_LigneCommande)) {
            $this->ID_LigneCommande = $ID_LigneCommande;
            $this->ID_Commande = $ID_Commande;
            $this->IMGProduit = $IMGProduit;
            $this->Quantite = $Quantite;
            $this->PrixUnitaire = $PrixUnitaire;
            $this->ID_Supplement = $ID_Supplement;
            $this->ID_PizzaFinale = $ID_PizzaFinale;
            $this->ID_Client = $ID_Client;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Ligne_Commande $this->ID_LigneCommande (Quantité: $this->Quantite)";
    }

    public static function create($ID_Commande, $IMGProduit, $Quantite, $PrixUnitaire, $ID_Client) {
        $requete = "INSERT INTO Ligne_Commande(ID_Commande, IMGProduit, Quantite, PrixUnitaire, ID_Client) VALUES (null,'$IMGProduit', '$Quantite', '$PrixUnitaire','$ID_Client')";
        connexion::pdo()->query($requete);
    }

    public static function delete($IMGProduit, $Quantite, $PrixUnitaire , $ID_Client) {
        $requete = "DELETE FROM `Ligne_Commande` WHERE IMGProduit = '$IMGProduit' AND  PrixUnitaire = '$PrixUnitaire' AND Quantite = '$Quantite' AND ID_Client = '$ID_Client'";
        connexion::pdo()->query($requete);
    }

     public static function getPanier($ID_Client) {
        $requete = "SELECT * FROM Ligne_Commande WHERE ID_Client = '$ID_Client'";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS,"Ligne_Commande");
        $panier = $resultat->fetchAll();
        return $panier;
       
     }

     public static function getLigne_CommandeDetails($ID_LigneCommande, $selection) {
        $colonnesAutorisees = ['IMGProduit', 'Quantite', 'PrixUnitaire'];
        if (!in_array($selection, $colonnesAutorisees)) {
            return null;
        }
        $requete = "SELECT $selection FROM Ligne_Commande WHERE ID_LigneCommande = '$ID_LigneCommande'";
        $resultat = connexion::pdo()->query($requete);
        if ($resultat) {
            $valeurColonne = $resultat->fetchColumn();
            return $valeurColonne;
        } else {
            return null;
        }
    }
    
}

?>
