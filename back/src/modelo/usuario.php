<?php

class Usuario 
{

    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $clave;

    public function __construct($id_usuario, $nombre, $apellidos, $correo, $telefono, $clave) {
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
    
}

