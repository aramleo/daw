<?php
// inicio de sesión
session_start();
// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// Inclusión de archivos
    include("../../config/funcionesBlog.php");

// Se recibe parametro por GET
    $id = $_GET['id'];
    // Instancia de clase
    $borrar = new FuncionesBlog;
    // Llamada a la función de borrado pasando el parámetro recibido por get
    $elimina = $borrar->borrarPost($id);
    // En caso de éxito
    if ($elimina === 'Registro eliminado') {
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../adminPost.php');
    }else{
        $_SESSION['eliminar'] = 'El registro no se ha eliminado';
        header('Location: ../adminPost.php');
    }
}else{
    header('Location: ../../');
}
