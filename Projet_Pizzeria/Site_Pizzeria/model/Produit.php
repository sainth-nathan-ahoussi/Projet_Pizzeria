<?php
require_once("objet.php");

class Produit extends objet {
    protected static string $classe = "Produit";
    protected $ID_Produit;
    protected $NomProduit;
    protected $PrixProduit;
    protected $imageProduit;

    public function __construct($ID_Produit = NULL, $NomProduit = NULL, $PrixProduit = NULL,$imageProduit = NULL) {
        if (!is_null($ID_Produit)) {
            $this->ID_Produit = $ID_Produit;
            $this->NomSupplement = $NomProduit;
            $this->PrixSupplement = $PrixProduit;
            $this->imageProduit = $imageProduit;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Produit $this->ID_Produit (Nom: $this->NomProduit)";
    }

    public static function create($NomProduit, $PrixProduit) {
        $requete = "INSERT INTO Produit(NomProduit, PrixProduit) VALUES ('$NomProduit', '$PrixProduit')";
        connexion::pdo()->query($requete);
    }

    public static function getProduitDetails($ID_Produit, $selection) {
        $colonnesAutorisees = ['NomProduit', 'PrixProduit', 'imageProduit'];
        if (!in_array($selection, $colonnesAutorisees)) {
            return null;
        }
        $requete = "SELECT $selection FROM Produit WHERE ID_Produit = '$ID_Produit'";
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
