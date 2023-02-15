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
    <!-- <link rel="stylesheet" href="styletest.css"> -->
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
    $debutdate = $_POST['date'] . " " . $_POST['debut'] . ":00"; // recuperer la date au format date + heure
    if (!empty($_POST['titre']) && !empty($_POST['date']) && !empty($_POST['descri'])) { // si tout les champs sont remplis
        if ($debutdate > date('Y-m-d H:i:s')) { // si la date n'est pas dans le passé
            $sous = $_POST['fin'] - $_POST['debut'];
            if ($sous == 1) { // si les crénaux ne sont pas plus d'une heure
                $jourdelasemaine = date("l", strtotime($_POST['date']));
                var_dump($jourdelasemaine);
                if ($jourdelasemaine != "Saturday" && $jourdelasemaine != "Sunday") {
                    $titre = $_POST['titre'];
                    $debut = $_POST['date'] . " " . $_POST['debut'] . ":00";
                    $fin = $_POST['date'] . " " .  $_POST['fin'] . ":00";
                    $descri = $_POST['descri'];
                    $sql2 = "INSERT INTO `reservations`(`titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$descri','$debut','$fin','$id')";
                    $request2 = $bd->query($sql2);
                    // header('location:planning.php');
                } else {
                    $message = "vous ne pouvez pas réserver le weekend, choississez une date en semaine !";
                }
            } else {
                $message = "Vous ne pouvez choisir que des crénaux d'une heure !";
            }
        } else {
            $message = "Vous ne pouvez pas choisir une date deja passé !";
        }
    } else {
        $message = "Vous devez remplir tout les champs !";
    }
}

?>

<body>
    <?php include("header-include.php"); ?>
    <main class="mainresa">
        <div class="login-boxR">
            <h1>Formulaire de Réservation</h1>

            <form method="POST">

                <div class="user-boxR">
                    <p class="userresa">Utilisateur: <?= $_SESSION['login'] ?></p>

                </div>

                <div class="user-boxR">
                    <input type="text" name="titre">
                    <label>Titre de la réservation :</label>

                </div>

                <div class="user-boxR">
                    <input type="date" name="date" required pattern="\d{4}-\d{2}-\d{2}">

                </div>

                <div class="user-boxR">
                    
                    <select name="debut">
                        <option value="08">8h</option>
                        <option value="09">9h</option>
                        <option value="10">10h</option>
                        <option value="11">11h</option>
                        <option value="12">12h</option>
                        <option value="13">13h</option>
                        <option value="14">14h</option>
                        <option value="15">15h</option>
                        <option value="16">16h</option>
                        <option value="17">17h</option>
                        <option value="18">18h</option>
                    </select>
                    <label for="debut"> Heure de début:</label>
                </div>

                <div class="user-boxR">

                    <select name="fin">
                        <option value="09">9h</option>
                        <option value="10">10h</option>
                        <option value="11">11h</option>
                        <option value="12">12h</option>
                        <option value="13">13h</option>
                        <option value="14">14h</option>
                        <option value="15">15h</option>
                        <option value="16">16h</option>
                        <option value="17">17h</option>
                        <option value="18">18h</option>
                        <option value="19">19h</option>
                    </select>
                    <label for="fin"> Heure de fin:</label>

                </div>

                <!-- <div class="user-boxR">
                <label>L'heure du début :</label>
                <input type="time" name="debut" value="08:00">
            </div>
            <div class="user-boxR">
                <label>L'heure de fin :</label>
                <input type="time" name="fin" value="09:00">
            </div> -->

                <div class="user-boxR">
                    <h2>Description :</h2>

                    <textarea rows="5" cols="40" type="text" name="descri"></textarea> <br>

                </div>

                <a class="buttonR" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <button type="submit" name="submit">Réserver</button>
                </a>

                <div class="message"><?= $message ?></div>
            </form>
        </div>

    </main>
    <footer>
        <?php include("footer-include.php");
        ?>
    </footer>
</body>

</html>