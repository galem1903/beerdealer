<?php
// Inclure le fichier security.php
require_once 'security/security.php';

if (isset($_SESSION['loggedUser'])) {
    header('Location: ../index.php');
}

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/config/connect.php');


if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $sql = 'SELECT * FROM `users` WHERE email=:email';
    $request = $client->prepare($sql);
    $request->execute([
        "email" => $_POST['email']
    ]);
    $user = $request->fetch();
    $password = $user['password'];

    if (password_verify($_POST['password'], $user['password'])) {
        $_SESSION['loggedUser'] = [
            'user_id' => $user['user_id'],
            'full_name' => $user['name'],
            'creation_date' => $user['creation_date']
        ];
        // Rediriger l'utilisateur vers la page home.php
        header('Location: ../index.php');
    } else {
        echo 'mauvais login/password';
    }
}

//step 1
//afficher un formulaire
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Mon site</title>
    <link href="../css/style.css" rel="stylesheet"/>
</head>

    <body>
        <div class="form">
            <main class="form">
                <section class="container">
                    <h2>Page de Connexion</h2>
                    <form class="data" action="login.php" method="POST">
                        <input type="email" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Mots de passe">
                        <input type="submit" value="Se connecter">
                        <p class="message">Pas de compte?<a href="register.php"> Créer un compte</a></p>
                    </form>
                </section>
            </main>
        </div>
    <?php require_once('partials/footer.php'); ?>
    </body>
</html>
