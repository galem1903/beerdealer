<?php

// Inclusion du fichier de constantes de connexion à la base de données de Beerdealer
require_once 'mysql.php';

try {
    // Création d'une nouvelle instance de la classe PDO pour se connecter à la base de données de Beerdealer
    $beerdealer = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', BEERDEALER_HOST, BEERDEALER_NAME, BEERDEALER_PORT),
        BEERDEALER_USER,
        BEERDEALER_PASSWORD
    );

    // Définition du mode d'erreur de la connexion à la base de données de Beerdealer
    $beerdealer->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    // Affichage d'un message d'erreur en cas d'échec de la connexion à la base de données de Beerdealer
    die('Erreur de connexion à la base de données de Beerdealer : '. $exception->getMessage());
}

?>