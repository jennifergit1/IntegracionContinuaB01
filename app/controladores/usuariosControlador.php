<?php
require_once("../modelos/conexionMySQL.php");
require_once("../modelos/usuarios.php");
$usuariosModelo = new usuarios();
if (isset($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case 'registrarse':
            $usuario = $_POST["usuario"];
            $resultado = $usuariosModelo->crearUsuario($usuario);
            echo (json_encode($resultado, JSON_UNESCAPED_UNICODE));
            break;
        case "iniciar_sesion":
            $usuario = $_POST["usuario"];
            $resultado = $usuariosModelo->validarUsuario($usuario);
            if ($resultado["status"] == "ok") {
                if ($resultado["mensaje"] == 1) {
                    session_start();
                    $_SESSION = array(
                        "id"        => $resultado["usuario"]["id"],
                        "correo"    => $resultado["usuario"]["correo"],
                        "nombres"   => $resultado["usuario"]["nombres"],
                        "activo"    => $resultado["usuario"]["activo"],
                        "admin"     => $resultado["usuario"]["admin"]
                    );
                }
            }
            echo (json_encode($resultado, JSON_UNESCAPED_UNICODE));
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
