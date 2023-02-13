<?php
session_start();
// if (!isset($_SESSION['login'])) {
//     header('location:connexion.php');
// }

$bd = new mysqli('localhost', 'root', '', 'reservationsalles');
$sql = 'SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id=id_utilisateur';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
$message = "";
$_SESSION = $result[0];
var_dump($_SESSION);
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
<?php

$lundi = date('d-m-Y', strtotime('monday this week'));
$mardi = date('d-m-Y', strtotime('tuesday this week'));
$mercredi = date('d-m-Y', strtotime('wednesday this week'));
$jeudi = date('d-m-Y', strtotime('thursday this week'));
$vendredi = date('d-m-Y', strtotime('friday this week'));


?>

<body>
    <?php include("header-include.php"); ?>

    <div class="container">
        <table class="tab">
            <thead>
                <tr>
                    <th class="vide"> </th>
                    <th class="ptab1">Lundi <?= $lundi ?></th>
                    <th class="ptab1">Mardi <?= $mardi ?></th>
                    <th class="ptab1">Mercredi <?= $mercredi ?></th>
                    <th class="ptab1">Jeudi <?= $jeudi ?></th>
                    <th class="ptab1">Vendredi <?= $vendredi ?></th>
                </tr>
            </thead>
            <tbody>
                <?php


                for ($ligne = 8; $ligne <= 19; $ligne++) {
                    echo '<tr>';
                    echo '<td>' . $ligne . 'h</td>';
                    for ($colonne = 1; $colonne <= 5; $colonne++) {
                        echo '<td>';
                        foreach ($result as $value) {
                            $id = $_SESSION['id'];
                            $jour = date("N", strtotime($value['debut']));
                            $heure =  date("H", strtotime($value['debut']));
                            if ($heure == $ligne && $jour == $colonne) {
                                echo $value['login'] . $value['titre'];
                            }
                        }
                    }
                }


                ?>
            </tbody>

        </table>
    </div>
</body>

</html>