<?php

class cuentaDAO
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
        return "INSERT INTO cuenta (id_usuario, saldo) VALUES ('$this->id_usuario', '$this->saldo')";
    }

    public function obtenerCuenta()
    {
        return "SELECT * FROM cuenta WHERE id_usuario = '$this->id_usuario'";
    }

    public function actualizarSaldo()
    {
        return "UPDATE cuenta SET saldo = '$this->saldo' WHERE id_cuenta = '$this->id_cuenta'";
    }

    
}