<?php
//Connexion en local
    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=ludotheque', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch(PDOException $e)
        {
            die('Erreur : '.$e->getMessage());
        }
?>


