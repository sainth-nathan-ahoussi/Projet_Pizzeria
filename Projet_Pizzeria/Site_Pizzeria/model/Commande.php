<?php
require_once("objet.php");

class Commande extends objet {
    protected static string $classe = "Commande";
    protected $ID_Commande;
    protected $DateCommande;
    protected $HeureCommande;
    protected $TypePaiement;
    protected $StatutCommande;
    protected $PrixCommande;
    protected $heureLivraison;
    protected $ID_Client;
    protected $ID_Caissier;
    protected $ID_Livreur;

    public function __construct($ID_Commande = NULL, $DateCommande = NULL, $HeureCommande = NULL, $TypePaiement = NULL, $StatutCommande = NULL, $PrixCommande = NULL, $heureLivraison = NULL, $ID_Client = NULL, $ID_Caissier = NULL, $ID_Livreur = NULL) {
        if (!is_null($ID_Commande)) {
            $this->ID_Commande = $ID_Commande;
            $this->DateCommande = $DateCommande;
            $this->HeureCommande = $HeureCommande;
            $this->TypePaiement = $TypePaiement;
            $this->StatutCommande = $StatutCommande;
            $this->PrixCommande = $PrixCommande;
            $this->heureLivraison = $heureLivraison;
            $this->ID_Client = $ID_Client;
            $this->ID_Caissier = $ID_Caissier;
            $this->ID_Livreur = $ID_Livreur;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Commande $this->ID_Commande (Prix: $this->PrixCommande)";
    }

    public static function create($DateCommande, $HeureCommande, $TypePaiement, $StatutCommande, $PrixCommande, $heureLivraison, $ID_Client) {
        $requete = "INSERT INTO Commande(DateCommande, HeureCommande, TypePaiement, StatutCommande, PrixCommande, heureLivraison, ID_Client) VALUES ('$DateCommande', '$HeureCommande', '$TypePaiement', '$StatutCommande', '$PrixCommande', '$heureLivraison', '$ID_Client')";
        connexion::pdo()->query($requete);
    }

}
?>
