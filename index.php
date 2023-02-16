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

    <main>
        <div class="bienvenue">
            <div class="titre">
                <h1>Bienvenue au cinéma de Toulon</h1>
            </div>
        </div>
    
        <h2 class="titre2">Qui sommes nous ?</h2>
        <div class="cards">
                <div class="box">
                    <div class="box-inner">
                        <div class="box-front">
                            <img src="img/yas.jpg" alt="">
                        </div>

                        <div class="box-back">
                            <h1 class="nom">Yasmine</h1><br>
                            <p class="description">Etudiante passionée de programmation.</br>Ce que j'aime dans la vie? Jouer a LoL et developper des sites web ^^</p><br>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-inner">
                        <div class="box-front">
                            <img class="camille" src="img/camille.jpg" alt="">
                        </div>

                        <div class="box-back">
                            <h1 class="nom">Camille</h1><br>
                            <p class="description">Etudiante en développement web depuis quelques mois je suis passionnée de casses-têtes, donc suis passionnée par le code ;) </p><br>

                        </div>
                    </div>
                </div>
            
        </div>
    </main>
    <footer>
    <?php include("footer-include.php"); ?>
    </footer>
</body>

</html>