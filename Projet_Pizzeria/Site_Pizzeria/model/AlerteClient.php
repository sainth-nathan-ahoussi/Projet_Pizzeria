<?php
require_once("objet.php");

class AlerteClient extends objet {
    protected static string $classe = "AlerteClient";
    protected $ID_AlerteClient;
    protected $Message;
    protected $ID_Client;
    protected $ID_Gestionnaire;

    public function __construct($ID_AlerteClient = NULL, $Message = NULL, $ID_Client = NULL, $ID_Gestionnaire = NULL) {
        if (!is_null($ID_AlerteClient)) {
            $this->ID_AlerteClient = $ID_AlerteClient;
            $this->Message = $Message;
            $this->ID_Client = $ID_Client;
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
        return "AlerteClient $this->ID_AlerteClient (Message: $this->Message)";
    }

    public static function create($Message, $ID_Client, $ID_Gestionnaire) {
        $requete = "INSERT INTO AlerteClient(Message, ID_Client, ID_Gestionnaire) VALUES ('$Message', '$ID_Client', '$ID_Gestionnaire')";
        connexion::pdo()->query($requete);
    }

}
?>
