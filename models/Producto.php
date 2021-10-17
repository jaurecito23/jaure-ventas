<?php

namespace App;


class Producto extends ActiveRecord{

    protected static $tabla = "productos";
    protected static $columnasDB = ["nombre","precio","id_categoria","descuento","precio_anterior","descripcion"];

    public $id;
    public $nombre;
    public $precio;
    public $id_categoria;
    public $descuento;
    public $precio_anterior;
    public $descripcion;
    public $imagenes;

    public function __construct($args = []){


        $this->id = $args["id"]  ?? NULL;
        $this->nombre = $args["nombre"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->id_categoria = $args["id_categoria"] ?? "";
        $this->descuento = $args["descuento"] ?? "";
        $this->precio_anterior = $args["precio_anterior"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->imagenes = $args["imagenes"] ?? [];

    }


/////////VALIDANDO //////////////////////////

public function validar(){
    //----nombre
    if(!$this->nombre){

        self::$errores[] = "Debes Colocar Un Nombre";

    }else{

        if(strlen($this->nombre) > 30){

            self::$errores[] = "Los nombres deben  tener menos de 20 caracteres";

        }

        if(strlen($this->nombre) < 2){

            self::$errores[] = "Los nombres deben tener más de 3 caracteres";

        }

    }

//////----descripcion

    if(!$this->descripcion){

        self::$errores[] = "Debes Colocar Una Descripción";

    }else{

        if(strlen($this->descripcion) > 100){

            self::$errores[] = "La descripción tiene más de 100 caracteres";

        }

        if(strlen($this->descripcion) < 8){

            self::$errores[] = "La descripción tiene menos de 8 caracteres";

        }

    }

    if(!$this->precio){

        self::$errores[] = "Debes Ingresar un Precio";

    }

    if(!$this->id_categoria || !$this->id_categoria == "--Seleccione--"){

        self::$errores[] = "Debes Elegir una Categoria";

    }
    if(!$this->descuento ){

        self::$errores[] = "Debes ingresar un descuento";

    }
    if(!$this->precio_anterior ){

        self::$errores[] = "Debes ingresar un precio anterior";

    }



    return self::$errores;


}


public function eliminarProducto(){

    $id = self::$db->escape_string($this->id) ?? NULL;

    $borrado = NULL;

    if($id !== NULL){

        $query1 = "DELETE FROM productos_carrito WHERE idProducto=${id}";
        $borrado = self::$db->query($query1);
        $query2 = "DELETE FROM fechas_cierre WHERE idProducto=${id}";
        $borrado = self::$db->query($query2);
    }

    if($borrado){

        $query = "DELETE FROM productos WHERE id ='${id}' LIMIT 1";
        $resultado = self::$db->query($query);

    }

    $this->borrarImagen();

    if($resultado){

      // header("Location: /tufrutiya/tufrutiya/admin?resultado=2");

    }

}



public static function obtenerMasVendidos(){

    $query = "SELECT * FROM productos WHERE id = (SELECT id_producto FROM mas_vendidos LIMIT 1);";
    $resultado = $resultado = self::consultarSQL($query);
    return $resultado;

}
public static function obtenerProductosCalidad(){

    $query = "SELECT id_producto FROM productos_calidad";
    $id_productos = self::$db->query($query);

    $resultado = [];
    foreach($id_productos as  $id_producto){
        $id = $id_producto["id_producto"];
        $query = "SELECT * FROM productos WHERE id = $id";
        $resultado[] = self::consultarSQL($query);

    }

    return $resultado;

}


    public function obtenerImagenes(){

        $id = $this->id;
        $query = "SELECT * FROM imagenes_producto WHERE id_producto = $id;";
        $resultado = self::$db->query($query);





        while($img = $resultado->fetch_assoc()){

            $imagenes[] = $img["urls"];

        };

        return $imagenes;


    }

    public static function obtenerCategorias(){

        $query = "SELECT * FROM categorias";
        $resultado = self::$db->query($query);


        $categorias = [];

        while($categoria = $resultado->fetch_assoc()){

            $categorias[] = $categoria;

        }
     return $categorias;


    }



}