<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

if (isset($_SESSION['user']['id'])) {
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM posts WHERE userid = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM comments WHERE userid = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM commentLikes WHERE userid = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    unset($_SESSION['user']);
    $_SESSION['message'] = "Your account has been deleted successfully!";

    redirect('/login.php');
}
