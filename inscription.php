<?php
session_start();
$message = "";
$bd = new mysqli('localhost', 'root', '', 'reservationsalles');

if (isset($_POST['submit'])) {
  if (!empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
    $sql = 'SELECT login FROM utilisateurs';
    $request = $bd->query($sql);
    $result = $request->fetch_all(MYSQLI_ASSOC);
    $i = 0;
    foreach ($result as $value) {
      if ($value["login"] == $_POST['login']) {
        $message = "Ce login existe deja, utilisez un autre login !";
        $i++;
      }
    }
    if ($i == 0) {
      if ($_POST['password1'] == $_POST['password2']) {
        $login = $_POST['login'];
        $mdp = $_POST['password1'];
        $sql = "INSERT INTO utilisateurs(login, password) VALUES ('$login', '$mdp')";
        $request = $bd->query($sql);
        header('location:connexion.php');
      } else {
        $message = "Les deux mots de passe ne sont pas identiques !";
      }
      echo $message;
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

<body>
  <?php include("header-include.php"); ?>
<main>
  <div class="login-box">
    <h1>Inscription</h1>
    <form method="POST">
      <div class="user-box">
        <input type="text" name="login">
        <label>Login</label>
      </div>

      <div class="user-box">
        <input type="password" name="password1">
        <label>Mot de passe</label>
      </div>

      <div class="user-box">
        <input type="password" name="password2">
        <label>Confirmez le mot de passe</label>
      </div>

      <a class="button" href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <button type="submit" name="submit">Inscription</button>
      </a>

      <div class="message"><?= $message ?></div>
    </form>

    <div class="petitmsg">
      <span>Vous avez deja un compte ? <a class="petitmsg2" href="connexion.php">Connectez-vous !</a></span>
    </div>
  </div>
  </main>
  <footer>
    <?php include("footer-include.php"); ?>
  </footer>
</body>

</html>