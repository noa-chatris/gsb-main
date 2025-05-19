<?php
    //cela permet de se déconnecter de la session
    session_start();
    $_SESSION["idRole"] = NULL;
    $_SESSION["idUser"] = NULL;
    session_abort();
    session_destroy();
    header("Location: index.php");
    //cela permet de rediriger vers la page d'accueil
?>