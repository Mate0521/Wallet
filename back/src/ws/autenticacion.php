<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");


require_once '../dao/conexion.php';
require_once '../dao/ususarioDAO.php';
require_once '../modelo/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = new Usuario();

    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $telefono = $data['telefono'];
    $clave = $data['clave'];

    if ($usuarioDAO->autenticacion($telefono, $clave)) {
        http_response_code(200);
        echo json_encode(array("mensaje" => "Autenticación exitosa"));
    } else {
        http_response_code(401);
        echo json_encode(array("mensaje" => "Credenciales inválidas"));
        
    }


}

//modulo para autenticar si es o no correcta alguna creedencial 