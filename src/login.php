<?php
// Inclure le fichier security.php
require 'security/security.php';

// Vérifier si la connexion est sécurisée (HTTPS) et définir l'en-tête Strict-Transport-Security
if (!empty($_SERVER['HTTPS'])) {
    header("Strict-Transport-Safety: max-age=31536000");
}

// Démarrer la session et définir les valeurs par défaut pour les variables de session
// session_start();

if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = uniqid("", true);
}
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

// Incrémenter la variable de session counter
$_SESSION['counter'] = 1 + $_SESSION['counter'];

if (isset($_POST['email']) && isset($_POST['password'])) {
    $sql = 'SELECT * FROM `users` WHERE email=:email AND password=:password';
    $request = $client->prepare($sql);
    $request->execute([
        "email" => $_POST['email'],
        "password" => $_POST['password'],
    ]);
    $user = $request->fetch();
    if ($user) {
        $_SESSION['loggedUser'] = true;
        $_SESSION['full_name'] = $user['full_name'];
        // Rediriger l'utilisateur vers la page home.php
        header('Location: ../index.php');
        exit;
    } else {
        echo 'mauvais login/password';
    }
}

//step 1
//afficher un formulaire
?>

<?php if (!isset($_SESSION['loggedUser'])) :?>
    <form action="index.php" method="POST" class="login-form">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <button type="submit">Envoyer</button>
        <p class="message">Not Registered?<a href="register.php">Create an account</a></p>
    </form>
<?php else :?>
    <div>
        <p>Utilisateur Connecté</p>
        <p><?php echo $_SESSION['full_name'];?></p>
        <a href="src/logout.php">Déconnexion</a>
    </div>

<?php endif;?>