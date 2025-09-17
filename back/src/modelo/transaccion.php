<?php 

class transaccion
{

    private $id_transaccion;
    private $monto;
    private $destino;
    private $fecha;
    private $id_cuenta;
    private $id_tipo;

    public function __construct($id_transaccion, $monto, $destino, $fecha, $id_cuenta, $id_tipo) {
        $this->id_transaccion = $id_transaccion;
        $this->monto = $monto;
        $this->destino = $destino;
        $this->fecha = $fecha;
        $this->id_cuenta = $id_cuenta;
        $this->id_tipo = $id_tipo;
    }
    public function getIdTransaccion() {
        return $this->id_transaccion;
    }
    public function getMonto() {
        return $this->monto;
    }
    public function getDestino() {
        return $this->destino;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getIdCuenta() {
        return $this->id_cuenta;
    }
    public function getIdTipo() {
        return $this->id_tipo;
    }
    public function setIdTransaccion($id_transaccion) {
        $this->id_transaccion = $id_transaccion;
    }
    public function setMonto($monto) {
        $this->monto = $monto;
    }
    public function setDestino($destino) {
        $this->destino = $destino;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function setIdCuenta($id_cuenta) {
        $this->id_cuenta = $id_cuenta;
    }
    public function setIdTipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }
}