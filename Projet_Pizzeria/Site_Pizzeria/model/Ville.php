<?php
require_once("objet.php");

class Ville extends objet {
    protected static string $classe = "Ville";
    protected $ID_Ville;
    protected $NomVille;
    protected $CodePostal;

    public function __construct($ID_Ville = NULL, $NomVille = NULL, $CodePostal = NULL) {
        if (!is_null($ID_Ville)) {
            $this->ID_Ville = $ID_Ville;
            $this->NomVille = $NomVille;
            $this->CodePostal  = $CodePostal ;
        }
    }

    public function __get($attribut) {
        return $this->$attribut;
    }

    public function __set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Ville $this->ID_Ville ($this->NomVille $this->CodePostal)";
    }

    

    public static function create($NomVille, $CodePostal) {
        $requete1 = "INSERT INTO Ville(NomVille, CodePostal) VALUES ('$NomVille', '$CodePostal')";
        connexion::pdo()->query($requete1);
    }
}
?>

