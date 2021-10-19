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


        $router->render('paginas/crearadmin',[



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


}