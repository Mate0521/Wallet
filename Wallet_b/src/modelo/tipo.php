<?php 
require_once ('../conexion/conexion.php');
require_once ('../dao/tipoDAO.php');

class tipo
{

    private $id_tipo;
    private $nombre;

    public function __construct($id_tipo=null, $nombre=null) {
        $this->id_tipo = $id_tipo;
        $this->nombre = $nombre;
    }
    public function getIdTipo() {
        return $this->id_tipo;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setIdTipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function obtenerNombre(){
        $conexion = new Conexion();
        $tipoDAO = new tipoDAO($this->id_tipo);
        $sql = $tipoDAO->obtenerNombre();
        $conexion->abrir();
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->nombre = $fila['nombre'];
            return $this;
        } else {
            return null;
        }
        $conexion->cerrar();
    }

    public function obtenerId() {
        $conexion = new Conexion();
        $tipoDAO = new tipoDAO($conexion);
        $sql = $tipoDAO->obtenerId($this->nombre);
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->id_tipo = $fila['id_tipo'];
            return $this;
        } else {
            return null;
        }
        $conexion->cerrar();
    }


}