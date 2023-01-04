<?php

class Type
{
    private $tableName;
    private $db;

    public function __construct($db)
    {
        $this->tableName = 'type';
        $this->db = $db;
    }

    public function create($data) {
        if (isset($data['name']) && !empty($data['name'])) {
            $name = $data['name'];
            $legs = $data['legs'];

            // select all query
            $query = "INSERT INTO $this->tableName SET name=:name, legs=:legs";

            // prepare query statement
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":legs", $legs);

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