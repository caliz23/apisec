## Documentación de la clase `Cpermisos` del Namespace `Controllers`

Esta clase se encarga de gestionar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre la tabla `apisec.permisos` de la base de datos.

**Atributos:**

* `$tabla`: String que contiene el nombre de la tabla a la que se accede (`apisec.permisos`).
* `$campos`: Arreglo que contiene los nombres de los campos de la tabla.
* `$condiciones`: Arreglo que contiene las condiciones para las consultas a la base de datos.
* `$modelo`: Instancia de la clase `Modelos` que se utiliza para realizar las operaciones CRUD.
* `$mensaje`: Instancia de la clase `CMensajes` que se utiliza para generar mensajes de respuesta.

**Métodos Públicos:**

* **`listar()`:** Obtiene todos los registros de la tabla `apisec.permisos` y genera un mensaje de respuesta con el código `success`.
* **`filtrar($filtro)`:** Obtiene los registros de la tabla `apisec.permisos` que cumplen con la condición especificada en `$filtro` y genera un mensaje de respuesta con el código `success` o `error` dependiendo de si se encontraron resultados.
* **`agregar($datos)`:** Inserta un nuevo registro en la tabla `apisec.permisos` con los datos proporcionados en `$datos` y genera un mensaje de respuesta con el código `success` o `error` dependiendo del éxito de la operación.
* **`modificar($datos, $filtro)`:** Actualiza un registro de la tabla `apisec.permisos` que cumple con la condición especificada en `$filtro` con los datos proporcionados en `$datos` y genera un mensaje de respuesta con el código `success` o `error` dependiendo del éxito de la operación.
* **`eliminar($filtro)`:** Elimina un registro de la tabla `apisec.permisos` que cumple con la condición especificada en `$filtro` y genera un mensaje de respuesta con el código `success` o `error` dependiendo del éxito de la operación.

**Observaciones:**

* Se utiliza la clase `Modelos` para realizar las operaciones CRUD a la base de datos.
* Se utiliza la clase `CMensajes` para generar mensajes de respuesta con un código y una descripción.
* Se debe implementar el código de la bitácora en las funciones `agregar`, `modificar` y `eliminar`.


**Nota:**

* Se debe implementar la lógica para la autenticación y autorización de los permisos antes de permitir el acceso a los métodos de la clase.
