<?php
class Employee implements EmployeeInterface {
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

    public function getAllEmployees()
    {
        $sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->db_table . ";";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createNewEmployee()
    {
        $sqlQuery = "INSERT INTO ". $this->db_table ." SET name = :name, email = :email, age = :age, designation = :designation, created = :created";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);

        if($stmt->execute()){
            return true;
        }
        return false;
    }


    public function getEmployeeById()
    {
        $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->age = $dataRow['age'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];

//        return $dataRow;
    }

    public function updateEmployee()
    {
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return $this->getById($this->id);
        }
        return false;
    }

    private function getById($id)
    {
        $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteEmployee()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>