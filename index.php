<?php
header("Content-Type: application/json; charset=UTF-8");

// get database connection
include_once './config/database.php';

// Entities
include_once './Entity/User.php';
include_once './Entity/Subject.php';

$database = new Database();
$db = $database->getConnection();

$ressource = $_GET['ressource'];
$action = $_GET['action'];
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

switch ($ressource) {
    case "User":
        $user = new User($db);
        http_response_code(200);
        echo json_encode($user->insert($data));
        break;
    case "Subject":
        $subject = new Subject($db);
        http_response_code(200);
        echo json_encode($subject->getAll());
        break;
    default:
        http_response_code(404);
        break;
}


/*
var_dump($ressource);
var_dump($action);
var_dump($method);
var_dump($data);

if (isset($data['email']) && (!empty($data['email']))) {
    // Requête SQL
    // $query = "SELECT COUNT(*) as nb FROM user WHERE email='" . $data['email'] . "'";
    $query = "SELECT COUNT(*) as nb FROM user WHERE email=:email";
    $stmt = $db->prepare($query);
    $email = $data['email'];
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $num = $stmt->fetchColumn(0);

    if($num>0){
        die("Oui");
    } else {
        die("Non");
    }
}

?>
*/