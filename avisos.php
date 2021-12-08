<?php

require 'includes/funciones/app.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




$fecha = obtenerFecha('actual');

$query = 'SELECT * FROM compras WHERE notificado="0" ;';


$resultado = mysqli_query($db,$query);



foreach ($resultado as $pedido) {

    $idCompra = $pedido['id'];
    $idCarrito = $pedido['idCarrito'];

    $query = "SELECT * FROM productos_carrito WHERE id_carrito = ${idCarrito};";


    $productosCarrito = mysqli_query($db,$query);

    $enviado = enviarEmail($pedido,$productosCarrito);

if($enviado){

  echo "Enviado";

     $query = "UPDATE compras SET notificado = '1' WHERE id = '${idCompra}'";
     mysqli_query($db,$query);
}


}

function enviarEmail($pedido,$productosCarrito){

    // Datos del cliente
    $nombres = $pedido['nombres'];


    $apellidos = $pedido['apellidos'];
    $celular = $pedido['celular'];
    $email = $pedido['email'];
    $direccion = $pedido['direccion'];
    $ciudad = $pedido['ciudad'];
    $localidad = $pedido['localidad'];
    $notas = $pedido['notas'];
    $total = $pedido['total'];
    $fecha = $pedido['fecha'];
    $metodo = $pedido['metodo'];
    $pagado = $pedido['pagado'];
    $idCarrito = $pedido['idCarrito'];


    $estado = "Pago No Verificado";

    if($pagado == 1){

        $estado = "Pago Verificado";

    }

    $mail = new PHPMailer();
    $mensaje = new Exception();
    $mail = new PHPMailer();


    // Protocolo para envio de emails
      // Connfigurar SMTP

      //Protocolo
      $mail->isSMTP();


      //Host
      $mail->Host='c2390677.ferozo.com';
      //mail

      $mail->Port=465;
      $mail->SMTPSecure='ssl';
      $mail->SMTPAuth=true;
      $mail->Username='pedidos@jaureventas.com';
      $mail->Password='17FRjb17';

      $mail->setFrom('pedidos@jaureventas.com','JaureVentas');
      $mail->addAddress('pedidos@jaureventas.com','JaureVentas');
      $mail->Subject= 'Tienes un Nuevo Pedido';
      $mail-> isHTML(true);
      $mail->CharSet = 'UTF-8';

    // Para generar el enlace
      $celular[0] = '8';
    $celular= '=59'.$celular;


    $contenido = "<html lang='es'><head><meta charset='utf-8' /> <link rel='preconnect' href='https://fonts.googleapis.com'> <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin> <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap' rel='stylesheet'><title>Nuevo Pedido</title><meta name='viewport' content='initial-scale=1.0; maximum-scale=1.0; width=device-width;'> <style> body{ font-family: 'Open Sans', sans-serif; color: #1E1F29; margin: 0; } </style></head><body> <header> <div style='height: 15vh; background-color: #15161D;'> </div> <h1 style='margin-top: 80px; margin-bottom: 60px; text-align: center; color: #333;'>¡Tienes un nuevo pedido de ${nombres}! </h1> </header> <div style='margin: 0 auto; max-width: 600px;'> <table style='width: 100%'> <thead> <tr> <th style='padding: 5px 10px; font-weight: 400; color: gray; text-align: left;'><span>Fecha del pedido</th> <th style='padding: 5px 10px; font-weight: 400; color: gray; text-align: left;'><span>ID de pedido</span></th> <th style='padding: 5px 10px; font-weight: 400; color: gray; text-align: left;'><span>Método</span></th> </tr> </thead> <tbody>";

    $contenido .= "<tr>";
    $contenido .= "<td style='padding: 5px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: left;'>${fecha}";
    $contenido .= "<td style='padding: 5px 10px; font-weight: bold; font-size: 14px;  color: #333; text-align: left;'>${idCarrito}</td>";
    $contenido .="<td style='padding: 5px 10px; font-weight: bold; font-size: 14px;  color: #333; text-align: left;'> ${metodo}</td>";
    $contenido .="</tr>";

    $contenido .='</tbody></table></div> ';
    $contenido .="<h3 style='text-align:center;font-size:22px;font-size:22px;margin-top:40px'>Pedido</h3><div style='margin:0 auto;max-width:600px'><table style='width:100%'><thead><tr><th style='padding:8px 10px;font-weight:400;color:gray;text-align:left' colspan='1'>Id</th><th style='padding:8px 10px;font-weight:400;color:gray;text-align:left' colspan='3'>Nombre</th><th style='padding:8px 10px;font-weight:400;color:gray;text-align:left' colspan='2'>Precio</th></tr></thead><tbody>";

    // Iterar sobre los productos
    $cantidades = [];
    $producto = null;


    $total = 0;

    foreach($productosCarrito as $productoCarrito) {

        $idProducto = $productoCarrito['id_producto'];
        $db = conectarDB();
        $query = "SELECT * FROM productos WHERE id ='$idProducto' LIMIT 1;";

        $producto = mysqli_query($db,$query);
        $producto = mysqli_fetch_assoc($producto);

        $id = $producto['id'];
        $nombre = $producto['nombre'];
        $precio_anterior = $producto['precio_anterior'];
        $precio = $producto['precio'];
        $total += intval($precio);
        $contenido .="<tr>";

        $contenido .="<td style='padding: 16px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: center;' colspan='1'>${id}</td>";


        $contenido .="<td style='padding: 16px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: center;' colspan='3'>${nombre}</td>";
        $contenido .="<td style='padding: 16px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: center;' colspan='2'> $${precio}</td>";
        $contenido .="</tr>";

      }

      $contenido .="<tr>";

      $contenido .="<td style='padding: 16px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: center;' colspan='1'>Total</td>";


      $contenido .="<td style='padding: 16px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: center;' colspan='3'>Precio Total en Pesos</td>";
      $contenido .="<td style='padding: 16px 10px; font-weight: bold; font-size: 14px; color: #333; text-align: center;' colspan='2'> $${total}</td>";
      $contenido .="</tr>";


      $contenido .="</tbody></table><h3 style='text-align:center;font-size:22px'>Datos de Contacto</h3><div style='margin:0 auto'><div style='background-color:#f5f5f5;margin:auto;max-width:600px;border-radius:8px;display:flex'><div style='padding:30px;width:60%'><h4 style='font-weight:700'>Datos del cliente</h4><table>";


      $contenido .="<tr><td style='font-size:14px;font-weight:700;color:#333;padding:5px 0'>Nombre:</td><td style='font-size:14px;padding-left:15px'>${nombres}</td></tr><tr><td style='font-size:14px;font-weight:700;color:#333;padding:5px 0'>Apellidos:</td><td style='font-size:14px;padding-left:15px'>${apellidos} </td></tr><tr><td style='font-size:14px;font-weight:700;color:#333;padding:5px 0'>Celular:</td><td style='font-size:14px;padding-left:15px'> ${celular}</td></tr><tr><td style='font-size:14px;font-weight:700;color:#333;padding:5px 0'>Email:</td><td style='font-size:14px;padding-left:15px'><a href='mailto:${email}'>${email}</a></td></tr><tr><td style='font-size:14px;font-weight:700;color:#333;padding:5px 0'>Estado:</td><td style='font-size:14px;padding-left:15px'>${estado}</td></tr><tr><td style='font-size:14px;font-weight:700;color:#333;padding:5px 0'>Notas:</td><td style='font-size:14px;padding-left:15px'>${notas}</td></tr></table></div><div style='padding:20px;width:40%'><h4 style='font-weight:700'>Dirección</h4><p style='font-size:14px'>${direccion}</p> </div></div>";



    $contenido .="<div style='display:flex'><a style='padding:12px;color:#fff;background-color:#25c541;border-style:none;border-radius:8px;margin:30px auto;font-size:15px;font-weight:700;text-decoration:none' href='https://api.whatsapp.com/send?phone=${celular}&text=Hola,%20%20%C2%BF%20como%20estas%20?%20Recibimos%20tu%20pedido%20,%20muchas%20gracias%20por%20comprar%20en%20Jaure%20Ventas'>Enviar Whatsapp</a></div><div style='height:15vh;background-color:#15161d'></div>";


        $mail->msgHTML($contenido);

        $enviado = $mail->send();

            echo $mail->ErrorInfo;

            echo $enviado;
            return $enviado;

}






?>