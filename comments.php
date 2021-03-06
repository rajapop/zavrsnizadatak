<script type="text/javascript">

    function toggle_visibility() {
        if (document.getElementById("show").innerHTML === "Hide comments") {
            document.getElementById("show").innerHTML = "Show comments";
        } else {
            document.getElementById("show").innerHTML = "Hide comments";
        }
        var e = document.getElementById('foo');
        if(e.style.display == 'block') {
            e.style.display = 'none';
        } else {
            e.style.display = 'block';
        }
    }
</script>
<form action="create-comment.php" method="POST">
    <?php
        $error = '';
        if (!empty($_GET['error'])) {
            $error = 'All fields are required.';
        }
    ?>
    <?php if (!empty($error)) {?>
        <span class="alert alert-danger"><?php echo $error; ?></span>
    <?php } ?>
    <div class="form-group">
        <label >Your name:</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label>Comment:</label>
        <textarea class="form-control" rows="3" name="comment"></textarea>
    </div>
    <input type="text" hidden value="<?php echo $_GET['post_id'] ?>" name="postId" >
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<br>
<button type="button" class="btn btn-default" onclick="toggle_visibility();" id="show">Hide comments</button>
<div class="comments" style="display: block" id="foo">   
    <h3>comments:</h3>
    <?php
        if (isset($_GET['post_id'])) {

            // pripremamo upit
            $sql4 = "SELECT posts.id, comments.author, comments.text, comments.id as comid FROM comments join posts on comments.post_id=posts.id where post_id = {$_GET['post_id']}";
            $comments = $connection->prepare($sql4);

            // izvrsavamo upit
            $comments->execute();

            // zelimo da se rezultat vrati kao asocijativni niz.
            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
            $comments->setFetchMode(PDO::FETCH_ASSOC);

            // punimo promenjivu sa rezultatom upita
            $singleComments = $comments->fetchAll();

            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                // echo '<pre>';
                // var_dump($singleComments);
                // echo '</pre>';

    ?>
    <?php foreach ($singleComments as $com){?>
        <div class="single-comment">
            <div>posted by: <strong><?php echo($com['author']); ?></strong></div>
                <div>
                    <ul>
                        <li>
                            <?php echo($com['text']); ?>                            
                        </li>
                    </ul>
                    <form action="delete-comment.php" method="POST">
                        <input type="text" hidden value="<?php echo $_GET['post_id'] ?>" name="postId" >
                        <input type="text" hidden value="<?php echo $com['comid']; ?>" name="commentId" >
                        <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                    </form>
                    <hr> 
                </div>
            </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>