<?php
    require_once("model/Ville.php");

    class controllerVille{
      public static function displayAll(){
        $tableauVille = Ville::getAll();
        include("Compte.php");
      }
    }
    
  ?>