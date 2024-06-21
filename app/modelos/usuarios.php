<?php
class usuarios
{
    function crearUsuario($usuario)
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();

            // Preparar la consulta SQL
            $sql = "INSERT INTO usuarios (nombres, correo, clave, admin, activo) VALUES (?, ?, MD5(?), 0, 1)";
            $stmt = $conn->prepare($sql);

            // Verificar si la preparación fue exitosa
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $conn->error);
            }

            // Vincular los parámetros
            $stmt->bind_param("sss", $usuario["nombres"], $usuario["correo"], $usuario["clave"]);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $resultado = $stmt->affected_rows;
                $stmt->close();
                $conn->close();
                return array(
                    "mensaje"   => "Registro exitoso del usuario " . $usuario["correo"],
                    "status"    => "ok",
                    "message"   => "affected rows: " . $resultado
                );
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
        } catch (Exception $ex) {
            return array(
                "mensaje"   => "Ha ocurrido un error al intentar registrar el usuario " . $usuario["correo"],
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }

    function validarUsuario($usuario)
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();
            $sql = "SELECT id, correo, clave, nombres, activo, admin FROM usuarios WHERE correo = '" . $usuario["correo"] . "' AND clave=MD5('" . $usuario["clave"] . "') LIMIT 1";
            $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
            $conn = $conexionMySQL->close();
            $count = count($resultado);
            $resultado["clave"] = null;
            return array(
                "usuario"   => $resultado[0],
                "mensaje"   => ($count > 0) ? 1 : 0,
                "status"    => "ok",
                "message"   => "rows found: " . $count
            );
        } catch (Exception $ex) {
            return array(
                "mensaje"   => "Ha ocurrido un error al intentar verificar el usuario " . $usuario["correo"],
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }
}
