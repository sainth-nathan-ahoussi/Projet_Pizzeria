<?php
require_once("objet.php");

class Boisson extends objet {
    protected static string $classe = "Boisson";
    protected $ID_Boisson;
    protected $NomBoisson;
    protected $PrixBoisson;
    protected $imageBoisson;

    public function __construct($ID_Boisson = NULL, $NomBoisson = NULL, $PrixBoisson = NULL, $imageBoisson = NULL) {
        if (!is_null($ID_Boisson)) {
            $this->ID_Boisson = $ID_Boisson;
            $this->NomBoisson = $NomBoisson;
            $this->PrixBoisson = $PrixBoisson;
            $this->imageBoisson = $imageBoisson;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Produit $this->ID_Boisson (Nom: $this->NomBoisson)";
    }

    public static function create($NomBoisson, $PrixBoisson) {
        $requete = "INSERT INTO Boisson(NomBoisson, PrixProduit) VALUES ('$NomBoisson', '$PrixBoisson')";
        connexion::pdo()->query($requete);
    }

    public static function getBoissonDetails($ID_Boisson, $selection) {
        $colonnesAutorisees = ['NomBoisson', 'PrixBoisson', 'imageBoisson'];
        if (!in_array($selection, $colonnesAutorisees)) {
            return null;
        }
        $requete = "SELECT $selection FROM Boisson WHERE ID_Boisson = '$ID_Boisson'";
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