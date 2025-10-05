<?php
class cuenta 
{
    private $id_cuenta;
    private $id_usuario;
    private $saldo;

    public function __construct($id_cuenta = "", $id_usuario = "", $saldo = "")
    {
        $this->id_cuenta = $id_cuenta;
        $this->id_usuario = $id_usuario;
        $this->saldo = $saldo;
    }

    /**
     * Get the value of id_cuenta
     */ 
    public function getId_cuenta()
    {
        return $this->id_cuenta;
    }

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Get the value of saldo
     */ 
    public function getSaldo()
    {
        return $this->saldo;
    }

    public function crear()
    {
        $conexion = new conexion();
        $cuentaDAO = new cuentaDAO(
            $this->id_cuenta,
            $this->id_usuario,
            $this->saldo
        );
        $conexion->abrir();
        $conexion->ejecutar($cuentaDAO->crear());
        $conexion->cerrar();
    }
    public function obtenerCuenta()
    {
        $conexion = new conexion();
        $cuentaDAO = new cuentaDAO(
            $this->id_cuenta,
            $this->id_usuario,
            $this->saldo
        );
        $conexion->abrir();
        $conexion->ejecutar($cuentaDAO->obtenerCuenta());
        $resultado = $conexion->registro();
        $this->id_cuenta = $resultado['id_cuenta'];
        $this->id_usuario = $resultado['id_usuario'];
        $this->saldo = $resultado['saldo'];
        $conexion->cerrar();
    }

    public function actualizarSaldo()
    {
        $conexion = new conexion();
        $cuentaDAO = new cuentaDAO(
            $this->id_cuenta,
            $this->id_usuario,
            $this->saldo
        );
        $conexion->abrir();
        $conexion->ejecutar($cuentaDAO->actualizarSaldo());
        $conexion->cerrar();
    }
}