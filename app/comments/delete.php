<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_GET['commentid'])) {
    $commentid = filter_var($_GET['commentid'], FILTER_SANITIZE_NUMBER_INT);


    $query = 'DELETE FROM comments
       WHERE commentid = :commentid';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':commentid', $commentid, PDO::PARAM_INT);


    $statement->execute();
}

redirect('/');
