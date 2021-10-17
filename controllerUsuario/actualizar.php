<?php


require "../includes/funciones/app.php";

session_start();

$id_usuario = $_SESSION["id_usuario"] ?? null;


if($id_usuario){


    $tipo = $_POST["tipo"] ?? null;
    $valor = $_POST["valor"] ?? null;
    $resultado = null;
    if($valor !== ""){

        $query = "UPDATE usuarios SET ${tipo} = '${valor}' WHERE id = $id_usuario;";

        $resultado= mysqli_query($db, $query);

    }else{

        $resultado = false;

    }

            echo json_encode(array(

                "valor"=>$valor,
                "tipo"=>$tipo,
                "resultado"=>$resultado

            ));


}










?>