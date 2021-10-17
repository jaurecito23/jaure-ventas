<?php

    require "../includes/funciones/app.php";
    use App\Producto;


    $tipo = $_POST["tipo"];
    $id_categoria = $_POST["id_categoria"];
    $cantidad = $_POST["cantidad"];

    $query = "";

    if($tipo == "descuentos"){

        $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria ORDER BY descuento DESC LIMIT $cantidad";

    }
    if($tipo == "precioSlider"){

        $minimo = $_POST["minimo"];
        $maximo = $_POST["maximo"];

        $query = "SELECT * FROM productos WHERE precio  BETWEEN $minimo AND $maximo ORDER BY descuento DESC LIMIT $cantidad";


    }

    if($tipo == "precio"){

        $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria  ORDER BY precio DESC LIMIT $cantidad";

    }

    if($tipo == "cantidad"){

        $ordenarPor = $_POST["ordenarPor"];

        if($ordenarPor == 0){

            $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria  ORDER BY precio DESC LIMIT $cantidad";

        }else{

            $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria ORDER BY descuento DESC LIMIT $cantidad";

        }

    }
    if($tipo == "marca"){

        $ordenarPor = $_POST["ordenarPor"];
        $marca = $_POST["marca"];


        if($ordenarPor == 0){



            $query = "SELECT * FROM productos LEFT JOIN detalles_productos ON detalles_productos.marca = '$marca' ORDER BY productos.precio DESC LIMIT $cantidad;";



        }else{

            $query = "SELECT * FROM productos  LEFT JOIN detalles_productos ON detalles_productos.marca = '$marca' ORDER BY productos.descuento DESC LIMIT $cantidad";

        }

    }



    $resultado = Producto::consultarSQL($query);
   $imagenes = [];

   foreach ($resultado as $producto) {
       $imagenes[$producto->id] = $producto->obtenerImagenes();
   }


    $respuesta = array(

        "productos"=>$resultado,
        "imagenes"=>$imagenes

    );

    echo json_encode($respuesta);

?>