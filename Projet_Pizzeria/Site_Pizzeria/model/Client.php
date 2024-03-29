<?php
require_once("objet.php");

class Client extends objet {
    protected static string $classe = "Client";
    protected $ID_Client;
    protected $NomClient;
    protected $PrenomClient;
    protected $NumTelClient;
    protected $AdresseMailClient;
    protected $AdresseClient; 
    protected $aReductionClient;
    protected $MotDePasseClient;

    public function __construct($ID_Client = NULL, $NomClient = NULL, $PrenomClient = NULL, $NumTelClient = NULL, $AdresseMailClient = NULL, $AdresseClient = NULL, $aReductionClient = NULL, $MotDePasseClient = NULL) {
        if (!is_null($ID_Client)) {
            $this->ID_Client = $ID_Client;
            $this->NomClient = $NomClient;
            $this->PrenomClient = $PrenomClient;
            $this->NumTelClient = $NumTelClient;
            $this->AdresseMailClient = $AdresseMailClient;
            $this->AdresseClient = $AdresseClient;
            $this->aReductionClient = $aReductionClient;
            $this->MotDePasseClient = $MotDePasseClient;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Client $this->ID_Client ($this->NomClient $this->PrenomClient)";
    }

    public static function create($NomClient, $PrenomClient, $NumTelClient, $AdresseMailClient, $AdresseClient, $MotDePasseClient) {
    $requete1 = "INSERT INTO Client(ID_Client, NomClient, PrenomClient, NumTelClient, AdresseMailClient, AdresseClient, aReductionClient, MotDePasseClient) VALUES (null, '$NomClient', '$PrenomClient', '$NumTelClient', '$AdresseMailClient','$AdresseClient',null,'$MotDePasseClient')";
    connexion::pdo()->query($requete1);
}
}
?>
