<?php

require_once  'myPdo.class.php';

// namespace ropa;

// use ropa\Db;

class Building extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_building 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordById($id)
    {
        $sql = "select * 
                from tbl_building
                where is_deleted = false
                and building_id = :id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetch();
        return $rs;
    }

    public function insertData($getData)
    {
        $building_id = $getData['building_id'];
        $building_name = $getData['building_name'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_building(building_id, building_name) 
                values(:building_id, :building_name)";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':building_name', $building_name, PDO::PARAM_STR);
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
        $building_id = $getData['building_id'];
        $building_name = $getData['building_name'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_building 
                set building_name = :building_name
                where building_id = :building_id";
        // , update_datetime = CURRENT_TIMESTAMP()
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':building_name', $building_name, PDO::PARAM_STR);
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
        $building_id = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_building 
                set is_deleted = 1
                where building_id = :building_id";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);

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
                from tbl_building 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $html = "<p>รายงานอาคารทั้งหมด</p>";

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
        $html .= "<th align='center' bgcolor='F2F2F2'>รหัสอาคาร</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>อาคาร</th>";
        $html .= "</tr>";
        foreach ($rs as $row) :
            $html .=  "<tr bgcolor='#c7c7c7'>";
            $html .=  "<td>{$row['building_id']}</td>";
            $html .=  "<td>{$row['building_name']}</td>";
            $html .=  "</tr>";
        endforeach;

        $html .= "</table>";

        return $html;
    }
    public function getHtmlData_()
    {
        $sql = "select * 
                from tbl_open_area_schedule_sub_details 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $html = "<p>ตอนนี้เปลี่ยนหัวข้อรายงานนี้ที่ getHtmlData_ function ในไฟล์ building.class.php</p>";

        // เรียกใช้งาน ฟังก์ชั่นดึงข้อมูลไฟล์มาใช้งาน
        $html .= "<style>";
        $html .= "table, th, td {";
        $html .= "border: 1px solid black;";
        $html .= "border-radius: 10px;";
        $html .= "background-color: #efffef;";
        $html .= "padding: 5px;}";
        $html .= "</style>";
        $html .= "<table cellspacing='0' cellpadding='1' style='width:1100px;'>";
        $html .= "<tr>";
        $html .= "<th align='center' bgcolor='F2F2F2'>open date</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>open time json</th>";
        $html .= "</tr>";
        foreach ($rs as $row) :
            $html .=  "<tr>";
            $html .=  "<td>{$row['open_date']}</td>";
            $html .=  "<td>{$row['open_time_json']}</td>";
            $html .=  "</tr>";
        endforeach;

        $html .= "</table>";

        return $html;
    }
}

// $stmt = $conn->prepare('select ...where :');
// $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
// $stmt->bindParam(':building_name', $building_name, PDO::PARAM_STR);
// $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
// $stmt->execute();
// $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);