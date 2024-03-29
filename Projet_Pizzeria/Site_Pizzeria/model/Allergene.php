<?php
require_once("objet.php");

class Allergene extends objet {
    protected static string $classe = "Allergene";
    protected $ID_Allergene;
    protected $NomAllergene;
    protected $EffetAllergene;

    public function __construct($ID_Allergene = NULL, $NomAllergene = NULL, $EffetAllergene = NULL) {
        if (!is_null($ID_Allergene)) {
            $this->ID_Allergene = $ID_Allergene;
            $this->NomAllergene = $NomAllergene;
            $this->EffetAllergene = $EffetAllergene;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Allergene $this->ID_Allergene (Nom: $this->NomAllergene)";
    }

    public static function create($NomAllergene, $EffetAllergene) {
        $requete = "INSERT INTO Allergene(NomAllergene, EffetAllergene) VALUES ('$NomAllergene', '$EffetAllergene')";
        connexion::pdo()->query($requete);
    }
}
?>
