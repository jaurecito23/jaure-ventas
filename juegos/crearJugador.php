<?php 

require "../includes/funciones/app.php";

$respuesta = [];

$apodo = $_POST["apodo"];

try{


    $stmt = $db->prepare("INSERT INTO apodos_pasapalabras (apodo,puntaje,nombre,celular) VALUES(?,?,?,?)");

    $null = "NULL";
    $cero = 0;

    $stmt->bind_param("siss",$apodo,$cero,$null,$null);
    $stmt->execute();


    $respuesta = array(
        "resultado"=>"exitoso",
        "apodo"=>$apodo,
        "id_jugador"=>$stmt->insert_id
    );


}catch(Exception $e){

    $respuesta = array(

        "resultado"=>"error",
        "error"=>$e->getMessage()

    );


}




echo json_encode($respuesta);






?>