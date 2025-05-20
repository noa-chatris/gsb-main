<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création user</title>
</head>
<body>
    <form method="post" action="creationUser.php">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password">
        <input type="text" name="nom" placeholder="nom">
        <input type="text" name="prenom" placeholder="prenom">
        <input type="text" name="addresse" placeholder="addresse">
        <input type="text" name="ville" placeholder="ville">
        <input type="text" name="cp" placeholder="cp">
        <input type="date" name="dateEmbauche" placeholder="dateEmbauche">
        <input type="number" name="role" placeholder="role">
        <input type="submit" value="click" name="submit">
    </form>

    <?php
        include '../../connect.php';
        session_start();
        if (!isset($_SESSION["idUser"])) {
            header("Location: http://127.0.0.1/?erreur=veuillez vous connecter");
        }
        else{
            if ($_SESSION["idRole"] == 3) {
                NULL;
            } elseif ($_SESSION["idRole"] == 2 || $_SESSION["idRole"] == 1) {
                header("Location: http://127.0.0.1/");
            } else {
                header("Location: http://127.0.0.1/?erreur=veuillez vous connecter");
            }
        }
        function add()
        {
            include './connect.php';
            $username = htmlspecialchars($_POST['username']);
            $password = stripslashes($_POST['password']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $adress = htmlspecialchars($_POST['addresse']);
            $city = htmlspecialchars($_POST['ville']);
            $postalCode = htmlspecialchars($_POST['cp']);
            $date = htmlspecialchars($_POST('dateEmbauche'));

            echo $date;

            /*
            $hash = password_hash(password_hash($_POST["username"], PASSWORD_ARGON2I).password_hash($_POST["password"], PASSWORD_ARGON2I), PASSWORD_ARGON2I);
            $connexion-> exec("INSERT INTO visiteur VALUES(null, \"$_POST[nom]\", \"$_POST[prenom]\", \"$_POST[addresse]\", \"$_POST[ville]\", \"$_POST[cp]\", \"$_POST[dateEmbauche]\", \"$hash\",$_POST[role])");
            */
        }
        
        if(isset($_POST['submit']))
        {
            add();
        } 
    ?>
</body>
</html>