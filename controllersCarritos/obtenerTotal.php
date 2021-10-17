<?php



require "../includes/funciones/app.php";

use App\ProductoCarrito;

session_start();

$idCarrito = NULL;
$total = 0;

if(isset($_SESSION["idCarrito"])){

    $idCarrito = $_SESSION["idCarrito"];

    // Obtiene el total
    $total = ProductoCarrito::obtenerTotal($idCarrito);
}else{

    echo $total;

}
session_write_close();
echo $total;






?>