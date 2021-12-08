<?php



function conectarDB():mysqli{

   //$db = new mysqli("localhost","c2390677_ventas","dimu17daNI","c2390677_ventas");
   $db = new mysqli("localhost","root","root","c2390677_ventas","3000");
    if($db){

        return $db;

    }else{

        echo "Hubo un error en la coneccion";
        exit;
    }

}


?>