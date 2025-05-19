<!DOCTYPE html>
<?php
    include __DIR__ . '/../../connect.php';
    session_start();
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
        <link rel="stylesheet" href="..\style.css">
    </head>
        <?php include "../include/header.inc.php"; header_element("..", "..", "..", "../..");?>
        <div class="container">
        <h2>Valider une fiche de frais</h2>
            <form> <br>
                <label>Sélection du visiteur</label>
                <select>
                    <option>Visiteur 1</option>
                    <option>Visiteur 2</option>
                </select>
                <br>
                <label>Liste des frais soumis</label>
                <textarea disabled>Affichage des frais en attente...</textarea>
                <br>
                <label>Commentaire</label>
                <textarea></textarea>
                <br>
                <button type="submit">Accepter</button>
                <button type="submit">Refuser</button>
            </form>
        </div>
    </body>
</html>