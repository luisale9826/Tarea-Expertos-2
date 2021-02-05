<?php
class Database
{

    public function __construct()
    {
    }
    // Esta función se encarga de establecer la conección con la base de datos y regresa la conección
    // con la base.
    // Retrona: La conección establecida con la base de datos
    public function connect()
    {
        $servername = "remotemysql.com";
        $username = "qcfLX4UH7j";
        $password = "HErIGDdxlf";
        $db = "qcfLX4UH7j";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $db);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}
