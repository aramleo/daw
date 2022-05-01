<?php
// Si existe un valor enviado por get
if (isset($_GET['id'])) {
	// Inclusión de archivos necesarios
	require_once '../config/funcionesBlog.php';
	// Instancia de la clase
	$consultas = new FuncionesBlog;

	$post = $consultas->getPostById($_GET['id']);
	// Si existe la variable $post y no es nula, ya que existe el valor
	if (isset($post) && $post != null) {
		// Cabecera de página
		include 'cabeza.php';

?>
<!-- Sección donde se muestran  los posts con detalles -->
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
		include '../template/footer.php';
	} else {
		// No existe un post. Evita el envío a través de la barra de dirección
		header('Location: ../blog.php');
	}
} else {
	// No existe usuario o rol
	header('Location: ../blog.php');
}
?>