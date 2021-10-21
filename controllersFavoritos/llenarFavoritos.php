<?php

require "../includes/funciones/app.php";




session_start();
$id_usuario = NULL;


$id_usuario = $_SESSION["id_usuario"] ?? null;

$existeUsuario = false;

$resultado = false;



$productos = [];

try{

    $stmtt = $db->prepare("SELECT * FROM favoritos WHERE id_usuario = ?");

    $stmtt->bind_param("i",$id_usuario);
    $stmtt->execute();

    // Obtener resultado de favoritos
    $resultado = $stmtt->get_result();


    // Si hay resultado existe usuario
    if($resultado){

        $existeUsuario = true;

    }

    // Por cada favorito existente:
    while($favorito = mysqli_fetch_assoc($resultado)){
        $id_producto = $favorito["id_producto"];
        $producto = null;

        // Obtiene el producto
        try{

            $stmt = $db->prepare("SELECT * FROM productos WHERE id = ? LIMIT 1;");
            $stmt->bind_param("i",$id_producto);
            $stmt->execute();

            $producto = $stmt->get_result();
            $producto = mysqli_fetch_assoc($producto);


            $stmt->close();
            //$db->close();


        }catch(Exception $e){

            echo "Error". $e->getMessage();

        }

        // Obtiene las imagenes
        try{

            $stmt = $db->prepare("SELECT * FROM imagenes_producto WHERE id_producto = ? LIMIT 1;");
            $stmt->bind_param("i",$id_producto);
            $stmt->execute();

            $imagenes = $stmt->get_result();
            $imagen = mysqli_fetch_assoc($imagenes);
            $producto["imagen"] = $imagen["urls"];
            $productos[] = $producto;



            $stmt->close();
            //$db->close();


        }catch(Exception $e){

            echo "Error". $e->getMessage();

        }






    };



    $stmtt->close();
    $db->close();

}catch(Exception $e){

    echo "Error". $e->getMessage();

}

//die(json_encode($respuesta));

///////----///////----///////----///////----///////----///////

// if($id_usuario){
//    $existeUsuario = true;

//    $query = "SELECT * FROM favoritos WHERE id_usuario=$id_usuario";
//    $resultado = mysqli_query($db, $query);





// }



session_write_close();

echo json_encode(array(

    "existeUsuario"=>$existeUsuario,
    "resultado"=>$resultado,
    "productos"=>$productos

 ));




//echo $idCarrito;
