<?php
header("Content-Type: application/json; charset=UTF-8");

// get database connection
include_once './config/database.php';

// Entities
include_once './Entity/Pet.php';
include_once './Entity/Type.php';

$database = new Database();
$db = $database->getConnection();

$ressource = $_GET['ressource'];
$action = $_GET['action'];
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

switch ($ressource) {
    case "Type":
        $type = new Type($db);
        http_response_code(200);
        if ($action == 'create') {
            echo json_encode($type->create($data));
        }
        break;
    default:
        http_response_code(404);
        break;
}