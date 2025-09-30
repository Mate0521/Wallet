<?php

class Usuario 
{

    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $clave;


    public function __construct($id_usuario=null, $nombre=null, $apellidos=null, $correo=null, $telefono=null, $clave=null) 
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->clave = $clave;
    }
    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getClave() {
        return $this->clave;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function autenticacion()
    {
        $conexion = new Conexion();
        $usuarioDAO = new usuarioDAO($conexion);
        $sql = $usuarioDAO->autenticacion($this->telefono, $this->clave);
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->id_usuario = $fila['id_usuario'];
            $this->nombre = $fila['nombre'];
            $this->apellidos = $fila['apellidos'];
            $this->correo = $fila['correo'];
            $this->telefono = $fila['telefono'];
            $this->clave = $fila['clave'];
            return $this;
        } else {
            return null;
        }
        $conexion->cerrar();
    }

    public function crearUsuario()
    {
        $conexion = new Conexion();
        $usuarioDAO = new usuarioDAO($conexion);
        $sql = $usuarioDAO->crearUsuario($this);
        $conexion->ejecutar($sql);
        $conexion->cerrar();
    }

    public function obtenerUsuarioTel()
    {
        $conexion = new Conexion();
        $usuarioDAO = new usuarioDAO($conexion);
        $sql = $usuarioDAO->obtenerUsuarioTel($this->telefono);
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->id_usuario = $fila['id_usuario'];
            $this->nombre = $fila['nombre'];
            $this->apellidos = $fila['apellidos'];
            $this->correo = $fila['correo'];
            $this->telefono = $fila['telefono'];
            $this->clave = $fila['clave'];
            return $this;
        } else {
            return null;
        }
        $conexion->cerrar();
    }

    public function obtenerUsuarioDestino($telefono)
    {
        $conexion = new Conexion();
        $usuarioDAO = new usuarioDAO($conexion);
        $sql = $usuarioDAO->obtenerUsuarioDestino($telefono);
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->id_usuario = $fila['id_usuario'];
            $this->nombre = $fila['nombre'];
            $this->apellidos = $fila['apellidos'];
            $this->telefono = $fila['telefono'];
            return $this;
        } else {
            return null;
        }
        $conexion->cerrar();
    }
    
    
}

