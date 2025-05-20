<?php
    include '../../connect.php';
    session_start();
    if (!isset($_SESSION["idUser"])) {
        header("Location: http://GestionFrais.5.gsb/?erreur=veuillez vous connecter");
    }
    else{
        if ($_SESSION["idRole"] == 2 || $_SESSION["idRole"] == 3) {
            NULL;
        } elseif ($_SESSION["idRole"] == 1) {
            header("Location: http://GestionFrais.5.gsb/visiteur");
        } else {
            header("Location: http://GestionFrais.5.gsb/?erreur=veuillez vous connecter");
        }
    }
    $month = date('n');
    if (isset($_POST["Valid"])){
        $connexion -> exec("UPDATE FicheFrais SET IdEtat = 'VA' WHERE idVisiteur = $_SESSION[idUser] AND Mois = $month;");
    }
    header("Location: http://GestionFrais.5.gsb/comptable/validation-frais");
?>