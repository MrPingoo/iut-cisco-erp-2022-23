<?php

class Lvl {
    private $tableName;
    private $db;
    private $user;

    public function __construct($db, $user)
    {
        $this->tableName = 'lvl';
        $this->db = $db;
        $this->user = $user;
    }

    public function getAll(){
        $data = [];

        // use the connection here
        $stmt = $this->db->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $rows = $stmt->fetchAll();

        // iterate over array by index and by name
        foreach($rows as $row) {
            $data[] = [
                "id" => $row['id'],
                "name" => $row['name']
            ];
        }

        return $data;
    }
}