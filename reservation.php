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
<html lang="en">

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

foreach ($result as $key => $value){
    if ($value['login'] == $_SESSION['login']){
        $id = $value['id'];
        $login = $value['login'];
    }
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['titre']) && !empty($_POST['date']) && !empty($_POST['descri'])){
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
    }
    else {
        $message = "Vous devez remplir tout les champs !";
    }
} 
?>

<body>
<body>
    <?php include("header-include.php"); ?>

    <div class="container">
        <form class='form1' method="POST">

            <h1 class="h1from">Formulaire de Réservation</h1>

            <div>
                <label>Utilisateur: <?= $_SESSION['login'] ?></label>
            </div>

            <div class="field">
                <label>Titre de la réservation :</label>
                <input type="text" name="titre">
            </div>

            <div class="field">
                <label>Veuillez saisir votre date :
                    <input type="date" name="date" required pattern="\d{4}-\d{2}-\d{2}">
                </label>
            </div>

            <div class="field">
                <label>L'heure du début :</label>
                <input type="time" name="debut" value="08:00">
            </div>

            <div class="field">
                <label>L'heure de fin :</label>
                <input type="time" name="fin" value="10:00">
            </div>

            <div class="">
                <label>Description :</label></br>
                <textarea rows="10" cols="50" type="text" name="descri" placeholder="Un commentaire a nous laisser ?"></textarea>
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Envoyer">
            </div>

            <div class="message"><?= $message ?></div>
        </form>

</body>

</html>