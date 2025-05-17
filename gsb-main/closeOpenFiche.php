<?php
    
    function close($connexion,$idUser = NULL){
        $month = date('n');
        $year = date('Y');
        $day = date('d');
        if ($idUser){
            $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdEtat = 1 AND Mois != $month AND année = $year AND IdVisiteur = $idUser;") -> fetchAll();
        }
        else{
            $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdEtat = 1 AND Mois != $month AND année = $year;") -> fetchAll();
        }
        if ($res != FALSE){
            foreach ($res as $x) {
                $connexion -> exec("UPDATE FicheFrais SET IdEtat = 2 WHERE IdVisiteur = $x[IdVisiteur] AND $x[Mois] != $month");
            }
        }
        else{
            $connexion -> exec("INSERT INTO FicheFrais VALUES('$_SESSION[idUser]', '$month', '$year', 0, )");
        }
    }
?>