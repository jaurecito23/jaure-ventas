<?php

namespace Controllers;

use MVC\RouterAdmin;
use App\Producto;
use App\Usuario;
use App\ProductoCarrito;

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
        
        
        
        $categorias = Producto::obtenerCategorias();
        $producto = new Producto();
        $errores = [];

        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $producto = new Producto($_POST["producto"]);
            
            $errores = $producto->validar();
            $erroresDetalles = $producto->validarDetalles($_POST["detalles"]);  
            $imagenes = $_FILES["producto"]["tmp_name"]["imagenes"];
            
            
            if(empty($errores) && empty($erroresDetalles) && empty($imagenes)){
                
                $resultado = $producto->guardar();
                $id_insertado = $resultado["id_insertado"];
                $detalles = $_POST["detalles"];
                $resultado = $producto->insertarDetalles($id_insertado,$detalles); 

         debuguear($resultado);

        }

      }
    
        $router->render('paginas/crearproducto',[
            
            "categorias"=>$categorias


        ]);

    }
    

}