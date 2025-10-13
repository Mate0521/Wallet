<?php 

class transaccionDAO
{


    public function obtenerTransaccionPorCuenta($id_cuenta)
    {
        return "SELECT * FROM transaccion WHERE id_cuenta = '$id_cuenta'";

    }

    public function insertarTransaccion($transaccion)
    {
        return "INSERT INTO transaccion (monto, destino, fecha, id_cuenta, id_tipo) 
                VALUES ('$transaccion->monto', '$transaccion->destino', '$transaccion->fecha', 
                '$transaccion->id_cuenta', '$transaccion->id_tipo')";
    }

}   