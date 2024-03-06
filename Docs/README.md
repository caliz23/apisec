
# APISEC

API para Menejo de Seguridad de las Aplicaciones, Manejo de Roles y Permisos.



## VERBOS PERMITIDOS
GET
POST
UPDATE
DELETE
----

## API Referencia

#### Get Todos los Usuarios 

```http
  GET /api/usuarios
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id_sesion`      | `string` | **Required**.  |


#### Get Un Usuario
```http
  GET /api/usuarios
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id_user`      | `string` | **Required** |
| `id_sesion`      | `string` | **Required**.  |


#### Insertar Usuario 
```http
  POST /api/usuarios
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id_sesion`      | `string` | **Required**.  |
| `usercode` | `string` | **Required**. |
| `username` | `string` | **Required**. |
| `userlastname` | `string` | **Required**. |
| `password` | `string` | **Required**.  |
| `activo` | `boolean` | **Required**.  |
| `created_at` | `date` | YYYY/MM/DD **Required**. |
| `updated_at` | `date` | YYYY/MM/DD **Required**. |

#### Insertar Usuario 
```http
  PUT /api/usuarios
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id_sesion`      | `string` | **Required**.  |
| `usercode` | `string` | **Required**. |
| `username` | `string` | **Required**. |
| `userlastname` | `string` | **Required**. |
| `password` | `string` | **Required**.  |
| `activo` | `boolean` | **Required**.  |
| `created_at` | `date` | YYYY/MM/DD **Required**. |
| `updated_at` | `date` | YYYY/MM/DD **Required**. |


#### Borrar Un Usuario
```http
  DELETE /api/usuarios
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id_user`      | `string` | **Required** |
| `id_sesion`      | `string` | **Required**.  |
