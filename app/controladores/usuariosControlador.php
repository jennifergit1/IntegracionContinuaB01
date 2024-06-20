<?php
require_once("../modelos/conexionMySQL.php");
require_once("../modelos/usuarios.php");
$usuariosModelo = new usuarios();
if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case 'registrarse':
            $usuario = $_POST["usuario"];
            $resultado = $usuariosModelo->crearUsuario($usuario);
            echo(json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
        case "iniciar_sesion":
            $usuario = $_POST["usuario"];
            $resultado = $usuariosModelo->validarUsuario($usuario);
            echo(json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
        
        default:
            $resultado = array(
                "mensaje"   => "Error: No se reconoce la acción",
                "status"    => "error",
                "message"   => "Not action found"

            );
            echo(json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
    }
}
?>