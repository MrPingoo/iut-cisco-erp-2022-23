<?php
header("Content-Type: application/json; charset=UTF-8");

// get database connection
include_once './config/database.php';

// Entities
include_once './Entity/User.php';
include_once './Entity/Subject.php';
include_once './Entity/Lvl.php';
include_once './Entity/Student.php';
include_once './Entity/Booking.php';

$database = new Database();
$db = $database->getConnection();

$ressource = $_GET['ressource'];
$action = $_GET['action'];
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

function checkAccess($token, $db){
    $user = new User($db, null);
    return $user->isValid($token);
}

$config = [
    'User' => [
        'register' => [
            'name' => 'insert',
            'logged' => false,
        ],
        'login' => [
            'name' => 'login',
            'logged' => false,
        ],
        'Info' => [
            'name' => 'getInfo',
            'logged' => true,
        ],
    ],
    'Subject' => [
        'list' => [
            'name' => 'getAll',
            'logged' => true,
        ],
    ],
    'Lvl' => [
        'list' => [
            'name' => 'getAll',
            'logged' => true,
        ],
    ],
    'Student' => [
        'create' => [
            'name' => 'create',
            'logged' => true,
        ],
        'list' => [
            'name' => 'getAll',
            'logged' => true,
        ]
    ],
    'Booking' => [
        'create' => [
            'name' => 'create',
            'logged' => true,
        ],
        'list' => [
            'name' => 'getAll',
            'logged' => true,
        ]
    ],
];

$idUser = null;

if (isset($config[$ressource][$action])) {
    if ($config[$ressource][$action]['logged']) {
        $idUser = checkAccess($_SERVER['HTTP_TOKEN'], $db);
        if ($idUser == null) {
            http_response_code(403);
            echo json_encode(['message' => 'Wrong user']);
        } else {
            http_response_code(200);
            $object = new $ressource($db, $idUser);
            $functionName = $config[$ressource][$action]['name'];
            echo json_encode($object->$functionName($data));
        }
    } else {
        http_response_code(200);
        $object = new $ressource($db, null);
        $functionName = $config[$ressource][$action]['name'];
        echo json_encode($object->$functionName($data));
    }
} else {
    echo json_encode([]);
    http_response_code(404);
}

/*
switch ($ressource) {
    case "User":
        $user = new User($db);
        http_response_code(200);
        if ($action == 'register') {
            echo json_encode($user->insert($data));
        } elseif ($action == 'login') {
            echo json_encode($user->login($data));
        } elseif ($action == 'Info') {
            echo json_encode($user->isValid($_SERVER['HTTP_TOKEN']));
        }
        break;
    case "Subject":
        $subject = new Subject($db);
        http_response_code(200);
        echo json_encode($subject->getAll());
        break;
    case "Lvl":
        $lvl = new Lvl($db);
        http_response_code(200);
        echo json_encode($lvl->getAll());
        break;
    default:
        list($logged, $id) = checkAccess($_SERVER['HTTP_TOKEN'], $db);
        http_response_code(404);
        break;
}
*/

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