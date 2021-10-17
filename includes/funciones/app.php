<?php
//Funciones
require __DIR__ . "/funciones.php";
//Coneccion a DB
require __DIR__."/../config/database.php";
//Autoload
require __DIR__."/../../vendor/autoload.php";

$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);


?>