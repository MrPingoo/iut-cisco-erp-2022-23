<?php

class User {

    private $tableName;
    private $db;

    public function __construct($db)
    {
        $this->tableName = 'user';
        $this->db = $db;
    }

    public function insert($data) {
        if (isset($data['email']) && !empty($data['email']) /*&& !isExist($db, $data['email'])*/) {
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
                return ['messae' => 'ok'];
            } else {
                return ['messae' => 'ko'];
            }
        }
    }
}