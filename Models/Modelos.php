<?php

namespace Models;

use Core\BaseDatos;

class Modelos
{
    private $tabla;
    private $campos;
    private $conexion;

    public function __construct($tabla, $campos)
    {
        $this->tabla = $tabla;
        $this->campos = $campos;
        $this->conexion = BaseDatos::getInstance();
    }
    /*public function __destruct()
    {
        $this->tabla;
        $this->campos;
        $this->conexion->desconectar() ;
    }*/
    public function insertar($datos)
    {
        if (count($datos) == count($this->campos)) {
            $cadsql = "INSERT INTO " . $this->tabla . " (";
            for ($i = 0; $i < count($this->campos); $i++) {
                $cadsql .= $this->campos[$i] . ", ";
            }
            $cadsql[strlen($cadsql) - 2] = ")";
            $cadsql .= "VALUES (";
            for ($i = 0; $i < count($this->campos); $i++) {
                if (!empty($datos[$i]) or $datos[$i] === "0") {
                    $cadsql .= "'" . $datos[$i] . "', ";
                } else {
                    $cadsql .= "NULL, ";
                }
            }
            $cadsql[strlen($cadsql) - 2] = ")";
            $cadsql[strlen($cadsql) - 1] = ";";

            return pg_query($this->conexion->link, $cadsql);
        }
        return false;
    }

    public function actualizar($datos, $condiciones)
    {
        //print_r($usuarios);
        if (count($datos) > 0) {
            if (count($condiciones) > 0) {
                $cadsql = "UPDATE " . $this->tabla . " SET ";
                for ($i = 1; $i < count($datos); $i++) {
                    $cadsql .= $this->campos[$i] . "='" . $datos[$i] . "', ";
                }
                $cadsql[strlen($cadsql) - 2] = " ";
                $cadsql .= "WHERE ";
                for ($i = 0; $i < count($condiciones); $i++) {
                    $cadsql .= $this->campos[$i] . "='" . $condiciones[$i] . "' AND ";
                }
                $cadsql[strlen($cadsql) - 5] = " ";
                $cadsql[strlen($cadsql) - 4] = " ";
                $cadsql[strlen($cadsql) - 3] = " ";
                $cadsql[strlen($cadsql) - 2] = " ";
                $cadsql = trim($cadsql);
                $cadsql .= ";";
                //  echo $cadsql;
                return pg_query($this->conexion->link, $cadsql);
            }
        }

        return false;
    }

    public function eliminar($condiciones)
    {
        if (count($condiciones) > 0) {
            $cadsql = "DELETE FROM " . $this->tabla . " WHERE ";
            for ($i = 0; $i < count($condiciones); $i++) {
                $cadsql .= $this->campos[$i] . "='" . $condiciones[$i] . "' AND ";
            }
            $cadsql[strlen($cadsql) - 5] = " ";
            $cadsql[strlen($cadsql) - 4] = " ";
            $cadsql[strlen($cadsql) - 3] = " ";
            $cadsql[strlen($cadsql) - 2] = " ";
            $cadsql = trim($cadsql);
            $cadsql .= ";";
            return pg_query($this->conexion->link, $cadsql);
        }
        return false;
    }

    public function consultar($condiciones = null, $campos = null)
    {
        $cadsql = "SELECT ";
        if (is_null($campos)) {
            $cadsql .= "* ";
        } else {
            for ($i = 0; $i < count($campos); $i++) {
                $cadsql .= $campos[$i] . ", ";
            }
            $cadsql[strlen($cadsql) - 2] = " ";
        }
        $cadsql .= "FROM " . $this->tabla;
        if (!is_null($condiciones)) {
            $cadsql .= " WHERE ";
            for ($i = 0; $i < count($condiciones); $i++) {
                $cadsql .= $this->campos[$i] . "='" . $condiciones[$i] . "' AND ";
            }
            $cadsql[strlen($cadsql) - 5] = " "; // Elimina el último AND innecesario
            $cadsql[strlen($cadsql) - 4] = " ";
            $cadsql[strlen($cadsql) - 3] = " ";
            $cadsql[strlen($cadsql) - 2] = " ";
            $cadsql = trim($cadsql);
        }

        $resultado = pg_query($this->conexion->link, $cadsql);

        if ($resultado) {
            $filas = array();
            while ($row = pg_fetch_array($resultado, NULL, PGSQL_ASSOC)) {
                $filas[] = $row;
            }
            pg_free_result($resultado);
            return $filas;
        }
        return false;
    }

    public function vincular($tablaRelacion, $entidad1, $campoEntidad1, $entidad2, $campoEntidad2) {
        if ($this->validarRelacion($tablaRelacion)) {
          $cadsql = "INSERT INTO " . $tablaRelacion . " (";
          $cadsql .= $campoEntidad1 . ", ";
          $cadsql .= $campoEntidad2 . ") ";
          $cadsql .= "VALUES ('" . $entidad1 . "', '" . $entidad2 . "');";
    
          return pg_query($this->conexion->link, $cadsql);
        }
        return false;
      }
    
      public function desvincular($tablaRelacion, $entidad1, $campoEntidad1, $entidad2 = null, $campoEntidad2 = null) {
        if ($this->validarRelacion($tablaRelacion)) {
          $cadsql = "DELETE FROM " . $tablaRelacion . " WHERE ";
          $cadsql .= $campoEntidad1 . "='" . $entidad1 . "'";
    
          if (!is_null($entidad2)) {
            $cadsql .= " AND " . $campoEntidad2 . "='" . $entidad2 . "'";
          }
    
          $cadsql .= ";";
    
          return pg_query($this->conexion->link, $cadsql);
        }
        return false;
      }
    
      // ... (otros métodos CRUD)
    
      private function validarRelacion($tablaRelacion) {
        $relacionesValidas = ["seguridad.roles_permisos", "seguridad.usuarios_roles", "seguridad.aplicacion_permiso"];
        return in_array($tablaRelacion, $relacionesValidas);
      }
    
/*
// Asignar un permiso a un rol
$modelo = new Modelos("seguridad.roles_permisos", ["tx_rol_id", "tx_permiso_id"]);
$resultado = $modelo->vincular("roles_permisos", "ROL001", "PERM002");

// Eliminar un permiso específico de un rol
$modelo = new Modelos("seguridad.roles_permisos", ["tx_rol_id", "tx_permiso_id"]);

*/
}
