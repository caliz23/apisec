<?php

namespace Routes;


class Routes
{
    public static function ListaRutas()
    {
        // Define las rutas
        $routes = [
            //['path' => '/', 'method' => 'GET', '' => 'index'],

            ['path' => '/api/auth', 'method' => 'POST', 'controller' => 'Cauth'],

            ['path' => '/api/usuarios', 'method' => 'GET', 'controller' => 'Cusuarios'],
            ['path' => '/api/usuarios', 'method' => 'POST', 'controller' => 'Cusuarios'],
            ['path' => '/api/usuarios', 'method' => 'PUT', 'controller' => 'Cusuarios'],
            ['path' => '/api/usuarios', 'method' => 'DELETE', 'controller' => 'Cusuarios'],

            ['path' => '/api/roles', 'method' => 'GET', 'controller' => 'Croles'],
            ['path' => '/api/roles', 'method' => 'POST', 'controller' => 'Croles'],
            ['path' => '/api/roles', 'method' => 'PUT', 'controller' => 'Croles'],
            ['path' => '/api/roles', 'method' => 'DELETE', 'controller' => 'Croles'],

            ['path' => '/api/permisos', 'method' => 'GET', 'controller' => 'Cpermisos'],
            ['path' => '/api/permisos', 'method' => 'POST', 'controller' => 'Cpermisos'],
            ['path' => '/api/permisos', 'method' => 'PUT', 'controller' => 'Cpermisos'],
            ['path' => '/api/permisos', 'method' => 'DELETE', 'controller' => 'Cpermisos'],

            ['path' => '/api/aplicaciones', 'method' => 'GET', 'controller' => 'Caplicaciones'],
            ['path' => '/api/aplicaciones', 'method' => 'POST', 'controller' => 'Caplicaciones'],
            ['path' => '/api/aplicaciones', 'method' => 'PUT', 'controller' => 'Caplicaciones'],
            ['path' => '/api/aplicaciones', 'method' => 'DELETE', 'controller' => 'Caplicaciones'],

        ];
        return $routes;//print_r($routes);
    }
}
