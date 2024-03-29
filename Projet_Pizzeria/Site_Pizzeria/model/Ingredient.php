<?php
require_once("objet.php");

class Ingredient extends objet {
    protected static string $classe = "Ingredient";
    protected $ID_Ingredient;
    protected $NomIngredient;
    protected $QuantiteStock;
    protected $SeuilAlerte;

    public function __construct($ID_Ingredient = NULL, $NomIngredient = NULL, $QuantiteStock = NULL, $SeuilAlerte = NULL) {
        if (!is_null($ID_Ingredient)) {
            $this->ID_Ingredient = $ID_Ingredient;
            $this->NomIngredient = $NomIngredient;
            $this->QuantiteStock = $QuantiteStock;
            $this->SeuilAlerte = $SeuilAlerte;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Ingredient $this->ID_Ingredient (Nom: $this->NomIngredient)";
    }

    public static function create($NomIngredient, $QuantiteStock, $SeuilAlerte) {
        $requete = "INSERT INTO Ingredient(NomIngredient, QuantiteStock, SeuilAlerte) VALUES ('$NomIngredient', '$QuantiteStock', '$SeuilAlerte')";
        connexion::pdo()->query($requete);
    }
}
?>
