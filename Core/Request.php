<?php

namespace Core;

use Controllers\Cauth;
use Controllers\Cpermisos;
use Controllers\Croles;
use Controllers\Cusuarios;

class Request
{
    private static $php_self;
    private static $request_uri;
    private static $script_filename;
    private static $document_root;

    private static $routes;

    public function __construct($php_self, $request_uri, $script_filename, $document_root, $routes)
    {
        // Almacena las variables del servidor para su uso posterior
        self::$php_self = $php_self;
        self::$request_uri = $request_uri;
        self::$script_filename = $script_filename;
        self::$document_root = $document_root;
        self::$routes = $routes;
    }
    public static function getUrl()
    {
        // Obtiene la ruta del script actual
        $path_origen = self::$script_filename;

        // Obtiene la ruta principal de la aplicación
        $path_main = self::$document_root . self::$php_self;

        // Calcula la URL de la solicitud
        $request_url = str_replace($path_origen, '', '/' . $path_main);

        // Retorna la URL de la solicitud
        return empty($request_url) ? '/' : $request_url;
    }

    public static function getPublic_url()
    {
        // Obtiene la ruta del script actual
        $path_origen = self::$script_filename;

        // Obtiene la URI de la solicitud
        $request_uri = self::$request_uri;

        // Obtiene la ruta principal de la aplicación
        $path_main = self::$document_root . self::$php_self;

        // Calcula la URL de la solicitud
        $request_url = str_replace($path_origen, '', $path_main);

        // Calcula la ruta pública de la solicitud
        $public_path = str_replace($request_url, '', $request_uri);

        // Retorna la ruta pública de la solicitud
        return $public_path;
    }

    public static function validate_url($url)
    {
        //print_r($url);
        // Recorre las rutas definidas
        foreach (self::$routes as $route) {
            // Crea una expresión regular a partir de la ruta
            $regex_route = preg_replace_callback(
                '/{([^}]+)}/',
                function ($matches) {
                    return "(?P<" . $matches[1] . ">[^/]+)";
                },
                $route['path']
            );

            // Convierte la ruta a una expresión regular compatible con PCRE
            $regex_route = str_replace("/", "\/", $regex_route);

            // Crea una expresión regular completa
            // $regex_route = '/^' . <span class="math-inline">regex\_route \. '</span>/';
            $regex_route = '/^' . $regex_route . '/';

            // Si la URL coincide con la expresión regular
            if (preg_match($regex_route, $url, $matches)) {
                // Retorna la ruta
                return $route;
            }
        }

        // Si no se encuentra ninguna coincidencia
        return false;
    }
    /*
    public static function Metodo_url($result, $url)
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($result) {
            //echo $result . 'ELWEBO';
             //echo $url;
            switch ($url) {
                case '/api/auth':
                    switch ($requestMethod) {
                        case 'GET':
                            //code block
                            break;
                            ##Aqui Termina case metodo
                        case 'POST':
                            $auth = json_decode(file_get_contents('php://input'), true);
                            if ($auth) {
                                //  print_r($auth);
                                $autenticar = new Cauth();
                                if ($auth != "") {
                                    //print_r( $filtro);
                                    $autenticar->autenticar($auth);
                                }
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'PUT':
                            //code block
                            break;
                            ##Aqui Termina case metodo
                        case 'DELETE':
                            //code block
                            break;
                            ##Aqui Termina case metodo
                        default:
                            //code block
                    }
                    break;
                    ##AQUI TERMINA EL CASE URL
                case '/api/usuarios':
                    switch ($requestMethod) {
                        case 'GET':
                            $user = json_decode(file_get_contents('php://input'), true);
                            if ($user) {
                                $filtro = $user['filtro'];
                                $usuarios = new Cusuarios();
                                if ($filtro != "") {
                                  //    print $filtro;
                                    ($filtro == "All") ? $usuarios->listarusuarios() : $usuarios->filtrarusuarios($filtro);
                                }
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'POST':
                            $user = json_decode(file_get_contents('php://input'), true);
                            //print_r($datos);
                            if ($user) {
                                //print_r($user);
                                foreach ($user as $key => $data) {
                                    $datos[] = $data;
                                }
                                $usuarios = new Cusuarios();
                                $usuarios->agregarusuario($datos);
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'PUT':
                            $user = json_decode(file_get_contents('php://input'), true);
                            if ($user) {
                                foreach ($user as $key => $data) {
                                    $datos[] = $data;
                                }
                                //print_r($datos);
                                $filtro = $datos[0];
                                //print $filtro;
                                $usuarios = new Cusuarios();
                                $usuarios->modificarusuario($datos, $filtro);
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'DELETE':
                            $user = json_decode(file_get_contents('php://input'), true);
                            if ($user) {
                                $usuarios = new Cusuarios();
                                $usuarios->eliminarusuarios($user['filtro']);
                            }
                            break;
                            ##Aqui Termina case metodo
                        default:
                            return "Error 404";
                    };
                    break;
                    ##AQUI TERMINA EL CASE URL
                case '/api/permisos':
                    switch ($requestMethod) {
                        case 'GET':
                            $permiso = json_decode(file_get_contents('php://input'), true);
                            if ($permiso) {
                                $filtro = $permiso['filtro'];
                                $permisos = new Cpermisos();
                                if ($filtro != "") {
                                    //  print $filtro;
                                    ($filtro == "All") ? $permisos->listarpermisos() : $permisos->filtrarpermisos($filtro);
                                }
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'POST':
                            $permiso = json_decode(file_get_contents('php://input'), true);
                            //print_r($datos);
                            if ($permiso) {
                                //print_r($permiso);
                                foreach ($permiso as $key => $data) {
                                    $datos[] = $data;
                                }
                                $permisos = new Cpermisos();
                                $permisos->agregarpermiso($datos);
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'PUT':
                            $permiso = json_decode(file_get_contents('php://input'), true);
                            if ($permiso) {
                                foreach ($permiso as $key => $data) {
                                    $datos[] = $data;
                                }
                                //print_r($datos);
                                $filtro = $datos[0];
                                //print $filtro;
                                $permisos = new Cpermisos();
                                $permisos->modificarpermiso($datos, $filtro);
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'DELETE':
                            $permiso = json_decode(file_get_contents('php://input'), true);
                            if ($permiso) {
                                $permisos = new Cpermisos();
                                $permisos->eliminarpermisos($permiso['filtro']);
                            }
                            break;
                            ##Aqui Termina case metodo
                        default:
                            return "Error 404";
                    };
                    break;
                    ##AQUI TERMINA EL CASE URL
                case '/api/roles':
                    switch ($requestMethod) {
                        case 'GET':
                            $rol = json_decode(file_get_contents('php://input'), true);
                            if ($rol) {
                                $filtro = $rol['filtro'];
                                $roles = new Croles();
                                if ($filtro != "") {
                                    //  print $filtro;
                                    ($filtro == "All") ? $roles->listarroles() : $roles->filtrarroles($filtro);
                                }
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'POST':
                            $rol = json_decode(file_get_contents('php://input'), true);
                            //print_r($datos);
                            if ($rol) {
                                //print_r($rol);
                                foreach ($rol as $key => $data) {
                                    $datos[] = $data;
                                }
                                $roles = new Croles();
                                $roles->agregarRol($datos);
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'PUT':
                            $rol = json_decode(file_get_contents('php://input'), true);
                            if ($rol) {
                                foreach ($rol as $key => $data) {
                                    $datos[] = $data;
                                }
                                //print_r($datos);
                                $filtro = $datos[0];
                                //print $filtro;
                                $roles = new Croles();
                                $roles->modificarRol($datos, $filtro);
                            }
                            break;
                            ##Aqui Termina case metodo
                        case 'DELETE':
                            //code block
                            $rol = json_decode(file_get_contents('php://input'), true);
                            if ($rol) {
                                $roles = new Croles();
                                $roles->eliminarroles($rol['filtro']);
                            }
                            break;
                            ##Aqui Termina case metodo
                        default:
                            return "Error 404";
                    };
                    break;
                    ##AQUI TERMINA EL CASE URL
                case '/api/aplicaciones':
                    switch ($requestMethod) {
                        case 'GET':
                            //code block
                            break;
                            ##Aqui Termina case metodo
                        case 'POST':
                            //code block;
                            break;
                            ##Aqui Termina case metodo
                        case 'PUT':
                            //code block
                            break;
                            ##Aqui Termina case metodo
                        case 'DELETE':
                            //code block
                            break;
                            ##Aqui Termina case metodo
                        default:
                            return "Error 404 ";
                    }
                    break;
                    ##AQUI TERMINA EL CASE URL
                default:
                    return "Error 404";
                    break;
            }
        }
    }
*/

    public static function Metodo_url($route, $url)
    {
        // Obtiene el método HTTP utilizado
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // Si se encontró una ruta válida
        if ($route) {
            // Si el controlado coincide con el controlador en las Rutas

            switch ($route['controller']) {
                case 'Cauth':
                    //$controller = new Cauth();
                    break;
                case 'Cusuarios':
                    $controller = new Cusuarios();
                    break;
                case 'Croles':
                    $controller = new Croles();
                    break;
                case 'Cpermisos':
                    $controller = new Cpermisos();
                    break;
                case 'Caplicaciones':
                    //$controller = new Caplicaciones();
                    break;
            }
            // Si el método coincide con el método de la rutas

            if ($route['method'] === $requestMethod) {
                // Obtiene los datos enviados por el usuario
                $data = json_decode(file_get_contents('php://input'), true);
                //print_r($data);
                // Crea una instancia del controlador
                //$controller = new $route['controller']();


                // Si se recibieron datos
                if ($data) {
                    // Llama al método correspondiente en el controlador
                    //   echo "ENTRO";
                    switch ($requestMethod) {
                        case 'GET':
                            if ($data['filtro'] != "") {
                                ($data['filtro'] == "All") ? $controller->listar() : $controller->filtrar($data['filtro']);
                            }
                            break;
                        case 'POST':
                            $controller->agregar($data);
                            break;
                        case 'PUT':
                            $filtro = $data[0];
                            $controller->modificar($data, $filtro);
                            break;
                        case 'DELETE':
                            $controller->eliminar($data['filtro']);
                            break;
                    }
                }
            } else {
                // Retorna un error de método no permitido
                return "Error 405: Método no permitido";
            }
        } else {
            // Retorna un error de ruta no encontrada
            return "Error 404: Ruta no encontrada";
        }
    }
}
