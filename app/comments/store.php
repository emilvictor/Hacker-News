<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../../views/header.php';



if (isset($_SESSION['user']['id'])) {
    $userid = $_SESSION['user']['id'];



    $query = ('SELECT users.id FROM users
                              INNER JOIN comments
                             ON users.id = comments.userid');

    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }


    $users = $statement->fetchAll(PDO::FETCH_ASSOC);


    if (isset($_POST['comment'], $_POST['postid'])) {
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
        $postid = filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT);


        $query = 'INSERT INTO comments (userid, postid, comment, dateposted, commentLikes) VALUES (:userid, :postid, :comment, datetime(), 0)';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }


        $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
        $statement->bindParam(':postid', $postid, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);

        $statement->execute();
    }
}

redirect('/');
