<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../../views/header.php';

if (isset($_SESSION['user'])) {
    $userid = $_SESSION['user']['id'];


    if (isset($_POST['comment'], $_POST['commentid'])) {
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
        $commentid = filter_var($_POST['commentid'], FILTER_SANITIZE_NUMBER_INT);

        $query = 'UPDATE comments
              SET comment = :comment,
                  dateposted = datetime()
              WHERE commentid = :commentid';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }


        $statement->bindParam(':commentid', $commentid, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);

        $statement->execute();
    }
}


redirect('/');
