<?php
    function close($connexion,$idUser = NULL){
        $month = date('n');
        $day = date("Y-m-d");
        if ($idUser){
            try{
                $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdEtat = 'CR' AND Mois != $month AND IdVisiteur = $idUser;") -> fetchAll();
            }catch(PDOException $e){
                $res = FALSE;
            }
        }
        else{
            $res = $connexion -> query("SELECT * FROM FicheFrais WHERE IdEtat = 'CR' AND Mois != $month;") -> fetchAll();
        }
        if ($res != FALSE){
            foreach ($res as $x) {
                $connexion -> exec("UPDATE FicheFrais SET IdEtat = 'CL' WHERE IdVisiteur = $x[IdVisiteur] AND $x[Mois] != $month");
            }
        }
        else{
            if(!$connexion -> query("SELECT * FROM FicheFrais WHERE Mois = $month AND IdVisiteur = $_SESSION[idUser]") -> fetch()){
                $connexion -> exec("INSERT INTO FicheFrais(IdVisiteur, Mois, nbJustificatifs, dateModif, montantValide, IdEtat) VALUES($_SESSION[idUser], '$month', 0, '$day', 0, 'CR')");
                $connexion -> exec("INSERT INTO LigneFraisForfait(idFrais, IdEtat, IdVisiteur, Mois, quantite) VALUES('ETP', 'CR', $_SESSION[idUser], $month, 0)");
                $connexion -> exec("INSERT INTO LigneFraisForfait(idFrais, IdEtat, IdVisiteur, Mois, quantite) VALUES('KM',  'CR', $_SESSION[idUser], $month, 0)");
                $connexion -> exec("INSERT INTO LigneFraisForfait(idFrais, IdEtat, IdVisiteur, Mois, quantite) VALUES('NUI', 'CR', $_SESSION[idUser], $month, 0)");
                $connexion -> exec("INSERT INTO LigneFraisForfait(idFrais, IdEtat, IdVisiteur, Mois, quantite) VALUES('REP', 'CR', $_SESSION[idUser], $month, 0)");
                }
            }
    }
?>