<?php


require "../includes/funciones/app.php";



$expresion = $_POST["expresion"] ?? "";

$query = "SELECT * FROM productos WHERE nombre LIKE '%${expresion}%' LIMIT 3;";


$resultado= mysqli_query($db, $query);


$productos = [];

while($producto = mysqli_fetch_assoc($resultado)){

    $id = $producto["id"];
    $query = "SELECT * FROM imagenes_producto WHERE id_producto = $id LIMIT 1;";
    $imagenes = mysqli_query($db, $query);
    $imagen = mysqli_fetch_assoc($imagenes);
    $producto["imagen"] = $imagen["urls"];
    $productos[] = $producto;
};






echo json_encode($productos);
?>