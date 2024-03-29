<?php
require_once("objet.php");

class Supplement extends objet {
    protected static string $classe = "Supplement";
    protected $ID_Supplement;
    protected $NomSupplement;
    protected $PrixSupplement;

    public function __construct($ID_Supplement = NULL, $NomSupplement = NULL, $PrixSupplement = NULL) {
        if (!is_null($ID_Supplement)) {
            $this->ID_Supplement = $ID_Supplement;
            $this->NomSupplement = $NomSupplement;
            $this->PrixSupplement = $PrixSupplement;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Supplement $this->ID_Supplement (Nom: $this->NomSupplement)";
    }

    public static function create($NomSupplement, $PrixSupplement) {
        $requete = "INSERT INTO Supplement(NomSupplement, PrixSupplement) VALUES ('$NomSupplement', '$PrixSupplement')";
        connexion::pdo()->query($requete);
    }

}
?>
