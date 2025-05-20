<?php
    include '../../connect.php';
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://GestionFrais.5.gsb/?erreur=veuillez vous connecter");
        exit();
    }
    else{
        if ($_SESSION["idRole"] == 1 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 2) {
            header("Location: http://GestionFrais.5.gsb/comptable");
            exit();
        } else {
            header("Location: http://GestionFrais.5.gsb/?erreur=veuillez vous connecter");
            exit();
        }
    }
    $month = date('n');
    if (isset($_POST["Id"])){
        $res = $connexion -> exec("DELETE FROM LigneFraisHorsForfait WHERE Id=$_POST[Id];");
    }
    header("Location: http://GestionFrais.5.gsb/visiteur/saisie-frais");
?>