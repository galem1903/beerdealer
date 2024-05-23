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

<h1 style="display: none;">Sessions</h1>
<p style="display: none;">Votre ID de session : <strong><code><?php echo(session_id());?></code></strong></p>
<p style="display: none;">Votre secret : <strong><code><?php echo($_SESSION['secret']);?></code></strong></p>
<?php

// Incrémenter la variable de session counter
$_SESSION['counter'] = 1 + $_SESSION['counter'];
?>
<p style="display: none;">Votre visite #<?php echo($_SESSION['counter']);?></p>

<?php
// Vérifier si la connexion est sécurisée (HTTPS) et définir l'en-tête Strict-Transport-Security
if (!empty($_SERVER['HTTPS'])) {
    header("Strict-Transport-Security: max-age=31536000");
}

// Démarrer la session et définir les valeurs par défaut pour les variables de session
// session_start();

if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = uniqid("", true);
}
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
?>

<h1 style="display: none;">Sessions</h1>
<p style="display: none;">Votre ID de session : <strong><code><?php echo(session_id());?></code></strong></p>
<p style="display: none;">Votre secret : <strong><code><?php echo($_SESSION['secret']);?></code></strong></p>
<?php
// Incrémenter la variable de session counter
$_SESSION['counter'] = 1 + $_SESSION['counter'];
?>
<p style="display: none;">Votre visite #<?php echo($_SESSION['counter']);?></p>