<?php
    class Database {
        private $host = "172.18.0.2";
        private $database_name = "users";
        private $username = "root";
        private $password = "root";
        public $conn;


    public function getConnectionDB() {
    $this->conn = null;
    try{
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
        $this->conn->exec("set names utf8");
    }   catch(PDOException $exception){
        echo "Database could not be connected: " . $exception->getMessage();
    }
        return $this->conn;
    }
}

?>