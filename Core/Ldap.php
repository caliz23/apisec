<?php

namespace Core;

class Ldap
{
    private $ldap_host;
    private $ldap_port;
    private $ldap_base;
    private $ldap_user;
    private $ldap_password;
    private $dominio;
    function __construct()
    {
        $this->ldap_host = getenv('LDAP_HOST');
        $this->ldap_port = getenv('LDAP_PORT');
        $this->ldap_base = getenv('LDAP_BASEDN');
        $this->dominio = "@PDVSA.COM";

    }
        function autenticar_ldap($usuario, $contraseña)
        {
            // echo "TEST";
            $this->ldap_user = $usuario;
            $this->ldap_password = $contraseña;
           // echo $this->ldap_base ."  ".$this->ldap_host ." ".$this->ldap_port ." <br> ";
            //echo $this->ldap_user." <br> ";
            //echo $this->ldap_password." <br> ";

            $ldap = ldap_connect($this->ldap_host, $this->ldap_port);
            if ($ldap) {
                ldap_set_option($ldap, 3, 3);
                if (ldap_bind($ldap, $this->ldap_user . $this->dominio, $this->ldap_password)) {
                    $filtro = "(uid=$this->ldap_user)";
                    $resultado = ldap_search($ldap, $this->ldap_base, $filtro);
                    if ($resultado) {
                        $entradas = ldap_get_entries($ldap, $resultado);
                        if ($entradas["count"] === 1) {
                            $usuario_ldap = $entradas[0];

                            if (ldap_bind($ldap, $usuario_ldap["dn"], $this->ldap_password)) {
                                echo "ENTRO";
                                //PONER AQUI CODIGO GENERAR TOKEN

                                return true;
                            }
                        }
                    }

                    ldap_unbind($ldap);
                } else {
                    echo "Usuario y/o Password Incorrectos";
                }
            } else {
                return "No ldap Conection";
            }

            return false;
        }
    }

