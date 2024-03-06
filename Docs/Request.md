## Documentación de la clase `Request` del namespace `Core`

Esta clase se encarga de procesar la información de la solicitud HTTP entrante y validar rutas definidas en la aplicación.

**Atributos Privados:**

* `self::$php_self`: String que contiene el nombre del script actual (por ejemplo, `/index.php`).
* `self::$request_uri`: String que contiene la URI de la solicitud (por ejemplo, `/usuarios/123`).
* `self::$script_filename`: String que contiene la ruta completa del script actual (por ejemplo, `/var/www/html/index.php`).
* `self::$document_root`: String que contiene la ruta raíz del documento del servidor web (por ejemplo, `/var/www/html`).
* `self::$routes`: Arreglo que contiene las rutas definidas para la aplicación. Cada ruta tiene la estructura:

```php
array(
    'path' => '/ruta/de/la/aplicacion',  // Ruta de la aplicación
    'controller' => 'NombreControlador', // Nombre del controlador asociado a la ruta
    'method' => 'metodoHTTP',            // Método HTTP permitido (GET, POST, PUT, DELETE)
)
```

**Constructor:**

* `__construct(string $php_self, string $request_uri, string $script_filename, string $document_root, array $routes)`: Inicializa los atributos de la clase y almacena las variables del servidor para su uso posterior.

**Métodos Públicos:**

* `getUrl()`: Obtiene la URL limpia de la solicitud actual, eliminando la ruta del script y la raíz del documento.
* `getPublic_url()`: Obtiene la ruta pública de la solicitud, eliminando la ruta del script actual.
* `validate_url(string $url)`: Valida la URL contra las rutas definidas en `self::$routes`. Retorna la ruta correspondiente si se encuentra una coincidencia, o `false` en caso contrario.
* `Metodo_url(array $route, string $url)`: **(Este método parece estar incompleto)** Procesa la solicitud HTTP en base a la ruta y método proporcionados. 

**Explicación del método `Metodo_url` :**

Este método es el encargado de procesar la solicitud HTTP completa:

1. Obtiene el método HTTP utilizado (`$_SERVER["REQUEST_METHOD"]`).
2. Si se encontró una ruta válida (`$route`) en la validación previa (`validate_url`):
    * Comprueba si el controlador definido en la ruta (`$route['controller']`) coincide con el nombre real del controlador a utilizar.
        * Actualmente, se usa un `switch` para establecer el valor de la variable `$controller` en base al nombre del controlador en la ruta. 
        * Crea una instancia del controlador seleccionado.
    * Si el método de la solicitud (`$requestMethod`) coincide con el método definido en la ruta (`$route['method']`):
        * Obtiene los datos enviados por el usuario en formato JSON (`json_decode(file_get_contents('php://input'), true)`).
        * Si hay datos del usuario (`$data`):
            * Llama al método correspondiente en el controlador según el método HTTP:
                * `GET`: Llama al método `listar` o `filtrar` del controlador dependiendo del valor de `$data['filtro']`.
                * `POST`: Llama al método `agregar` del controlador.
                * `PUT`: Llama al método `modificar` del controlador.
                * `DELETE`: Llama al método `eliminar` del controlador.
    * Si el método de la solicitud no coincide con el definido en la ruta, se retorna un error 405 ("Método no permitido").
3. Si no se encontró una ruta válida, se retorna un error 404 ("Ruta no encontrada").

