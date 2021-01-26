<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Here we check if user clicked the register button

if (isset($_POST['submit'])) {
    //Here we check if user inserted a correct email and we retrieving data from $_POST
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $usersName = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //Inserting user to the database                                                        //Placeholders
    $statement = $pdo->prepare('INSERT INTO users (email, password, username) VALUES (:emil, :password, :username)');
    $statement->bindParam(':emil', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':username', $usersName, PDO::PARAM_STR);

    $statement->execute();

    //   $user = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/login.php');


    echo "it works!";
}

redirect('/');
