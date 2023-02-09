<?php
session_start();
$message = "";
$bd = new mysqli('localhost', 'root', '', 'reservationsalles');
$sql = 'SELECT login,password FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $mdp = $_POST['password'];
        foreach ($result as $resultat) {
            if ($login == $resultat['login'] && $mdp == $resultat['password']) {
                $_SESSION['login'] = $login;
                header('location:profil.php');
            } else {
                $message = "Le login et le mot de passe ne correspendent pas !";
            }
        }
    } else {
        $message = "Vous devez remplir tous les champs !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Reservation Salles</title>
</head>

<body class="body1">
    <?php include("header-include.php"); ?>

    <div class="container">
        <form class='form1' method="POST"> 

            <h1 class="h1from">Connexion</h1> 

            <div class="field">
                <label>Login :</label>
                <input type="text" name="login">
            </div>

            <div class="field">
                <label>Mot de passe :</label>
                <input type="password" name="password">
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Connexion">
            </div>

            <div class="message"><?= $message ?></div>

        </form>
        <div class="petitmsg">
        <span>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></span>
        </div>

</body>

</html>