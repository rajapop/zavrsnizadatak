<?php
include 'db.php';

$postId = $_POST['postId'];

$sql12 = "DELETE FROM posts WHERE id ='$postId'";
$statement = $connection->prepare($sql12);
$statement->execute();

header("Location: http://localhost/vivifyacademy-basic-blog-boilerplate/index.php");
?>