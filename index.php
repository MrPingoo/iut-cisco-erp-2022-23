<?php
// get database connection
include_once './config/database.php';

$database = new Database();
$db = $database->getConnection();

var_dump($db);
?>