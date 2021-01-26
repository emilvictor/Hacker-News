<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {

    $id = $_POST['commentid'];

    $sql = "SELECT * FROM comments WHERE id = '$id'";
    $statement = $pdo->query($sql);

    $commentrow = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();





    redirect('/../post.php?id=' .  $commentrow['postid']);
}

//redirect('/');
