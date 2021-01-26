<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $link = $_POST['link'];
    $description = $_POST['description'];
    $id = $_POST['postid'];

    $statement = $pdo->prepare('UPDATE posts SET title = :title, link = :link, description = :description WHERE id = :id');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':link', $link, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);



    $statement->execute();


    redirect('/../index.php');
}

//redirect('/');
