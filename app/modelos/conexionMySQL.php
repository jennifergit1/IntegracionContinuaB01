<?php
class conexionMySQL{
    public static function Db() {
        // Create connection
        $conn = mysqli_connect("DBGrupo29:3306", "root", "123", "integracionContinua");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}
