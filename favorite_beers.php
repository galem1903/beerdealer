<?php
 
session_start();
 
if (!isset($_SESSION['loggedUser'])) {
    header('Location: src/login.php');
}
 
require_once(__DIR__ . '/src/config/mysql.php');
require_once(__DIR__ . '/src/config/connect.php');
 
// $sql = 'SELECT * FROM beers
// JOIN user_beer ON user_beer.beer_id = beers.beer_id
// WHERE user_beer.user_id=:user_id';
// $request = $client->prepare($sql);
// $request->execute([
//     'user_id' => $_SESSION['user_id']
// ]);
// $recipes = $request->fetchAll();
 
 
$sql = 'SELECT * FROM beers JOIN user_beer ON user_beer.beer_id = beers.beer_id WHERE user_beer.user_id = :user_id';
$request = $client->prepare($sql);
$request->execute([
    'user_id' => $_SESSION['loggedUser']['user_id']
]);
$beers = $request->fetchAll();
 
?>
 
<!DOCTYPE html>
 
<html lang="fr">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeerDealer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
 
<body>
 
<?php require_once(__DIR__ . '/src/partials/header.php'); ?>
<main>
    <section class="container">
        <h2>Mes bières favorites</h2>
        <div class="data">
            <?php foreach ($beers as $beer): ?>
                <article>
                    <div class="title">
                        <h3><?= $beer['name'] ?></h3>
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
</main>
<?php require_once(__DIR__ . '/src/partials/footer.php'); ?>
</body>
 
</html>
