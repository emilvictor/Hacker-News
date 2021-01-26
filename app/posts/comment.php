<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['submit'])) {

    $comment_posted = $_POST['comment'];
    $userid = $_SESSION['user']['id'];
    $postid = $_POST['postid'];

    $statement = $pdo->prepare('INSERT INTO comments (userid, postid, comment_posted) VALUES (:userid, :postid, :comment_posted)');
    $statement->bindParam(':userid', $userid, PDO::PARAM_STR);
    $statement->bindParam(':postid', $postid, PDO::PARAM_STR);
    $statement->bindParam(':comment_posted', $comment_posted, PDO::PARAM_STR);

    $statement->execute();

    $posts = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/../post.php?id=' . $postid);
}

redirect('/');
