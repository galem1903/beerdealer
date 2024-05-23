<?php
if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['age'])) {
    $sql = 'INSERT INTO users (full_name, email, password, age) VALUES (:full_name, :email, :password, :age)';
    $request = $client->prepare($sql);
    $request->execute([
        'full_name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'age' => $_POST['age'],
    ]);
    header("Location: index.php");
}

?>

<?php if (!isset($_SESSION['loggedUser'])) :?>
    <form action="register.php" method="POST" class="register-form">
        <div>
            <label for="full_name">Nom complet</label>
            <input type="text" name="full_name">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="age">Age</label>
            <input type="number" name="age">
        </div>
        <button type="submit">Inscription</button>
        <p class="message">Already registered? <a href="login.php">Sign In</a></p>
    </form>
<?php endif;?>