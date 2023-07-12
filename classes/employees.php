<?php
class Employee {
    // Connection
    private $conn;
    // Table
    private $db_table = "Employee";
    // Columns
    public $id;
    public $name;
    public $email;
    public $age;
    public $designation;
    public $created;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllEmployees(){

    }
}

?>