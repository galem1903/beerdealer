<?php
// Définir les fonctions pour les opérations de base de données ici
function getBeersFromDatabase($conn) {
    // Retourner un tableau de bières à partir d'une base de données
    $results = array();
    $sql = "SELECT * FROM beers";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
    return $results;
}

// Fermer la connexion
$conn->close();
?>