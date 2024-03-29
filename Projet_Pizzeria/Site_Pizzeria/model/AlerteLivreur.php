<?php
require_once("objet.php");

class AlerteLivreur extends objet {
    protected static string $classe = "AlerteLivreur";
    protected $ID_AlerteLivreur;
    protected $Message;
    protected $ID_Livreur;
    protected $ID_Gestionnaire;

    public function __construct($ID_AlerteLivreur = NULL, $Message = NULL, $ID_Livreur = NULL, $ID_Gestionnaire = NULL) {
        if (!is_null($ID_AlerteLivreur)) {
            $this->ID_AlerteLivreur = $ID_AlerteLivreur;
            $this->Message = $Message;
            $this->ID_Livreur = $ID_Livreur;
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
        return "AlerteLivreur $this->ID_AlerteLivreur (Message: $this->Message)";
    }

    public static function create($Message, $ID_Livreur, $ID_Gestionnaire) {
        $requete = "INSERT INTO AlerteLivreur(Message, ID_Livreur, ID_Gestionnaire) VALUES ('$Message', '$ID_Livreur', '$ID_Gestionnaire')";
        connexion::pdo()->query($requete);
    }
}
?>
