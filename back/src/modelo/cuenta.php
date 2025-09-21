<?php
class cuenta 
{
    private $id_cuenta;
    private $saldo;
    private $id_usuario;


    public function __construct($id_cuenta=null, $saldo=null, $id_usuario=null) {
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

    public function obtenerCuentaId()
    {
        $conexion = new Conexion();
        $cuentaDAO = new cuentaDAO($conexion);
        $sql = $cuentaDAO->obtenerCuentaPorId($this->id_cuenta);
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->saldo = $fila['saldo'];
            $this->id_usuario = $fila['id_usuario'];
            return $this;
        } else {
            return null;
        }
        $conexion->cerrar();
    }

    public function obtenerCuentaIdUsuario()
    {
        $conexion = new Conexion();
        $cuentaDAO = new cuentaDAO($conexion);
        $sql = $cuentaDAO->obtenerCuentaPorIdUsuario($this->id_usuario);
        $conexion->ejecutar($sql);
        $fila = $conexion->registro();
        if ($fila) {
            $this->saldo = $fila['saldo'];
            $this->id_usuario = $fila['id_usuario'];
        } else {
            return null;
        }   
        $conexion->cerrar();
    }

    public function modificarSaldo($nuevo_saldo)
    {
        $conexion = new Conexion();
        $cuentaDAO = new cuentaDAO($conexion);
        $sql = $cuentaDAO->modificarSaldo($this->id_cuenta, $nuevo_saldo);
        $conexion->ejecutar($sql);
        $this->saldo = $nuevo_saldo;
        $conexion->cerrar();
    }

    public function crearCuenta()
    {
        $conexion = new Conexion();
        $cuentaDAO = new cuentaDAO($conexion);
        $sql = $cuentaDAO->crearCuenta($this->id_usuario);
        $conexion->ejecutar($sql);
        $conexion->cerrar();
    }






}