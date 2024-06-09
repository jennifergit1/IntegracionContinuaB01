<?php
// require_once("../conexionMySQL.php");
class mensajes{
    function getMensajes(){
        $conn = conexionMySQL::Db();
        $sql = "SELECT mensaje FROM mensajes";
        $resultado = mysqli_query($conn, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            while($row = mysqli_fetch_assoc($resultado)) {
                echo $row["mensaje"]. "<br>";
            }
        } else {
            echo "0 resultados";
        }
    }
}