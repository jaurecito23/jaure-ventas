<?php

//define("BUILD", __DIR__."/../tufrutiya/build/");
// define("CARPETA_IMAGENES", __DIR__."/../../imagenes/");

function incluirTemplate($nombre,$nave = false,$tipo = "Verduras",$cantidad = 1){

    $nav = $nave;
    $productos = $nave;
    include __DIR__."/../templates/${nombre}.php";

}

function debuguear($var){

    echo "<pre>";
        var_dump($var);
    echo "</pre>";
    exit;

}

function san($value){

    $value = htmlspecialchars($value);
    return $value;

}


function validarORedireccionar($url){

    $id = buscarQueryString("id");
    $id = filter_var($id ,FILTER_VALIDATE_INT);

        if(!$id){

            header("Location: ${url}");

        }

        return $id;



}

function buscarQueryString($var)
{
    $var = "?".$var. "=";
    $resultado = explode("${var}", $_SERVER['REQUEST_URI'])[1] ?? null;

    if ($resultado !== null) {
        return intval($resultado);
    } else {
        return $resultado;
    }
}


function mostrar($var){

    echo "<pre>";
        var_dump($var);
    echo "</pre>";

}

function obtenerFecha($tipo){

    if($tipo == "actual"){
        $fecha =date("Y")."-".date("m")."-".date("d");
        return $fecha;
    }
}


function obtenerGet(){

    $var ="?";
    $resultado = explode("?", $_SERVER['REQUEST_URI'])[1] ?? null;
    if($resultado !== null){
    $resultado =  explode("&", $resultado) ?? null;

    $get = [];


        foreach ($resultado as $variable) {

            $values = explode("=", $variable)?? null;

            $get[$values[0]] =$values[1];

        }

        return $get;
    }

}
?>