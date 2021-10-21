<?php

namespace App;

Class ProductoCarrito extends Producto{

///////////////////////////////////////////////////////

// Permite encontrar un producti segun su id
// Devuelve un array con sus valores
public static function encontrarProducto($id){
    try{
            $id = self::$db->escape_string($id);
                $query = "SELECT * FROM productos WHERE id='${id}'";


              $producto = self::consultarSQL($query);

              return array_shift($producto);

        }catch(Exception $e){

            $respuesta = array(

            "error"=>$e->getMessage()

        );


        }

    }


    // Obtiene los productos del carrito y los devuelve en arreglo

public static function obtenerProductosCarrito($idCarrito){

    // Sanitiza y filtra el id carrito

    $idCarrito = intval($idCarrito);
    $idCarrito = self::$db->escape_string($idCarrito);
    $idCarrito = filter_var($idCarrito,FILTER_VALIDATE_INT);

    //query para seleccionar los idCarrito e idProducto
    $query = "SELECT * FROM productos_carrito WHERE id_carrito = '${idCarrito}';";


    $resultado = self::$db->query($query);

    $productos = [];

    // Por cada registro se trae el producto y lo añadie a un arrgelo
foreach ($resultado as $registro){
    $idProducto = $registro["id_producto"];
    $producto = static::encontrarProducto($idProducto);
    $productos[] = $producto;

}

return $productos;


}

public static function insertarProductoAlCarrito($id,$idCarrito){

    $idCarrito = self::$db->escape_string($idCarrito);
    $idCarrito = filter_var($idCarrito,FILTER_VALIDATE_INT);

    $query = "INSERT INTO productos_carrito (id_carrito,id_producto) VALUES(${idCarrito},${id});";

         $resultado = self::$db->query($query);

    if($resultado){


     $producto = static::encontrarProducto($id);
     return $producto;

    }

}

public static function creandoCarrito(){

// Si el cliente esta registrado habra una session con el id de cliente
// De lo contrario usara el usuario default

    $idUsuario = $_SESSION["id_usuario"] ?? 1;

    $idUsuario = self::$db->escape_string($idUsuario);

    $idUsuario = filter_var($idUsuario,FILTER_VALIDATE_INT);


    /// Creamos el carrito
    $query = "INSERT INTO carritos (id_usuario,terminado,notificado,fecha,tipoPago) VALUES(${idUsuario},0,0,'0000-00-00','null')";


     $resultado = self::$db->query($query);

     if($resultado){

        $idCarrito = self::$db->insert_id;

        return $idCarrito;
     }

}
public static function obtenerIdCarrito($idUsuario){

// Si el cliente esta registrado habra una session con el id de cliente
// De lo contrario usara el usuario default

    $idUsuario = self::$db->escape_string($idUsuario);
    $idUsuario = filter_var($idUsuario,FILTER_VALIDATE_INT);

    /// Obtenemos  el  id carrito
    $query = "SELECT * FROM carritos WHERE id_usuario = '$idUsuario' LIMIT 1;";


     $resultado = self::$db->query($query);

     if($resultado){

        $idCarrito = null;

        if($resultado->num_rows == 0){

            $idCarrito = static::creandoCarrito();

        }else{

            $resultado = mysqli_fetch_assoc($resultado);
            $idCarrito = $resultado["id"];

        }
        return $idCarrito;
     }

    }



public static function obtenerTotal($idCarrito){


    //Obtiene los productos
    $productos = static::obtenerProductosCarrito($idCarrito);
    $total = 0;

 //    Obtiene el total
     foreach($productos as $producto){
          $total += intval($producto->precio);
      }


    return $total;

    }

public static function borrarProductoCarrito($idCarrito,$idProducto){

    $query = "DELETE FROM productos_carrito WHERE id_carrito = ${idCarrito} AND id_producto = ${idProducto};";

    $resultado = self::$db->query($query);

    if($resultado){

        return true;

    }else{

        return false;

    }
}

}





