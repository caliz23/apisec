<?php

namespace Controllers;

use Controllers\CMensajes;
use Models\Modelos;
//AQUI VA EL CODIGO DE LA BITACORA
class Croles
{
  public $tabla;
  public $campos;
  public $condiciones;
  public $modelo;
  public $mensaje;
  public function __construct()
  {
    $this->mensaje = new CMensajes;
    $this->tabla = "apisec.roles";
    $this->campos = array('tx_id_roles','tx_nombre','tx_descripcion','fe_created_at','fe_updated_at');
  }

  public function listar()
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = ""; //array("*");
    $roles = $modelo->consultar();
    print $this->mensaje->generarMensaje('success', 'roles', 'Lista de roles', $roles);
  }
  public function filtrar($filtro)
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = array($filtro);
    $roles = $modelo->consultar($condiciones);
    if (count($roles) == 0) {
    print $this->mensaje->generarMensaje('success', 'roles', 'Rol No Encontrado', $roles);
    }else{
      print $this->mensaje->generarMensaje('success', 'roles', 'Rol Encontrado', $roles);
      
    }
  }
  public function agregar($datos)
  {

    $datos = $datos;
    $condiciones[] = $datos[0];
    $modelo = new Modelos($this->tabla, $this->campos);
    $roles = $modelo->consultar($condiciones);
    if (count($roles) == 0) {
      $roles = $modelo->insertar($datos);
      if ($roles) {
        print $this->mensaje->generarMensaje('success', 'roles', 'Rol Insertado correctamente', $datos);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'roles', 'Error al Insertar el Rol', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'roles', 'Error al Insertar el Rol, ya exite', '');
    }
  }
  public function modificar($datos, $filtro)
  {

    $datos = $datos;
    $condiciones = array($filtro);
    $modelo = new Modelos($this->tabla, $this->campos);
    $roles = $modelo->consultar($condiciones);
    if (count($roles) > 0) {

      $roles = $modelo->actualizar($datos, $condiciones);
      if ($roles) {
        print $this->mensaje->generarMensaje('success', 'roles', 'Rol Modificado correctamente', $datos);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'roles', 'Error al Modificar el Rol', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'roles', 'Error al Modificar, el Rol no Existe', '');
    }
  }
  public function eliminar($filtro)
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = array($filtro);
    $roles = $modelo->consultar($condiciones);
    if (count($roles) > 0) {
      $roles = $modelo->eliminar($condiciones);
      if ($roles) {
        print $this->mensaje->generarMensaje('success', 'roles', 'Rol Eliminado correctamente', $condiciones);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'roles', 'Error al Eliminar el Rol, No Existe', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'roles', 'Error al Eliminar, el Rol no Existe', '');
    }
  }
}
