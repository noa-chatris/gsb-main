<?php
    //ce script permet de fermer les fiches de frais ouvertes
    //et de les mettre à l'état "cloturé"
    include './connect.php';
    function close($connexion,$idUser = NULL){
        $month = date('n');
        $day = date('d');
        if ($idUser){
            $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdEtat = 1 AND Mois != $month AND IdVisiteur = $idUser;") -> fetchAll();
        }
        else{
            $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdEtat = 1 AND Mois != $month ;") -> fetchAll();
        }
        if ($res != FALSE){
            foreach ($res as $x) {
                $connexion -> exec("UPDATE FicheFrais SET IdEtat = 2 WHERE IdVisiteur = $x[IdVisiteur] AND $x[Mois] != $month");
            }
        }
        else{
            $connexion -> exec("INSERT INTO FicheFrais(IdVisiteur, Mois, année) VALUES ($_SESSION[idUser],'$month', 0);");
        }
    }
?>