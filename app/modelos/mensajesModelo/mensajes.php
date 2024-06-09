<?php
// require_once("../conexionMySQL.php");
class mensajes{
    function getMensajes(){
        $conexionMySQL = new conexionMySQL();
        $conn = $conexionMySQL->open();
        $sql = "SELECT mensaje FROM mensajes";
        $resultado = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
        $conn = $conexionMySQL->close();
        return $resultado;
        // if (mysqli_num_rows($resultado) > 0) {
        //     while($row = mysqli_fetch_assoc($resultado)) {
        //         echo $row["mensaje"]. "<br>";
        //     }
        // } else {
        //     echo "0 resultados";
        // }
    }
}