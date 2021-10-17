<?php

namespace App;


class Usuario extends ActiveRecord{

    protected static $tabla = "usuarios";
    protected static $columnasDB = ["nombres","apellidos","celular","email","direccion","ciudad","localidad","contrasena","notas"];

    public $id;
    public $nombres;
    public $apellidos;
    public $celular;
    public $email;
    public $direccion;
    public $ciudad;
    public $localidad;
    public $contrasena;
    public $notas;

    public function __construct($args = []){

        $this->id = $args["id"]  ?? NULL;
        $this->nombres = $args["nombres"] ?? "";
        $this->apellidos = $args["apellidos"] ?? "";
        $this->celular = $args["celular"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->direccion = $args["direccion"] ?? "";
        $this->ciudad = $args["ciudad"] ?? "";
        $this->localidad = $args["localidad"] ?? "";
        $this->contrasena = $args["contrasena"] ?? "";
        $this->notas = $args["notas"] ?? "";

    }


/////////VALIDANDO //////////////////////////

public function validar(){
    //----nombre
    if(!$this->nombres){

        self::$errores[] = "Debes Colocar Un Nombre";

    }else{

        if(strlen($this->nombres) > 30){

            self::$errores[] = "Los nombres deben  tener menos de 20 caracteres";

        }

        if(strlen($this->nombres) < 2){

            self::$errores[] = "Los nombres deben tener más de 3 caracteres";

        }

    }
    //----apellidos
    if(!$this->apellidos){

        self::$errores[] = "Debes Colocar Un Nombre";

    }else{

        if(strlen($this->apellidos) > 30){

            self::$errores[] = "Los apellidos deben  tener menos de 20 caracteres";

        }

        if(strlen($this->apellidos) < 2){

            self::$errores[] = "Los apellidos deben tener más de 3 caracteres";

        }

    }


    if(!$this->celular){

        self::$errores[] = "Debes Colocar un celular";

    }

    if(!$this->email){

        self::$errores[] = "Debes Ingresar un email";

    }

    if(!$this->direccion){

        self::$errores[] = "Debes Ingresar una ciudad";

    }

    if(!$this->ciudad){

        self::$errores[] = "Debes Ingresar una ciudad";

    }

    if(!$this->localidad){

        self::$errores[] = "Debes Ingresar una ciudad";

    }
    if(!$this->contrasena){

        self::$errores[] = "Debes Ingresar una contraseña";

    }



    return self::$errores;


}


public function existeUsuario(){

    $celular = $this->celular ?? NULL;
    $email = $this->email ?? NULL;

    $query = "SELECT * FROM usuarios WHERE email = '$email'  OR celular = '$celular';";
    $resultado = self::$db->query($query);

    $existe = false;


    if($resultado->num_rows > 0){

        $existe = true;

    }

    return $existe;





}

public static function ingresarUsuario($email){

    $query = "SELECT * FROM usuarios WHERE email = '$email'  OR celular = '$email' LIMIT 1;";

    $resultado = self::$db->query($query);

    return $resultado;

}

    public function ingresarCodigoCambiarContraseña($codigo){

        $id_usuario = $this->id;

        $query = "INSERT INTO codigos_contraseñas (id_usuario,codigo) VALUES ('$id_usuario','$codigo');";
        $resultado = self::$db->query($query);

        return $resultado;


    }
    public static function verificarCodigoContraseña($codigo){



        $query = "SELECT * FROM codigos_contraseñas WHERE codigo = $codigo LIMIT 1;";
        $resultado = self::$db->query($query);

        return $resultado;


    }

    public static function actualizarContraseña($codigo,$contraseñaCifrada){

        $resultado = static::verificarCodigoContraseña($codigo);

        $id_usuario = $resultado->fetch_assoc()["id_usuario"];

        $query = "UPDATE usuarios SET contrasena = '${contraseñaCifrada}' WHERE id = $id_usuario;";
        $resultado = self::$db->query($query);
        if($resultado){

            $query = "DELETE FROM codigos_contraseñas WHERE id_usuario = $id_usuario;";
            $resultado = self::$db->query($query);
            if($resultado){



                return true;

            }
        }
    }

    public static function encontrarUsuarioEmail($email){

        $query = "SELECT * FROM usuarios WHERE email = '${email}' LIMIT 1";


       $resultado = self::consultarSQL($query);

        return array_shift($resultado);


    }








}