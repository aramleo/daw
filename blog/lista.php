<?php 

	include 'cabeza.php';

?>

<div class="card">
	<img class="card-img-top" src="" alt="">
	<div class="card-body">
		<ul class="">
		<?php foreach ($posts as $post) : ?>
			<li>
				<h5>
					<a href="blog/mostrar.php?id=<?php echo $post['id'] ?>">
						<?php echo $post['titulo'] ?>
					</a>
					<h5>
			</li>
		<?php endforeach; ?>
	</ul>
	</div>
</div>
	
</body>

</html>