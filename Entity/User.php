<?php
include_once './config/JWT.php';

class User {

    private $tableName;
    private $db;
    private $jwt;

    public function __construct($db)
    {
        $this->tableName = 'user';
        $this->db = $db;
        $this->jwt = new JWT;
    }

    public function isExisting($email) {
        $query = "SELECT COUNT(*) as nb FROM user WHERE email=:email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return ($stmt->fetchColumn(0) > 0) ? true : false;
    }

    public function insert($data) {
        if (isset($data['email']) && !empty($data['email']) && !$this->isExisting($data['email'])) {
            $email = $data['email'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $password = $data['password'];

            // select all query
            $query = "INSERT INTO $this->tableName SET email=:email, firstname=:firstname, lastname=:lastname, password=:password";

            // prepare query statement
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":password", $password);

            // execute query
            if ($stmt->execute()) {
                return ['message' => 'ok'];
            } else {
                return ['message' => 'ko'];
            }
        } else {
            return ['message' => 'ko'];
        }
    }

    public function login($data) {
        $email = $data['email'];
        $password = $data['password'];

        $query = "SELECT id FROM user WHERE email=:email AND password=:password";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

        $id = $stmt->fetchColumn(0);

        if ($id){
            return ['token' => $this->jwt->createToken($id)];
        }
    }

    public function isValid($token) {
        return $this->jwt->validateToken($token);
    }
}
