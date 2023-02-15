<?php
session_start();

$bd = new mysqli('localhost', 'root', '', 'reservationsalles');
$sql = 'SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id=id_utilisateur';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
$message = "";
$results = $result[0];
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

<body class="plan">
    <?php include("header-include.php"); ?>
    <main>
        <div class="container">
            <table class="tab">
                <thead>
                    <tr>
                        <th class="ptab1"> </th>
                        <th class="ptab1">Lundi <?= $lundi ?></th>
                        <th class="ptab1">Mardi <?= $mardi ?></th>
                        <th class="ptab1">Mercredi <?= $mercredi ?></th>
                        <th class="ptab1">Jeudi <?= $jeudi ?></th>
                        <th class="ptab1">Vendredi <?= $vendredi ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $dt = new DateTime();
                     if (isset($_GET['year']) && isset($_GET['week'])) {
                         $dt->setISODate($_GET['year'], $_GET['week']);
                     } else {
                         $dt->setISODate($dt->format('o'), $dt->format('W'));
                     }
                     $year = $dt->format('o');
                     $week = $dt->format('W');
                     $month = $dt->format('F');

                    $count=0;
                    for ($ligne = 8; $ligne <= 19; $ligne++) {
                        
                        echo '<tr>';
                        echo '<td class="ptab2">' . $ligne . 'h</td>';
                        for ($colonne = 1; $colonne <= 5; $colonne++) {
                            echo '<td class="ptab2">';
                            foreach ($result as $value) {
                                $id = $results['id'];
                                $jour = date("N", strtotime($value['debut']));
                                $heure =  date("H", strtotime($value['debut']));
                                $semaine = date("W",strtotime($value['debut']));
                                $annee = date("o",strtotime($value['debut']));
                                if ($heure == $ligne && $jour == $colonne  && $annee == $year  && $semaine == $week) {
                                   $count++;
                                    echo "Login: " . $value['login']  . '<br>' . "Titre: " . $value['titre'] . '<br>' .
                                        "<div class='box3'>
	                                        <a class='buttonP' href='#popup$count'>Détails</a>
                                             <div id='popup$count' class='overlay'>
                                                <div class='popup'>
                                                    <a class='close' href='#'>&times;</a>
                                                    <div class='content'>
                                                        <p>$value[login]</p><br>
                                                        <p>Titre: $value[titre]</p><br>
                                                        <p>$value[description]</p><br>
                                                        <p>$heure h</p><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>". '</td>';
                                       

                                        
                                }
                            }
                        }
                       
                    }





                    ?>
                </tbody>

            </table>
        </div>
    </main>

    <footer>
        <?php include("footer-include.php"); ?>
    </footer>
</body>

</html>