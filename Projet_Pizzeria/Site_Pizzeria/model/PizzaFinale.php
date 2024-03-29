<?php
require_once("objet.php");

class PizzaFinale extends objet {
    protected static string $classe = "PizzaFinale";
    protected $ID_PizzaFinale;
    protected $PrixFinal;
    protected $DescriptionPizzaFinale;
    protected $ID_Pizza;

    public function __construct($ID_PizzaFinale = NULL, $PrixFinal = NULL, $DescriptionPizzaFinale = NULL, $ID_Pizza = NULL) {
        if (!is_null($ID_PizzaFinale)) {
            $this->ID_PizzaFinale = $ID_PizzaFinale;
            $this->PrixFinal = $PrixFinal;
            $this->DescriptionPizzaFinale = $DescriptionPizzaFinale;
            $this->ID_Pizza = $ID_Pizza;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "PizzaFinale $this->ID_PizzaFinale (Prix: $this->PrixFinal)";
    }

    public static function create($PrixFinal, $DescriptionPizzaFinale) {
        $requete = "INSERT INTO PizzaFinale(PrixFinal, DescriptionPizzaFinale) VALUES ('$PrixFinal', '$DescriptionPizzaFinale')";
        connexion::pdo()->query($requete);
    }
}
?>
