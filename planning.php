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

foreach ($result2 as $key => $value){
    if (isset($_SESSION['login']) == TRUE){

    }
}
$lundi = date('d/m/y',strtotime('monday this week'));
$mardi = date('d/m/y',strtotime('tuesday this week'));
$mercredi = date('d/m/y',strtotime('wednesday this week'));
$jeudi = date('d/m/y',strtotime('thursday this week'));
$vendredi = date('d/m/y',strtotime('friday this week'));
?>

<body>
    <?php include("header-include.php"); ?>

    <div class="container">
    <table>
      <tr>
        <th></th>
        <th>Lundi <?= $lundi ?></th>
        <th>Mardi <?= $mardi ?></th>
        <th>Mrecredi <?= $mercredi ?></th>
        <th>Jeudi <?= $jeudi ?></th>
        <th>Vendredi <?= $vendredi ?></th>
      </tr>
      <tr>
        <td>8h00-9h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>9h00-10h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>10h00-11h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>11h00-12h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>12h00-13h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>13h00-14h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>14h00-15h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>15h00-16h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>16h00-17h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>17h00-18h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>18h00-19h00</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </div>      
</body>

</html>
