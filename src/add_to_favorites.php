<?php
// Inclure le fichier security.php
require_once 'security/security.php';

require_once(__DIR__. '/config/mysql.php');
require_once(__DIR__. '/config/connect.php');

if (isset($_SESSION['loggedUser'])) {
    $user_id = $_SESSION['loggedUser']['user_id'];

    if (isset($beers[$_POST['add_to_favorite']])) {
        $favorite_beer = $beers[$_POST['add_to_favorite']]['beer'];

        $sql = 'SELECT * FROM beers where name = :name';
        $request = $client->prepare($sql);
        $request->execute([
            'name' => $favorite_beer['name']
        ]);

        // ajoute la bière à la bd si elle n'y est pas déja.
        $result = $request->fetch();
        $beer_id = 0;
        if ($request->rowCount() == 0) {
            $sql = 'INSERT INTO beers (beer_id, name, brewery, type, percentage, rating) values (:beer_id, :name, :brewery, :type, :percentage, :rating)';
            $request = $client->prepare($sql);
            $request->execute([
                'beer_id' => $favorite_beer['id'],
                'name' => $favorite_beer['name'],
                'brewery' => $favorite_beer['brewer']['name'],
                'type' => $favorite_beer['style']['name'],
                'percentage' => round($favorite_beer['abv'], 1),
                'rating' => round($favorite_beer['averageQuickRating'], 1)
            ]);
            $beer_id = $client->lastInsertId();
        } else {
            $beer_id = $result['beer_id'];
        }

        $sql = 'INSERT INTO user_beer (user_id, beer_id) VALUES (:user_id, :beer_id)';
        $request = $client->prepare($sql);
        $request->execute([
            'user_id' => $user_id,
            'beer_id' => $beer_id
        ]);
    }
}

?>