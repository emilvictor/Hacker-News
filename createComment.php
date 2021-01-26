<?php


require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (isset($_GET['postid'])) {
    $postid = filter_var($_GET['postid'], FILTER_SANITIZE_NUMBER_INT);

    $statement = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $postid, PDO::PARAM_INT);

    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
}

?>
<form action="/app/comments/store.php" method="post">


    <input class="form-control" type="hidden" name="postid" id="postid" value="<?php echo $postid; ?>">

    <textarea name="comment" id="comment" placeholder="" cols="30" rows="10" required></textarea>


    <button type="submit" class="btn btn-primary" name="submit">Add a comment!</button>
</form>

<?php require __DIR__ . '/views/footer.php'; ?>
