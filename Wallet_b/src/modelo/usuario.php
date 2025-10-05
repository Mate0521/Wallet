<?php
require_once 'src/config/conexion.php';
require_once 'src/dao/usuarioDAO.php';

class Usuario 
{

    private $nombres;
    private $apellidos;
    private $id;
    private $clave;
    private $telefono;
    private $correo;
    private $fecha_Nac;

    public function __construct($nombres = "", $apellidos = "", $id = "", $clave = "", $telefono = "", $correo = "", $fecha_Nac = "")
    {
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->id = $id;
        $this->clave = $clave;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->fecha_Nac = $fecha_Nac;
    }
    

    /**
     * Get the value of nombres
     */ 
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set the value of nombres
     *
     * @return  self
     */ 
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of clave
     */ 
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set the value of clave
     *
     * @return  self
     */ 
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of fecha_Nac
     */ 
    public function getFecha_Nac()
    {
        return $this->fecha_Nac;
    }

    /**
     * Set the value of fecha_Nac
     *
     * @return  self
     */ 
    public function setFecha_Nac($fecha_Nac)
    {
        $this->fecha_Nac = $fecha_Nac;

        return $this;
    }

    public function autenticacion()
    {
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO(
            $this->nombres, 
            $this->apellidos, 
            $this->id, 
            $this->clave, 
            $this->telefono, 
            $this->correo, 
            $this->fecha_Nac
        );
        $conexion->abrir();
        $conexion->ejecutar($usuarioDAO->autenticar());
        if($conexion->filas() != 0)
        {
            $registro = $conexion->registro();
            $this->id = $registro[0];
            $conexion->cerrar();
            return true;
        }else{
            $this->id = "";
            $conexion->cerrar();
            return false;
        }

    }

    public function crearUsuario()
    {
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO(
            $this->nombres, 
            $this->apellidos, 
            $this->id, 
            $this->clave, 
            $this->telefono, 
            $this->correo, 
            $this->fecha_Nac
        );
        $conexion->abrir();
        $conexion->ejecutar($usuarioDAO->registrar());
        $conexion->cerrar();
    }

    public function Editar()
    {
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO(
            $this->nombres, 
            $this->apellidos, 
            $this->id, 
            $this->clave, 
            $this->telefono, 
            $this->correo, 
            $this->fecha_Nac
        );
        $conexion->abrir();
        $conexion->ejecutar($usuarioDAO->editar());
        $conexion->cerrar();
    }

    public function ver()
    {
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO("", "", $this->id, "", "", "", "");
        $conexion->abrir();
        $conexion->ejecutar($usuarioDAO->obtenerUsuarioDestino());
        if($conexion->filas() != 0)
        {
            $registro = $conexion->registro();
            $this->id = $registro[0];
            $this->nombres = $registro[1];
            $this->apellidos = $registro[2];
            $this->clave = $registro[3];
            $this->telefono = $registro[4];
            $this->correo = $registro[5];
            $this->fecha_Nac = $registro[6];
            $conexion->cerrar();
            return true;
        }else{
            $this->id = "";
            $conexion->cerrar();
            return false;
        }
    }

    public function eliminar()
    {
        $conexion = new conexion();
        $usuarioDAO = new usuarioDAO("", "", $this->id, "", "", "", "");
        $conexion->abrir();
        $conexion->ejecutar($usuarioDAO->eliminar());
        $this->id = "";
        $this->nombres = "";
        $this->apellidos = "";
        $this->clave = "";
        $this->telefono = "";
        $this->correo = "";
        $this->fecha_Nac = "";
        $conexion->cerrar();
    }
    
    
}

