<?php

class tipoDAO
{
    private $id_tipo;
    private $nombre;

    public function __construct($id_tipo=null, $nombre=null) {
        $this->id_tipo = $id_tipo;
        $this->nombre = $nombre;
    }

    public function obtenerNombre($id)
    {
        return "SELECT * FROM tipo WHERE id_tipo = '$this->id_tipo'";

    }

    public function obtenerId($tipo)
    {
        return "SELECT * FROM tipo WHERE nombre = '$tipo'";

    }

}
