<?php
// Inicio de sesión
session_start();
// Comprobamos usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// Inclusión de los archivos necesarios
    include("../../config/funcionesUsuarios.php");

// Id de la varible get
    $id = $_GET['id'];
    // Instancia de la clase
    $borrar = new FuncionesUsuarios;
    $elimina = $borrar->borrar($id);
    // Comprobaciones
    if ($elimina === 'Registro eliminado') {
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../usuarios.php');
    }
}else{
    header('Location: ../../');
}
