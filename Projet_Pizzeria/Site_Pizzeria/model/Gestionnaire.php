<?php
require_once("objet.php");

class Gestionnaire extends objet {
    protected static string $classe = "Gestionnaire";
    protected $ID_Gestionnaire;
    protected $loginGestionnaire;
    protected $MotPasseGestionnaire;
    protected $MailGestionnaire;

    public function __construct($ID_Gestionnaire = NULL, $loginGestionnaire = NULL, $MotPasseGestionnaire = NULL, $MailGestionnaire = NULL) {
        if (!is_null($ID_Gestionnaire)) {
            $this->ID_Gestionnaire = $ID_Gestionnaire;
            $this->loginGestionnaire = $loginGestionnaire;
            $this->MotPasseGestionnaire = $MotPasseGestionnaire;
            $this->MailGestionnaire = $MailGestionnaire;
        }
    }

    public function get($attribut) {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void {
        $this->$attribut = $valeur;
    }

    public function __toString() {
        return "Gestionnaire $this->ID_Gestionnaire ($this->loginGestionnaire $this->MotPasseGestionnaire)";
    }

    public static function getAll() {
        $classeRecuperee = static::$classe;
        $requete = "SELECT * FROM $classeRecuperee;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS, $classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }

    public static function create($loginGestionnaire, $MotPasseGestionnaire, $MailGestionnaire) {
        $requete1 = "INSERT INTO Gestionnaire(loginGestionnaire, MotPasseGestionnaire, MailGestionnaire) VALUES ('$loginGestionnaire', '$MotPasseGestionnaire', '$MailGestionnaire')";
        connexion::pdo()->query($requete1);
    }
}
?>
