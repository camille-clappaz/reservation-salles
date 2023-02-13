<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:connexion.php');
}

$bd = new mysqli('localhost', 'root', '', 'reservationsalles');
$sql = 'SELECT * FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
$message = "";
?>

<!DOCTYPE html>
<html lang="fr">

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Reservation Salles</title>
</head>
<?php
$sql2 = 'SELECT * FROM reservations';
$request2 = $bd->query($sql2);
$result2 = $request2->fetch_all(MYSQLI_ASSOC);

foreach ($result as $key => $value) {
    if ($value['login'] == $_SESSION['login']) {
        $id = $value['id'];
        $login = $value['login'];
    }
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['titre']) && !empty($_POST['date']) && !empty($_POST['descri'])) {
        $titre = $_POST['titre'];
        $debut = $_POST['date'] . " " . $_POST['debut'] . ":00";
        $fin = $_POST['date'] . " " .  $_POST['fin'] . ":00";
        $debut = $_POST['date'] . " " . $_POST['debut'] . ":00";
        $fin = $_POST['date'] . " " .  $_POST['fin'] . ":00";
        $descri = $_POST['descri'];
        $sql2 = "INSERT INTO `reservations`(`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$descri','$debut','$fin','$id')";
        $sql2 = "INSERT INTO `reservations`(`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$descri','$debut','$fin','$id')";
        $request2 = $bd->query($sql2);
        //header('location:planning.php');
    } else {
        $message = "Vous devez remplir tout les champs !";
    }
}
?>


<body>
    <?php include("header-include.php"); ?>
    <main class="mainresa">
        <div class="login-box">
            <h1>Formulaire de Réservation</h1>
            <form method="POST">
                <div>
                    <label>Utilisateur: <?= $_SESSION['login'] ?></label>
                </div>

                <div class="user-box">
                    <label>Titre de la réservation :</label>
                    <input type="text" name="titre">
                </div>

                <div class="user-box">
                    <label>Veuillez saisir votre date :</label>
                    <input type="date" name="date" required pattern="\d{4}-\d{2}-\d{2}">
                </div>

                <div class="user-box">
                    <label>L'heure du début :</label>
                    <input type="time" name="debut" value="08:00">
                </div>

                <div class="user-box">
                    <label>L'heure de fin :</label>
                    <input type="time" name="fin" value="10:00">
                </div>

                <div class="user-box">
                    <label>Description :</label></br>
                    <textarea rows="10" cols="40" type="text" name="descri" placeholder="Un commentaire a nous laisser ?"></textarea>
                </div>

                <a class="button" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <button type="submit" name="submit">Réserver</button>
                </a>

                <div class="message"><?= $message ?></div>
            </form>
    </main>
    <footer>
        <?php include("footer-include.php"); ?>
    </footer>
</body>

</html>