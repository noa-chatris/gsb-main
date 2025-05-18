<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://localhost/gsb-main/gsb-main/index.php?erreur=veuillez vous connecter");
    }
    else{
        if ($_SESSION["idRole"] == 1 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 2) {
            header("Location: http://localhost/gsb-main/gsb-main/comptable");
        } else {
            header("Location: http://localhost/gsb-main/gsb-main/index.php?erreur=connecter vous");
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
        <h2>Consulter mes fiches de frais</h2>
            <form>
                <label>Période</label> <br>
                <input type="month"> <br>
                <button type="submit">Afficher mes fiches</button>
            </form>
        </div>
    </body>
</html>