<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php

$id = $_GET['id'];

$pdo = new PDO('sqlite:app/database/database.db');
        $sql = "SELECT * FROM posts WHERE id = '$id'";
        $statement = $pdo->query($sql);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));

        }

        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);



        $sql_comments = "SELECT * FROM comments WHERE postid = '$id' order by dateposted desc";
        $statement = $pdo->query($sql_comments);
        //Here we check if something is wrong with the statement and if its wrong we stop excecuting the script and dump the error
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));

        }

        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($comments)
?>

<article>
    <h1><?php echo $posts[0]['title']; ?></h1>

    <p><?php echo $posts[0]['description']; ?></p>

    <form action="app/posts/comment.php" method="post">
        <div class="form-group">
            <label for="title">Comment</label>
            <input class="form-control" type="text" name="comment" id="comment" placeholder="Comment" required>
            <small class="form-text text-muted">Leave your comment here.</small>
        </div><!-- /form-group -->

        <input type="text" name="postid" value="<?php echo $id; ?>" hidden>

        <button type="submit" name="submit" class="btn btn-primary">Add comment</button>
    </form>

    <?php foreach ($comments as $comment): ?>
        <p><?php echo $comment['comment_posted'] ?></p>
            <div class="row">
                <div class="col-md-6">
                    <form action="/commentUpdate.php" method="post">
                        <button type="submit" name="submit">Update comment</button>
                        <input type="hidden" name="commentid" value="<?php echo $comment['id'];?>">
                    </form>
                    </div>

                    <div class="col-md-6">
                    <form action="/app/posts/commentDelete.php" method="post">
                        <button type="submit" name="submit">Delete comment</button>
                        <input type="hidden" name="commentid" value="<?php echo $comment['id'];?>">
                    </form>
                </div>

            </div>



    <?php endforeach ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
