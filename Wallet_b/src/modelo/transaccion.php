<?php 

require_once 'src/conexion/conexion.php';
require_once 'src/dao/tipoDAO.php';

class transaccion
{

    private $id_cuenta;//
    private $monto;
    private $fecha;//
    private $tipo;
    private $id_transaccion;
    private $destino; //Destino

    public function __construct($id_cuenta = "", $monto = "", $fecha = "", $tipo = "", $id_transaccion = "", $destino = "")
    {
        $this->id_cuenta = $id_cuenta;
        $this->monto = $monto;
        $this->fecha = $fecha;
        $this->tipo = $tipo;
        $this->id_transaccion = $id_transaccion;
        $this->destino = $destino;
    }

    /**
     * Get the value of id_cuenta
     */ 
    public function getId_cuenta()
    {
        return $this->id_cuenta;
    }

    /**
     * Set the value of id_cuenta
     *
     * @return  self
     */ 
    public function setId_cuenta($id_cuenta)
    {
        $this->id_cuenta = $id_cuenta;

        return $this;
    }

    /**
     * Get the value of monto
     */ 
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get the value of id_transaccion
     */ 
    public function getId_transaccion()
    {
        return $this->id_transaccion;
    }

    /**
     * Get the value of destino
     */ 
    public function getDestino()
    {
        return $this->destino;
    }

    
    public function Enviar()
    {
        $conexion = new conexion();
        $transaccionDAO = new transaccionDAO(
            $this->id_cuenta,
            $this->monto,
            $this->fecha,
            $this->tipo,
            $this->id_transaccion,
            $this->destino
        );
        $conexion->abrir();
        $conexion->ejecutar($transaccionDAO->enviar());
        $conexion->cerrar();
    }

    public function historial()
    {
        $conexion = new conexion();
        $transaccionDAO = new transaccionDAO(
            $this->id_cuenta,
            $this->monto,
            $this->fecha,
            $this->tipo,
            $this->id_transaccion,
            $this->destino
        );
        $conexion->abrir();
        $conexion->ejecutar($transaccionDAO->historial());
        $conexion->cerrar();
    }
}