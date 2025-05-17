<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./src/logo.ico">
        <link rel="stylesheet" href="style.css">
        <title>Intranet GSB</title>
    </head>
    <div class="loader"></div> 
    <br>
    <br>
    <br>
    <body>
        <div class="animation-overlay">
            <div class="pulse-circle"></div>
        </div>
        <br>
        <br>
        <br>
        <?php
            session_start();
            include './connect.php';
            include './closeOpenFiche.php';
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $res = $connexion -> query("SELECT * FROM Visiteur WHERE nom = '$login' AND password = '$password'");
            $res = $res -> fetch();
            if ($res){
                $_SESSION["nom"] = $res["nom"];
                $_SESSION["prenom"] = $res["prenom"];
                if ($res["idRole"] == 2){
                    $_SESSION["idRole"]= 2;
                    $_SESSION["idUser"]= $res["IdVisiteur"];
                    
                    exit();
                }
                if ($res["idRole"] == 1){
                    $_SESSION["idRole"]= 1;
                    $_SESSION["idUser"]= $res["IdVisiteur"];
                   
                    close($connexion,$res["IdVisiteur"]);
                    exit();
                }
                if ($res["idRole"] == 3){
                    $_SESSION["idRole"]= 3;
                    $_SESSION["idUser"]= $res["IdVisiteur"];
                    
                    close($connexion,$res["IdVisiteur"]);
                    exit();
                }
            }
            echo "
            <script>
                function sleep(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }
                async function relocate() {
                    await sleep(1000);
                    window.location.href = 'index.php?erreur=Identifiant ou mot de passe incorrect';
                }
                relocate();
            </script>
            ";
            sleep(1);
        ?>
    </body>
</html>
