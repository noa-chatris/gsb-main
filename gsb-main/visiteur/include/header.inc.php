<?php
//cela permet de créer le header de la page
//et de l'inclure dans les pages
//cela permet de ne pas avoir à le réécrire à chaque fois
    //session_start();
    function header_element($acceuil = ".", $saisie_frais = ".", $consultation_frais = ".", $logoff = "..", ){
        $comptable = "";
        if ($_SESSION["idRole"] == 3){
            $comptable = "<li><a href=\"http://GestionFrais.5.gsb/comptable\">Comptable</a></li>";
        }
        echo "
            <div class=\"header\">
                <h1>Intranet visiteurs médicaux</h1>
            </div>

            <nav class=\"navbar\">
                <ul class=\"centered-links\">
                    <li><a href=\"$acceuil/\">Acceuil</a></li>
                    <li><a href=\"$saisie_frais/saisie-frais\">Saisie de frais</a></li>
                    <li><a href=\"$consultation_frais/consultation-frais\">Consultation fiche de frais</a></li>
                </ul>
                <ul class=\"right-aligned\">
                    <li><p></p></li>
                    <li><p>$_SESSION[nom] $_SESSION[prenom]</p></li>
                    $comptable
                    <li class=\"bouton_logoff\"><a href=\"$logoff/logoff.php\">Déconnection</a></li>
                </ul>
            </nav>
            ";
    }
?>