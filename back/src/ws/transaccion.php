<?php 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $tipo = new tipo();
    $usuario = new usuario();
    $cuenta = new cuenta();

    $monto = $data['monto'];
    $destinoUser = $usuario->obtenerUsuarioDestino($data['destino']);
    $fecha = date('Y-m-d H:i:s');
    $tipo = $tipo->obtenerNombre($data['tipo'])->getIdTipo();
    $cuenta = $cuenta->obtenerCuentaId($data['id_cuenta']);


    if ($user != null ){


    }

 







}

//modulo para recivir informacion oprerar y hacer  los cambios corresspontientes alas transacciones realizadas
// casos de uso
// 1. registrar una nueva transaccion
// 2. obtener datos de la transaccion
