<?php 

class tipo
{

    private $id_tipo;
    private $nombre;

    public function __construct($id_tipo, $nombre) {
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

}