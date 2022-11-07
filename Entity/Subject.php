<?php

class Subject {
    private $tableName;
    private $db;

    public function __construct($db)
    {
        $this->tableName = 'subject';
        $this->db = $db;
    }

    public function getAll(){
        $query = "SELECT id, name FROM $this->tableName";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $data = [];

        foreach ($stmt->fetchAll() as $item) {
            $data[] = [
                'id' => $item['id'],
                'name' => $item['name']
            ];
        }

        return $data;
    }
}