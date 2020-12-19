<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';
print_r($_POST);
if (isset($_POST['submit'])) {


    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!empty($_POST['password'])) {

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $database->prepare('UPDATE users set email = :email, password = :password WHERE username = :username');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);

    }else {

    $statement = $database->prepare('UPDATE users set email = :email WHERE username = :username');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);


    }

    $_SESSION['user']['email']=$email;

    $statement->execute();

 //   $user = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/profile.php');

}
