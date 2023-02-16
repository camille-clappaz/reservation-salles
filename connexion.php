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
                header('location:index.php');
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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Reservation Salles</title>
</head>

<body>
    <?php include("header-include.php"); ?>
<main class="mainform">
    <div class="login-box">
        <h1>Connexion</h1>
        <form method="POST">
            <div class="user-box"> 
                <input type="text" name="login">
                <label>Login</label>
            </div>
            <div class="user-box">
                <input type="password" name="password">
                <label>Mot de passe</label>
            </div>
            <a class="button" href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button type="submit" name="submit">Se connecter</button>
            </a>

            <div class="message"><?= $message ?></div>

        </form>
        <div class="petitmsg">
            <span>Vous n'avez pas encore de compte ? <a class="petitmsg2" href="inscription.php">Inscrivez-vous !</a></span>
        </div>
    </div>
    </main>
    <footer>
    <?php include("footer-include.php"); ?>
    </footer>
</body>

</html>