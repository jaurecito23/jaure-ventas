<?php


namespace App;

class ActiveRecord{

    protected static $db;
    protected static $tabla;
    protected static $columnasDB = [];
    protected static $errores = [];

  public static function setDB($database){

        self::$db = $database;

    }

    public function guardar(){

        if(is_null($this->id)){

         $resultado =  $this->crear();

         return $resultado;

        }else{

            $this->actualizar();

        }

    }

// SECCION CREAR PRODUCTOS /////////////////////////////////////////////
    public function crear(){

                 $atributos = $this->sanitizarAtributos();

            $query = "INSERT INTO ".static::$tabla." ( ";
            $query .= join(" ,",array_keys($atributos));
            $query .=" ) VALUES('";
            $query .=join("' ,'",array_values($atributos));
            $query .= "');";

           
        

            $resultado = self::$db->query($query);


            $idInsertado = self::$db->insert_id;


           

            return array(
                
                "resultado"=>$resultado,
                "id_insertado"=>$idInsertado

            ); 

    }

    public function actualizar(){

        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
          }


          $query = " UPDATE " .static::$tabla . " SET ";
          $query .= join(',',$valores);
          $query .= " WHERE id = '" . self::$db->escape_string($this->id). "' ";
          $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);


        $tipo = static::$tabla;

        $idInsertado = $this->id;

        if($resultado){

            if($tipo == "clientes"){



                if(isset($_POST["contraseña"])){
                    $contraseña = $_POST["contraseña"][1];
                    $this->setearContraseña($contraseña,$idInsertado);
                }
                header("Location: /tufrutiya/tufrutiya/pagar/envio");

            }

            if($tipo == "boxs"){
                header("Location: /tufrutiya/tufrutiya/admin/boxproductos?id=${idInsertado}");

            }else{
                $this->setearFechaCierre($idInsertado);
                header('Location: /tufrutiya/tufrutiya/admin?resultado=1');
            }
        }

        return $resultado;

      }



    public function sanitizarAtributos(){

        $atributos = $this->atributos();
        $sanitizado = [];

       foreach ($atributos as $key => $value) {

            $sanitizado[$key] = self::$db->escape_string($value);

        }
        return $sanitizado;

    }

    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
//////////////////////////////////////////////////////////////////////////////////////

// SECCION VALIDAR ////////////////////////////////


public function validar(){

    self::$errores = [];
    return $errores;

}


// SECCION OBTENER PRODUCTOS //////////////////////
public static function find($id){
   try{

       $query = "SELECT * FROM ". static::$tabla ." WHERE id = ${id} LIMIT 1";

       $resultado = self::consultarSQL($query);

       return array_shift($resultado);


    }catch(Exception $e){

        $respuesta = array(

          "error"=>$e->getMessage()

    );

    }

}
///////////// OBTENIENDO PRODUCTOS ///////////////////////

public static function obtenerProductos($id_categoria = null, $cantidad = 6){

    $query = "";


    if($id_categoria === null){

       $query = "SELECT * FROM ".static::$tabla." LIMIT 6;";

    }else{

        $query = "SELECT * FROM ".static::$tabla." WHERE id_categoria = $id_categoria ORDER BY precio DESC LIMIT $cantidad ;";


    }



    $resultado = self::consultarSQL($query);

    return $resultado;

}
public static function obtenerTodosProductos(){




 $query = "SELECT * FROM ".static::$tabla.";";

    $resultado = self::consultarSQL($query);

    return $resultado;

}


public static function consultarSQL($query){

    $resultado = self::$db->query($query);



    $array = [];

   while($registro = $resultado->fetch_assoc()){

      $array[] = static::crearObjeto($registro);

   }

   $resultado->free();

   return $array;

}


public static function crearObjeto($registro){

    $objeto = new static;

    foreach ($registro as $key => $value) {

        if(property_exists($objeto,$key)){

            $objeto->$key = $value;

        }



    }
  
    if(static::$tabla == "productos"){

        $objeto->imagenes = $objeto->obtenerImagenes();
        
    }

    return $objeto;

}


// SECCION SUBIR IMAGENES //////////////////////////////////////////////////////

    public function setImagen($imagen){

        if($imagen){

            $this->imagen = $imagen;

        }


    }

// BORRAR ////////////////////////////////////////////////////////

public function eliminar(){

    $id = self::$db->escape_string($this->id) ?? NULL;

    $query = "";

    if($id !== NULL){

        $query = "DELETE FROM ".static::$tabla." WHERE id ='${id}' LIMIT 1";


    }

    $resultado = self::$db->query($query);
    $this->borrarImagen();

    if($resultado){

       header("Location: index.php?resultado=1");

    }

}

public function borrarImagen(){

    $existeArchivo =  file_exists(CARPETA_IMAGENES . $this->imagen);



    if($existeArchivo){
     //   fclose(CARPETA_IMAGENES);
        unlink(CARPETA_IMAGENES.$this->imagen);
    }
}

//////////ERRORES /////////////////////////////



public static function getErrores(){

    return static::$errores;

}



 // Sincorniza el objeto en memoria con los cambios realizados
                        // por el usuario

                        public function sincronizar($args = []){

                            foreach ($args as $key => $value) {
                                if(property_exists($this,$key) && !is_null($value)){

                                      $this->$key = $value;

                                }
                            }

                          }


}