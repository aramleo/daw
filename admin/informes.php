<?php
session_start();
/**
 * En este archivo se presentan todos los alquileres introducidos en la base de datos por el administrador
 * de la página web.
 */

// Comprueba si existe la session de un usuario y si tiene el rol de administrador.
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Informes</title>
  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">

  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</head>

<body>
     
<?php
// Incluimos la tabla seleccionada con GET- tipo
    include 'informes/'.$_GET['tipo'].'.php';

} else {
    // Si no ha iniciado sesión, te redirige a la página principal
    header('Location: ../');
}
?>

</body>

</html>