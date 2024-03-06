<?php

namespace Controllers;

use Controllers\CMensajes;
use Models\Modelos;
//AQUI VA EL CODIGO DE LA BITACORA
class Cpermisos
{
  public $tabla;
  public $campos;
  public $condiciones;
  public $modelo;
  public $mensaje;
  public function __construct()
  {
    $this->mensaje = new CMensajes;
    $this->tabla = "apisec.permisos";
    $this->campos = array('tx_id_permisos', 'tx_nombre', 'descripcion', 'fe_created_at', 'fe_updated_at');
  }

  public function listar()
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = ""; //array("*");
    $permisos = $modelo->consultar();
    print $this->mensaje->generarMensaje('success', 'permisos', 'Lista de permisos', $permisos);
  }
  public function filtrar($filtro)
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = array($filtro);
    $permisos = $modelo->consultar($condiciones);
    if (count($permisos) == 0) {
      print $this->mensaje->generarMensaje('success', 'permisos', 'Permiso No Encontrado', $permisos);
    } else {
      print $this->mensaje->generarMensaje('success', 'permisos', 'Permiso Encontrado', $permisos);
    }
  }
  public function agregar($datos)
  {

    $datos = $datos;
    $condiciones[] = $datos[0];
    $modelo = new Modelos($this->tabla, $this->campos);
    $permisos = $modelo->consultar($condiciones);
    if (count($permisos) == 0) {
      $permisos = $modelo->insertar($datos);
      if ($permisos) {
        print $this->mensaje->generarMensaje('success', 'permisos', 'permiso Insertado correctamente', $datos);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'permisos', 'Error al Insertar el permiso', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'permisos', 'Error al Insertar el permiso, ya exite', '');
    }
  }
  public function modificar($datos, $filtro)
  {

    $datos = $datos;
    $condiciones = array($filtro);
    $modelo = new Modelos($this->tabla, $this->campos);
    $permisos = $modelo->consultar($condiciones);
    if (count($permisos) > 0) {

      $permisos = $modelo->actualizar($datos, $condiciones);
      if ($permisos) {
        print $this->mensaje->generarMensaje('success', 'permisos', 'permiso Modificado correctamente', $datos);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'permisos', 'Error al Modificar el permiso', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'permisos', 'Error al Modificar, el permiso no Existe', '');
    }
  }
  public function eliminar($filtro)
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = array($filtro);
    $permisos = $modelo->consultar($condiciones);
    if (count($permisos) > 0) {
      $permisos = $modelo->eliminar($condiciones);
      if ($permisos) {
        print $this->mensaje->generarMensaje('success', 'permisos', 'permiso Eliminado correctamente', $condiciones);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'permisos', 'Error al Eliminar el permiso, No Existe', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'permisos', 'Error al Eliminar, el permiso no Existe', '');
    }
  }
}
