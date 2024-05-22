<?php
session_start();

if (isset($_POST['user_id']) && isset($_POST['beer_id'])) {
    $user_id = $_POST['user_id'];
    $beer_id = $_POST['beer_id'];

    // Connexion à la base de données
    $db = mysqli_connect('localhost', 'ee67ed30eled', 'r5|e5e?0ed', 'rbleaebler20');

    if (!$db) {
        die('Erreur de connexion à la base de données');
    }

    // Vérifier si la bière est déjà dans la liste des favoris
    $query = "SELECT * FROM user_beer WHERE user_id = $user_id AND beer_id = $beer_id";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // La bière est déjà dans la liste des favoris, ne rien faire
    } else {
        // Ajouter la bière à la liste des favoris
        $query = "INSERT INTO user_beer (user_id, beer_id, liked) VALUES ($user_id, $beer_id, 1)";
        mysqli_query($db, $query);
    }

    mysqli_close($db);
}
?>