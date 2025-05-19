<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- cela sert a indiquer a google que la page est en anglais -->
        >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./src/gsb logo 2">
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
            // On démarre la session
            // On vérifie si l'utilisateur est déjà connecté
            include './connect.php';
            include './closeOpenFiche.php';
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $res = $connexion -> query("SELECT * FROM Visiteur WHERE login = '$login' AND password = '$password'");
            $res = $res -> fetch();
            // On vérifie si le mot de passe et le login sont corrects
            // Si oui, on redirige vers la page d'accueil selon son rôle
            // Sinon, on affiche un message d'erreur
            if ($res){
                $_SESSION["nom"] = $res["nom"];
                $_SESSION["prenom"] = $res["prenom"];
                if ($res["idRole"] == 2){
                    $_SESSION["idRole"]= 2;
                    $_SESSION["idUser"]= $res["IdVisiteur"];
                    header("Location: http://localhost/gsb-main/gsb-main/comptable/index.php");
                    exit();
                }
                if ($res["idRole"] == 1){
                    $_SESSION["idRole"]= 1;
                    $_SESSION["idUser"]= $res["IdVisiteur"];
                    header("Location: http://localhost/gsb-main/gsb-main/visiteur/index.php");
                    close($connexion,$res["IdVisiteur"]);
                    exit();
                }
                if ($res["idRole"] == 3){
                    $_SESSION["idRole"]= 3;
                    $_SESSION["idUser"]= $res["IdVisiteur"];
                    header("Location: http://localhost/gsb-main/gsb-main/comptable/index.php");
                    close($connexion,$res["IdVisiteur"]);
                    exit();
                }
            }
            // On affiche un message d'erreur si le mot de passe ou le login sont incorrects
            // On redirige vers la page de connexion après 10 secondes
            echo "
            <script>
                function sleep(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }
                async function relocate() {
                    await sleep(1000);
                    window.location.href = './index.php ?erreur=Identifiant ou mot de passe incorrect';
                }
                relocate();
            </script>
            ";
            sleep(1);
        ?>
    </body>
</html>
