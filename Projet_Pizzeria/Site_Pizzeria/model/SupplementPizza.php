<?php
require_once("objet.php");

class SupplementPizza extends objet {
    protected static string $classe = "SupplementPizza";
    protected $ID_SupplementPizza;
    protected $NomSupplementPizza;
    protected $PrixSupplementPizza;
    protected $ID_Ingredient;

    public function __construct($ID_SupplementPizza = NULL, $NomSupplementPizza = NULL, $PrixSupplementPizza = NULL, $ID_Ingredient = NULL) {
        if (!is_null($ID_SupplementPizza)) {
            $this->ID_SupplementPizza = $ID_SupplementPizza;
            $this->NomSupplementPizza = $NomSupplementPizza;
            $this->PrixSupplementPizza = $PrixSupplementPizza;
            $this->ID_Ingredient = $ID_Ingredient;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "SupplementPizza $this->ID_SupplementPizza (Nom: $this->NomSupplementPizza)";
    }

    public static function create($NomSupplementPizza, $PrixSupplementPizza, $ID_Ingredient) {
        $requete = "INSERT INTO SupplementPizza(NomSupplementPizza, PrixSupplementPizza, ID_Ingredient) VALUES ('$NomSupplementPizza', '$PrixSupplementPizza', '$ID_Ingredient')";
        connexion::pdo()->query($requete);
    }
}
?>
