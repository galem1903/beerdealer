<?php

// Vérifier si la connexion est sécurisée (HTTPS) et définir l'en-tête Strict-Transport-Security
if (!empty($_SERVER['HTTPS'])) {
    header("Strict-Transport-Security: max-age=31536000");
}

// Démarrer la session et définir les valeurs par défaut pour les variables de session
session_start();

if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = uniqid("", true);
}
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
?>