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
$router->get("/crearproducto",[AdminController::class,"crearproducto"]);
$router->get("/verproductos",[AdminController::class,"verproductos"]);
$router->get("/login",[AdminController::class,"login"]);
$router->get("/crearadmin",[AdminController::class,"crearadmin"]);
$router->get("/cerrarsesion",[AdminController::class,"cerrarsesion"]);


//POST
$router->post("/crearproducto",[AdminController::class,"crearproducto"]);
$router->post("/crearadmin",[AdminController::class,"crearadmin"]);
$router->post("/login",[AdminController::class,"login"]);

// Paginas Admin
$router->comprobarRutas();