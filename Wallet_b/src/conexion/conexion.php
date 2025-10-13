<?php

class Conexion{
    private $conexion;
    private $resultado;
    
    public function abrir(){
        if ($this->conexion instanceof mysqli && $this->conexion->ping()) {
            return true;
        }
        $this->conexion = new mysqli("localhost", "root", "", "wallet", 3306);
        if ($this->conexion->connect_error) {
            throw new Exception("Error de conexión MySQL: " . $this->conexion->connect_error);
        }
        $this->conexion->set_charset('utf8mb4');
        return true;
    }
    
    public function cerrar(){
        if ($this->conexion instanceof mysqli) {
            $this->conexion->close();
        }
        $this->conexion = null;
        $this->resultado = null;
    }
    
    public function ejecutar($sentencia){
        if (!$this->conexion instanceof mysqli) {
            $this->abrir();
        }
        $this->resultado = $this->conexion->query($sentencia);
        if ($this->resultado === false) {
            throw new Exception("Error en query: " . $this->conexion->error . " -- SQL: " . $sentencia);
        }
        return $this->resultado;
    }
    
    // devuelve fila asociativa
    public function registro(){
        if ($this->resultado instanceof mysqli_result) {
            return $this->resultado->fetch_assoc();
        }
        return null;
    }
    
    public function filas(){
        return ($this->resultado instanceof mysqli_result) ? $this->resultado->num_rows : 0;
    }
    
}

