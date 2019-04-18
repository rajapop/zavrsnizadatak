<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php';?>

<main role="main" class="container">
    <div class="row">
        <?php //Prvi upit
            if (isset($_GET['post_id'])) {

                // pripremamo upit
                $sql1 = "SELECT * FROM posts  WHERE posts.id = {$_GET['post_id']}";
                $statement1 = $connection->prepare($sql1);

                // izvrsavamo upit
                $statement1->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement1->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $singlePost = $statement1->fetch();

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                // echo '<pre>';
                // var_dump($singlePost);
                // echo '</pre>';
        ?>
        <div class="col-sm-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($singlePost['id']) ?>"><?php echo($singlePost['title']) ?></a></h2>
            <p class="blog-post-meta"><?php echo($singlePost["created_at"]) ?> by <a href="#"><?php echo($singlePost["author"]) ?></a></p>
            <p><?php echo($singlePost["body"]) ?></p>
            <form action="delete-post.php" method="POST" name="deletePostForm">
                <input type="text" hidden value="<?php echo $_GET['post_id'] ?>" name="postId" >
                <button type="submit" class="btn btn-primary btn-sm" id="submitDelete">Delete Post</button>
            </form>
            <hr> 
        </div><!-- /.blog-post -->



<?php } ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>
        <?php include 'comments.php';?>
        <?php include 'sidebar.php';?>
    </div><!-- /.row -->
</main><!-- /.container -->

<?php include 'footer.php';?>

</body>
</html>
<script>
  document.getElementById('submitDelete').addEventListener("click", function(event){
    event.preventDefault();
    if (window.confirm("Do you really want to delete this post?")) { 
      document.deletePostForm.submit();
    }
  });
</script>