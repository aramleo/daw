<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpParser\Node\Stmt\TryCatch;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'template/header.php';
include 'config/datos.php';

if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {

    if (isset($_SESSION['lista']) && isset($_SESSION['total'])) {

        $datos = $_SESSION['lista'];
        $id_usuario = $_SESSION['id'];
        $precio_total = $_SESSION['total'];
        $id_pedido = $id_usuario . str_replace(".", "", $precio_total) . date('Ymd');


        include 'config/funcionesProductos.php';
        include 'config/funcionesUsuarios.php';

        $confirmo = new Funciones;
        $usuario = new FuncionesUsuarios;
        $pedido = $confirmo->guardar_pedido($id_pedido, $id_usuario, $precio_total);
        foreach ($datos as $dato) {
            $id_producto = $dato['id'];
            $precio = $dato['precio'];
            $cantidad = $dato['cantidad_pro'];
            $detalle_pedido = $confirmo->guardar_detalle_pedido($id_pedido, $id_producto, $precio, $cantidad);
        }
        if (isset($detalle_pedido) && $detalle_pedido != null) {

            $detallePedidos = $confirmo->consultarDetallePedidos($id_pedido);
            $pedido = $confirmo->consultarPedidos($id_pedido);
            $nombrecliente = $usuario->consultarUsuarioId($id_usuario);

            $mail = new PHPMailer(true);
            try {
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $correo;
                $mail->Password = $password_correo;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom($correo, 'Huertos Urbanos');
                $mail->addAddress('desert.antoro2@gmail.com');

                $mail->isHTML(true);
                $mail->Subject = 'Pedido realizado';
                $cuerpo = '
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
                <body>
                        <p>Numero de pedido: ' . $id_pedido . '</p>
                        <p>Nombre del cliente: ' . $nombrecliente[0]['nombre'] . '</p>
                        <p>Correo electrónico: ' . $_SESSION['usuario'] . '</p>
                        <p>Fecha de compra: ' . $pedido[0]['fecha'] . '</p>
                        <p>Importe total del pedido: ' . number_format($precio_total, 2, ',', '.') . '€</p>
                        <p>Recuerde realizar la transferencia.</p>
                        <h4 class="card-title">Pago por transferencia</h4>
                            <p class="card-text">Debe realizar el pago por transferencia y mandar a nuestro
                                correo una prueba de la realización. En cuanto se compruebe el pago, se le enviarán
                                los productos.</p>
                            <p>Nuestra cuenta es Banco Mibanco IBAN 00 0000 0000 00 0000000000.</p>
                </body>
                </html>';
                $mail->Body = $cuerpo;
                $mail->send();
            } catch (Exception $e) {
                echo 'Mensaje' . $mail->ErrorInfo;
            }
?>
            <div class="container">
                <div class="card mt-5">
                    <div class="card-body">
                        <h4 class="card-title">
                            Huertos Urbanos
                        </h4>
                        <p class="card-text">Gracias por su pedido a Huertos Urbanos. Agradecemos su confianza en nuestros productos
                            . Para cualquier problema póngase en contacto con nostros a través de nuestro correo electrónico.
                        </p>
                        <p>Su pedido va a ser procesado...</p>
                        </p>
                    </div>
                </div>
                <a href="tienda.php" class="btn btn-info mt-3" role="button">Volver a la tienda</a>
            </div>
        <?php
            unset($_SESSION['lista']);
            unset($_SESSION['total']);
            unset($_SESSION['cesta']['productos']);
            $id_pedido = '';
        } else {
        ?>
            <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Uppss!!. Su pedido no ha podido ser procesado</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                        <p>Vuelva a intentarlo más tarde</p>
                        </p>
                    </div>
                </div>
                <a href="tienda.php" class="btn btn-info mt-3" role="button">Volver a la tienda</a>
            </div>
<?php
        }
    } else {
        header('Location: tienda.php');
    }
} else {
    header("Location: ./");
}
