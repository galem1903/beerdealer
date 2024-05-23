<?php
// Inclure le fichier security.php
require_once 'security/security.php';

if (isset($_SESSION['loggedUser'])) {
    header('Location: ../index.php');
}

require_once(__DIR__. '/config/mysql.php');
require_once(__DIR__. '/config/connect.php');

if (isset($_POST['full_name']) && !empty($_POST['full_name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $sql = 'INSERT INTO users (name, email, password, creation_date) VALUES (:name, :email, :password, :creation_date)';
    $request = $client->prepare($sql);
    $creation_date = date('Y-m-d', time());
    $result = $request->execute([
        'name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'creation_date' => $creation_date
    ]);
    if ($result) {
        $_SESSION['loggedUser'] = [
            'user_id' => $client->lastInsertId(),
            'full_name' =>  $_POST['full_name'],
            'creation_date' => $creation_date
        ];
        header("Location: ../index.php");
    }
}

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
            <h2>Page d'Inscription</h2>
            <form class="data" action="register.php" method="POST">
                <input type="text" name="full_name" placeholder="Pseudo">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Mots de passe">
                <input type="submit" value="Créer mon compte">
                <p class="message">Déjà un compte?<a href="login.php"> Se connecter</a></p>
            </form>
        </section>
    </main>
</div>
<?php require_once('partials/footer.php'); ?>
</body>
</html>