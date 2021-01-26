<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//print_r($_SESSION);

if (isset($_POST['submit'])) {

    $postid = $_POST['postid'];
    $userid = $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT * FROM posts_likes WHERE userid = :userid AND postid = :postid');
    $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
    $statement->bindParam(':postid', $postid, PDO::PARAM_INT);
    $statement->execute();

    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    if (empty($likes)) {

        $statement = $pdo->prepare('INSERT INTO posts_likes (userid, postid) VALUES (:userid, :postid)');
    } else {

        $statement = $pdo->prepare('DELETE FROM posts_likes WHERE userid = :userid AND postid = :postid');
    }

    $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
    $statement->bindParam(':postid', $postid, PDO::PARAM_INT);

    $statement->execute();

    redirect('/../index.php');
}
