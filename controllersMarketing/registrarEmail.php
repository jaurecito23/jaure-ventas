<?php

require "../includes/funciones/app.php";



$email = $_POST["email"];


    $query = "INSERT INTO email_marketing (email) VALUES('$email');";

    $resultado= mysqli_query($db, $query);



 echo json_encode(array(

    "email"=>$email,
    "resultado"=>$resultado

 ));








