<?php
// Inclure le fichier security.php
require_once 'security/security.php';

require_once(__DIR__. '/config/mysql.php');
require_once(__DIR__. '/config/connect.php');

if (isset($_SESSION['loggedUser'])) {
    $user_id = $_SESSION['loggedUser']['user_id'];

        $sql = 'DELETE FROM user_beer where user_id = :user_id AND beer_id = :beer_id';
        $request = $client->prepare($sql);
        $request->execute([
            'user_id' => $user_id,
            'beer_id' => $_POST['remove_to_favorite']
        ]);

        header('Location: ../favorite_beers.php');
}

?>