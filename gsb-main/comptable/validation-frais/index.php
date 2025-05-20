<!DOCTYPE html>
<?php
    include __DIR__ . '/../../connect.php';
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://GestionFrais.5.gsb/index.php?erreur=connecter vous");
    }
    else{
        if ($_SESSION["idRole"] == 2 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 1) {
            header("Location: http://GestionFrais.5.gsb/visiteur");
        } else {
            header("Location: http://GestionFrais.5.gsb/index.php?erreur=connecter vous");
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
            <form method="post" action="./">
                <label for="visiteur">Choisissez le visiteur</label>
                <select name="visiteur" id="visiteur" required>
                    <option value="">-- Choisir --</option>
                    <?php
                        $res = $connexion -> query("SELECT IdVisiteur, nom, prenom FROM Visiteur WHERE idRole = 1 OR idRole = 3");
                        while ($row = $res->fetch()) {
                            echo "<option value=\"$row[IdVisiteur]\">{$row['prenom']} {$row['nom']}</option>";
                        }
                    ?>
                </select><br>
                <label for="mois">Choisissez le mois</label>
                <select name="mois" id="mois" required>
                    <option value="">-- Choisir --</option>
                    <?php
                        for($i =1; $i <= 12; $i ++) {
                            echo "<option value=\"{$i}\">{$i}</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="vallidez la séléction">
            </form>
                <?php 
                    if(isset($_POST["visiteur"])){
                        $res_1 = $connexion->query("SELECT * FROM FicheFrais WHERE Mois = $_POST[mois] AND $_POST[visiteur]")->fetch();
                        $res_2 = $connexion->query("SELECT libelle, IdEtat, quantite FROM LigneFraisForfait INNER JOIN FraisForfais ON FraisForfais.idFrais = LigneFraisForfait.idFrais WHERE Mois = $_POST[mois] AND $_POST[visiteur]")->fetchAll();
                        $res_3 = $connexion->query("SELECT libelle, montant, dateHorsFrais, IdEtat, Id FROM LigneFraisHorsForfait WHERE Mois = $_POST[mois] AND $_POST[visiteur]")->fetchAll();
                        if (!$res_1){
                            echo "pas de fiche pour cette utilisateur et cette période";
                        }
                        else{
                            echo "<h1>Fiche de Frais</h1><table>";
                            echo "<tr><td>libelle</td><td>Etat</td><td>quantité</td></tr>";
                            foreach($res_2 as $e){
                                echo "<tr><td>$e[0]</td><td>$e[1]</td><td>$e[2]</td></tr>";
                            }
                            echo "</table><table>";
                            echo "<tr><td>libelle</td><td>montant</td><td>dateHorsFrais</td><td>Etat</td></tr>";
                            echo "<form method='post' action='deleteFiche.php'><input type='hidden' name='None' value='0'><input id='invisible' type='submit' value=''></form>";
                            foreach($res_3 as $e){
                                echo "<tr>
                                        <td>$e[0]</td>
                                        <td>$e[1]</td>
                                        <td>$e[2]</td>
                                        <td>$e[3]</td>
                                        <td><form method='post' action='deleteFiche.php'><input type='hidden' name='Id' value='".$e[4]."'><input type='submit' value='supprimer'></form></td>
                                    </tr>";
                            }
                            echo "</table>";
                            echo "<form method='post' action='modificationEtat.php'><input type='hidden' name='Valid' value=1><input style='margin-top:20px;' type='submit' value='Vallidez'></form>";
                        }
                    }
                ?>
        </div>
    </body>
</html>