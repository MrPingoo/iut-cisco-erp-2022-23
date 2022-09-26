<?php

class Database{

    private $host = "localhost:3306";
    private $db_name = "db_105";
    private $username = "db_105";
    private $password = "Mubuntu$105";
    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>