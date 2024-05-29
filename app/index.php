<?php

// Create connection
$conn = mysqli_connect("DBGrupo29:3306", "root", "123", "integracionContinua");
// Check connection
if (!$conn) {
die("Connection failed: ". mysqli_connect_error());
}   
echo "Connected successfully <br>"; 
$sql = "SELECT mensaje FROM mensajes";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    while($row = mysqli_fetch_assoc($resultado)) {
        echo $row["mensaje"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Cerrar conexión
mysqli_close($conn);

?>
