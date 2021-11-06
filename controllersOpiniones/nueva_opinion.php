<?php 

require "../includes/funciones/app.php";

    $fecha = obtenerFecha("actual");
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $opinion = $_POST["opinion"];
    $puntaje = $_POST["puntaje"];
    $id_producto = $_POST["id_producto"];


    $respuesta = null;

     try{

     $stmt = $db->prepare("INSERT INTO opiniones_productos (id_producto,opinion,nombre,fecha,puntaje,email) VALUES(?,?,?,?,?,?);");
     $stmt->bind_param("isssis", $id_producto,$opinion,$nombre,$fecha,$puntaje,$email);
     
     $stmt->execute();

     if($stmt->affected_rows > 0){

        $respuesta = array(

            "resultado"=>"Correcto"


        );


     }


     }catch(Exception $e){


        

        $respuesta = array(

            "resultado"=>"Correcto",
           "error" => $e->getMessage()


        );

     }




echo json_encode($respuesta);


?>