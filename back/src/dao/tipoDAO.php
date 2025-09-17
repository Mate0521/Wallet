<?php

class tipoDAO
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTipos()
    {
        $sql = "SELECT * FROM tipo";
        $this->conexion->ejecutarConsulta($sql);
        $tipos = [];
        while ($fila = $this->conexion->siguienteRegistro()) {
            $tipos[] = new Tipo($fila[0], $fila[1]);
        }
        return $tipos;
    }
}
