<!DOCTYPE html>
<html lang="fr" >
    <head>
        <meta charset="UTF-8">
        <title>GSB : page de connexion</title>
        <link rel="icon" type="image/x-icon" href="../src/gsb logo 2.png">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <div class="screen-1 carte">
            <svg class="logo">
                <img src="src/gsb logo 2.png" alt="gsb logo 2">
            </svg>
            <form id="login-form" action="login.php" method="post">
                <div class="email">
                    <label for="email">Identifiant</label>
                    <div class="sec-2">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="login" name="login" placeholder="Identifiant"/>
                    </div>
                </div>
                <br>
                <div class="password">
                    <label for="password">Mot de passe</label>
                    <div class="sec-2">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input class="pas" type="password" name="password" placeholder="······"/>
                        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                    </div>
                </div>
                <button type="submit" class="login">S'identifier </button>
                <div class="footer"><span>Mot de passe perdu ?</span></div>
                <?php
                    // On démarre la session
                    // On vérifie si l'utilisateur est déjà connecté
                    session_start();
                    $_SESSION["idRole"] = NULL;
                    $_SESSION["idUser"] = NULL;
                    error_reporting(E_ERROR | E_PARSE);
                    try{
                        if ($_GET["erreur"]){
                            echo "<p>$_GET[erreur]</p>";
                        }
                        }catch(Error){
                            NULL;
                        }
                ?>
            </form>
        </div>
    </body>
</html>
