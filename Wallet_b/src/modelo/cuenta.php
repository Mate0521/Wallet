<?php
require_once ('../dao/cuentaDAO.php');
require_once ('../conexion/conexion.php');
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
        $cuentaDAO = new cuentaDAO($this->id_cuenta);
        $sql = $cuentaDAO->obtenerCuentaPorId();
        $conexion->abrir();
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
        $cuentaDAO = new cuentaDAO("","",$this->id_usuario);
        $sql = $cuentaDAO->obtenerCuentaPorIdUsuario();
        try{
            $conexion->abrir();
            $conexion->ejecutar($sql);
            $fila = $conexion->registro();
            if ($fila) {
                $this->id_cuenta = $fila['id_cuenta'];
                $this->saldo = $fila['saldo'];
                $this->id_usuario = $fila['id_usuario'];
                return $this;
            } else {
                return null;
            }   
            $conexion->cerrar();

        }catch(Exception $e){
            $e->getMessage();
        }

    }

    public function modificarSaldo($cuenta, $nuevo_saldo)
    {
        $conexion = new Conexion();
        $cuentaDAO = new cuentaDAO();
        $sql = $cuentaDAO->modificarSaldo($cuenta, $nuevo_saldo);
        try{
            $conexion->abrir();
            $conexion->ejecutar($sql);
            $this->saldo = $nuevo_saldo;
            $conexion->cerrar();
            return true;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function crearCuenta()
    {
        $conexion = new Conexion();
        $cuentaDAO = new cuentaDAO("","",$this->id_usuario);
        $sql = $cuentaDAO->crearCuenta();
        $conexion->ejecutar($sql);
        $conexion->cerrar();
    }






}