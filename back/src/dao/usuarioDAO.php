<?php

class usuarioDAO
{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function insertarUsuario($usuario)
    {
        $id_usuario = $usuario->getIdUsuario();
        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $correo = $usuario->getCorreo();
        $telefono = $usuario->getTelefono();
        $clave = $usuario->getClave();

        $sql = "INSERT INTO usuario (id_usuario, nombre, apellidos, correo, telefono, clave) 
                VALUES ('$id_usuario', '$nombre', '$apellidos', '$correo', '$telefono', '$clave')";

        return $this->conexion->ejecutarConsulta($sql);
    }

    public function obtenerUsuarioPorCredenciales($telefono, $clave)
    {
        $sql = "SELECT * FROM usuario WHERE correo = '$telefono' AND clave = '$clave'";
        $this->conexion->ejecutarConsulta($sql);
        $fila = $this->conexion->siguienteRegistro();

        if ($fila) {
            return new Usuario($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);
        } else {
            return null;
        }
    }
}