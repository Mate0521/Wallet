<?php
class cuenta 
{
    private $id_cuenta;
    private $saldo;
    private $id_usuario;


    public function __construct($id_cuenta, $saldo, $id_usuario) {
        $this->id_cuenta = $id_cuenta;
        $this->saldo = $saldo;
        $this->id_usuario = $id_usuario;

    }
    public function getIdCuenta() {
            return $this->id_cuenta;
    }
    public function getSaldo() {
        return $this->saldo;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdCuenta($id_cuenta) {
        $this->id_cuenta = $id_cuenta;
    }
    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

}