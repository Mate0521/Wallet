<?php

class usuarioDAO
{
    private $nombres;
    private $apellidos;
    private $id;
    private $clave;
    private $telefono;
    private $correo;
    private $fecha_Nac;

    public function __construct($nombres, $apellidos, $id, $clave, $telefono, $correo, $fecha_Nac)
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

    public function autenticar()
    {
        return "SELECT id_usuario 
                FROM usuario 
                WHERE email = '" . $this->correo . "' 
                AND clave = MD5('" . $this->clave . "');
                ";
    }
    public function registrar()
    {
        return "
            insert into usuario(apellidos,clave,email,fecha_nac,id_usuario,nombre,telefono)
            values ('" . $this->apellidos .
             "',md5('" . $this->clave .
              "'),'" . $this->correo .
               "','" . $this->fecha_Nac .
                "','" . $this->id .
                 "','" . $this->nombres .
                  "'," . $this->telefono . ");
        ";
    }

    public function editar()
    {
        return "
            update usuario set 
            apellidos = '" . $this->apellidos . "',
            clave = md5('" . $this->clave . "'),
            email = '" . $this->correo . "',
            fecha_nac = '" . $this->fecha_Nac . "',
            nombre = '" . $this->nombres . "',
            telefono = " . $this->telefono . "
            where id_usuario = '" . $this->id . "';
        ";
    }

    public function obtenerUsuarioDestino()
    {
        return "
            select id_usuario, nombre, apellidos, telefono, email, fecha_nac
            from usuario
            where telefono = " . $this->telefono . ";
        ";
    }

    public function eliminar()
    {
        return "
            delete from usuario
            where id_usuario = '" . $this->id . "';
        ";
    }

}