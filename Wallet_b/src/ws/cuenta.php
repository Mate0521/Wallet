<?php 

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../dao/usuarioDAO.php';
require_once '../dao/cuentaDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);



}


//modulo para registra una nueva cuenta operar cooordinadamente con la creacion del usuario nuevo
// casos de uso
// 1. registrar un nueva cuenta
// 2. eliminar cuenta
// 4. obtener datos de la cuenta 
