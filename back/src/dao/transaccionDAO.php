<?php 

class transaccionDAO
{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTransacciones()
    {
        $sql = "SELECT * FROM transaccion";
        $this->conexion->ejecutarConsulta($sql);
        $transacciones = [];
        while ($fila = $this->conexion->siguienteRegistro()) {
            $transacciones[] = new Transaccion($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);
        }
        return $transacciones;
    }

    public function obtenerTransaccionPorCuenta($id_cuenta)
    {
        $sql = "SELECT * FROM transaccion WHERE id_cuenta = '$id_cuenta'";
        $this->conexion->ejecutarConsulta($sql);
        $transacciones = [];
        while ($fila = $this->conexion->siguienteRegistro()) {
            $transacciones[] = new Transaccion($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);
        }
        return $transacciones;
    }
    public function insertarTransaccion($transaccion)
    {

    }
}