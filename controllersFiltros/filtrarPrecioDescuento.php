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
    if($tipo == "cambiarPagina"){
        $id_ultimo = $_POST["id_ultimo"];
        $idprimero = $_POST["id_primero"];
        $aumentar = $_POST["aumentar"];
        $ante_ultimo = $_POST["id_ante_ultimo"];

        if($aumentar == "true"){


            $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria AND id < $id_ultimo ORDER BY id DESC LIMIT $cantidad";


        }else{



           $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria AND id BETWEEN  $idprimero AND $ante_ultimo  ORDER BY id DESC LIMIT $cantidad";



        }

    }

    if($tipo == "cantidad"){

        $ordenarPor = $_POST["ordenarPor"];

        if($ordenarPor == 0){

            $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria  ORDER BY id DESC LIMIT $cantidad";

        }else{

            $query = "SELECT * FROM productos WHERE id_categoria = $id_categoria ORDER BY id DESC LIMIT $cantidad";

        }

    }
    if($tipo == "marca"){

        $ordenarPor = $_POST["ordenarPor"];
        $marca = $_POST["marca"];






            $query = "SELECT * FROM detalles_productos INNER JOIN productos ON productos.id = detalles_productos.id_producto WHERE marca = '$marca' ORDER BY productos.id LIMIT $cantidad;";




    }



    $resultado = Producto::consultarSQL($query);

   $imagenes = [];

   $id_primero = false;
   foreach ($resultado as $producto) {

    if($id_primero == false){

        $id_primero = $producto->id;
    }
    $imagenes[$producto->id] = $producto->obtenerImagenes();

   }



    $respuesta = array(

        "id_primero"=>$id_primero,
        "productos"=>$resultado,
        "imagenes"=>$imagenes

    );

    echo json_encode($respuesta);

?>