
<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) :

    redirect('/login.php');

    endif; ?>

<article>

    <h2>My profile</h2>

    <div class="card">
        <img src="" />
    </div>

    <!--Here user can update/change their email and/or password-->
    <p>Update your profile</p>

    <form action="/app/users/profile/update.php" method="post" enctype="multipart/form-data">

    <input type="file" name="pic">

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email'] ?>" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" >
            <small class="form-text text-muted">Please provide the your password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
