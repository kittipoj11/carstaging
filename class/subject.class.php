<?php

require_once  'myPdo.class.php';

// namespace ropa;

// use ropa\Db;

class Subject extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_subject 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordById($id)
    {
        $sql = "select * 
                from tbl_subject
                where is_deleted = false
                and subject_code = :id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetch();
        return $rs;
    }

    public function insertData($getData)
    {
        $subject_code = $getData['subject_code'];
        $subject_name = $getData['subject_name'];
        $category_code = $getData['category_code'];
        $credit = $getData['credit'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_subject(subject_code, subject_name, category_code, credit) 
                values(:subject_code, :subject_name, :category_code, :credit)";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);
        $stmt->bindParam(':subject_name', $subject_name, PDO::PARAM_STR);
        $stmt->bindParam(':category_code', $category_code, PDO::PARAM_STR);
        $stmt->bindParam(':credit', $credit, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
        // $affected = $stmt->execute();

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been created successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }
    }
    public function updateData($getData)
    {
        $subject_code = $getData['subject_code'];
        $subject_name = $getData['subject_name'];
        $category_code = $getData['category_code'];
        $credit = $getData['credit'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_subject 
                set subject_name = :subject_name
                , category_code = :category_code
                , credit = :credit
                where subject_code = :subject_code";
        // , update_datetime = CURRENT_TIMESTAMP()
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);
        $stmt->bindParam(':subject_name', $subject_name, PDO::PARAM_STR);
        $stmt->bindParam(':category_code', $category_code, PDO::PARAM_STR);
        $stmt->bindParam(':credit', $credit, PDO::PARAM_STR);
        // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been update successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }
    }
    public function deleteData($getData)
    {
        $subject_code = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_subject 
                set is_deleted = 1
                where subject_code = :subject_code";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been delete successfully.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            } else {
                $_SESSION['message'] =  'Something is wrong.Can not add data.';
            }
        }
    }

    public function getHtmlData()
    {
        $sql = "select * 
                from tbl_subject 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $html = "<p>รายงาน...ทั้งหมด</p>";

        // เรียกใช้งาน ฟังก์ชั่นดึงข้อมูลไฟล์มาใช้งาน
        $html .= "<style>";
        $html .= "table, th, td {";
        $html .= "border: 1px solid black;";
        $html .= "border-radius: 10px;";
        $html .= "background-color: #b3ffb3;";
        $html .= "padding: 5px;}";
        $html .= "</style>";
        $html .= "<table cellspacing='0' cellpadding='1' style='width:1100px;'>";
        $html .= "<tr>";
        $html .= "<th align='center' bgcolor='F2F2F2'>subject_code</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>subject_name</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>category_code</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>credit</th>";
        $html .= "</tr>";
        foreach ($rs as $row) :
            $html .=  "<tr bgcolor='#c7c7c7'>";
            $html .=  "<td>{$row['subject_code']}</td>";
            $html .=  "<td>{$row['subject_name']}</td>";
            $html .=  "<td>{$row['category_code']}</td>";
            $html .=  "<td>{$row['credit']}</td>";
            $html .=  "</tr>";
        endforeach;

        $html .= "</table>";

        return $html;
    }
}

// $stmt = $conn->prepare('select ...where :');
// $stmt->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);
// $stmt->bindParam(':subject_name', $subject_name, PDO::PARAM_STR);
// $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
// $stmt->execute();
// $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);