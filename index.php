<?php

session_start();

if (!isset($_SESSION['loggedUser'])) {
    header('Location: src/login.php');
}

require_once(__DIR__ . '/src/config/mysql.php');
require_once(__DIR__ . '/src/config/connect.php');

$sql = 'SELECT * FROM beers
JOIN user_beer ON user_beer.beer_id = beers.beer_id
WHERE user_beer.user_id=:user_id';
$request = $client->prepare($sql);
$request->execute([
    'user_id' => $_SESSION['user_id']
]);
$recipes = $request->fetchAll();

$sql = "SELECT beers.*, COUNT(user_beer.beer_id) as likes
        FROM beers 
        JOIN user_beer ON beers.beer_id = user_beer.beer_id 
        GROUP BY beers.name
        ORDER BY likes DESC";


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
    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'flex';
        }

        function hideLoader() {
            document.getElementById('loader').style.display = 'none';
        }
    </script>
</head>

<body>

<?php require_once(__DIR__ . '/src/partials/header.php'); ?>
<main>

    <form class="search-form" action="api.php" method="post" onsubmit="showLoader()"> <!-- Lien vers api.php -->
        <input type="text" name="search" placeholder="Rechercher une bière...">
        <input type="submit" value="Rechercher">
    </form>

    <section class="container">
        <h2>Les bières les plus populaires</h2>
        <div class="data">
            <?php foreach ($beers as $beer): ?>
                <article>
                    <div class="title">
                        <h3><?= $beer['name'] ?></h3>
                        <span class="like"><?= $beer['likes'] ?></span>
                    </div>
                    <div>
                        <ul>
                            <li><span>Brasserie:</span> <?= $beer['name'] ?> </li>
                            <li><span>Type:</span> <?= $beer['type'] ?> </li>
                            <li><span>Pourcentage:</span> <?= round($beer['percentage'], 1) ?>%</li>
                            <li><span>Avis:</span> <?= round($beer['rating'], 1) ?>/5</li>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <ul>

    </ul>
</main>
<div id="loader">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" fill="none" stroke-width="10" r="35"
                stroke-dasharray="164.93361431346415 56.97787143782138">
            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s"
                              values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
        </circle>
    </svg>
</div>
<?php require_once(__DIR__ . '/src/partials/footer.php'); ?>
</body>

</html>