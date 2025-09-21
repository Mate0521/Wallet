<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $usuario = new Usuario();

    $usuario->setTelefono($data['telefono']);
    $usuario->setClave(md5($data['clave']));


    if ($usuario->autenticacion()) {
        http_response_code(200);
        echo json_encode(array("mensaje" => "Autenticación exitosa"));
    } else {
        http_response_code(401);
        echo json_encode(array("mensaje" => "Credenciales inválidas"));
        
    }


}

//modulo para autenticar si es o no correcta alguna creedencial 