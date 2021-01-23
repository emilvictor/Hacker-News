<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>

    <?php if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
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
                    <li>
                        <h5><a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h5>
                    </li>
                    <a href="<?php echo $post['link']; ?>"><?php echo $post['link']; ?></a>
                    <p><?php echo $post['description']; ?></p>
                    <button type="submit" name="submit">Delete this post</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
                <br>
                <form action="/postUpdate.php" method="post">
                    <button type="submit" name="submit">Update post</button>
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>
                <br>

                <form action="/app/posts/likePost.php" method="post">
                    <?php

                    $postid = $post['id'];
                    $userid = $_SESSION['user']['id'];

                    $statement = $pdo->prepare('SELECT * FROM posts_likes WHERE userid = :userid AND postid = :postid');
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
                    <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                </form>

                <hr>
                <br>

                <!-- to add comments -->
                <?php if (isset($_SESSION['user']['id'])) : ?>
                    <input type="hidden" name="postid" value="<?php echo $postid; ?>">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">

                    <div class="addComment">
                        <a href="createComment.php?postid=<?php echo $postid; ?>">Comment</a>

                    </div>
                <?php endif; ?>

                <!-- to display comments-->

                <div class="ulComments">

                    <?php $statement = $pdo->query('SELECT * FROM comments
                                 INNER JOIN users ON users.id = comments.userid
                                WHERE comments.postid = :postid ;');
                    ?>
                    <?php
                    if (!$statement) {
                        die(var_dump($pdo->errorInfo()));
                    } ?>

                    <?php $statement->bindParam(':postid', $postid, PDO::PARAM_INT); ?>

                    <?php $statement->execute(); ?>

                    <?php $comments = $statement->fetchAll(PDO::FETCH_ASSOC); ?>


                    <?php foreach ($comments as $comment) : ?>

                        <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
                        <input type="hidden" name="postid" value="<?php echo $comment['postid']; ?>">
                        <input type="hidden" name="userid" value="<?php echo $comment['userid']; ?>">


                        <!-- user -->
                        <div class="user">
                            <?php if (!$comment['username']) : ?>
                                <?php echo 'Unknown'; ?>
                            <?php else : ?>
                                <?php echo 'By:' . ' ' . $comment['username']; ?>
                            <?php endif; ?>
                        </div>



                        <div class="commentContent">
                            <?php echo $comment['comment']; ?>
                        </div>
                        <div class="commentTime">
                            <?php echo $comment['dateposted']; ?>
                        </div>
                        <!-- to detete and edit comments-->
                        <div class="commentEdit">
                            <?php if (isset($_SESSION['user']['id'])) : ?>
                                <input type="hidden" name="postid" value="<?php echo $postid; ?>">
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">

                                <?php if ($comment['userid'] == $_SESSION['user']['id']) : ?>
                                    <a href="app/comments/delete.php?commentid=<?php echo $comment['commentid']; ?>">Delete</a>
                                    <a href="updateComment.php?commentid=<?php echo $comment['commentid']; ?>">Edit</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>

                </div>

            <?php endforeach; ?>



        </ul>

    <?php endif ?>


</article>

<?php require __DIR__ . '/views/footer.php'; ?>
