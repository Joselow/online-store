<?php

class Database {
    private $hostname = "localhost";
    private $database = "store_online";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    function connect(){
        try {
            $connection = "mysql:host=".$this->hostname.";dbname=".$this->database.";charset=".$this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,    // para emittir errores (PDOException)
                PDO::ATTR_EMULATE_PREPARES => FALSE,           // para emular declaraciones preparadas
            ];

            $pdo = new PDO($connection, $this->username, $this->password, $options);

            return $pdo;
        } catch(PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }
}

?>