## Documentación de la clase `Modelos`

Esta clase pertenece al namespace `Models` y se utiliza para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en una base de datos PostgreSQL.

**Dependencias:**

* La clase `Modelos` depende de la clase `BaseDatos` del namespace `Core`, la cual presumiblemente se encarga de establecer la conexión con la base de datos.

**Propiedades privadas:**

* `$tabla`: String que almacena el nombre de la tabla en la base de datos.
* `$campos`: Arreglo que almacena los nombres de los campos de la tabla.
* `$conexion`: Objeto de la clase `BaseDatos` que representa la conexión a la base de datos.

**Método constructor (`__construct`):**

* Recibe dos parámetros:
    * `$tabla`: String que representa el nombre de la tabla a la que se va a acceder.
    * `$campos`: Arreglo que contiene los nombres de los campos de la tabla.
* Inicializa las propiedades `$tabla`, `$campos`, y `$conexion`.


**Métodos públicos:**

* `insertar($datos)`:
    * Inserta un nuevo registro en la tabla.
    * Parámetros:
        * `$datos`: Arreglo asociativo que contiene los valores a insertar para cada campo.
    * Retorna:
        * El resultado de la consulta `pg_query` ejecutada. Si la inserción es exitosa, se retorna un recurso de PostgreSQL. De lo contrario, se retorna `false`.
* `actualizar($datos, $condiciones)`:
    * Actualiza registros existentes en la tabla.
    * Parámetros:
        * `$datos`: Arreglo asociativo que contiene los valores nuevos para los campos.
        * `$condiciones`: Arreglo que contiene las condiciones para filtrar los registros a actualizar (opcional).
    * Retorna:
        * El resultado de la consulta `pg_query` ejecutada. Si la actualización es exitosa, se retorna un recurso de PostgreSQL. De lo contrario, se retorna `false`.
* `eliminar($condiciones)`:
    * Elimina registros de la tabla.
    * Parámetros:
        * `$condiciones`: Arreglo que contiene las condiciones para filtrar los registros a eliminar.
    * Retorna:
        * El resultado de la consulta `pg_query` ejecutada. Si la eliminación es exitosa, se retorna un recurso de PostgreSQL. De lo contrario, se retorna `false`.
* `consultar($condiciones = null, $campos = null)`:
    * Consulta registros de la tabla.
    * Parámetros:
        * `$condiciones`: Arreglo (opcional) que contiene las condiciones para filtrar los registros a consultar.
        * `$campos`: Arreglo (opcional) que especifica los campos a consultar. Si se omite, se consultan todos los campos.
    * Retorna:
        * Arreglo de arreglos asociativos que representan los registros consultados. Si no se encuentran registros, se retorna `false`.

* `vincular($tablaRelacion, $entidad1, $campoEntidad1, $entidad2, $campoEntidad2)`: 
    * Este método permite vincular dos entidades en una tabla de relación de muchos a muchos.
    * Toma los siguientes parámetros:
        * `$tablaRelacion`: El nombre de la tabla intermedia (e.g., "seguridad.roles_permisos").
        * `$entidad1`: El ID de la primera entidad.
        * `$campoEntidad1`: El nombre del campo en la tabla intermedia que referencia a la primera entidad (e.g., "tx_rol_id").
        * `$entidad2`: El ID de la segunda entidad.
        * `$campoEntidad2`: El nombre del campo en la tabla intermedia que referencia a la segunda entidad (e.g., "tx_permiso_id").
* `desvincular($tablaRelacion, $entidad1, $campoEntidad1, $entidad2 = null, $campoEntidad2 = null)`:
    * Este método permite desvincular dos entidades en una tabla de relación de muchos a muchos.
    * Toma los siguientes parámetros:
        * `$tablaRelacion`: El nombre de la tabla intermedia (e.g., "seguridad.roles_permisos").
        * `$entidad1`: El ID de la primera entidad.
        * `$campoEntidad1`: El nombre del campo en la tabla intermedia que referencia a la primera entidad (e.g., "tx_rol_id").
        * `$entidad2` (opcional): El ID de la segunda entidad (por defecto null).
        * `$campoEntidad2` (opcional): El nombre del campo en la tabla intermedia que referencia a la segunda entidad (por defecto null).
    * Si `$entidad2` es null, elimina todos los vínculos de la `$entidad1`.
* `validarRelacion($tablaRelacion)`:$modelo = new Modelos("seguridad.roles_permisos", ["tx_rol_id", "tx_permiso_id"]);
    * Este método privado verifica si la tabla proporcionada corresponde a una relación válida de muchos a muchos.

    **Implementacion**
    * $modelo = new Modelos("seguridad.roles_permisos", ["tx_rol_id", "tx_permiso_id"]);
