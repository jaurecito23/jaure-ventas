<?php

    namespace Controllers;

    use MVC\Router;
    use App\Producto;





// use PHPMailer\PHPMailer\PHPMailer;


// Esta clase es usada como controlador de todas las paginas
class PaginasController{

        public static function home(Router $router){





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
                "pagina"=>$pagina

            ]);

        }
        public static function producto(Router $router){

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
                "categoria_actual"=>$categoria_actual,
                "pagina"=>$pagina
            ]);

        }
        public static function tienda(Router $router){

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
                "productos_calidad"=>$productos_calidad,
                "pagina"=>$pagina,
                "marca_productos"=>$marca_productos


            ]);

        }


    }