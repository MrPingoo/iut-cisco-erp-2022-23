<?php
header("Content-Type: application/json; charset=UTF-8");

// get database connection
include_once './config/database.php';

// Entities
include_once './Entity/Comment.php';

// DB
$database = new Database();
$db = $database->getConnection();

// All vars
$ressource = $_GET['ressource'];
$action = $_GET['action'];
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

switch ($ressource) {
    case "Comment":
        $comment = new Comment($db);
        http_response_code(200);
        if ($action == 'create') {
            echo json_encode($comment->insert($data));
        }
        break;
    default:
        http_response_code(404);
        break;
}
