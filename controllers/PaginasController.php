<?php

namespace Controllers;

use MVC\Router;
use App\Producto;
use App\Usuario;
use App\ProductoCarrito;





// use PHPMailer\PHPMailer\PHPMailer;


// Esta clase es usada como controlador de todas las paginas
class PaginasController{

        public static function home(Router $router){


            // Obtener el usuario si existe
                $id_usuario = $_SESSION["id_usuario"] ?? null;

                $usuario = null;

                if($id_usuario){

                    $usuario = Usuario::find($id_usuario);

                }


                $categorias = Producto::obtenerCategorias();
                 $productos = Producto::obtenerProductos();
                $mas_vendidos = Producto::obtenerMasVendidos();
                $productos_calidad = Producto::obtenerProductosCalidad();
                 $pagina = "home";




            $router->render('paginas/home',[

                "productos"=>$productos,
                "mas_vendidos"=>$mas_vendidos,
                "productos_calidad"=>$productos_calidad,
                "categorias"=>$categorias,
                "usuario"=>$usuario,
                "pagina"=>$pagina

            ]);

        }


        ////////////////////////////////// Pagar /////////////////////////////////
        public static function pagar(Router $router){

            //Obtener id carrito


            $idCarrito = $_SESSION["idCarrito"] ?? null;

            if(!$idCarrito){

                header("Location: /accesorios/ventas-jaure");

            }

            $productos = ProductoCarrito::obtenerProductosCarrito($idCarrito);
            $total = $total = ProductoCarrito::obtenerTotal($idCarrito);


            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }else{

                $usuario = new Usuario();

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
        public static function micuenta(Router $router){



            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }else{

                $usuario = new Usuario();

            }



                $categorias = Producto::obtenerCategorias();
                 $pagina = "micuenta";



            $router->render('paginas/micuenta',[


                "categorias"=>$categorias,
                "usuario"=>$usuario,
                "pagina"=>$pagina

            ]);

        }
        ////////////////////////////////// Crear Cuenta /////////////////////////////////
        public static function crearcuenta(Router $router){

                $categorias = Producto::obtenerCategorias();
                $pagina = "crearcuenta";
                $errores = [];
                $usuario = new Usuario();

                if($_SERVER["REQUEST_METHOD"] === "POST"){


                    $usuario = new Usuario($_POST["usuario"]);
                    $errores = $usuario->validar();

                    $existeUsuario = $usuario->existeUsuario();

                    if($existeUsuario){

                        $errores[] = "Este usuario ya existe, usa otro email o celular";

                    }

                    if(empty($errores)){

                      $contraseña = $usuario->contrasena;

                      $contraseñaCifrada = password_hash($contraseña,PASSWORD_DEFAULT);



                        $usuario->contrasena = $contraseñaCifrada;

                           $resultados = $usuario->guardar();

                          $id_insertado = $resultados["id_insertado"];

                      if($id_insertado){

                          $_SESSION["id_usuario"] = $id_insertado;


                          $idCarrito =   $_SESSION["idCarrito"];
                          $productos = ProductoCarrito::obtenerProductosCarrito($idCarrito);

                           $id_usuario = $_SESSION["id_usuario"];

                          $_SESSION["idCarrito"] = ProductoCarrito::obtenerIdCarrito($id_usuario);

                          $idCarrito =   $_SESSION["idCarrito"];

                          foreach ($productos as $producto) {
                              $id_producto = $producto->id;
                              $producto = ProductoCarrito::insertarProductoAlCarrito($id_producto,$idCarrito);
                          }


                          header("Location: /accesorios/ventas-jaure");

                        }



                    }



                }


            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            // $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }

            $router->render('paginas/crearcuenta',[


                "categorias"=>$categorias,
                "pagina"=>$pagina,
                "usuario"=>$usuario,
                "errores"=>$errores

            ]);

        }


        public static function producto(Router $router){


            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }

            $categorias = Producto::obtenerCategorias();
            $productos = Producto::obtenerProductos();
            $id = \buscarQueryString("id");
            if(!$id){
                header("Location: /accesorios/ventas-jaure");
            }


            $producto = Producto::find($id);
            $id_categoria = $producto->id_categoria;


            // Obtener la categoria del producto actual

            $query = "SELECT * FROM categorias WHERE id = $id_categoria";

            $db = conectarDB();
            $resultado_categoria = mysqli_query($db, $query);

           $categoria_actual = mysqli_fetch_assoc($resultado_categoria);
            //_________________//

           $pagina = "producto";

            $router->render('paginas/producto',[

                "productos"=>$productos,
                "producto"=>$producto,
                "id"=>$id,
                "categorias"=>$categorias,
                "usuario"=>$usuario,
                "categoria_actual"=>$categoria_actual,
                "pagina"=>$pagina
            ]);

        }
        public static function tienda(Router $router){


            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }

            $id_categoria = buscarQueryString("categoria") ?? null;
            if(!$id_categoria){
                header("Location: /accesorios/ventas-jaure");
            }

            $categorias = Producto::obtenerCategorias();
            $productos_calidad = Producto::obtenerProductosCalidad();
            $productos = Producto::obtenerProductos($id_categoria, 5);

            // Obtener la categoria actual



               $query = "SELECT * FROM categorias WHERE id = $id_categoria";

               $db = conectarDB();
               $resultado_categoria = mysqli_query($db, $query);

              $categoria_actual = mysqli_fetch_assoc($resultado_categoria);
               //_________________//


               // Obtener cantidad de productos por categoria

               $query = "SELECT count(nombre),id_categoria FROM productos  GROUP BY(id_categoria);";

               $db = conectarDB();
               $resultado_productos = mysqli_query($db, $query);

               $cantidad_productos = [];

               while($cantidad = mysqli_fetch_assoc($resultado_productos)){

                   $cantidad_productos[$cantidad["id_categoria"]] = $cantidad;

                }

                // Obtener todas las marcas

                // Obtener las marcas

                $query = "SELECT count(id_producto),marca FROM detalles_productos GROUP BY(marca);";

                $db = conectarDB();
                $resultado_marcas= mysqli_query($db, $query);

                $marca_productos = [];

                while($marca = mysqli_fetch_assoc($resultado_marcas)){

                    $marca_productos[] = $marca;

                }



            $pagina = "tienda";


            $router->render('paginas/tienda',[
                "categorias"=>$categorias,
                "productos"=>$productos,
                "categoria_actual"=>$categoria_actual,
                "cantidad_productos"=>$cantidad_productos,
                "usuario"=>$usuario,
                "productos_calidad"=>$productos_calidad,
                "pagina"=>$pagina,
                "marca_productos"=>$marca_productos


            ]);

        }


        public static function ingresar(Router $router){



                $categorias = Producto::obtenerCategorias();
                 $pagina = "ingresar";
                 $errores = [];

                if($_SERVER["REQUEST_METHOD"] === "POST"){



                    $email = $_POST["email"] ?? "";
                    $contraseña = $_POST["contrasena"] ?? "";

                    if($email == ""){

                        $errores[] = "Debes Ingresar tu Correo";

                    }

                    if($contraseña == ""){

                        $errores[] = "Debes Ingresar tu Contraseña";

                    }

                    if(empty($errores)){

                        $contraseñaCifrada = null;
                        $id_usuario = null;
                        $resultado = Usuario::ingresarUsuario($email);

                        if($resultado->num_rows > 0){

                            foreach($resultado as $usuario){

                               $contraseñaCifrada = $usuario["contrasena"];
                                $id_usuario = $usuario["id"];
                            }

                          $coinciden = password_verify($contraseña,$contraseñaCifrada);

                          if($coinciden){


                            $idCarrito =   $_SESSION["idCarrito"];
                            $productos = ProductoCarrito::obtenerProductosCarrito($idCarrito);




                            $_SESSION["id_usuario"] = $id_usuario;

                            $_SESSION["idCarrito"] = ProductoCarrito::obtenerIdCarrito($id_usuario);

                            $idCarrito =   $_SESSION["idCarrito"];

                            foreach ($productos as $producto) {
                                $id_producto = $producto->id;
                                $producto = ProductoCarrito::insertarProductoAlCarrito($id_producto,$idCarrito);
                            }


                            header("Location: /accesorios/ventas-jaure");

                          }else{

                              $errores[] = "La contraseña es incorrecta.";

                          }


                        }else{

                            $errores[] = "El email ingresado no esta registrado.";


                        }


                    }




                }


            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }

            $router->render('paginas/ingresar',[


                "categorias"=>$categorias,
                "pagina"=>$pagina,
                "usuario"=>$usuario,
                "errores"=>$errores

            ]);
        }


        public static function cambiarcontrasena(Router $router){


                $codigo = \buscarQueryString("codigo");



                if($codigo == null){

                    header("Location: /accesorios/ventas-jaure");
                }

                $existeCodigo = Usuario::verificarCodigoContraseña($codigo);




                $categorias = Producto::obtenerCategorias();
                 $pagina = "cambiarcontraseña";
                 $errores = [];
                 $actualizadaContraseña = false;

                if($_SERVER["REQUEST_METHOD"] === "POST"){



                    $contraseña1 = $_POST["contrasena1"] ?? "";
                    $contraseña2 = $_POST["contrasena2"] ?? "";



                    if($contraseña1 == "" || strlen($contraseña1 ) < 8 || $contraseña2 == "" || strlen($contraseña2) < 8){

                        $errores[] = "Debes Ingresar una Contraseña mayor o igual a 8 caracteres";

                    }

                    if(empty($errores)){

                        if($contraseña1 === $contraseña2){

                            $contraseñaCifrada = password_hash($contraseña1,PASSWORD_DEFAULT);

                            $actualizadaContraseña = Usuario::actualizarContraseña($codigo,$contraseñaCifrada);

                        }else{

                            $errores[] = "Las Contraseñas no coinciden.";

                            }



                        }




                }


            // Obtener el usuario si existe
            $id_usuario = $_SESSION["id_usuario"] ?? null;

            $usuario = null;

            if($id_usuario){

                $usuario = Usuario::find($id_usuario);

            }

            $router->render('paginas/cambiarcontrasena',[


                "categorias"=>$categorias,
                "pagina"=>$pagina,
                "usuario"=>$usuario,
                "existeCodigo"=>$existeCodigo,
                "actualizadaContraseña"=>$actualizadaContraseña,
                "errores"=>$errores

            ]);
        }


        public static function cerrarsession(Router $router){

                $_SESSION = [];
                session_destroy();

                header("Location: /accesorios/ventas-jaure");


        }
    }
