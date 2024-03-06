<?php

use Core\Request;
use Routes\Routes;

spl_autoload_register(function ($class) {
    require_once str_replace("\\", "/", $class) . ".php";
});

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//"Se Obtienen las Rutas";
$rutas = new Routes();
$routes = $rutas->ListaRutas();
// Obtiene la URL
$url = $_SERVER['REQUEST_URI'];

// Crea una instancia de la clase Request
$request = new Request($_SERVER['PHP_SELF'], $_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_FILENAME'], $_SERVER['DOCUMENT_ROOT'], $routes);
// Obtiene la ruta coincidente
$route = $request->validate_url($url);
//print_r($route);
// Si se encontró una ruta válida
if ($route) {
    // Llama al método Metodo_url
    $request->Metodo_url($route, $url);
} else {
    // Retorna un error de ruta no encontrada
    echo "Error 404: Ruta no encontrada";
}
