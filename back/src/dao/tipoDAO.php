<?php

class tipoDAO
{

    public function obtenerNombre($id)
    {
        return "SELECT * FROM tipo WHERE id_tipo = '$id'";

    }

    public function obtenerId($tipo)
    {
        return "SELECT * FROM tipo WHERE nombre = '$tipo'";

    }

}
