<?php


require_once 'bFuncion.php';
include '../admin/config/conexion.php';
$post = getPostById($conn, $_GET['id']);

include 'cabeza.php';

?>

<h1><?php echo $post[0]['titulo'] ?></h1>
<div><?php echo $post[0]['fecha'] ?></div>
<div><?php echo $post[0]['texto'] ?></div>
<br>
<div>
	<?php echo $post[0]['imagen'] ?>
</div>
<div>
	<br>
	<a href="../blog.php">Volver</a>
</div>
<div class="fixed-bottom">
<?php
include 'pie.php';
?>
</div>