<?php

namespace Controllers;

use Controllers\CMensajes;
use Models\Modelos;
//AQUI VA EL CODIGO DE LA BITACORA
class Cusuarios
{
  public $tabla;
  public $campos;
  public $condiciones;
  public $modelo;
  public $mensaje;
  public function __construct()
  {
    $this->mensaje = new CMensajes;
    $this->tabla = "apisec.usuarios";
    $this->campos = array('tx_usercode', 'tx_username', 'tx_userlastname', 'tx_password', 'activo', 'fe_created_at', 'fe_updated_at');
  }

  public function listar()
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = ""; //array("*");
    $usuarios = $modelo->consultar();
    print $this->mensaje->generarMensaje('success', 'Usuarios', 'Lista de Usuarios', $usuarios);
  }
  public function filtrar($filtro)
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = array($filtro);
    $usuarios = $modelo->consultar($condiciones);
    if (count($usuarios) == 0) {
      print $this->mensaje->generarMensaje('success', 'Usuarios', 'Usuario No Encontrado', $usuarios);}
    else{
      print $this->mensaje->generarMensaje('success', 'Usuarios', 'Usuario Encontrado', $usuarios);
    }
    
  }
  public function agregar($datos)
  {

    $datos = $datos;
    $condiciones[] = $datos[0];
    $modelo = new Modelos($this->tabla, $this->campos);
    $usuarios = $modelo->consultar($condiciones);
    if (count($usuarios) == 0) {
      $usuarios = $modelo->insertar($datos);
      if ($usuarios) {
        print $this->mensaje->generarMensaje('success', 'Usuarios', 'Usuario Insertado correctamente', $datos);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'Usuarios', 'Error al Insertar el usuario', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'Usuarios', 'Error al Insertar el usuario, ya exite', '');
    }
  }
  public function modificar($datos, $filtro)
  {

    $datos = $datos;
    $condiciones = array($filtro);
    $modelo = new Modelos($this->tabla, $this->campos);
    $usuarios = $modelo->consultar($condiciones);
    if (count($usuarios) > 0) {

      $usuarios = $modelo->actualizar($datos, $condiciones);
      if ($usuarios) {
        print $this->mensaje->generarMensaje('success', 'Usuarios', 'Usuario Modificado correctamente', $datos);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'Usuarios', 'Error al Modificar el usuario', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'Usuarios', 'Error al Modificar, el usuario no Existe', '');
    }
  }
  public function eliminar($filtro)
  {
    $modelo = new Modelos($this->tabla, $this->campos);
    $condiciones = array($filtro);
    $usuarios = $modelo->consultar($condiciones);
    if (count($usuarios) > 0) {
      $usuarios = $modelo->eliminar($condiciones);
      if ($usuarios) {
        print $this->mensaje->generarMensaje('success', 'Usuarios', 'Usuario Eliminado correctamente', $condiciones);
        //AQUI VA EL CODIGO DE LA BITACORA
      } else {
        print $this->mensaje->generarMensaje('error', 'Usuarios', 'Error al Eliminar el usuario, No Existe', '');
      }
    } else {
      print $this->mensaje->generarMensaje('error', 'Usuarios', 'Error al Eliminar, el usuario no Existe', '');
    }
  }
}
