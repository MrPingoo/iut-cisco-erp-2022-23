<?php
/*
SELECT * FROM slot
INNER JOIN slot_has_subject ON slot_has_subject.slot_id = slot.id
WHERE slot_has_subject.lvl_id IN (SELECT lvl.id FROM lvl WHERE lvl.value >= 3)
AND slot_has_subject.subject_id IN (2, 1)
AND slot.begin >= "2022-11-06 15:00:00"
AND slot.end <= "2023-11-06 15:00:00"
AND slot.id NOT IN (SELECT booking.slot_id FROM booking WHERE booking.student_id = 1)
;
 */
class Slot {

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

    public function search($data) {
        $student = $data['student'];
        $query = "SELECT lvl.value FROM student INNER JOIN lvl on student.lvl_id = lvl.id WHERE student.id=:student LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":student", $student);
        $stmt->execute();

        $id = $stmt->fetchColumn(0);

        $dateBegin = $data['begin'];
        $dateEnd = $data['end'];
        $subjects = implode(',', $data['subjects']);

        $query = "SELECT * FROM slot
            INNER JOIN slot_has_subject ON slot_has_subject.slot_id = slot.id
            WHERE slot_has_subject.lvl_id IN (SELECT lvl.id FROM lvl WHERE lvl.value >= $id)
            AND slot_has_subject.subject_id IN ($subjects)
            AND slot.begin >= '" . $dateBegin . "'
            AND slot.end <= '" . $dateEnd . "'
            AND slot.id NOT IN (SELECT booking.slot_id FROM booking WHERE booking.student_id = $student)
            ;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $rows = $stmt->fetchAll();

        $data = [];
        foreach($rows as $row) {
            $data[] = [
                "id" => $row['id'],
                "begin" => $row['begin'],
                "end" => $row['end']
            ];
        }

        return $data;
    }
}
