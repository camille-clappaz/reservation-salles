<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="head">
            <nav>
                <ul class="menu">
                    <li><a class="list1" href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['login']) == TRUE) {
                    ?>
                        <li><a class="list1" href="profil.php">Profil</a></li>
                    <?php }
                    ?>
                    <?php if (isset($_SESSION['login']) != TRUE) {
                    ?>
                        <li><a class="list1" href="inscription.php">Inscription</a></li>
                        <li><a class="list1" href="connexion.php">Connexion</a></li>
                    <?php }
                    ?>


                    <li class="list1">Reservation
                        <ul class="sub-menu">
                            <li><a class="list1" href="planning.php">Planning</a></li>
                            <li><a class="list1" href="reservation.php">Formulaire de réservation</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['login']) == TRUE) {
                    ?>
                        <li><a class="list1" href="deconnexion.php">Deconnexion</a></li>
                    <?php }
                    ?>

                </ul>
            </nav>
        </div>
    </header>
</body>

</html>