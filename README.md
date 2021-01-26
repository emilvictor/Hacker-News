# Hacker-News
Page that should look and work similar to "Hacker News"

## Features

- As a user I should be able to create an account.

- As a user I should be able to login.

- As a user I should be able to logout.

- As a user I should be able to edit my account email, password and biography.

- As a user I should be able to upload a profile avatar image.

- As a user I should be able to create new posts with title, link and description.

- As a user I should be able to edit my posts.

- As a user I should be able to delete my posts.

- As a user I'm able to view most upvoted posts.

- As a user I'm able to view new posts.

- As a user I should be able to upvote posts.

- As a user I should be able to remove upvote from posts.

- As a user I'm able to comment on a post.

- As a user I'm able to edit my comments.

- As a user I'm able to delete my comments.


# Installation
Clone the repository to your computer

$ git clone https://github.com/emilvictor/Hacker-News.git
Start a local server in the command line

$ php -S localhost:8000
Open the index.php file in your preferred browser


## Code review by:
**Moa Berg**
- `posts.php:15-16` - Input type should be “url”, it helps validate the input value to make sure that it's either empty or a properly-formatted URL before the form can be submitted.

- `index.php:33-43` - Delete post-button and update post-button is visible for everyone, not just for the creator of the post. Consider changing this. Now all users can delete all posts. 

- `app/posts/delete.php: 15` - The delete post form should also be validated here, for example “delete from posts where id = :id **and user_id = :user_id**, to prevent other users from deleting your posts. This also applies to `app/posts/postUpdate.php`.

- `app/posts/commentUpdate.php:12`- in your SQL query, validate that the user is the owner of the comment. - “UPDATE comments SET comment_posted = :comment_posted WHERE id = :id **AND user_id = :user_id**".

- `app/posts/store.php:11-13` - Sanitize your user-data, for example: `$title = filter_var($_POST[‘title’], FILTER_SANITIZE_STRING);`

- The project is well structured and easy to navigate, bra jobbat! 🥳

## New features by:
**Aseel Mohamad**
- This is the link to pull request:
https://github.com/emilvictor/Hacker-News/pull/2
