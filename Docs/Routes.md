## Documentación de la clase `Routes` del Namespace `Routes`

Esta clase se encarga de definir las rutas de la aplicación para las solicitudes HTTP entrantes.

**Método Público:**

* `ListaRutas()`: Devuelve un arreglo que contiene las rutas definidas para la aplicación. Cada ruta tiene la estructura:

```php
array(
    'path' => '/ruta/de/la/aplicacion',  // Ruta de la aplicación (URL)
    'method' => 'metodoHTTP',            // Método HTTP permitido (GET, POST, PUT, DELETE)
    'controller' => 'NombreControlador', // Nombre del controlador asociado a la ruta
)
```

**Explicación del método `ListaRutas`:**

Este método define un arreglo llamado `$routes` que almacena la configuración de las rutas de la aplicación. Cada elemento del arreglo representa una ruta y contiene la siguiente información:

* `path`: La ruta de la aplicación a la que se aplica esta definición. Por ejemplo, `/api/usuarios`.
* `method`: El método HTTP permitido para esta ruta. Puede ser `GET`, `POST`, `PUT`, o `DELETE`.
* `controller`: El nombre del controlador que se encargará de procesar la solicitud si la ruta coincide.

