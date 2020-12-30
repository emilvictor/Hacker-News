<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>

    <?php if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['username'];?>!</p>
        <p>You are now logged in</p>
        <br>
        <h3>Posts</h3>
        <br>

     <?php endif ?>

     <?php

        $pdo = new PDO('sqlite:app/database/database.db');

        $statement = $pdo->query('SELECT * FROM posts');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));

        }

        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <ul>
            <?php foreach ($posts as $post) : ?>
                <li><h5><?php echo $post['title']; ?></h5></li>
                <a href="<?php echo $post['link'];?>"><?php echo $post['link']; ?></a>
                <p><?php echo $post['description']; ?></p>
            <?php endforeach; ?>
        </ul>



</article>

<?php require __DIR__ . '/views/footer.php'; ?>
