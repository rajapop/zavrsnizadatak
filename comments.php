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
 <button type="button" class="btn btn-default" onclick="toggle_visibility();" id="show">Hide comments</button>
 <div class="comments" style="display: block" id="foo">   
    <h3>comments:</h3>
        <?php
            if (isset($_GET['post_id'])) {

                // pripremamo upit
                $sql4 = "SELECT posts.id, comments.author, comments.text FROM comments join posts on comments.post_id=posts.id where post_id = {$_GET['post_id']}";
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
                    <hr> 
                </div>
            </div>
        <?php } ?>

        <?php } ?>
    </div>
</div>