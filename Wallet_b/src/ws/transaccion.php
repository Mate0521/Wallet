<?php 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once ('../modelo/cuenta.php');
require_once ('../modelo/usuario.php');
require_once ('../modelo/tipo.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $cuenta = new cuenta();
    $usuario = new Usuario();

    $monto = $data['monto'];
    $fecha = date('Y-m-d H:i:s');

    $usuarioDestino = $usuario->obtenerUsuarioDestino($data['destino']);
    if ($usuarioDestino == null) {
        echo json_encode(array("mensaje" => "El usuario destino no existe",
        "exito" => false
        ));
        http_response_code(401);
        exit();
    }

    $cuentaDestino = new Cuenta();
    $cuentaDestino->setIdUsuario($usuarioDestino->getIdUsuario());
    $cuentaDestino = $cuentaDestino->obtenerCuentaIdUsuario();


    $cuentaOrigen = new Cuenta();
    $cuentaOrigen->setIdCuenta($data['id_cuenta']);
    $cuentaOrigen = $cuentaOrigen->obtenerCuentaId();

    $tipoObj = new Tipo();
    $tipoObj->setIdTipo($data['tipo']);
    $tipoObj = $tipoObj->obtenerNombre();
    $part = explode(".", $tipoObj->getNombre());

    if (($cuentaDestino!=null && $cuentaOrigen->getSaldo() >= $monto ) || (hash_equals("consignar", $part[0]) && $cuentaDestino!=null)){

        if($cuentaDestino->getIdCuenta() == $cuentaOrigen->getIdCuenta() && hash_equals("enviar", $part[0])){
            echo json_encode(array("mensaje" => "No se puede enviar a la misma cuenta",
            "exito" => false
            ));
            http_response_code(401);
            exit();
        }


        $map =
        [
            "enviar" => function() use ($monto, $cuentaOrigen, $cuentaDestino) {

                $saldo1 = $cuentaOrigen->getSaldo() - $monto;
                $saldo2 = $cuentaDestino->getSaldo() + $monto;

                $ok1 = $cuentaOrigen->modificarSaldo($cuentaOrigen->getIdCuenta(), $saldo1);
                $ok2 = $cuentaDestino->modificarSaldo($cuentaDestino->getIdCuenta(), $saldo2);
                if ($ok1 && $ok2) {
                    return true;
                } else {
                    return false;
                }
            },
            "consignar"=> function() use($cuentaOrigen,$monto){
                return $cuentaOrigen->modificarSaldo($cuentaOrigen->getIdCuenta(), $cuentaOrigen->getSaldo()+$monto);
            },
            "retirar"=> function() use( $cuentaOrigen,$monto){
                return $cuentaOrigen->modificarSaldo($cuentaOrigen->getIdCuenta(), $cuentaOrigen->getSaldo()-$monto);
            }
            
        ];

        if(isset($map[$part[0]])){
            $respuesta = $map[$part[0]]();

            if ($respuesta) {
                echo json_encode(array("mensaje" => "Transacción realizada con éxito",
                "exito" =>true
                ));
                http_response_code(200);
            } else {
                echo json_encode(array("mensaje" => "Error en la transacción",
                "exito" => false
                ));
                http_response_code(401);
            }
        } else {
            echo json_encode(array("mensaje" => "Acción no registrada",
            "exito" => false
            ));
        }

    } else {
        echo json_encode(array("mensaje" => "Fondos insuficientes o cuenta destino no existe"));
        http_response_code(401);
    }

}



//modulo para recivir informacion oprerar y hacer  los cambios corresspontientes alas transacciones realizadas
// casos de uso
// 1. registrar una nueva transaccion
// 2. obtener datos de la transaccion
