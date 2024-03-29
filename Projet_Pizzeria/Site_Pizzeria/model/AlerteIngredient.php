<?php
require_once("objet.php");

class AlerteIngredient extends objet {
    protected static string $classe = "AlerteIngredient";
    protected $ID_Alerte;
    protected $Message;
    protected $ID_Ingredient;
    protected $ID_Gestionnaire;

    public function __construct($ID_Alerte = NULL, $Message = NULL, $ID_Ingredient = NULL, $ID_Gestionnaire = NULL) {
        if (!is_null($ID_Alerte)) {
            $this->ID_Alerte = $ID_Alerte;
            $this->Message = $Message;
            $this->ID_Ingredient = $ID_Ingredient;
            $this->ID_Gestionnaire = $ID_Gestionnaire;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "AlerteIngredient $this->ID_Alerte (Message: $this->Message)";
    }

    public static function create($Message, $ID_Ingredient, $ID_Gestionnaire) {
        $requete = "INSERT INTO AlerteIngredient(Message, ID_Ingredient, ID_Gestionnaire) VALUES ('$Message', '$ID_Ingredient', '$ID_Gestionnaire')";
        connexion::pdo()->query($requete);
    }
}
?>
