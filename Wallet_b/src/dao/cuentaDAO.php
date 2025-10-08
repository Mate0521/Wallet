<?php

class cuentaDAO
{
    private $id_cuenta;
    private $saldo;
    private $id_usuario;

    public function __construct($id_cuenta=null, $saldo=null, $id_usuario=null) {
        $this->id_cuenta = $id_cuenta;
        $this->saldo = $saldo;
        $this->id_usuario = $id_usuario;

    }

    //crear una nueva cuenta asociandola al usuario correspondiente 
    public function crearCuenta (){
        return "INSERT INTO cuenta (saldo, id_usuario) VALUES (0, '$this->id_usuario')";
    }

    //obtener la cuenta de un usuario por su id_cuenta
    public function obtenerCuentaPorId(){
        return "SELECT * FROM cuenta WHERE id_cuenta = '$this->id_cuenta'";
    }

    //obtener la cuenta de un usuario por su id_usuario
    public function obtenerCuentaPorIdUsuario(){
        return "SELECT  `id_cuenta`, `saldo`, `id_usuario`  
                FROM cuenta 
                WHERE id_usuario = '$this->id_usuario'";
    }

    //modificar el saldo de una cuenta
    public function modificarSaldo($id_cuenta, $nuevo_saldo){
        return "UPDATE cuenta SET saldo = '$nuevo_saldo' WHERE id_cuenta = '$id_cuenta'";
    }
}