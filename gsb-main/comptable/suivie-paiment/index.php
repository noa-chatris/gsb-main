<!DOCTYPE html>
<?php
    
    session_start();
    include '../../connect.php';
     
    if (!isset($_SESSION["idUser"])) {
        header("Location: https://127.0.0.1/?erreur=veuillez vous connecter");
    }
    else{
        if ($_SESSION["idRole"] == 2 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 1) {
            header("Location: https://127.0.0.1/visiteur");
        } else {
            header("Location: https://127.0.0.1/?erreur=veuillez vous connecter");
        }
    }
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Intranet - Comptable</title>
        <link rel="stylesheet" href="..\style.css">
    </head>
    <body>
        <?php include "../include/header.inc.php"; header_element("..", "..", "..", "../..");?>
        <div class="container">
        <h2>Suivre le paiement des fiches de frais</h2>
            <form>
                <label>Numéro de fiche de frais</label>
                <br> <input type="text" required> <br>
                
                <button type="submit">Vérifier l'état du paiement</button>
            </form>
        </div>
    </body>
</html>