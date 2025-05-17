<?php
    session_start();
    $_SESSION["idRole"] = NULL;
    $_SESSION["idUser"] = NULL;
    session_abort();
    session_destroy();
    header("Location: index.php");
?>