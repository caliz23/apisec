## Documentación de la clase `Ldap`

Esta clase pertenece al namespace `Core` y se encarga de realizar la autenticación de usuarios contra un servidor LDAP.

**Propiedades privadas:**

* `$ldap_host`: String que almacena la dirección del servidor LDAP (obtenida mediante `getenv('LDAP_HOST')`).
* `$ldap_port`: Entero que almacena el puerto del servidor LDAP (obtenido mediante `getenv('LDAP_PORT')`).
* `$ldap_base`: String que almacena la base de búsqueda en el servidor LDAP (obtenida mediante `getenv('LDAP_BASEDN')`).
* `$ldap_user`: String que almacena el nombre de usuario para la conexión inicial a LDAP (se asigna dentro del método `autenticar_ldap`).
* `$ldap_password`: String que almacena la contraseña del usuario para la conexión inicial a LDAP (se asigna dentro del método `autenticar_ldap`).
* `$dominio`: String que almacena el dominio LDAP (valor fijo "@PDVSA.COM").

**Método público:**

* `autenticar_ldap($usuario, $contraseña)`: Este método realiza la autenticación de un usuario contra el servidor LDAP.
    * Parámetros:
        * `$usuario`: String que contiene el nombre de usuario a autenticar.
        * `$contraseña`: String que contiene la contraseña del usuario a autenticar.
    * Retorno:
        * `true`: Si la autenticación es exitosa.
        * `false`: Si la autenticación falla.
        * `String`: Mensajes de error específicos ("No ldap Conection" o "Usuario y/o Password Incorrectos").

**Funcionamiento del método `autenticar_ldap`:**

1. Se asignan los valores de los parámetros `$usuario` y `$contraseña` a las propiedades privadas correspondientes.
2. Se realiza la conexión al servidor LDAP utilizando `ldap_connect`.
3. Se configura la opción LDAP para seguir referencias (opcional).
4. Se realiza un primer intento de enlace con el servidor LDAP utilizando el nombre de usuario completo (`$usuario . $dominio`) y la contraseña proporcionada.
5. Si el enlace inicial es exitoso:
    * Se define un filtro de búsqueda basado en el `uid` del usuario.
    * Se realiza la búsqueda en el servidor LDAP utilizando la base de búsqueda (`$ldap_base`) y el filtro definido.
    * Si la búsqueda tiene éxito y se encuentra una entrada:
        * Se obtienen los detalles de la entrada encontrada.
        * Se realiza un segundo enlace utilizando el DN (Distinguished Name) de la entrada encontrada y la contraseña proporcionada.
        * Si el segundo enlace es exitoso:
            * Se imprime un mensaje indicando el éxito de la autenticación (opcional).
            * Se puede agregar aquí la lógica para generar un token (pendiente de implementación).
            * El método retorna `true` indicando la autenticación exitosa.
    * Si la búsqueda falla o no se encuentra una entrada:
        * El método retorna `false` indicando un error en la autenticación.
6. Si el enlace inicial falla:
    * Se imprime un mensaje indicando que el usuario y/o contraseña son incorrectos.
    * El método retorna `false` indicando un error en la autenticación.
7. Si la conexión al servidor LDAP falla:
    * Se imprime un mensaje indicando que no se pudo conectar al servidor.
    * El método retorna el mensaje "No ldap Conection".

