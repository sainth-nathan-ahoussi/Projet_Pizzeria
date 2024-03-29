<?php
    require_once("model/Client.php");
    $tableauClients = Client::getAll();
    include("Compte.php");


  ?>