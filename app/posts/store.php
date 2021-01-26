<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $link = $_POST['link'];
    $description = $_POST['description'];

    $statement = $pdo->prepare('INSERT INTO posts (title, link, description) VALUES (:title, :link, :description)');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':link', $link, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);

    $statement->execute();

    $posts = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/../index.php');
}

redirect('/');
