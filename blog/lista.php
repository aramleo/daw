<?php 
// inclusión de header de la página
	include 'cabeza.php';

?>
<!-- Tabla con los diferentes post de la base de datos -->
<div class="container">
	<img class="rounded mx-auto d-block" src="./img/imagen_blog.jpg" alt="Imagen de blog">
	<div class="card-body">
		<h5 class="text-center">Últimos Posts</h5>
		<ul class="list-group list-group-flush">
		<?php foreach ($posts as $post) : ?>
			<li class="list-group-item">
				<h5>
					<!-- No envía a la página del post donde podemos ver los detalles -->
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