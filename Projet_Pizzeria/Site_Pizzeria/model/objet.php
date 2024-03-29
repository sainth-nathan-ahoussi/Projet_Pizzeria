
<?php

class objet{
    public function __get($attribut) {
        return $this->$attribut;
    
}

public function __set($attribut, $valeur) : void  {
        $this->$attribut = $valeur;

}

public static function getAll(){
        $classeRecuperee = static::$classe;
        $requete = "SELECT * FROM $classeRecuperee;";
        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // traitement de la réponse par le prisme de la classe bd
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        // récupération des instances de bd dans une variable $tableau
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
}

?>


