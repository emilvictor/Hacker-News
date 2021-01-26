<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {

    $comment = $_POST['comment'];
    $id = $_POST['commentid'];

    $statement = $pdo->prepare('UPDATE comments SET comment_posted = :comment_posted WHERE id = :id');
    $statement->bindParam(':comment_posted', $comment, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);



    $statement->execute();

    $sql = "SELECT * FROM comments WHERE id = '$id'";
    $statement = $pdo->query($sql);

    $commentrow = $statement->fetch(PDO::FETCH_ASSOC);



    redirect('/../post.php?id=' .  $commentrow['postid']);
}

//redirect('/');
