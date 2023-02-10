<?php
session_start();
$mysqli=new mysqli('localhost', 'root', '', 'reservationsalles');
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
<?php include("header-include.php"); ?>
</header>

<main>
        <?php
        var_dump($_SESSION['id']);
        if (isset($_POST['submit'])) { // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            if (!empty($_POST["login"]) && !empty($_POST["password"])) {
                $id=$_SESSION['id'];
                $login = $_POST['login'];
                $password = $_POST['password'];
                if ($_POST['password'] == $_POST['confirmpassword']) {//Attention si on cherche par le login, on ne pourra pas le modifier
                    //donc il faut chercher par l'id.
                    $request = $mysqli->query("UPDATE `utilisateurs`  SET login='$login', password='$password' WHERE id LIKE'$id'");
                    header('Location:index.php');
                } else {
                    echo "Les mots de passe sont différents!";
                }
            } else {
                echo "il manque des trucs bro!";
            }
        }
        ?>

       
        <div class="login-box">
  <h2>Modifier le profil</h2>
  <form method="POST">
    <div class="user-box">
      <input  type="text" name="login" value="<?php
                                                        $login = $_SESSION['login'];
                                                        echo "$login"; ?>">
      <label>Login</label>
    <div class="user-box">
      <input  type="password" name="password" value="<?php
                                                                ?>">
      <label>Password</label>
    </div>
    <div class="user-box">
      <input  type="password" name="confirmpassword" value="<?php
                                                                       ?>">
      <label>Confirmation Password</label>
    </div>
    <a href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <button type="submit" name="submit" >Modifier le profil</button>
    </a>
  </form>
</div>

    </main>
    <footer><?php include("footer-include.php"); ?></footer>

</body>
</html>