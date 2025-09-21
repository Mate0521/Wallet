<?php

class cuentaDAO
{
    

    //crear una nueva cuenta asociandola al usuario correspondiente 
    public function crearCuenta ($id_usuario){
        return "INSERT INTO cuenta (saldo, id_usuario) VALUES (0, '$id_usuario')";
    }

    //obtener la cuenta de un usuario por su id_cuenta
    public function obtenerCuentaPorId($id_cuenta){
        return "SELECT * FROM cuenta WHERE id_cuenta = '$id_cuenta'";
    }

    //obtener la cuenta de un usuario por su id_usuario
    public function obtenerCuentaPorIdUsuario($id_usuario){
        return "SELECT * FROM cuenta WHERE id_usuario = '$id_usuario'";
    }

    //modificar el saldo de una cuenta
    public function modificarSaldo($id_cuenta, $nuevo_saldo){
        return "UPDATE cuenta SET saldo = '$nuevo_saldo' WHERE id_cuenta = '$id_cuenta'";
    }
}