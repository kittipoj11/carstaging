<?php
@session_start();
require_once  'myPdo.class.php';

// namespace ropa;
// use ropa\Db;

class Semester extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select id, grade_level, term, number_of_credits, gpa, number_of_subjects
                from tbl_semester_header
                where is_deleted = false
                order by grade_level, term";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    
    public function insertSchedule($getData)
    {
        try {
            //สร้าง id มี OA เป็น prefix
            $id = uniqid('OA', true);
            $grade_level = $getData['grade_level'];
            $term = $getData['term'];
            $number_of_credits = $getData['number_of_credits'];
            $gpa = $getData['gpa'];
            $number_of_subjects = $getData['number_of_subjects'];

            $sql = "insert into tbl_semester_header(id, grade_level, term, number_of_credits, number_of_subjects, gpa) 
                values(:id, :grade_level, :term, :number_of_credits, :number_of_subjects, :gpa)";
            $stmt = $this->myPdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':grade_level', $grade_level, PDO::PARAM_INT);
            $stmt->bindParam(':term', $term, PDO::PARAM_INT);
            $stmt->bindParam(':number_of_credits', $number_of_credits, PDO::PARAM_STR);
            $stmt->bindParam(':gpa', $gpa, PDO::PARAM_STR);
            $stmt->bindParam(':number_of_subjects', $number_of_subjects, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $sqlDetail = 'insert into tbl_semester_detail(id, grade_level, term, number_of_credits, gpa, number_of_subjects) 
                        values(:id, :grade_level, :term, :number_of_credits, :gpa, :number_of_subjects)';
                $stmtDetail = $this->myPdo->prepare($sqlDetail);

                // กำหนด parameter
                foreach ($getData['date_start'] as $key_data => $value_data) :
                    $stmtDetail->bindParam(':id', $id, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':grade_level', $grade_level, PDO::PARAM_INT);
                    $stmtDetail->bindParam(':term', $term, PDO::PARAM_INT);
                    $stmtDetail->bindParam(':number_of_credits', $number_of_credits, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':gpa', $gpa, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':number_of_subjects',$number_of_subjects, PDO::PARAM_INT);
                endforeach;

                $_SESSION['message'] =  'data has been created successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }finally{
            $stmt->closeCursor();
            $stmtDetail->closeCursor();
            unset($stmt);
            unset($stmtDetail);
            unset($stmtSubs);
        }
    }

}