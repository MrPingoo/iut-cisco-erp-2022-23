<?php

class Comment
{

    private $tableName;
    private $db;

    public function __construct($db)
    {
        $this->tableName = 'comment';
        $this->db = $db;
    }

    public function insert($data) {
        if (isset($data['name']) && !empty($data['name']) && isset($data['comment']) && !empty($data['comment'])) {
            $name = $data['name'];
            $comment = $data['comment'];

            $query = "INSERT INTO $this->tableName SET name=:name, comment=:comment";

            // prepare query statement
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":comment", $comment);

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