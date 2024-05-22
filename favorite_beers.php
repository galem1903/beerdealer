<?php
session_start();

if (isset($_SESSION['loggedUser'])) {
    $user_id = $_SESSION['loggedUser']['user_id'];

    $sql = 'SELECT beers.* FROM user_beer
            JOIN beers ON user_beer.beer_id = beers.beer_id
            WHERE user_beer.user_id = :user_id';
    $request = $client->prepare($sql);
    $request->execute([
        'user_id' => $user_id,
    ]);

    $beers = $request->fetchAll();
}

if (isset($beers)) {
    foreach ($beers as $beer) {
        echo "<h2>". htmlspecialchars($beer['name']). "</h2>";
        echo "<p>". htmlspecialchars($beer['description']). "</p>";
    }
} else {
    echo "<p>Aucune bière n'a été trouvée.</p>";
}
?>