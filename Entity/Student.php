<?php

class Student {

    private $tableName;
    private $db;
    private $jwt;
    private $user;

    public function __construct($db, $user)
    {
        $this->tableName = 'student';
        $this->db = $db;
        $this->user = $user;
    }

    public function getAll() {
        $query = "SELECT id, firstname, lastname FROM student WHERE user_id=:user LIMIT 5";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user", $this->user);
        $stmt->execute();

        $rows = $stmt->fetchAll();

        foreach($rows as $row) {
            $data[] = [
                "id" => $row['id'],
                "firstname" => $row['firstname'],
                "lastname" => $row['lastname']
            ];
        }

        return $data;
    }

    public function create($data) {
        if (isset($data['firstname']) && !empty($data['firstname'])) {
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $lvlId = $data['lvl'];

            // select all query
            $query = "INSERT INTO $this->tableName SET firstname=:firstname, lastname=:lastname, user_id=:user_id, lvl_id=:lvl_id";

            // prepare query statement
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":user_id", $this->user);
            $stmt->bindParam(":lvl_id", $lvlId);

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
}
