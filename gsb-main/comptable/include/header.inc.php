<?php
//cela permet de créer le header de la page
//et de l'inclure dans les pages
//cela permet de ne pas avoir à le réécrire à chaque fois
    function header_element($acceuil = ".", $suivi_paiment = ".", $validation_frais = ".", $logoff = "..", ){
        $visiteur = "";
            if ($_SESSION["idRole"] == 3){
                $visiteur = "<li><a href=\"http://127.0.0.1/visiteur/index.php\">Visiteur</a></li>";
            }
        echo "
            <div class=\"header\">
                <h1>Intranet Comptable</h1>
            </div>

            
            <nav class=\"navbar\">
                <ul class=\"centered-links\">
                    <li><a href=\"$acceuil/\">Acceuil</a></li>
                    <li><a href=\"$suivi_paiment/suivie-paiment\">Suivi des paiements</a></li>
                    <li><a href=\"$validation_frais/validation-frais\">Validation des fiches de frais</a></li>
                </ul>
                <ul class=\"right-aligned\">
                    <li><p>$_SESSION[nom] $_SESSION[prenom]</p></li>
                    $visiteur
                    <li class=\"bouton_logoff\"><a href=\"$logoff/logoff.php\">Déconnection</a></li>
                </ul>
            </nav>
           
            "; //<img alt=\"Logo\" src='../../src/gsb logo 2.png'>
    }
?>