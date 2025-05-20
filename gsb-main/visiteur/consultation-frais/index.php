<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://127.0.0.1/index.php?erreur=veuillez vous connecter");
    }
    else{
        if ($_SESSION["idRole"] == 1 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 2) {
            header("Location: http://127.0.0.1/comptable");
        } else {
            header("Location: http://127.0.0.1/index.php?erreur=connecter vous");
        }
    }
    if (isset($_POST["number"])){
        $number = $_POST["number"];
    }
    else{
        $number = 1;
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
        <h2>Consulter mes fiches de frais</h2>
            <form action="./" method="post">
                <label for="number">Sélectionner le mois par son numéro</label>
                <?php echo "<input type=\"number\" id=\"number\" name=\"number\" min=\"1\" max=\"12\" value=\"$number\">"; ?>
                <input type="submit" value="Afficher les fiches">
            </form>
            <?php 
                if (isset($_POST["number"])){
                    $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdVisiteur = $_SESSION[idUser] AND Mois = '$_POST[number]'; ") -> fetch();
                    if ($res){
                        echo "<p>statut de la fiche : ".$connexion -> query("SELECT Libelle FROM Etat WHERE '$res[IdEtat]' = IdEtat;") -> fetch()[0]."</p>";
                        echo "<table>";
                        echo "<tr><th colspan='2'>Fiche du mois numéros $number</th></tr>";
                        echo "<tr><td colspan='2' class=\"pseudo_title\">frais forfait</td>";
                        $res_2 = $connexion -> query("SELECT libelle, quantite FROM LigneFraisForfait INNER JOIN FraisForfais ON FraisForfais.idFrais = LigneFraisForfait.idFrais WHERE Mois = $number AND IdVisiteur = $_SESSION[idUser]; ") -> fetchAll();
                        foreach ($res_2 as $e){
                            echo "<tr><td>$e[0]</td><td>$e[1]</td>";
                        }
                        echo "</table>";
                        echo "<table>";
                        echo "<tr><td colspan='4' class=\"pseudo_title\">frais hors forfait</td>";
                        $res_2 = $connexion -> query("SELECT LigneFraisHorsForfait.libelle as LF_libelle, dateHorsFrais, montant, Etat.Libelle as E_libelle FROM LigneFraisHorsForfait INNER JOIN Etat ON Etat.IdEtat = LigneFraisHorsForfait.IdEtat WHERE LigneFraisHorsForfait.Mois = $number AND LigneFraisHorsForfait.IdVisiteur = $_SESSION[idUser];") -> fetchAll();
                        foreach ($res_2 as $e){
                            echo "<tr><td>$e[0]</td><td>$e[1]</td><td>$e[2]</td><td>$e[3]</td>";
                        }
                        echo "</table>";
                    }
                    else{
                        echo "<br><p>aucune fiche n'existe pour le mois séléctionner</p>";
                    }
                }
            ?>
        </div>
    </body>
</html>