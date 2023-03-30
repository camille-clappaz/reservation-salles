<?php
session_start();
 if (!isset($_SESSION['login'])) {
    header('location:connexion.php');
 }

$bd = new mysqli('localhost', 'root', '', 'reservationsalles');
$sql = 'SELECT * FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
$message= "";
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
    <div>
        <h1 class="bonjour"><?= 'Bonjour, ' . $_SESSION['login'] ?></h1>
    </div>
<?php 
foreach ($result as $key => $value){
    if ($value['login'] == $_SESSION['login']){
        $id = $value['id'];
        $login = $value['login'];
        $mdp = $value['password'];
    }
}
if (isset($_POST['enregistrer'])) {
    if (!empty($_POST['login'])) {
        $login = !empty($_POST['login'])? $_POST['login']:$_SESSION['login'];
        $log = $_SESSION['login'];
        $sql = "UPDATE utilisateurs SET login = '$login' WHERE id = '$id'";
        if ($request = $bd->query($sql)) {
            $_SESSION['login'] = $login;
            header('refresh:0');
        }
    } 
    if (!empty($_POST['password1']) && !empty($_POST['password2'])){
        if ($_POST['password1'] == $_POST['password2']) {
        $mdp = $_POST['password1'];
        $sql = "UPDATE utilisateurs SET password = '$mdp' WHERE id = '$id'";
        $request = $bd->query($sql);
        } 
        else {
        $message = "Les deux mots de passe ne sont pas identiques !";
        }
    }
    else {
        $message = "Il faut remplir tous les champs de mot de passe !";
    }
}

if (isset($_POST['deconnexion'])){
    session_destroy();
    header('location:connexion.php');
}

?>
    <div class="login-box">
        <div class="popcorn">
        <img class="popcornimg" src="img/popcornlunettes.jpg" alt=""></div><br>
    <h1>Modifier le profil</h1>

        <form  method="POST"> 
            <div class="user-box">
            <input type="text" name="login" placeholder="<?php echo $login;?>">
                <label>Login </label>
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
        <button type="submit" name="submit">Enregistrer</button>
      </a>
            <div class="message"><?= $message ?></div>
        </form>
        
    </div>
    </main>
    <footer>
    <?php include("footer-include.php"); ?>
    </footer>
</body>
</html>