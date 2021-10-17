<?php

    require "../includes/funciones/app.php";

    $id = $_POST["id"] ?? null;

    $db = conectarDB();



    if($id){


        $query = "SELECT count(nombre) FROM productos WHERE id_categoria = $id";
         $resultado= mysqli_query($db, $query);



      $total = mysqli_fetch_assoc($resultado);

        $total = $total["count(nombre)"];

        echo $total;

    }



?>