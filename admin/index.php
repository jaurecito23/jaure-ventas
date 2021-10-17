<?php
    // Enlazar el app
    session_start();
     require_once __DIR__ . "/../includes/funciones/app.php";
     use Controllers\AdminController;
     use MVC\RouterAdmin;

$router = new RouterAdmin();

//PropiedadController::class Trae el namespace donde se encuentra

//AdministradorZONA PRIVADA


//GET


// Paginas Admin
$router->get("/",[AdminController::class,"admin"]);
$router->get("/crearadmin",[AdminController::class,"crearadmin"]);




// Paginas Admin
$router->comprobarRutas();