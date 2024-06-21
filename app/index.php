<?php
// Cerrar conexión
//  mysqli_close($conn);
session_start();
if(isset($_SESSION["id"])){
    header("Location: vistas/inicio/inicio.php");
}else{
    header("Location: vistas/login/login.php");
}
exit;
?>
