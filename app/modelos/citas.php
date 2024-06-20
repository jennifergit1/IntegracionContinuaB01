<?php
class citas
{
    function obtenerCitas()
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();
            $sql = "SELECT id, idUsuario, fecha, estado FROM citas ORDER BY fecha DESC";
            $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
            $conn = $conexionMySQL->close();
            return array(
                "citas"  => $resultado,
                "mensaje"   => count($resultado) . " registros encontrados.",
                "status"    => "ok",
                "message"   => count($resultado) . " row(s) returned"
            );
        } catch (Exception $ex) {
            return array(
                "citas"  => [],
                "mensaje"   => "Ha ocurrido un error al intentar consultar las citas",
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }

    function obtenerCitasConUsuario()
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();
            $sql =  "SELECT c.id, c.idUsuario, c.fecha, c.estado, u.correo, u.nombres, u.activo FROM citas AS c JOIN usuarios AS u ON u.id = c.idUsuario WHERE u.activo=1 ORDER BY c.fecha DESC;";
            $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
            $conn = $conexionMySQL->close();
            return array(
                "citas"  => $resultado,
                "mensaje"   => count($resultado) . " registros encontrados.",
                "status"    => "ok",
                "message"   => count($resultado) . " row(s) returned"
            );
        } catch (Exception $ex) {
            return array(
                "citas"  => [],
                "mensaje"   => "Ha ocurrido un error al intentar consultar las citas",
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }

    function obtenerCitasPorUsuario($idUsuario)
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();
            $sql =  "SELECT c.id, c.idUsuario, c.fecha, c.estado, u.correo, u.nombres, u.activo FROM citas AS c JOIN usuarios AS u ON u.id = c.idUsuario WHERE idUsuario=" . $idUsuario . " AND activo=1 ORDER BY fecha DESC;";
            $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
            $conn = $conexionMySQL->close();
            return array(
                "citas"  => $resultado,
                "mensaje"   => count($resultado) . " registros encontrados.",
                "status"    => "ok",
                "message"   => count($resultado) . " row(s) returned"
            );
        } catch (Exception $ex) {
            return array(
                "citas"  => [],
                "mensaje"   => "Ha ocurrido un error al intentar consultar las citas",
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }

    function obtenerCitaPorId($id){
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();
            $sql =  `SELECT 
                     c.id
                     ,c.idUsuario
                     ,c.fecha
                     ,c.estado
                     ,u.correo
                     ,u.nombres
                     ,u.activo
                     FROM integracionContinua.citas AS c
                     JOIN integracionContinua.usuarios AS u
                     ON u.id = c.idUsuario;
                     WHERE id=` . $id . `
                     AND activo=1
                     ORDER BY fecha DESC;`;
            $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
            $conn = $conexionMySQL->close();
            return array(
                "cita"  => $resultado[0],
                "mensaje"   => "Éxito al consultar la cita.",
                "status"    => "ok",
                "message"   => count($resultado) . " row(s) returned"
            );
        } catch (Exception $ex) {
            return array(
                "cita"  => null,
                "mensaje"   => "Ha ocurrido un error al intentar consultar las citas",
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }

    function crearCita($cita)
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();

            // Preparar la consulta SQL
            $sql = "INSERT INTO citas (id, idUsuario, fecha, estado) VALUES (null, ?, ?, 'AGENDADA')";
            $stmt = $conn->prepare($sql);

            // Verificar si la preparación fue exitosa
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $conn->error);
            }

            // Vincular los parámetros
            $stmt->bind_param("ss", $cita["idUsuario"], $cita["fecha"]);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $resultado = $stmt->affected_rows;
                $stmt->close();
                $conn->close();
                return array(
                    "mensaje"   => "Registro de cita exitoso",
                    "status"    => "ok",
                    "message"   => "affected rows: " . $resultado
                );
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
        } catch (Exception $ex) {
            return array(
                "mensaje"   => "Ha ocurrido un error al intentar registrar la cita",
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }

    function editarCita($cita)
    {
        try {
            $conexionMySQL = new conexionMySQL();
            $conn = $conexionMySQL->open();

            // Preparar la consulta SQL
            $sql = "UPDATE citas SET fecha=?, estado=? WHERE id=?";
            $stmt = $conn->prepare($sql);

            // Verificar si la preparación fue exitosa
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $conn->error);
            }

            // Vincular los parámetros
            $stmt->bind_param("sss", $cita["fecha"], $cita["estado"], $cita["id"]);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $resultado = $stmt->affected_rows;
                $stmt->close();
                $conn->close();
                return array(
                    "mensaje"   => (isset($cita["nombres"])) ? "Actualización de cita exitosa para el usuario " . $cita["nombres"] : "Actualización de cita exitosa",
                    "status"    => "ok",
                    "message"   => "affected rows: " . $resultado
                );
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
        } catch (Exception $ex) {
            return array(
                "mensaje"   => "Ha ocurrido un error al intentar editar la cita",
                "status"    => "error",
                "message"   => $ex->getMessage()
            );
        }
    }
}
