<?php


require "../includes/funciones/app.php";

use App\ProductoCarrito;

session_start();


$idProducto = $_POST["id"] ?? 14;
$idProducto = intval($idProducto);
$idProducto = filter_var($idProducto,FILTER_VALIDATE_INT);

$idCarrito = NULL;
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

$resultado = ProductoCarrito::borrarProductoCarrito($idCarrito,$idProducto);

echo json_encode(array(

    "resultado"=>$resultado

));

?>