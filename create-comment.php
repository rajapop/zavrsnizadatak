<?php
include 'db.php';

$postId = $_POST['postId'];
 
if (!empty($_POST['author']) && !empty($_POST['comment'])){
    $author=$_POST['author'];
    $comment=$_POST['comment'];

    $sql6 = "insert into comments ( author, text, post_id) values ( '$author', '$comment', $postId )";
    $statement = $connection->prepare($sql6);
    $statement->execute();

    header("Location: http://localhost/vivifyacademy-basic-blog-boilerplate/single-post.php?post_id=$postId");
} else {
    header("Location: http://localhost/vivifyacademy-basic-blog-boilerplate/single-post.php?post_id=$postId&error=required");
}

?>