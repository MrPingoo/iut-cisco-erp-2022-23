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
        return [];
    }
}