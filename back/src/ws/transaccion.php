<?php 
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    $cuenta = new cuenta();


    $monto = $data['monto'];
    $fecha = date('Y-m-d H:i:s');

    $usuarioDestino = $usuario->obtenerUsuarioDestino($data['destino']);

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


        $map =
        [
            "enviar" => function() use ($monto, $cuentaOrigen, $cuentaDestino) {
                return $cuentaOrigen->modificarSaldo($cuentaOrigen, $cuentaOrigen->getSaldo() - $monto)
                    && ($cuentaDestino !== null ? $cuentaDestino->modificarSaldo($cuentaDestino, $cuentaDestino->getSaldo() + $monto) : false);
            },
            "consignar"=> function() use($cuenta, $cuentaOrigen,$monto){
                $cuenta->modificarSaldo($cuentaOrigen, $cuentaOrigen->getSaldo()+$monto);
            },
            "retirar"=> function() use($cuenta, $cuentaOrigen,$monto){
                $cuenta->modificarSaldo($cuentaOrigen, $cuentaOrigen->getSaldo()-$monto);
            }
            
        ];

        if(isset($map[$part[0]])){
            $respuesta = $map[$part[0]]();

            if ($resultado) {
                echo "operación exitosa";
            } else {
                echo "error al modificar saldo";
            }
        } else {
            echo "accion no registrada";
        }

    }

}



//modulo para recivir informacion oprerar y hacer  los cambios corresspontientes alas transacciones realizadas
// casos de uso
// 1. registrar una nueva transaccion
// 2. obtener datos de la transaccion
