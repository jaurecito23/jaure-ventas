<?php

namespace Controllers;

use MVC\Router;
use App\Producto;
use App\Usuario;
use App\ProductoCarrito;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Shipments;
use MercadoPago\Item;
use MercadoPago\Payer;


// use PHPMailer\PHPMailer\PHPMailer;


// Esta clase es usada como controlador de todas las paginas
class PagarController{

        public static function pagar(Router $router){

        //Obtener id carrito



                    $idCarrito = $_SESSION["idCarrito"] ?? null;

                    if(!$idCarrito){

                        header("Location: /accesorios/ventas-jaure");

                    }



                    $productos = ProductoCarrito::obtenerProductosCarrito($idCarrito);
                    $total = ProductoCarrito::obtenerTotal($idCarrito);
                    if($total < 850){

                        $total += 145;
                    }







                    // Obtener el usuario si existe
                    $id_usuario = $_SESSION["id_usuario"] ?? null;

                    $usuario = null;

                    if($id_usuario){

                        $usuario = Usuario::find($id_usuario);

                    }else{

                        $usuario = new Usuario();

                    }


                    if($_SERVER["REQUEST_METHOD"] === "POST"){


                            // Si el metodo es mercado pagos debe :

                        try{

                            $db = conectarDB();
                            $stmt = $db->prepare("INSERT INTO compras (nombres,apellidos,celular,email,direccion,ciudad,localidad,notas,pagado,idCarrito,total,fecha,notificado,metodo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


                            $nombres = $_POST["usuario"]["nombres"];
                            $apellidos = $_POST["usuario"]["apellidos"];
                            $celular = $_POST["usuario"]["celular"];
                            $email = $_POST["usuario"]["email"];
                            $direccion = $_POST["usuario"]["direccion"];
                            $ciudad = $_POST["usuario"]["ciudad"];
                            $localidad = $_POST["usuario"]["localidad"];
                            $notas = $_POST["usuario"]["notas"];
                            $pagado = 0;
                            $fecha = obtenerFecha("actual");
                            $notificado = 0;
                            $metodo = $_POST["payment"];


                            $stmt->bind_param("ssssssssiidsis",$nombres,$apellidos,$celular,$email,$direccion,$ciudad,$localidad,$notas,$pagado,$idCarrito,$total,$fecha,$notificado,$metodo);

                            $stmt->execute();

                            if($stmt->affected_rows > 0){

                            $idCompra = $stmt->insert_id;


                            $_SESSION["idCompra"] = $idCompra;

                            header("Location: /accesorios/ventas-jaure/terminarpago?metodo=${metodo}");

                            };

                            $stmt->close();
                            $db->close();



                        }catch(Exception $e){


                            echo $e->getMessage();

                        }



                    }

                        $categorias = Producto::obtenerCategorias();
                        $pagina = "pagar";





                    $router->render('paginas/pagar',[

                        "categorias"=>$categorias,
                        "usuario"=>$usuario,
                        "productos"=>$productos,
                        "total"=>$total,
                        "pagina"=>$pagina

                    ]);

        }
        public static function terminarpago(Router $router){

                    //Obtener id carrito



                    $idCarrito = $_SESSION["idCarrito"] ?? null;

                    if(!$idCarrito){

                        header("Location: /accesorios/ventas-jaure");

                    }


                    $metodo = buscarQueryString("metodo");




                    $productos = ProductoCarrito::obtenerProductosCarrito($idCarrito);
                    $total = ProductoCarrito::obtenerTotal($idCarrito);


                       // Obtener el usuario si existe
                       $id_usuario = $_SESSION["id_usuario"] ?? null;

                       $usuario = null;

                       if($id_usuario){

                           $usuario = Usuario::find($id_usuario);

                       }else{

                           $usuario = new Usuario();

                       }

                       $preference = null;

                    if($metodo == "mercadopagos"){


                        $costoEnvio = 0;
                        $freeEnvio = true;
                        if($total < 850){

                            $freeEnvio = false;
                            $costoEnvio = 145;

                        }



                        SDK::setAccessToken('APP_USR-601948510932988-102114-27070cb838c142b23853be3f3da48f1e-1004453345');


                        $productosItems = [];

                                $preference = new Preference();

                                $shipments = new Shipments();
                                $shipments->cost = $costoEnvio;
                                $shipments->mode = "not_specified";
                                $shipments->mode = "not_specified";
                                $shipments->receiver_address = $usuario->direccion;
                                $shipments->free_shipping = $freeEnvio;




                                foreach ($productos as $producto) {
                                    // Crea un ítem en la preferencia
                                     $item = new Item();
                                     $item->id = $producto->id;
                                     $item->description = $producto->descripcion;
                                     $item->title = $producto->nombre;
                                     $item->quantity = 1;
                                     $item->currency_id = "UYU";
                                     $item->category_id = "others";
                                     $item->unit_price =  $producto->precio;
                                     $productosItems[] = $item;

                                 }



                                   $fecha = obtenerFecha("actual");


                                 $payer = new Payer();
                                 $payer->name = $usuario->nombres;
                                 $payer->first_name = $usuario->nombres;
                                 $payer->surname = $usuario->apellidos;
                                 $payer->last_name = $usuario->apellidos;
                                 $payer->email = $usuario->email;
                                 $payer->date_created = $fecha;
                                 $payer->phone = array(
                                     "area_code" => "598",
                                     "number" => $usuario->celular
                                    );
                                $payer->address = $usuario->direccion;









                                $preference->back_urls = array(
                                 "success" => "/localhost/accesorios/ventas-jaure/resultadopagar",
                                   "failure" => "/localhost/accesorios/ventas-jaure/pagar/resultadopagar",
                                    "pending" => "/localhost/accesorios/ventas-jaure/pagar/resultadopagar"
                                );

                                 $preference->auto_return = "approved";

                                //     $preference->back_urls = array(
                                //         "success" => "https://jaureventas.com/accesorios/ventas-jaure/pagar/resultado",
                                //     "failure" => "https://jaureventas.com/accesorios/ventas-jaure/pagar/resultado",
                                //         "pending" => "https://jaureventas.com/accesorios/ventas-jaure/pagar/resultado"
                                //         );
                                //     $preference->auto_return = "approved";



                                $preference->payer = $payer;
                                $preference->shipments = $shipments;
                                 $preference->items = $productosItems;
                                 $preference->save();

                    }
                    if($total < 850){

                        $total += 145;
                    }

                    // Obtener el usuario si existe
                    $id_usuario = $_SESSION["id_usuario"] ?? null;

                    $usuario = null;

                    if($id_usuario){

                        try{
                            $db = conectarDB();
                            $stmt = $db->prepare("UPDATE carritos  SET id_usuario = ? WHERE id_usuario= ?");


                            $newUser = 1;
                            $stmt->bind_param("ii",$newUser,$id_usuario);


                            $stmt->execute();

                            $stmt->close();
                            $db->close();

                        }catch(Exception $e){

                            echo $e->getMessage();

                        }
                    }else{


                        $_SESSION["idCarrito"] = null;

                    }

                        $categorias = Producto::obtenerCategorias();
                        $pagina = "terminarpago";







                    $router->render('paginas/terminarpago',[


                        "categorias"=>$categorias,
                        "usuario"=>$usuario,
                        "productos"=>$productos,
                        "total"=>$total,
                        "metodo"=>$metodo,
                        "preference"=>$preference,
                        "pagina"=>$pagina

                    ]);

        }




        public static function resultadopagar(Router $router){

            //Obtener id carrito



                        $idCarrito = $_SESSION["idCarrito"] ?? null;

                        if(!$idCarrito){

                            header("Location: /accesorios/ventas-jaure");

                        }




                        // Obtener el usuario si existe
                        $id_usuario = $_SESSION["id_usuario"] ?? null;
                        $idCompra = $_SESSION["idCompra"] ?? null;

                        $usuario = null;

                        if($id_usuario){

                            $usuario = Usuario::find($id_usuario);

                        }else{

                            $usuario = new Usuario();

                        }


                        $get = obtenerGet();

                        $paymentId = $get["payment_id"] ?? null;
                        $status = false;


                        if($paymentId){


                            $ch = curl_init();
                            $url = "https://api.mercadopago.com/v1/payments/${paymentId}" . "?access_token=APP_USR-601948510932988-102114-27070cb838c142b23853be3f3da48f1e-1004453345";



                            // Establecer URL y otras opciones apropiadas
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                            curl_setopt($ch, CURLOPT_HEADER, TRUE);
                            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


                        // Capturar la URL y pasarla al navegador
                        curl_exec($ch);

                        $resultado = file_get_contents($url);

                        // Cerrar el recurso cURL y liberar recursos del sistema
                        $resultado= json_decode($resultado);
                        $status = $resultado->status;
                        curl_close($ch);
                    }

                    $estado = false;

                    if($status == "approved" && $idCompra){

                        try{

                            $db = conectarDB();
                           $stmt = $db->prepare("UPDATE compras SET pagado = ? WHERE id = ?;");

                            $pagado = 1;
                            $stmt->bind_param("ii",$pagado,$idCompra);
                            $stmt->execute();

                            if($stmt->affected_rows > 0){

                                $estado = true;

                            }

                            $stmt->close();
                            $db->close();

                        }catch(Exception $e){

                            echo $e->getMessage();

                        }


                        $estado = true;

                    }


                            $categorias = Producto::obtenerCategorias();
                            $pagina = "pagar";





                        $router->render('paginas/resultadoPagar',[

                            "categorias"=>$categorias,
                            "usuario"=>$usuario,
                            "estado"=>$estado,
                            "pagina"=>$pagina

                        ]);

            }

}