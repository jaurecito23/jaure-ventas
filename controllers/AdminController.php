<?php

namespace Controllers;

use MVC\RouterAdmin;
use App\Producto;
use App\Usuario;
use App\ProductoCarrito;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController{

    public static function admin(RouterAdmin $router){



        $router->render('paginas/admin-area',[


        ]);

    }
    public static function crearadmin(RouterAdmin $router){

        $respuesta = null;
        $errores = [];
    if($_SERVER["REQUEST_METHOD"] == "POST"){

            $usuario = $_POST["usuario"] ?? null;
            $nombre = $_POST["nombre"] ?? null;
            $password = $_POST["password"] ?? null;
            $nivel = $_POST["nivel"] ?? null;

            if($usuario == ""){

                $errores[] = "Debe ingresar un usuario";

            }
            if($nombre == ""){

                $errores[] = "Debe ingresar un nombre";

            }
            if($password == ""){

                $errores[] = "Debe ingresar un password";

            }
            if($nivel == ""){

                $errores[] = "Debe ingresar un nivel";

            }
    if(empty($errores)){


        $opciones = array(
            "cost"=>12
        );

     $password_hashed = password_hash($password, PASSWORD_BCRYPT,$opciones);


        try{

            $db = conectarDB();

            $stmt = $db->prepare("INSERT INTO admins (usuario,nombre,password,editado,nivel) VALUES(?,?,?,NOW(),?);");

            $stmt->bind_param("sssi",$usuario,$nombre,$password_hashed,$nivel);
            $stmt->execute();
            $id_registro = $stmt->insert_id;

            $respuesta = null;
            if($stmt->affected_rows !== -1){

                $respuesta = "exito";

            }





            $stmt->close();
            $db->close();

        }catch(Exception $e){

            echo "Error". $e->getMessage();

        }






    }

}

$router->render('paginas/crearadmin',[

            "respuesta"=>$respuesta,
            "errores"=>$errores

        ]);

    }

    public static function crearproducto(RouterAdmin $router){


        $resultadoAccion = buscarQueryString("resultado");


        $categorias = Producto::obtenerCategorias();
        $producto = new Producto();
        $errores = [];
        $erroresDetalles = [];


        if($_SERVER["REQUEST_METHOD"] === "POST"){



            $producto = new Producto($_POST["producto"]);

            $errores = $producto->validar();
            $erroresDetalles = $producto->validarDetalles($_POST["detalles"]);

            $imagenes = $_FILES["producto"]["tmp_name"]["imagenes"];

            if(empty($imagenes)){

                $errores[] = "Debes Agregar Imagenes";

            }

            if(empty($errores) && empty($erroresDetalles) && !empty($imagenes)){

                // Guardar los productos
                $resultado = $producto->guardar();
                $id_insertado = $resultado["id_insertado"];

                // Insertar los detalles
                $detalles = $_POST["detalles"];
                $resultado = $producto->insertarDetalles($id_insertado,$detalles);

                if($resultado){


                    // Insertar Imagenes
                    foreach ($imagenes as $imagen) {


                        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";  // Toma una entrada y la  convierte
                        // fit() resize mas crop ,,, grande o chica
                        $image = Image::make($imagen)->fit(800,600);

                        $imagenGuardada = $producto->guardarNombreImagen($nombreImagen,$id_insertado);

                        $image->save(CARPETA_IMAGENES . $nombreImagen);

                        if($imagenGuardada){

                            header("Location: /accesorios/admin/crearproducto?resultado=1");

                        }

                    }



                }
            }

        }

        $router->render('paginas/crearproducto',[

            "categorias"=>$categorias,
            "resultadoAccion"=>$resultadoAccion,
            "errores"=>$errores,
            "erroresDetalles"=>$erroresDetalles


        ]);

    }

    public static function cerrarsesion(RouterAdmin $router){

        session_start();
        $_SESSION = [];
        session_destroy();

        header("Location: /accesorios/admin/login");


    }

    public static function login(RouterAdmin $router){

        $respuesta = null;
        $db = conectarDB();

        if($_SERVER["REQUEST_METHOD"] == "POST"){

                $usuario = $_POST["usuario"];
                $password = $_POST["password"];



                try{



                    $stmt = $db->prepare("SELECT * FROM admins WHERE usuario = ?;");

                    $stmt->bind_param("s",$usuario);
                    $stmt->execute();
                    $id_registro = $stmt->insert_id;

                    $stmt->bind_result($id_admin,$usuario_admin,$nombre_admin,$password_admin,$editado,$nivel);


                    if($stmt->affected_rows){

                        $existe = $stmt->fetch();

                        if($existe){

                            if(password_verify($password, $password_admin)){

                                session_start();
                                $_SESSION["usuario"] = $usuario_admin;
                                $_SESSION["nombre"] = $nombre_admin;
                                $_SESSION["nivel"] = $nivel;
                                $_SESSION["id_admin"] = $id_admin;

                                header("Location: /accesorios/admin/");


                            }

                        }else{
                            $respuesta = "error";
                        }

                    }



                    $stmt->close();
                    $db->close();

                }catch(Exception $e){

                    echo "Error". $e->getMessage();

                }

             }




        $router->render('paginas/login',[

            "respuesta" => $respuesta

        ]);

    }


}