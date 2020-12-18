<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Sign up</h1>

    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Username</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="username" required>
            <small class="form-text text-muted">Please provide the your username here.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
            <small class="form-text text-muted">Please provide the your password .</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Repeat password</label>
            <input class="form-control" type="password" name="pwdrepeat" id="password" placeholder="Repeat password" required>
            <small class="form-text text-muted">Please repeat the your password here.</small>
        </div><!-- /form-group -->

        <button type="submit" name="submit" class="btn btn-primary">Sign up</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
