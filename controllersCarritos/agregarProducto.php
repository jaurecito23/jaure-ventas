<?php

require "../includes/funciones/app.php";

 use App\ProductoCarrito;

 $id = $_POST["id"] ?? 1;
 $id = filter_var($id,FILTER_VALIDATE_INT);
 //$producto = ProductoCarrito::encontrarProducto($id);

 $idCarrito = NULL;
 session_start();

 if(!isset($_SESSION["id_usuario"]) ){
    if(isset($_SESSION["idCarrito"])){
        $idCarrito = $_SESSION["idCarrito"];
    }else{
        $idCarrito = ProductoCarrito::creandoCarrito();
        $_SESSION["idCarrito"] = $idCarrito;
    }

}else{
    $id_usuario = $_SESSION["id_usuario"];
    $idCarrito = ProductoCarrito::obtenerIdCarrito($id_usuario);
    $_SESSION["idCarrito"] = $idCarrito;
}

  $producto = ProductoCarrito::insertarProductoAlCarrito($id,$idCarrito);


 echo json_encode($producto);
// echo json_encode($_SESSION);
//echo $producto;
