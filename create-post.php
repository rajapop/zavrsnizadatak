<?php
include 'db.php';

// postTitle: t4gb4tgbt
// postBody: 5tgb5tgb5t
// postAuthor: 5tgb5tg

// postDate: 2019-04-18

// da li je empty $_POSt['author ] i comment 
if (!empty($_POST['postTitle']) && !empty($_POST['postBody']) && !empty($_POST['postAuthor'])){
// ako nije
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