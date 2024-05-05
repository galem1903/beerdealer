<?php
// Définir les fonctions pour les opérations MySQL ici
function connectToDatabase() {
    // Définir les paramètres de connexion à la base de données ici
    $host = 'localhost';
    $dbname = 'rbleaebler20';
    $user = 'ee67ed30eled';
    $password = 'r5|e5e?0ed';

    // Créer la connexion
    $conn = new mysqli($host, $user, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion: ". $conn->connect_error);
    }

    return $conn;
}
?>