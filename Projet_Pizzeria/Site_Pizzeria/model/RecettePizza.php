<?php
require_once("objet.php");

class RecettePizza extends objet {
    protected static string $classe = "RecettePizza";
    protected $ID_Pizza;
    protected $NomPizza;
    protected $DescriptionPizza;
    protected $PrixBasePizza;
    protected $imagePizza;

    public function __construct($ID_Pizza = NULL, $NomPizza = NULL, $DescriptionPizza = NULL, $PrixBasePizza = NULL, $imagePizza = NULL) {
        if (!is_null($ID_Pizza)) {
            $this->ID_Pizza = $ID_Pizza;
            $this->NomPizza = $NomPizza;
            $this->DescriptionPizza = $DescriptionPizza;
            $this->PrixBasePizza = $PrixBasePizza;
            $this->imagePizza = $imagePizza;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "RecettePizza $this->ID_Pizza (Nom: $this->NomPizza)";
    }

    public static function create($NomPizza, $DescriptionPizza, $PrixBasePizza, $imagePizza) {
        $requete = "INSERT INTO RecettePizza(NomPizza, DescriptionPizza, PrixBasePizza, imagePizza) VALUES ('$NomPizza', '$DescriptionPizza', '$PrixBasePizza', '$imagePizza')";
        connexion::pdo()->query($requete);
    }

    public static function getPizzaDetails($ID_Pizza, $selection) {
        $colonnesAutorisees = ['NomPizza', 'DescriptionPizza', 'PrixBasePizza', 'imagePizza'];
        if (!in_array($selection, $colonnesAutorisees)) {
            return null;
        }
        $requete = "SELECT $selection FROM RecettePizza WHERE ID_Pizza = '$ID_Pizza'";
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
