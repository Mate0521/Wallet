<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");
require_once ('../modelo/usuario.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $usuario = new Usuario();

    $usuario->setTelefono($data['telefono']);
    $usuario->setClave($data['clave']);


    if ($usuario->autenticacion()) {
        echo json_encode(array("mensaje" => "Autenticación exitosa"));
        http_response_code(200);
    } else {
        echo json_encode(array("mensaje" => "Credenciales incorrectas"));
        http_response_code(401);
        
    }

}

//modulo para autenticar si es o no correcta alguna creedencial 