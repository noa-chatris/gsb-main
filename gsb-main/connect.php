<?php
    $dsn = 'mysql:host=localhost;dbname=gsb;charset=utf8';
    $user = 'root';
    $password = '';
    //$password = "root";
    try {
        $connexion = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        die('Echec de la connexion : '.$e->getMessage());
    }
    //tout cela est pour la connexion à la base de données
    //et ont fait un try catch pour éviter les erreurs de connexion
