<?php


require_once '../config/funcionesBlog.php';

$consultas = new FuncionesBlog;

$post = $consultas->getPostById($_GET['id']);

include 'cabeza.php';

?>
<div class="container">
	<div class="my-5">
		<h4 class="card-title"><?php echo $post[0]['titulo'] ?></h4>
		<?php if (isset($post[0]['imagen'])) {
			$imag = "../img/blog/" . $post[0]['imagen'];
		?>
			<img class="rounded mx-auto d-block p-3" style="max-width: 300px" src="<?php echo $imag; ?>" alt="Imagen del post">
		<?php
		} ?>
		<div>
			<p class="card-text"><?php echo $post[0]['texto'] ?></p>
		</div>
		<div class="mt-3 text-end">Publicado el <?php echo $post[0]['fecha'] ?></div>
		<div>
			<br>
			<a href="../blog.php">Volver</a>
		</div>
	</div>
</div>
<?php
include 'pie.php';
?>