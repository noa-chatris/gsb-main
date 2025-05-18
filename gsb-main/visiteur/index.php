<?php
    session_start();
    
    if (!isset($_SESSION["idUser"])) {
        header("Location:  http://localhost/gsb-main/gsb-main/index.php?erreur=veuillez vous connecter");
        exit();
    }
    else{
        if ($_SESSION["idRole"] == 1 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 2) {
            header("Location: http://localhost/gsb-main/gsb-main/comptable");
        } else {
        header("Location: http://localhost/gsb-main/gsb-main/index.php?erreur=veuiller vous connecter");
        }
    }
?>  
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="../src/gsb logo 2">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Intranet - Visiteurs médicaux</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <?php include "./include/header.inc.php"; header_element();?>
        <div class="container">
            <h3>Saisie des frais</h3>
            <p>
                Formulaire pour entrer les frais forfaitisés (quantité pour chaque type) <br>
                Formulaire pour ajouter des frais hors forfait (date, libellé,montant) <br>
                Liste des frais saisis avec possibilité de modification/suppression
            </p>
            <h3>Consultation des fiches de frais</h3>
            <p>
                Sélecteur de mois pour afficher une fiche de frais <br>
                Tableau avec les frais forfaitisés et hors forfait <br>
                Indicateur d'état de la fiche (saisie, validée, mise en paiement, remboursée)
            </p>
        </div>
    </body>
</html>
