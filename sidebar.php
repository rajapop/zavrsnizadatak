<?php
	// pripremamo upit
	$sql5 = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 5";
	$statement = $connection->prepare($sql5);
	
	// izvrsavamo upit
	$statement->execute();
	
	// zelimo da se rezultat vrati kao asocijativni niz.
	// ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
	$statement->setFetchMode(PDO::FETCH_ASSOC);
	
	// punimo promenjivu sa rezultatom upita
	$posts1 = $statement->fetchAll();
	
	// koristite var_dump kada god treba da proverite sadrzaj neke promenjive
	    // echo '<pre>';
	    // var_dump($posts1);
	    // echo '</pre>';
	
	?>
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
	<div class="sidebar-module sidebar-module-inset">
		<h4>Latest posts:</h4>
		<p>
			<?php
				foreach ($posts1 as $post) {
				?>
			<a href="single-post.php?post_id=<?php echo($post['id']) ?>"> - <?php echo($post['title']) ?> <br></a>
			<?php } ?> 
		</p>
	</div>
</aside>
<!-- /.blog-sidebar -->