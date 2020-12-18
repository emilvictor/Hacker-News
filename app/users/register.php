<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $usersName = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $database->prepare('INSERT INTO users (email, password, username) VALUES (:email, :password, :username)');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':username', $usersName, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/login.php');


    echo "it works!";
}

redirect('/');
