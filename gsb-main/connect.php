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
?>