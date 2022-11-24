<?php

class Lvl {
    private $tableName;
    private $db;

    public function __construct($db)
    {
        $this->tableName = 'lvl';
        $this->db = $db;
    }

    public function getAll(){

        return [];
    }
}