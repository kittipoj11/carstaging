<?php
// require_once 'config.php';
require_once 'myPdo.class.php';

// namespace carstaging;

// use carstaging\Db;

class Car_type extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_car_type 
                where is_deleted = false";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRecordById($id)
    {
        $sql = "select * 
                from tbl_car_type
                where is_deleted = false
                and car_type_id = :id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch();
        return $rs;
    }
    // public function getRecordByIdx($id)
    // {
    //     $sql = "select * 
    //             from tbl_car_type
    //             where is_deleted = false
    //             and car_type_id = :id";

    //     $stmt = $this->myPdo->prepare($sql);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     $rs = $stmt->fetchAll();
    //     return $rs;
    // }

    public function insertData($getData)
    {
        $car_type_name = $getData['car_type_name'];
        $take_time_minutes = $getData['take_time_minutes'];
        $parking_fee = $getData['parking_fee'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;

        $sql = "insert into tbl_car_type(car_type_name, take_time_minutes, parking_fee) 
                values(:car_type_name, :take_time_minutes, :parking_fee)";
        $stmt = $this->myPdo->prepare($sql);
        // $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_name', $car_type_name, PDO::PARAM_STR);
        $stmt->bindParam(':take_time_minutes', $take_time_minutes, PDO::PARAM_INT);
        $stmt->bindParam(':parking_fee', $parking_fee, PDO::PARAM_INT);
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
        $car_type_id = $getData['car_type_id'];
        $car_type_name = $getData['car_type_name'];
        $take_time_minutes = $getData['take_time_minutes'];
        $parking_fee = $getData['parking_fee'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_car_type 
                set car_type_name = :car_type_name
                , take_time_minutes = :take_time_minutes
                , parking_fee = :parking_fee
                where car_type_id = :car_type_id";
        // , update_datetime = CURRENT_TIMESTAMP()
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->bindParam(':car_type_name', $car_type_name, PDO::PARAM_STR);
        $stmt->bindParam(':take_time_minutes', $take_time_minutes, PDO::PARAM_INT);
        $stmt->bindParam(':parking_fee', $parking_fee, PDO::PARAM_INT);
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
        $car_type_id = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_car_type 
                set is_deleted = 1
                where car_type_id = :car_type_id";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);

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
                from tbl_car_type 
                where is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $html = "<p>รายงานประเภทรถทั้งหมด</p>";

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
        $html .= "<th align='center' bgcolor='F2F2F2'>รหัสประเภทรถ</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>ประเภทรถ</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>เวลาที่กำหนดให้ในการ Load</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>ค่าปรับเมื่อเกินเวลาต่อชั่วโมง</th>";
        $html .= "</tr>";
        foreach ($rs as $row) :
            $html .=  "<tr bgcolor='#c7c7c7'>";
            $html .=  "<td>{$row['car_type_id']}</td>";
            $html .=  "<td>{$row['car_type_name']}</td>";
            $html .=  "<td>{$row['take_time_minutes']}</td>";
            $html .=  "<td>{$row['parking_fee']}</td>";
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