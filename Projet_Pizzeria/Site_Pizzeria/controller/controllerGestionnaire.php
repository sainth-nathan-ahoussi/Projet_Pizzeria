<?php
    require_once("model/Gestionnaire.php");
    $tableauGestionnaire = Gestionnaire::getAll();
    include("Compte.php");
    
  ?>
