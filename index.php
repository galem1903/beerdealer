<?php
session_start();
require_once(__DIR__ . '/src/variables.php');
require_once(__DIR__ . '/src/functions.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>BeerDealer - Recherche de bières</title>
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <?php require_once(__DIR__ . '/src/partials/header.php'); ?>

    <div id="corps">
        <?php require_once(__DIR__ . '/src/search.php'); ?>

        <?php if (isset($_SESSION['loggedUser'])) : ?>
            <h1>Liste des bières</h1>

            <?php foreach (getBeers($beers) as $beer) : ?>
                <article>
                    <h3><?= $beer['name'] ?></h3>
                    <div><?= $beer['description'] ?></div>
                    <i><?= displayBrewery($beer['brewery'], $breweries) ?></i>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php require_once(__DIR__ . '/src/partials/footer.php'); ?>

</body>

</html>