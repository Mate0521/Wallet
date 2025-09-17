<?php

class cuentaDAO
{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerCuentaPorIdUsuario($id_usuario) {
        $this->conexion->abrirConexion();
        $consulta = "SELECT id_cuenta, saldo, id_usuario FROM cuenta WHERE id_usuario = ?";
        $stmt = $this->conexion->mysqlConexion->prepare($consulta);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $cuenta = null;
        if ($fila = $resultado->fetch_assoc()) {
            $cuenta = new cuenta($fila['id_cuenta'], $fila['saldo'], $fila['id_usuario']);
        }
        $stmt->close();
        $this->conexion->cerrarConexion();
        return $cuenta;
    }

    public function actualizarSaldo($id_cuenta, $nuevo_saldo) {
        $this->conexion->abrirConexion();
        $consulta = "UPDATE cuenta SET saldo = ? WHERE id_cuenta = ?";
        $stmt = $this->conexion->mysqlConexion->prepare($consulta);
        $stmt->bind_param("di", $nuevo_saldo, $id_cuenta);
        $exito = $stmt->execute();
        $stmt->close();
        $this->conexion->cerrarConexion();
        return $exito;
    }

    public function crearCuenta($saldo_inicial, $id_usuario) {
        $this->conexion->abrirConexion();
        $consulta = "INSERT INTO cuenta (saldo, id_usuario) VALUES (?, ?)";
        $stmt = $this->conexion->mysqlConexion->prepare($consulta);
        $stmt->bind_param("di", $saldo_inicial, $id_usuario);
        $exito = $stmt->execute();
        $nuevo_id = $this->conexion->obtenerLlaveAutonumerica();
        $stmt->close();
        $this->conexion->cerrarConexion();
        if ($exito) {
            return new cuenta($nuevo_id, $saldo_inicial, $id_usuario);
        } else {
            return null;
        }
    }
}