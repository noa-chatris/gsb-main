<!DOCTYPE html>
<?php
    include './connect.php';
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: https://gsb.lucas-lestiennes.fr/?erreur=veuillez vous connecter");
    }
    else{
        if ($_SESSION["idRole"] == 2 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 1) {
            header("Location: https://gsb.lucas-lestiennes.fr/visiteur");
        } else {
            header("Location: https://gsb.lucas-lestiennes.fr/?erreur=veuillez vous connecter");
        }
    }
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Intranet - Comptable</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <?php include "./include/header.inc.php"; header_element();?>
        <div class="container">
            <h3>Validation des fiches de frais</h3>
            <p>Sélection d’un visiteur et d’un mois <br>
                Affichage des détails de la fiche <br>
                Modification des frais forfaitisés <br>
                Suppression ou report des frais hors forfait <br>
                Bouton pour valider la fiche</p>
            <h3>Suivi des paiements</h3>
            <p>Liste des fiches en attente de paiement <br>
                Détail des fiches mises en paiement <br>
                Bouton pour marquer comme "Remboursé"</p>
        </div>
    </body>
</html>