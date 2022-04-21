<?php
// Incio de sesion
session_start();

// Comprobación usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// Carga de archivos necesarios
    include("../../config/funcionesAlquileres.php");

// Se pasa el id del alquiler para su borrado
    $id = $_GET['id'];
    $borrar = new FuncionesAlquileres;
    $elimina = $borrar->borrar($id);
    if ($elimina === 'Registro eliminado') {
        // En caso de éxito
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../alquileres.php');
    }else{
        // En caso de no ejecución
        $_SESSION['eliminar'] = 'El registro no ha podido ser eliminado';
        header('Location: ../alquileres.php');
    }
}else{
    header('Location: ../../');
}
