<?php 

require "../includes/funciones/app.php";

$id_producto = $_POST["id_producto"] ?? 11;

$respuesta = array();

try{

    $stmt = $db->prepare("SELECT * FROM opiniones_productos  WHERE id_producto = ? ORDER BY id DESC LIMIT 3;");
    $stmt->bind_param("i",$id_producto);
    $stmt->execute();


    $opiniones = [];

    $resultado = $stmt->get_result();
    $puntajes = array(

        "1"=>0,
        "2"=>0,
        "3"=>0,
        "4"=>0,
        "5"=>0

    );

    foreach($resultado as $opinion){

        $puntos = $opinion["puntaje"];

        $puntajes[$puntos]++;
        $opiniones[] = $opinion;

    }

    $respuesta = array(

        "resultado"=>"Correcto",
        "opiniones"=>$opiniones,
        "puntajes"=>$puntajes

    );   



}catch(Exception $e){

    $respuesta = array(

        "resultado"=>"error",
        "error"=>$e->getMessage()

    );


}


echo json_encode($respuesta);

?>