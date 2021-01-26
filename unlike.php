<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

if (isset($_POST['unlike'], $_POST['id'], $_POST['commentid'], $_POST['postid'])) {


    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $userid = filter_var($_POST['userid'], FILTER_SANITIZE_NUMBER_INT);
    $postid = filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT);
    $commentid = filter_var($_POST['commentid'], FILTER_SANITIZE_NUMBER_INT);

    // delete from likes table
    $query = 'DELETE FROM commentLikes WHERE id = :id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();




    $statement = $pdo->prepare('SELECT * FROM comments WHERE  postid = :postid AND commentid = :commentid');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':postid', $postid, PDO::PARAM_INT);
    $statement->bindParam(':commentid', $commentid, PDO::PARAM_INT);


    $statement->execute();

    $comment = $statement->fetch(PDO::FETCH_ASSOC);
    // add +1 like to the existed likes
    $likes = $comment['commentLikes'];
    $n = $likes - 1;

    // update the number of likes
    $query = 'UPDATE comments
    SET commentLikes = :n
    WHERE commentid = :commentid ';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':commentid', $commentid, PDO::PARAM_INT);
    $statement->bindParam(':n', $n, PDO::PARAM_INT);

    $statement->execute();
}



redirect('/');
