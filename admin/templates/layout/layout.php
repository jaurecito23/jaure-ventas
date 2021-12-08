<?php


include_once __DIR__."/header.php";

$paginaActual = obtenerPaginaActual();

if($paginaActual != "/accesorios/admin/login"){

    include_once __DIR__."/barra.php";
    include_once __DIR__."/navegacion.php";

};

echo $contenido;

if($paginaActual !== "/accesorios/admin/login"){

    include_once __DIR__."/footer.php";

};












?>