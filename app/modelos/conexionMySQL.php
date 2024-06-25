<?php
class conexionMySQL
{
    private $conn;
    public function open()
    {
        // Create connection
        $this->conn = mysqli_connect("DBGrupo29:3306", "root", "123", "integracionContinua");
        // Check connection
        $this->conn->set_charset("utf8");
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->conn;
    }
    public function close()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}
