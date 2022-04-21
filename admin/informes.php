<?php
session_start();
/**
 * En este archivo se presentan todos los alquileres introducidos en la base de datos por el administrador
 * de la página web.
 */

// Comprueba si existe la session de un usuario y si tiene el rol de administrador.
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../config/funcionesAlquileres.php");
    // llama a la clase FuncionesAlquileres.

    if (isset($_GET['tipo'])) {
        switch ($_GET['tipo']) {
            case 'alquileres':
                $consulta = new FuncionesAlquileres;
                $resultados = $consulta->consultarAlquilerAdmin();
                break;
            case 'servicios':
                # code...
                break;
            case 'descargas':
                # code...
                break;
            case 'productos':
                # code...
                break;
            case 'usuarios':
                # code...
                break;
        }
    }

?>
<<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Album example · Bootstrap</title>
  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/">

  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</head>

<body>
  <!-- Tabla donde se muestran los alquileres instroducidos por el administrador -->
  <div class="container">
        <div>
            <h5 class="text-center">Lista de alquileres</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="alquileres" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Localidad</th>
                            <th>metros</th>
                            <th>Imagen</th>
                            <th>Teléfono</th>
                            <th>Activa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultados as $resultado) {

                        ?>
                            <tr>
                                <td><?php echo $resultado->referencia; ?></td>
                                <td><?php echo $resultado->localidad; ?></td>
                                <td><?php echo $resultado->metros; ?></td>
                                <td><?php echo $resultado->imagen; ?></td>
                                <td><?php echo $resultado->telefono; ?></td>
                                <td><?php if ($resultado->activa == 1) {
                                        echo 'Activo';
                                    } else {
                                        echo 'No activo';
                                    } ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php
} else {
    // Si no ha iniciado sesión, te redirige a la página principal
    header('Location: ../');
}
?>

</body>

</html>