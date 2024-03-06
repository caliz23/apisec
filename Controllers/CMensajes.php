<?php

namespace Controllers;

class CMensajes
{
    function generarMensaje($tipo, $titulo, $mensaje, $datos)
    {
        $respuesta = array(
            "tipo" => $tipo,
            "titulo" => $titulo,
            "mensaje" => $mensaje,
            "datos" => $datos,
        );

        return json_encode($respuesta);
    }
}
