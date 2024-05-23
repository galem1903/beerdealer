<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Mon site</title>
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>

    <?php require_once(__DIR__. '/src/partials/header.php');?>
    <div class="form">
<main class="form">
    <section class="container">
        <h2>Page de Contact</h2>
        <div class="data">
            <p>Vous avez des questions ? Contactez-nous !</p>
            <textarea placeholder="Question..." name="content"></textarea>
            <input type="submit" value="Envoyer">
        </div>
    </section>
</main>
    </div>

    <?php require_once(__DIR__. '/src/partials/footer.php');?>

</body>

</html>