<?php

namespace Controllers;

use Core\Ldap;
use Models\Modelos;

class  Cauth
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
    $this->campos = array('tx_usercode','tx_username', 'tx_userlastname', 'tx_password', 'activo', 'fe_created_at', 'fe_updated_at');
  }
  public function autenticar($datos)
  {
    $datos = $datos;
    $condiciones = array($datos['tx_usercode']);
    $user = $datos['tx_usercode'];
    $pass = $datos['tx_password'];

    $modelo = new Modelos($this->tabla, $this->campos);
    $usuarios = $modelo->consultar($condiciones);
    if (count($usuarios) > 0) {
      $activo = $usuarios[0]['activo'];
      if ($usuarios) {
        if ($activo == 't') {
          // print "LLAMAR FUNCION AQUI";
          $auth_ldap = new Ldap();
          $auth_ldap->autenticar_ldap($user,$pass);
        }
      }
    }
  }
}
