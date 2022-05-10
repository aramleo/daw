<?php
// Inicio de sesión
session_start();

// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    // Inclusión de archivos necesarios
    include("../../config/funcionesDescargas.php");

    // Recepción de la variable GET id para borrar el registro
    $id = $_GET['id'];
    // Creando instancia
    $borrar = new FuncionesDescargas;
    // Borrado de descarga
    $elimina = $borrar->borrar($id);
    // En caso de éxito
    if ($elimina === 'Registro eliminado') {
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../descargasAd.php');
    }else{
        $_SESSION['eliminar'] = 'El registro no se ha eliminado';
        header('Location: ../descargasAd.php');
    }
}else{
    header('Location: ../../');
}
