<?php



require "../includes/funciones/app.php";


use App\Usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


session_start();



$email = $_POST["email"] ?? null;


if($email){

    $usuario = Usuario::encontrarUsuarioEmail($email);

    if($usuario){



      $mail = new PHPMailer();
      $mensaje = new Exception();
      $mail = new PHPMailer();


      //  // Protocolo para envio de emails
      //   // Connfigurar SMTP

      //   //Protocolo
      $mail->isSMTP();


      //   //Host
      $mail->Host="c2390677.ferozo.com";
      //   //mail

      $mail->Port=465;
      $mail->SMTPSecure="ssl";
      $mail->SMTPAuth=true;
      $mail->Username="jaureventas@jaureventas.tk";
           $mail->Password="zxASqw12@";
           $mail->setFrom("jaureventas@jaureventas.tk","Facundo Jaure-Ventas");

           $email = $usuario->email;
           $nombres = $usuario->nombres;

           $codigoAleatorio = mt_rand(0, mt_getrandmax());

           $resultado = $usuario->ingresarCodigoCambiarContraseña($codigoAleatorio);

           if($resultado){


             $enlace = "jaureventas.com/accesorios/ventas-jaure/cambiarcontrasena?codigo=${codigoAleatorio}";


             $mail->addAddress("$email","$nombres");

             $mail->Subject= "Restaurar Contraseña";
             $mail-> isHTML(true);
             $mail->CharSet = "UTF-8";



             $contenido = "<!DOCTYPE html><html> <head> <meta charset='utf-8'> <style> .encabezado{ background-color: rgba(1,1,1,.2); padding: 2rem 3rem; border-radius: 1rem; color: #15161D; text-transform: uppercase; } .encabezado h1{ font-size: 25px; } .encabezado h2 { text-align: center; font-size: 20px; margin-top: 2rem; } .encabezado h2 span{ color:#11B009; } .encabezado p{ font-size: 15px; text-align: center; } .resumen p{ color:#15161D; font-size: 20px; } p span{ color:#11B009; } .resumen a:hover{ color:#11B009; } </style> </head> <body> <div class='encabezado'> <h1>Restablecer Contraseña. </h1> <h2><span>J</span>aure<span>V</span>entas</h2> <p> Hola <span>${nombres}</span> , espero que te encuentres muy bien.</p> <p> Recientemente necesitabas cambiar tu Contraseña. </p> <p> Si eso no es correcto ignora este Email </p> </div> <div class='resumen'> <p> En Jaure-Ventas nos encanta poder ayudarte y estamos siempre disponibles frente a cualquier inconveniente que tengas </p> <p>Te dejo aqui el enlace para Restablecer tu Contraseña :</p> <a href='${enlace}'>${enlace}</a> <p>Que tengas un gran dia <span> ${nombres}.</span></p> </div> </body></html>";// Estilos







                $mail->msgHTML($contenido);

                $enviado = $mail->send();

                //   echo $mail->ErrorInfo;


                echo json_encode(array(

                  "resultado"=>$enviado

                ));





              }
       }else{

        echo json_encode(array(

          "resultado"=>false

        ));


       }

    }
