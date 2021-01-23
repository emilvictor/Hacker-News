<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


if (isset($_GET['commentid'])) {
    $commentid = filter_var($_GET['commentid'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('SELECT * FROM comments WHERE commentid =:commentid');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':commentid', $commentid, PDO::PARAM_INT);

    $statement->execute();
    $comment = $statement->fetch(PDO::FETCH_ASSOC);
}

?>

<article>

    <form class="updateComment" action="app/comments/update.php" method="post">

        <input id="commentid" name="commentid" value="<?php echo $comment['commentid']; ?>">

        <textarea rows="8" cols="50" class="form-control" name="comment" id="comment"><?php echo $comment['comment']; ?></textarea>

        <button type="submit" name="update">Update</button>

    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
