<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) :

    redirect('/login.php');

endif; ?>

<?php

$statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
$statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
$statement->execute();

// Fetch the user as an associative array.
$user = $statement->fetch(PDO::FETCH_ASSOC);


?>


<article>

    <!--Here user can update/change their email and/or password and infotext-->

    <div class="container">
        <div class="avatar">
            <img src="/app/users/pics/<?php echo $user['pic']; ?>" height="150" width="150">
        </div>
        <h2><?php echo $_SESSION['user']['username']; ?></h2>
        <p><?php echo $user['bio']; ?></p>
    </div>

    <form action="/app/users/update.php" method="post" enctype="multipart/form-data">
        <input type="file" name="pic">

        <br>
        <br>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email'] ?>" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
            <small class="form-text text-muted">Please provide your password.</small>
        </div><!-- /form-group -->

        <textarea name="bio" id="" placeholder="Write your bio/info here" cols="30" rows="10"></textarea>

        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>


    <a href="app/users/deleteAccount.php">Delete your account </a>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
