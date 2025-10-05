<?php 
require_once 'src/dao/tipoDAO.php';
require_once 'src/conexion/conexion.php';
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
    
        $conexion = new conexion();
        $tipoDAO = new tipoDAO($this->id_tipo);
        $conexion->abrir();
        $conexion->ejecutar($tipoDAO->obtenerNombre());
        $resultado = $conexion->registro();
        $this->nombre = $resultado['nombre'];
        $conexion->cerrar();
    }

    public function obtenerId() {
        
    }



}