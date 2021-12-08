<?php
    // Enlazar el app
    session_start();
     require_once __DIR__ . "/../includes/funciones/app.php";

     use Controllers\PaginasController;
     use Controllers\AdminController;
     use Controllers\PagarController;
     use MVC\Router;
     use App\Producto;

$router = new Router();

//PropiedadController::class Trae el namespace donde se encuentra

//AdministradorZONA PRIVADA


//GET



// Paginas Publicas
$router->get("/",[PaginasController::class,"home"]);
$router->get("/producto",[PaginasController::class,"producto"]);
$router->get("/tienda",[PaginasController::class,"tienda"]);
$router->get("/crearcuenta",[PaginasController::class,"crearcuenta"]);
$router->get("/cerrarsession",[PaginasController::class,"cerrarsession"]);
$router->get("/micuenta",[PaginasController::class,"micuenta"]);
$router->get("/ingresar",[PaginasController::class,"ingresar"]);
$router->get("/cambiarcontrasena",[PaginasController::class,"cambiarcontrasena"]);
$router->get("/pagar",[PagarController::class,"pagar"]);
$router->get("/terminarpago",[PagarController::class,"terminarpago"]);
$router->get("/resultadopagar",[PagarController::class,"resultadopagar"]);
$router->get("/pasapalabras",[PaginasController::class,"pasapalabras"]);



// Paginas Admin
$router->get("/admin",[AdminController::class,"admin"]);




// POST

// Paginas Publicas
$router->post("/cambiarcontrasena",[PaginasController::class,"cambiarcontrasena"]);
$router->post("/crearcuenta",[PaginasController::class,"crearcuenta"]);
$router->post("/ingresar",[PaginasController::class,"ingresar"]);
$router->post("/pagar",[PagarController::class,"pagar"]);

// Paginas Admin
$router->comprobarRutas();