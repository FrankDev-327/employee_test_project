<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../db_config/database.php';
include_once '../classes/employees.php';

$database = new Database();
$db = $database->getConnectionDB();

$item = new Employee($db);
$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

if($item->deleteEmployee()){
    http_response_code(200);
    echo json_encode("Employee deleted.");
} else{
    http_response_code(401);
    echo json_encode("Data could not be deleted");
}

?>