<!DOCTYPE html>
<?php
// j'y connecte la base de données
    include '../../connect.php';
// je démarre la session
    // je vérifie si l'utilisateur est connecté
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://127.0.0.1/index.php?erreur=veuillez vous connecter");
    }
    // je vérifie si l'utilisateur est un visiteur médical
    // ou un comptable
    else{
        if ($_SESSION["idRole"] == 1 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 2) {
            header("Location: http://127.0.0.1/comptable");
        } else {
            header("Location: http://127.0.0.1/index.php?erreur=connecter vous");
        }
    }
    $month = date('n');
    if (isset($_POST["number_ETP"])){
        $connexion -> exec("UPDATE LigneFraisForfait SET quantite = $_POST[number_ETP] WHERE IdVisiteur = $_SESSION[idUser] AND Mois = $month AND idFrais = 'ETP'");
        $connexion -> exec("UPDATE LigneFraisForfait SET quantite = $_POST[number_KM] WHERE IdVisiteur = $_SESSION[idUser] AND Mois = $month AND idFrais = 'KM'");
        $connexion -> exec("UPDATE LigneFraisForfait SET quantite = $_POST[number_NUI] WHERE IdVisiteur = $_SESSION[idUser] AND Mois = $month AND idFrais = 'NUI'");
        $connexion -> exec("UPDATE LigneFraisForfait SET quantite = $_POST[number_REP] WHERE IdVisiteur = $_SESSION[idUser] AND Mois = $month AND idFrais = 'REP'");
    }
    if (isset($_POST["new_date"]) && $_POST["new_date"] != ''){
        $connexion -> exec("INSERT INTO LigneFraisHorsForfait(IdEtat, IdVisiteur, Mois, dateHorsFrais, montant, libelle) VALUES('CR', $_SESSION[idUser], $month, '$_POST[new_date]', '$_POST[new_price]', '$_POST[new_libelle]')");
    }
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../src/gsb logo 2">

        <title>Intranet - Visiteurs médicaux</title>
        <link rel="stylesheet" href="..\style.css">
    </head>
    <body>
        <?php include "../include/header.inc.php"; header_element("..", "..", "..", "../..");?>
        <div class="container">
            <h1>Compléter la fiche de frais</h1>
            <h2>Compléter les Frais compris</h2>
            <form method="post" action="./">
                <table>
                    <?php
                        $month = date('n');
                        $res_2 = $connexion -> query("SELECT libelle, quantite, LigneFraisForfait.idFrais FROM LigneFraisForfait INNER JOIN FraisForfais ON FraisForfais.idFrais = LigneFraisForfait.idFrais WHERE Mois = $month AND IdVisiteur = $_SESSION[idUser]; ") -> fetchAll();
                        foreach ($res_2 as $e){
                            echo "<tr><td><label for=\"number_$e[2]\">$e[0]</label></td><td><input style=\"margin-left:5px;\" required=\"required\" type=\"number_$e[2]\" id=\"number_$e[2]\" name=\"number_$e[2]\" value=\"$e[1]\"></td></tr>";
                        }
                    ?>
                </table>
                <br>
                <br>
                <h2>Compléter les Frais Hors Forfait</h2>
                <table style="width: 41vw;">
                    <?php
                        $month = date('n');
                        $res_2 = $connexion -> query("SELECT libelle , dateHorsFrais, montant, Id FROM LigneFraisHorsForfait WHERE LigneFraisHorsForfait.Mois = $month AND LigneFraisHorsForfait.IdVisiteur = $_SESSION[idUser];") -> fetchAll();
                        echo "<form method='post' action='deleteFiche.php'><input type='hidden' name='None' value='0'><input id='invisible' type='submit' value=''></form>";
                        foreach ($res_2 as $e){
                            echo "<tr>
                                    <td>$e[libelle]</td>
                                    <td>$e[dateHorsFrais]</td>
                                    <td>$e[montant]</td>
                                    <td><form method='post' action='deleteFiche.php'><input type='hidden' name='Id' value='".$e["Id"]."'><input type='submit' value='supprimer'></form></td>
                                </tr>";
                        }
                    ?>
                    <tr><td><input placeholder="entrer le libelle" name="new_libelle"/></td><td>Sélectionner la date:<input type="date" name="new_date"></td><td>Montant:<input type="number" name="new_price"></td></tr>
                </table>
                <input type="submit" value="Soumettre"/>
            </form>
        </div>
    </body>
</html>