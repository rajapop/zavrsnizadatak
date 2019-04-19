<?php
include 'db.php';

if (!empty($_POST['postTitle']) && !empty($_POST['postBody']) && !empty($_POST['postAuthor'])){

    $postTitle= $_POST['postTitle'];
    $postBody= $_POST['postBody'];
    $postAuthor= $_POST['postAuthor'];
    $postDate= $_POST['postDate'];

    $sql10 = "insert into posts ( title, body, author, created_at) values ( '$postTitle', '$postBody', '$postAuthor', '$postDate' )";
    $statement = $connection->prepare($sql10);
    $statement->execute();

    header("Location: http://localhost/vivifyacademy-basic-blog-boilerplate/index.php");
} else {
    header("Location: http://localhost/vivifyacademy-basic-blog-boilerplate/create.php?error=required");
}

?>