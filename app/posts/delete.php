<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

//print_r($_POST);

if (isset($_POST['submit'])) {

    $id = $_POST['postid'];

    $statement = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);


    $statement->execute();


    redirect('/../index.php');
}
