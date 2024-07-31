<?php
require_once 'building.class.php';

// namespace ropa;

// use ropa\Db;

class Hall extends MyConnection
{
    public function getAllRecord()
    {
        $sql = "select * 
                from tbl_hall hall
                left join tbl_building building
                    on hall.building_id = building.building_id
                where hall.is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }


    public function getRecordById($building_id = "%", $hall_id)
    {
        $sql = "select * 
                from tbl_hall hall
                left join tbl_building building
                    on hall.building_id = building.building_id
                where hall.building_id like (:building_id)
                and hall_id = :hall_id
                and hall.is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetch();
        return $rs;
    }

    public function getRecordByBuildingId($building_id)
    {
        $sql = "select * 
                from tbl_hall hall
                inner join tbl_building building
                    on hall.building_id = building.building_id
                where hall.is_deleted = false
                and hall.building_id = :building_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function insertData($getData)
    {
        $hall_id = $getData['hall_id'];
        $hall_name = $getData['hall_name'];
        $building_id = $getData['building_id'];
        $reservable_slots = $getData['reservable_slots'];
        $total_slots = $getData['total_slots'];
        $start_time = $getData['start_time'];
        $end_time = $getData['end_time'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "insert into tbl_hall(hall_id, hall_name, building_id, reservable_slots, total_slots, start_time, end_time) 
                values(:hall_id, :hall_name, :building_id, :reservable_slots, :total_slots, :start_time, :end_time)";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_name', $hall_name, PDO::PARAM_STR);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':reservable_slots', $reservable_slots, PDO::PARAM_INT);
        $stmt->bindParam(':total_slots', $total_slots, PDO::PARAM_INT);
        $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);
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
        $hall_id = $getData['hall_id'];
        $hall_name = $getData['hall_name'];
        $building_id = $getData['building_id'];
        $reservable_slots = $getData['reservable_slots'];
        $total_slots = $getData['total_slots'];
        $start_time = $getData['start_time'];
        $end_time = $getData['end_time'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_hall 
                set hall_name = :hall_name
                , building_id = :building_id
                , reservable_slots = :reservable_slots
                , total_slots = :total_slots
                , start_time = :start_time
                , end_time = :end_time
                where hall_id = :hall_id";
        // , update_datetime = CURRENT_TIMESTAMP()
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_name', $hall_name, PDO::PARAM_STR);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':reservable_slots', $reservable_slots, PDO::PARAM_INT);
        $stmt->bindParam(':total_slots', $total_slots, PDO::PARAM_INT);
        $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);
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
        $hall_id = $getData['delete_id'];
        // $is_active = isset($getData['is_active']) ? 1 : 0;
        $sql = "update tbl_hall 
                set is_deleted = 1
                where hall_id = :hall_id";
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);

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
                from tbl_hall hall
                inner join tbl_building building
                    on hall.building_id = building.building_id
                where hall.is_deleted = false";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $html = "<p>รายงานพื้นที่ทั้งหมด</p>";

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
        $html .= "<th align='center' bgcolor='F2F2F2'>รหัสพื้นที่</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>พื้นที่</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>อาคาร</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>จำนวนช่องโหลดที่เปิดให้จอง</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>จำนวนช่องโหลดทั้งหมด</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>ตั้งค่าเวลาจองเริ่มต้น</th>";
        $html .= "<th align='center' bgcolor='F2F2F2'>ตั้งค่าเวลาจองสิ้นสุด	</th>";
        $html .= "</tr>";
        foreach ($rs as $row) :
            $html .=  "<tr bgcolor='#c7c7c7'>";
            $html .=  "<td>{$row['hall_id']}</td>";
            $html .=  "<td>{$row['hall_name']}</td>";
            $html .=  "<td>{$row['building_name']}</td>";
            $html .=  "<td>{$row['reservable_slots']}</td>";
            $html .=  "<td>{$row['total_slots']}</td>";
            $html .=  "<td>{$row['start_time']}</td>";
            $html .=  "<td>{$row['end_time']}</td>";
            $html .=  "</tr>";
        endforeach;

        $html .= "</table>";

        return $html;
    }
}
