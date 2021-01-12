<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Update comment</h1>

    <form action="app/posts/commentUpdate.php" method="post">
    <input type="hidden" name="commentid" value="<?php echo $_POST['commentid'];?>">

        <div class="form-group">
            <label for="comment">Comment</label>
            <input class="form-control" type="text" name="comment" id="comment" placeholder="Comment" required>
            <small class="form-text text-muted">Update your comment here.</small>
        </div><!-- /form-group -->



        <button type="submit" name="submit" class="btn btn-primary">Add post</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
