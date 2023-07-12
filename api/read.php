<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../db_config/database.php';
include_once '../classes/employees.php';

$database = new Database();
$db = $database->getConnectionDB();
$items = new Employee($db);
$stmt = $items->getAllEmployees();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);
if($itemCount > 0){

    $employeeArr = array();
    $employeeArr["body"] = array();
//    $employeeArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "age" => $age,
            "designation" => $designation,
            "created" => $created
        );

        $employeeArr["body"][] = $e;
    }

    http_response_code(200);
    echo json_encode($employeeArr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>