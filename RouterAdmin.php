<?php

namespace MVC;


// Para conectar el index con sus respectivos controladores

class RouterAdmin
{

    public $rutasGET = [];
    public $rutasPOST = [];

    // Obtiene las rutas en GET

    public function post($url,$fn){

        $this->rutasPOST[$url]= $fn;

    }

    // Obtiene las rutas en POST
    public function get($url, $fn){

        $this->rutasGET[$url] = $fn;

    }


    // Comprueba que ruta es la actual y ejecuta los controladores
    public function comprobarRutas()
    {



        //Arreglo de rutas protegidas...

      //  $rutas_protegidas = [''];

        $url = $_GET['views'] ?? '';
        $urlActual = "/".$url;
        $metodo = $_SERVER['REQUEST_METHOD'];
        // var_dump($_GET['views']);
         //debuguear($urlActual);

        // $urlActual = $_SERVER['PATH_INFO'] ?? "/";




        // Obtiene la funcion dependiendo del metodo a ejecutar

        $fn = null;
        if($metodo === "GET"){
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        }else if($metodo === "POST"){
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }


        //Arreglo de rutas protegidas...

        // $rutas_protegidas = ['/admin','/admin/crear','admin/actualizar'];
         $rutas_protegidas = [];

        $auth = $_SESSION["login"] ?? NULL;

        //Proteger las rutas

         if(in_array($urlActual,$rutas_protegidas) && !$auth ){

            header("Location: /auriculares-premium/auriculares-premium");

         }

        // Si la url existe y tiene func
        if(isset($fn)){

            // Llama la funcion que tiene la variable
                // Fn contiene la referencia al controlador y la funcion
                // Mientras que this contiene la instancia d este proyecto del nnuevo router

            call_user_func($fn, $this);

        }else{

            echo "Pagina no encontrada";

        }



    }


    // Muestra una views renderiza
    // Pasa los datos por arreglo

    public function render($view,$datos = []){

        // ob_start() Inicia un almacenamiento en memoria

        foreach ($datos as $key => $value) {

            // Doble signo de dolar crea una variable con nombre igual a la llave
            // y valor igual al value
            $$key = $value;

        }

        ob_start();

        include __DIR__ . "/admin/templates/$view.php";

        // Get_clean Limpiamos la memoria $contenido almacena la view que le pasamos

        $contenido = \ob_get_clean();

        include __DIR__ . "/admin/templates/layout/layout.php";

    }

}