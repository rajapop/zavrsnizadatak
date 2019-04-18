<?php
include 'db.php';

$postId = $_POST['postId'];
$commentId = $_POST['commentId'];

$sql9 = "DELETE FROM comments WHERE id ='$commentId'";
$statement = $connection->prepare($sql9);
$statement->execute();

header("Location: http://localhost/vivifyacademy-basic-blog-boilerplate/single-post.php?post_id=$postId");
?>