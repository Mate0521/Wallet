<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");
require_once ('../modelo/usuario.php');
require_once ('../modelo/cuenta.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $usuario = new Usuario();
    $usuario->setTelefono($data['telefono']);;
    $usuario = $usuario->obtenerUsuarioTel();

    $cuenta =new cuenta();
    $cuenta->setIdUsuario($usuario->getIdUsuario());
    $cuenta->obtenerCuentaIdUsuario();

    if($cuenta!=null && $usuario!=null){
        echo json_encode(
            array(
                "usuario"=>[
                    "id_usuario" => $usuario->getIdUsuario(),
                    "telefono" => $usuario->getTelefono(),
                    "nombre" => $usuario->getNombre(),
                    "apellidos"=>$usuario->getApellidos(),
                    "correo"=>$usuario->getCorreo()
                ],
                "cuenta" => [
                    "id_cuenta" => $cuenta->getIdCuenta(),
                    "saldo" => $cuenta->getSaldo(),
                    "id_usuario"=> $cuenta->getIdUsuario()
                ]
            )

        );
    }else{
        echo json_encode(array(
            "usuario"=>null,
            "cuenta"=>null
        ));
    }



}