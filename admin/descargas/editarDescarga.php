<?php
// Inicio de sesión
session_start();
// Comrpobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  // Inclusión de los archivos necesarios
  include("../../config/funcionesDescargas.php");
  include("../../config/funcion_generica.php");

  // En caso de no recibir la variable POST actualizar
  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarDescarga.php');
    // Se ha recibido la varible correctamente
  } else {
    // Instanciando
    $actualizar = new FuncionesDescargas;
    // Función para guardar la imagen en una carpeta
    $foto = new Generica;
    // Variables asignación
    $id = $_POST['id'];
    $referencia = $_POST['referencia'];
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
    if(isset($_POST['imagen'])){
      $imagen = $_POST['imagen'];
    }else{ $imagen = $foto->subirFoto('descargas');}
    $activa = $_POST['activa'];
    // Gaurdado de datos
    $datos = $actualizar->actualizar($id, $referencia, $titulo, $enlace, $imagen, $activa);
    // En caso de error
    if ($datos === false) {
      $datos = 'El registro no se ha actualizado';
      $_SESSION['error'] = $datos;
      header('Location: formEditarDescarga.php');
    }
    // En caso de éxito
    if ($datos === 'Registro actualizado') {
      $_SESSION['editado'] = 'El registro ha sido actualizado';
      header('Location: ../descargasAd.php');
    }
  }
}else{
  // El usuario o rol no es correcto
  header('Location: ../../');
}
