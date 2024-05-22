<?php
session_start();

if (isset($_SESSION['loggedUser'])) {
    $user_id = $_SESSION['loggedUser']['user_id'];

    $sql = 'INSERT INTO user_beer (user_id, beer_id) VALUES (:user_id, :beer_id)';
    $request = $client->prepare($sql);
    $request->execute([
        'user_id' => $user_id,
        'beer_id' => $_POST['beer_id'],
    ]);
}

header("Location: index.php");
?>