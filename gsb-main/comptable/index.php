<!DOCTYPE html>
<?php
    session_start();
    include '../connect.php';
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://localhost/gsb-main/gsb-main/index.php?erreur=connecter vous");
    }
    else{
        if ($_SESSION["idRole"] == 2 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 1) {
            header("Location: http://localhost/gsb-main/gsb-main/visiteur");
        } else {
            header("Location: http://localhost/gsb-main/gsb-main/index.php?erreur=connecter vous");
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