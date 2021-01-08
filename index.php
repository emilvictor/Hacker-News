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
        <hr>

    <?php

        $pdo = new PDO('sqlite:app/database/database.db');

        $statement = $pdo->query('SELECT * FROM posts ORDER BY dateposted DESC');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));

        }

        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <ul>

                <?php foreach ($posts as $post) : ?>
                    <form action="app/posts/delete.php" method="post">
                        <h6><?php echo $post['dateposted']; ?></h6>
                        <li><h5><?php echo $post['title']; ?></h5></li>
                        <a href="<?php echo $post['link'];?>"><?php echo $post['link']; ?></a>
                        <p><?php echo $post['description']; ?></p>
                        <button type="submit" name="submit">Delete this post</button>
                      <input type="hidden" name="postid" value="<?php echo $post['id'];?>">
                    </form>
                    <br>
                    <form action="/postUpdate.php" method="post">
                        <button type="submit" name="submit">Update post</button>
                        <input type="hidden" name="postid" value="<?php echo $post['id'];?>">
                    </form>
                    <br>

                    <form action="/app/posts/likePost.php" method="post">
                       <?php

                        $postid = $post['id'];
                        $userid = $_SESSION['user']['id'];

                        $statement = $database->prepare('SELECT * FROM posts_likes WHERE userid = :userid AND postid = :postid');
                        $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
                        $statement->bindParam(':postid', $postid, PDO::PARAM_INT);
                        $statement->execute();

                        $likes = $statement->fetch(PDO::FETCH_ASSOC);

                        if (!empty($likes)) :
                        ?>
                            <button type="submit" name="submit"><b>Like post</b></button>
                         <?php else : ?>
                            <button type="submit" name="submit">Like post</button>
                        <?php endif ?>
                         <input type="hidden" name="postid" value="<?php echo $post['id'];?>">
                    </form>

                        <hr>
                        <br>
                <?php endforeach; ?>



        </ul>

        <?php endif ?>


</article>

<?php require __DIR__ . '/views/footer.php'; ?>
