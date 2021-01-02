<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Add post</h1>

    <form action="app/posts/postUpdate.php" method="post">
    <input type="hidden" name="postid" value="<?php echo $_POST['postid'];?>">

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Title" required>
            <small class="form-text text-muted">Please provide the title of your post.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" id="link" placeholder="Link" required>
            <small class="form-text text-muted">Please provide the link here.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="description">Description</label>
            <input class="form-control" type="text" name="description" id="description" placeholder="Description" required>
            <small class="form-text text-muted">Please provide a description for your post here .</small>
        </div><!-- /form-group -->

        <button type="submit" name="submit" class="btn btn-primary">Add post</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
