<?php

class usuarioDAO
{

    public function crearUsuario($usuario)
    {
        return "INSERT INTO usuario (id_usuario, nombre, apellidos, correo, telefono, clave) 
                VALUES ('$usuario->id_usuario', '$usuario->nombre', '$usuario->apellidos', '$usuario->correo', '$usuario->telefono', '".md5($usuario->clave)."')";
    }

    public function obtenerUsuarioDestino($tel)
    {
        return "SELECT * FROM usuario WHERE telefono = '$tel'";
    }

    public function autenticacion($tel, $clave )
    {
        return "SELECT `id_usuario` FROM usuario WHERE `telefono` = '$tel' AND `clave` = '$clave'";
    }

    public function obtenerUsuarioTel($tel)
    {
        return "SELECT `id_usuario`, `nombre`, `apellidos`, `fecha_nac`, `telefono`, `email`, `clave` FROM `usuario` WHERE `telefono` = $tel;";
    }
}