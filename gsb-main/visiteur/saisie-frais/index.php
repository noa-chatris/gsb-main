<!DOCTYPE html>
<?php
    include './connect.php';
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: https://gsb.lucas-lestiennes.fr/?erreur=veuillez vous connecter");
    }
    else{
        if ($_SESSION["idRole"] == 1 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 2) {
            header("Location: https://gsb.lucas-lestiennes.fr/comptable");
        } else {
            header("Location: https://gsb.lucas-lestiennes.fr/?erreur=veuillez vous connecter");
        }
    }
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Intranet - Visiteurs médicaux</title>
        <link rel="stylesheet" href="..\style.css">
    </head>
    <body>
        <?php include "../include/header.inc.php"; header_element("..", "..", "..", "../..");?>
        <div class="container">
            <h2>Renseigner une fiche de frais</h2>
            <form>
                <label>Date de la dépense</label>
                <input type="date" required> <br>
                
                <label>Montant (€)</label>
                <input type="number" required> <br>
                
                <label>Type de dépense</label>
                <select>
                    <option>Hébergement</option>
                    <option>Transport</option>
                    <option>Restauration</option>
                    <option>Autre</option>
                </select> <br>
                
                <label>Justificatif</label>
                <input type="file" accept=".pdf,.jpg,.png">
                <br>
                <label>Commentaire</label>
                <textarea></textarea>
                <br>
                <button type="submit">Soumettre</button>
            </form>
        </div>
    </body>
</html>