<?php
session_start();
require_once(__DIR__. '/src/config/mysql.php');
require_once(__DIR__. '/src/config/connect.php');
require_once(__DIR__. '/src/partials/header.php');
require_once(__DIR__. '/src/partials/footer.php');

// $sql = 'SELECT * FROM beers
// JOIN user_beer ON user_beer.beer_id = beers.beer_id
// WHERE user_beer.user_id=:user_id';
// $request = $client->prepare($sql);
// $request->execute([
//     'user_id' => $_SESSION['user_id']
// ]);
// $recipes = $request->fetchAll();
$sql = 'SELECT * FROM beers
JOIN user_beer ON user_beer.beer_id = beers.beer_id';
$request = $client->prepare($sql);
$request->execute();
$beers = $request->fetchAll();
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeerDealer</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        #loader {
            display: none;
            width: 200px;
        }
    </style>
    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
        }

        function hideLoader() {
            document.getElementById('loader').style.display = 'none';
        }
    </script>
</head>

<body>
    <header>
        
    </header>
    <main>
        <section>
            <h1>BeerDealer</h1>
            <form action="api.php" method="post" onsubmit="showLoader()"> <!-- Lien vers api.php -->
                <input type="text" name="search" placeholder="Rechercher une bière..." >
                <button type="submit">Rechercher</button>
            </form>
            <h2>Liste des bières</h2>
            <ul>
                <?php foreach ($beers as $beer) :
                    $description = isset($beer['description'])? $beer['description'] : '';
                    $description = htmlspecialchars($description);
               ?>
                    <li>
                        <h3><?= htmlspecialchars($beer['name'])?></h3>
                        <p><?= $description?></p>
                        <a href="beer.php?id=<?= $beer['id']?>">Voir plus</a>
                    </li>
                <?php endforeach;?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 BeerDealer</p>
    </footer>
    <div id="loader">
        <svg xmlns=http://www.w3.org/2000/svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <circle cx="50" cy="50" fill="none" stroke="#49d1e0" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
        </svg>
    </div>
</body>

</html>