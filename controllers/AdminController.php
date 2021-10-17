<?php

namespace Controllers;

use MVC\RouterAdmin;
use App\Producto;
use App\Usuario;
use App\ProductoCarrito;

class AdminController{

    public static function admin(RouterAdmin $router){



        $router->render('paginas/admin-area',[


        ]);

    }
    public static function crearadmin(RouterAdmin $router){



        $router->render('paginas/crearadmin',[



        ]);

    }


}