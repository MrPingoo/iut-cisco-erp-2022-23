<?php

class Booking {

    private $tableName;
    private $db;
    private $jwt;
    private $user;

    public function __construct($db, $user)
    {
        $this->tableName = 'booking';
        $this->db = $db;
        $this->user = $user;
    }

    public function getAll() {
        $query = "SELECT id, firstname, lastname FROM student WHERE user_id=:user LIMIT 5";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user", $this->user);
        $stmt->execute();

        $rows = $stmt->fetchAll();

        $i = 0;
        foreach($rows as $row) {
            $querySlots = "SELECT begin, end FROM slot INNER JOIN booking ON booking.slot_id = slot.id WHERE student_id = " . $row['id'];
            $data[$i] = [
                "id" => $row['id'],
                "firstname" => $row['firstname'],
                "lastname" => $row['lastname']
            ];

            $stmtSlots = $this->db->prepare($querySlots);
            $stmtSlots->execute();
            $slotsRows = $stmtSlots->fetchAll();

            foreach ($slotsRows as $s) {
                $data[$i]["slots"][] = [
                    "begin" => $s['begin'],
                    "end" => $s['end'],
                ];
            }
            $i++;
        }

        return $data;
    }

    public function create($data) {
        if (isset($data['student']) && isset($data['slot'])) {
            $student = $data['student'];
            $slot = $data['slot'];

            // select all query
            $query = "INSERT INTO $this->tableName SET student_id=:student, slot_id=:slot";

            // prepare query statement
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":student", $student);
            $stmt->bindParam(":slot", $slot);

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
