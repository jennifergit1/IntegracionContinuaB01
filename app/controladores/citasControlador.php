<?php
require_once("../modelos/conexionMySQL.php");
require_once("../modelos/citas.php");
$citasModelo = new citas();
if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case 'registrar_cita':
            $cita = $_POST["cita"];
            $resultado = $citasModelo->crearCita($cita);
            echo(json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
        case 'editar_cita':
            $cita = $_POST["cita"];
            $resultado = $citasModelo->editarCita($cita);
            echo(json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
        default:
            $resultado = array(
                "mensaje"   => "Error: No se reconoce la acción",
                "status"    => "error",
                "message"   => "Not action found"

            );
            echo (json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
    }
}
