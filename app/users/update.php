<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['submit'])) {


    if (!empty($_FILES['pic']['name'])) {
        move_uploaded_file($_FILES['pic']['tmp_name'], 'pics/' . $_FILES['pic']['name']);
        $statement = $pdo->prepare('UPDATE users set pic = :pic WHERE username =:username');
        $statement->bindParam(':pic', $_FILES['pic']['name']);
        $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);

        $statement->execute();
    }

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!empty($_POST['password'])) {

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $statement = $pdo->prepare('UPDATE users set email = :email, password = :password WHERE username = :username');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
    } else {

        $statement = $pdo->prepare('UPDATE users set email = :email WHERE username = :username');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
    }

    $statement->execute();

    if (!empty($_POST['bio'])) {
        $statement = $pdo->prepare('UPDATE users set bio = :bio where username = :username');
        $statement->bindParam(':bio', $_POST['bio']);
        $statement->bindParam(':username', $_SESSION['user']['username']);

        $statement->execute();
    }


    $_SESSION['user']['email'] = $email;


    //   $user = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/profile.php');
}
