<?php
class mensajes
{
    function getMensajes()
    {
        $conexionMySQL = new conexionMySQL();
        $conn = $conexionMySQL->open();
        $sql = "SELECT mensaje FROM mensajes";
        $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
        $conn = $conexionMySQL->close();
        return $resultado;
    }
}
