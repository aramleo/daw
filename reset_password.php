<?php
// Iniciamos sesión
session_start();

// Librerías para el envio de correos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpParser\Node\Stmt\TryCatch;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
/* Comprobamos que no existe sesión de usuario o rol. En caso de existir no redirige a la página
principal de la página web*/

if (!isset($_SESSION['usuario']) || (!isset($_SESSION['rol']))) {
  //Carga los archivos necesarios para el saneamiento y validación y el header común de las páginas
  include("template/header.php");
  include_once("config/funcionesSanearValidar.php");
  include_once("config/funcioneslogreg.php");
  include_once("config/datos.php");


  // Llamamos al constructor de la clase
  $llamada = new FuncionesSaneaValida;

  // Iniciamos la variables a vacío
  $error_email = $error_registro = '';

  /* Comprobamos el usuario saneando y validando el valor introducido. En caso de error en la 
     validación completa la variable error_nombre */
  if (!isset($_POST['email_reset'])) {
    $error_email = "El campo email no puede estar vacío";
  } else {
    $email_reset = $llamada->sanearEmail($_POST['email_reset']);
    if (!empty($llamada->validaEmail($email_reset))) {
      $error_email = $llamada->validaEmail($email_reset);
    }
  }

  if ($error_email == "") {
    $reset = new FuncionesLogReg;
    $datos = $reset->email_reset($email_reset);
    if ($datos) {
      // Selecciona un número aleatorio para el reseteo de la contraseña.
        $aleatorio = random_int(10000001, 99999999);
      echo '<div class="text-center">Se ha enviado un correo electrónico a su bandeja</div>';
      $resulta = $reset->resetPassword($email_reset, $aleatorio);
      if($resulta = 'OK'){
        $mail = new PHPMailer(true);
        try {
          // Envía un correo electrónico con la librería PHP Mailer
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $correo;
            $mail->Password = $password_correo;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($correo, 'Huertos Urbanos');
            $mail->addAddress($email_reset);

            $mail->isHTML(true);
            $mail->Subject = 'Password reseteado';
            $cuerpo = '
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Huertos Urbanos</title>
            </head>
            <body>
                    <h4>Su contraseña ha sido cambiada</h4>
                    <p>Su nueva contraseña es '.$aleatorio.' y debe ser cambiada cunado entre de nuevo en sus sesión 
                    en opción de Perfil->Password</p>
            </body>
            </html>';
            $mail->Body = $cuerpo;
            $mail->send();
        } catch (Exception $e) {
            echo 'Mensaje' . $mail->ErrorInfo;
        }
        ?>
        <div class="text-center">
            <a href="./" class="btn btn-info mt-3" role="button">Volver a Home</a>
        </div>
        <?php
      }
    } else {
        echo 'NO es correcto';
      $_SESSION['noexiste'] = 'El usuario no existe';
    }

} else {
  // Redirige a la principal en caso de existir usuario y rol
  header('Location: ./');
}
}