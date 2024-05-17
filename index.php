<?php
session_start();
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>BeerDealer</h1>
        <form action="" method="post">
            <input type="text" name="search" placeholder="Rechercher une bière..." value="<?= htmlspecialchars($searchTerm)?>">
            <button type="submit">Rechercher</button>
        </form>
    </header>
    <main>
        <section>
            <h2>Liste des bières</h2>
            <ul>
                <?php foreach ($beers as $beer) :?>
                    <li>
                        <h3><?= htmlspecialchars($beer['name'])?></h3>
                        <p><?= htmlspecialchars($beer['description'])?></p>
                        <a href="beer.php?id=<?= $beer['id']?>">Voir plus</a>
                    </li>
                <?php endforeach;?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 BeerDealer</p>
    </footer>
</body>
</html>