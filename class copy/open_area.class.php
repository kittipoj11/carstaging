<?php
@session_start();
require_once  'myPdo.class.php';

// namespace ropa;
// use ropa\Db;

class OpenArea extends MyConnection
{
    public function insertSchedule($getData)
    {
        try {
            //สร้าง id มี OA เป็น prefix
            $id = uniqid('OA', true);
            $hall_id = $getData['hall_id'];
            $building_id = $getData['building_id'];
            $event_name = $getData['event_name'];
            $reservable_slots = $getData['reservable_slots'];
            $total_slots = $getData['total_slots'];
            $open_time_start = $getData['time_start_header'];
            $open_time_end = $getData['time_end_header'];
            // $is_active = isset($getData['is_active']) ? 1 : 0;

            //หา open date start-end
            $open_date_min = new DateTime();
            $open_date_max = new DateTime();
            $open_date_start = new DateTime();
            $open_date_end = new DateTime();

            $first_record=true;

            // $_SESSION['open_date'] = $getData['date_start'];
            // $_SESSION['getData'] = $getData;
            foreach ($getData['date_start'] as $key_data => $value_data) :
                if($first_record==true):
                    $open_date_min = new DateTime($getData['date_start'][$key_data]);
                    $open_date_max = new DateTime($getData['date_end'][$key_data]);
                    $first_record=false;
                endif;
                $open_date_start = new DateTime($getData['date_start'][$key_data]);
                $open_date_end = new DateTime($getData['date_end'][$key_data]);

                if ($open_date_start < $open_date_min) :
                    $open_date_min = $open_date_start;
                endif;

                if ($open_date_end > $open_date_max) :
                    $open_date_max = $open_date_end;
                endif;
            endforeach;

            $sql = "insert into tbl_open_area_schedule_header(id, hall_id, building_id, event_name, open_date_start, open_date_end, open_time_start, open_time_end, total_slots, reservable_slots) 
                values(:id, :hall_id, :building_id, :event_name, :open_date_start, :open_date_end, :open_time_start, :open_time_end, :total_slots, :reservable_slots)";
            $stmt = $this->myPdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
            $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
            $stmt->bindParam(':event_name', $event_name, PDO::PARAM_STR);
            $stmt->bindParam(':open_date_start', $open_date_min->format('Y-m-d'), PDO::PARAM_STR);
            $stmt->bindParam(':open_date_end', $open_date_max->format('Y-m-d'), PDO::PARAM_STR);
            $stmt->bindParam(':open_time_start', $open_time_start, PDO::PARAM_STR);
            $stmt->bindParam(':open_time_end', $open_time_end, PDO::PARAM_STR);
            $stmt->bindParam(':total_slots', $total_slots, PDO::PARAM_INT);
            $stmt->bindParam(':reservable_slots', $reservable_slots, PDO::PARAM_INT);

            // $stmt->bindParam(':is_active', $is_active, PDO::PARAM_BOOL);
            // $affected = $stmt->execute();
            // $_SESSION['getData'] = $getData;
            // $_SESSION['sql'] = $stmt->debugDumpParams();
            // $stmt->debugDumpParams();
            // exit;
            if ($stmt->execute()) {

                $open_id = $this->getOpenId($id);
                $sqlDetail = 'insert into tbl_open_area_schedule_detail(id, open_id, hall_id, building_id, event_name, open_date_start, open_date_end, open_time_start, open_time_end, reservable_slots, car_type_json) 
                        values(:id, :open_id, :hall_id, :building_id, :event_name, :open_date_start, :open_date_end, :open_time_start, :open_time_end, :reservable_slots, :car_type_arr)';
                $stmtDetail = $this->myPdo->prepare($sqlDetail);

                $sqlSubs = 'insert into tbl_open_area_schedule_sub_details(id, open_id, hall_id, building_id, event_name, open_date_start, open_date_end, open_time_start, open_time_end, open_date, open_time_json, reservable_slots, car_type_json) 
                            values(:id, :open_id, :hall_id, :building_id, :event_name, :open_date_start, :open_date_end, :open_time_start, :open_time_end, :open_date, :open_time_json, :reservable_slots, :car_type_arr)';
                $stmtSubs = $this->myPdo->prepare($sqlSubs);

                // กำหนด parameter
                foreach ($getData['date_start'] as $key_data => $value_data) :
                    $open_date_start = $getData['date_start'][$key_data];
                    $open_date_end = $getData['date_end'][$key_data];

                    $open_time_start = $getData['time_start'][$key_data];
                    $open_time_end = $getData['time_end'][$key_data];
                    $reservable_slots = $getData['reservable_slots'][$key_data];

                    $rowid = $getData['id'][$key_data];
                    $checkbox = implode(',', $getData['chkCarType' . $rowid]);
                    $car_type_arr = '[' . $checkbox . ']';

                    $stmtDetail->bindParam(':id', $id, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':open_id', $open_id, PDO::PARAM_INT);
                    $stmtDetail->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':building_id', $building_id, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':event_name', $event_name, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':open_date_start', $open_date_start, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':open_date_end', $open_date_end, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':open_time_start', $open_time_start, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':open_time_end', $open_time_end, PDO::PARAM_STR);
                    $stmtDetail->bindParam(':reservable_slots', $reservable_slots, PDO::PARAM_INT);
                    $stmtDetail->bindParam(':car_type_arr', $car_type_arr);
                    if ($stmtDetail->execute()) {
                        //Sub detail
                        $start = new DateTime($open_date_start);
                        $end = new DateTime($open_date_end);
                        $end->modify('+1 day');
                        $interval = new DateInterval('P1D');
                        //หรือ $interval = DateInterval::createFromDateString('1 day');
                        $period = new DatePeriod($start, $interval, $end);

                        $start_time = new DateTime($open_time_start);
                        $end_time = new DateTime($open_time_end);
                        $end_time->modify('+10 minute');
                        $interval_time = new DateInterval('PT10M');
                        $period_time = new DatePeriod($start_time, $interval_time, $end_time);

                        $stmtSubs->bindParam(':id', $id, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':open_id', $open_id, PDO::PARAM_INT);
                        $stmtSubs->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':building_id', $building_id, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':event_name', $event_name, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':open_date_start', $open_date_start, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':open_date_end', $open_date_end, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':open_time_start', $open_time_start, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':open_time_end', $open_time_end, PDO::PARAM_STR);
                        $stmtSubs->bindParam(':reservable_slots', $reservable_slots, PDO::PARAM_INT);
                        $stmtSubs->bindParam(':car_type_arr', $car_type_arr);

                        foreach ($period as $date) :
                            $open_date = $date->format("Y-m-d");
                            $stmtSubs->bindParam(':open_date', $open_date, PDO::PARAM_STR);

                            // แก้ไขตรงนี้
                            $open_time_json = '{';
                            foreach ($period_time as $time) :
                                $open_time_json .= '"' . $time->format("H:i") . '":' . $reservable_slots . ',';

                            endforeach;
                            $open_time_json = substr($open_time_json, 0, -1);
                            $open_time_json .= '}';

                            // $_SESSION['open_time_json'] = $open_time_json;
                            $stmtSubs->bindParam(':open_time_json', $open_time_json, PDO::PARAM_STR);
                            $stmtSubs->execute();
                        endforeach;
                    }
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
            $stmtSubs->closeCursor();
            unset($stmt);
            unset($stmtDetail);
            unset($stmtSubs);
        }
    }

    public function deleteSchedule($getData)
    {
        try {
            $id = $getData['delete_id'];
            // $is_active = isset($getData['is_active']) ? 1 : 0;
            $sql = "delete from tbl_open_area_schedule_header 
                where id = :id";
            $stmt = $this->myPdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            unset($stmt);
            $sql = "delete from tbl_open_area_schedule_detail 
                where id = :id";
            $stmt = $this->myPdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            unset($stmt);
            $sql = "delete from tbl_open_area_schedule_sub_detail 
                where id = :id";
            $stmt = $this->myPdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION['message'] =  'data has been delete successfully.';
            echo "success";
        } catch (PDOException $e) {
            $_SESSION['message'] =  'Something is wrong.Can not delete data.';
            echo "fail";
        }
    }

    public function updateSlotsBooked($getData, $getNumberOfSlots)
    {
        try {
            //ถ้า insert ข้อมูลลง tbl_booking สำเร็จ
            // จะทำการ update ข้อมูล ใน tbl_open_area_schedule_sub_details
            
            //// --Increment a number in JSON
            //UPDATE tbl_open_area_schedule_sub_details
            //SET open_time_json = json_replace(open_time_json, '$.10:00',  JSON_EXTRACT(open_time_json, '$.10:00') - 1, '$.11:00',  JSON_EXTRACT(open_time_json, '$.11:00') - 1, '$.12:20', JSON_EXTRACT(open_time_json, '$.12:20') - 1);
            
            // condition: ตามวันที่และเวลาจอง  โดยที่เวลาจองจะเป็นข่วงเวลาตามประเภทรถที่กำหนดเวลาไว้้
            $open_area = new OpenArea;
            $rsData = $open_area->getRSOpenTimeJson($getData);
            
            $open_time_json = [];
            foreach ($rsData as $row) :
                // ทำการรวมเวลาหลายๆช่วงให้อยู่ในตัวแปรอาร์เรย์เดียว
                $open_time_json = array_merge($open_time_json, json_decode($row['open_time_json'], TRUE));
            endforeach;

            $_SESSION['$open_time_json']= $open_time_json;
            $open_id = $getData['open_id'];
            $building_id = $getData['building_id'];
            $hall_id = $getData['hall_id'];
            $booking_date = $getData['txtDate'];
            $booking_time = new DateTime($getData['txtTime']); //เวลาในรูปแบบ 00:00 $open_time = $time->format("H:i"); [แปลง time object เป็น text]
            $car_type_id = $getData['car_type_id'];

            $counter = 0;
            $number_of_slots = $getNumberOfSlots;

            // $sql = "";
            $sql = "UPDATE tbl_open_area_schedule_sub_details";
            $sql .= " SET open_time_json = json_replace(open_time_json";

            // booking_time_json = json_insert(booking_time_json, '$.00:00', '$.00:10', '$.00:20', '$.24:00')
            $booking_time_json = '{';
            // Loop ตรงนี้
            while ($number_of_slots > $counter) :
                $time = $booking_time->format("H:i");
                if ($open_time_json[$time] > 0) :
                    $counter += 1;
                    $sql .= " ,'$.{$time}',  JSON_EXTRACT(open_time_json, '$.{$time}') - 1";
                    $booking_time_json .= "\"{$time}\":1,";
                elseif (array_key_exists("'$.{$time}'", $open_time_json)) :
                    break;
                endif;
                $booking_time->modify('+10 minute');
            endwhile;

            $booking_time_json = substr($booking_time_json, 0, -1);
            $booking_time_json .= '}';
            $_SESSION['booking_time_json'] = $booking_time_json;
            // สิ้นสุด Loop ตรงนี้
            $sql .= ")";
            $sql .= " where open_id = :open_id";
            $sql .= " and building_id = :building_id";
            $sql .= " and hall_id = :hall_id";
            $sql .= " and open_date = :booking_date";
            $sql .= " and json_contains(car_type_json,:car_type_id)";

            // $_SESSION['sql'] = $sql;
            // echo 'sql = ' . $sql;
            // exit;
            $stmt = $this->myPdo->prepare($sql);

            // กำหนด parameter
            $stmt->bindParam(':open_id', $open_id, PDO::PARAM_STR);
            $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
            $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
            $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
            $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['message'] =  'data has been update successfully.';
            return $booking_time_json;
        } catch (PDOException $e) {
            $_SESSION['message'] =  "Something is wrong.Can not update data({$e->getMessage()})";
            return '{}';
        }
    }
    public function updateNumberSlotsAlreadyBooked($getData, $getNumberOfSlots)
    {
        try {
            //ถ้า insert ข้อมูลลง tbl_booking สำเร็จ
            // จะทำการ update ข้อมูล ใน tbl_open_area_schedule_sub_detail
            // filed: number_slots_already_booked + 1 
            // condition: ตามวันที่และเวลาจอง  โดยที่เวลาจองจะเป็นข่วงเวลาตามประเภทรถที่กำหนดเวลาไว้้
            $open_id = $getData['open_id'];
            $building_id = $getData['building_id'];
            $hall_id = $getData['hall_id'];
            $booking_date = $getData['txtDate'];
            $booking_time = $getData['txtTime'];
            $number_of_slots = $getNumberOfSlots;

            $sql = 'update tbl_open_area_schedule_sub_detail a
                        inner join (select * from tbl_open_area_schedule_sub_detail
                                    where open_id = :open_id
                                    and building_id = :building_id
                                    and hall_id = :hall_id
                                    and open_date = :booking_date
                                    and open_time >= :booking_time
                                    and number_slots_already_booked < reservable_slots
                                    LIMIT 0, :number_of_slots) b
                            on a.building_id = b.building_id and a.hall_id = b.hall_id and a.open_date = b.open_date and a.open_time = b.open_time
                        set a.number_slots_already_booked = a.number_slots_already_booked+1
            ';
            $stmt = $this->myPdo->prepare($sql);
            // กำหนด parameter
            $stmt->bindParam(':open_id', $open_id, PDO::PARAM_STR);
            $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
            $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
            $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
            $stmt->bindParam(':booking_time', $booking_time, PDO::PARAM_STR);
            $stmt->bindParam(':number_of_slots', $number_of_slots, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['message'] =  'data has been delete successfully.';
            return true;
        } catch (PDOException $e) {
            $_SESSION['message'] =  "Something is wrong.Can not delete data({$e->getMessage()})";
            return false;
        }
    }

    // การกำหนดวัน/เวลาเปิดพื้นที่ Setup
    public function getAllRecord()
    {
        $sql = "select h.id, h.open_id, h.hall_id, h.event_name, h.total_slots, h.reservable_slots
                , h.open_date_start, h.open_date_end
                , h.open_time_start, h.open_time_end
                , hall.hall_name, b.building_name
                from tbl_open_area_schedule_header h
                left join tbl_hall hall
                    on h.hall_id = hall.hall_id
                left join tbl_building b
                    on hall.building_id = b.building_id
                where h.is_deleted = false
                order by h.open_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getOpenId($id)
    {
        $sql = "select open_id
                from tbl_open_area_schedule_header 
                where id = :id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        return $rs[0]['open_id'];
    }

    public function getRSOpenId($open_id = 0)
    {
        if ($open_id == 0) :
            $condition = " (open_id = :open_id OR True)";
        else :
            $condition = " open_id = :open_id";
        endif;

        $sql = <<<EOD
                select id, open_id, event_name
                from tbl_open_area_schedule_detail
                where {$condition}
                -- and (open_date_start > curdate() or open_date_end > curdate())
                group by id, open_id, event_name
                order by open_id
                EOD;

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getEventNameByOpenId($open_id)
    {
        $sql = "select id, open_id, event_name
                from tbl_open_area_schedule_header
                where open_id = :open_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();


        if (count($rs) == 0) :
            $event_name = $open_id;
        else :
            $event_name = $rs[0]['event_name'];
        endif;

        return $event_name;
    }


    public function getRSBuildingByOpenId($open_id)
    {
        $sql = "select h.building_id, b.building_name
                from tbl_open_area_schedule_header h
                inner join tbl_building b
                    on h.building_id = b.building_id
                where open_id = :open_id
                group by h.building_id, b.building_name
                order by h.building_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSOpenDate($getData)
    {
        $open_id = $getData['open_id'];
        $building_id = $getData['building_id'];
        $hall_id = $getData['hall_id'];
        $car_type_id = $getData['car_type_id'];
        $car_license_number = $getData['car_license_number'];

        $sql = "select open_date
                from tbl_open_area_schedule_sub_details 
                where open_id = :open_id
                and building_id = :building_id
                and hall_id = :hall_id
                -- and open_date >= CURRENT_DATE()
                and open_date > CURRENT_DATE()
                and json_contains(car_type_json,:car_type_id)
                -- and not exists(select 1 from tbl_booking b
                                -- where b.open_id= open_id
                                -- and b.building_id= building_id
                                -- and b.hall_id= hall_id
                                -- and b.booking_date = open_date
                                -- and b.car_license_number = :car_license_number)
                group by open_date";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        // $stmt->bindParam(':car_license_number', $car_license_number, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSOpenTime($getData)
    {
        $open_id = $getData['open_id'];
        $building_id = $getData['building_id'];
        $hall_id = $getData['hall_id'];
        $car_type_id = $getData['car_type_id'];
        $book_date = $getData['txtDate'];
        $take_time_minutes = $getData['take_time_minutes'];

        if ($book_date == date("Y-m-d")) {
            $sql = 'select open_time, number_slots_already_booked, reservable_slots
                    from tbl_open_area_schedule_sub_detail
                    where open_id = :open_id
                    and building_id = :building_id
                    and hall_id = :hall_id
                    and json_contains(car_type_json,:car_type_id)
                    and open_date = :book_date 
                    and :book_date = CURDATE() 
                    and open_time >= TIME_FORMAT(CURTIME(), "%H:%i:%s")
                    and open_time <= DATE_ADD(open_time_end, INTERVAL - :take_time_minutes MINUTE)';
        } else {
            $sql = 'select open_time, number_slots_already_booked, reservable_slots
                    from tbl_open_area_schedule_sub_detail
                    where open_id = :open_id
                    and building_id = :building_id
                    and hall_id = :hall_id
                    and json_contains(car_type_json,:car_type_id)
                    and open_date = :book_date
                    and open_time <= DATE_ADD(open_time_end, INTERVAL -:take_time_minutes MINUTE)';
        }

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->bindParam(':book_date', $book_date, PDO::PARAM_STR);
        $stmt->bindParam(':take_time_minutes', $take_time_minutes, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSOpenTimeJson($getData)
    {
        $open_id = $getData['open_id'];
        $building_id = $getData['building_id'];
        $hall_id = $getData['hall_id'];
        $car_type_id = $getData['car_type_id'];
        $book_date = $getData['txtDate'];
        $take_time_minutes = $getData['take_time_minutes'];

        $sql = 'select open_time_json, number_slots_already_booked, reservable_slots
                -- , open_date_start, open_date_end
                , open_time_start, open_time_end, :take_time_minutes as take_time_minutes
                from tbl_open_area_schedule_sub_details
                where open_id = :open_id
                and building_id = :building_id
                and hall_id = :hall_id
                and json_contains(car_type_json,:car_type_id)
                and open_date = :book_date';

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->bindParam(':book_date', $book_date, PDO::PARAM_STR);
        $stmt->bindParam(':take_time_minutes', $take_time_minutes, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSHallByOpenIdAndBuildingId($open_id, $building_id)
    {
        $sql = "select h.hall_id, hall_name
                from tbl_open_area_schedule_header h
                inner join tbl_hall hall
                    on h.building_id = hall.building_id and  h.hall_id = hall.hall_id
                where open_id = :open_id
                and h.building_id = :building_id
                group by h.hall_id, hall_name
                order by open_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSOpenAreaScheduleHeaderById($id)
    {
        $sql = "select h.id, h.open_id, h.hall_id, h.building_id, h.event_name, h.total_slots, h.reservable_slots
                , h.open_date_start, h.open_date_end
                , h.open_time_start, h.open_time_end
                , hall.hall_name, b.building_name
                from tbl_open_area_schedule_header h
                left join tbl_hall hall
                    on h.hall_id = hall.hall_id
                left join tbl_building b
                    on h.building_id = b.building_id
                where id = :id
                order by h.open_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    // การกำหนดวัน/เวลาเปิดพื้นที่ Setup
    public function getRSOpenAreaSchedule()
    {
        $sql = "select h.id, h.open_id, h.hall_id, h.event_name, h.total_slots, h.reservable_slots
                , h.open_date_start, h.open_date_end
                , h.open_time_start, h.open_time_end
                , hall.hall_name, b.building_name
                from tbl_open_area_schedule_header h
                left join tbl_hall hall
                    on h.hall_id = hall.hall_id
                left join tbl_building b
                    on hall.building_id = b.building_id
                where h.is_deleted = false
                and h.open_date_end  > CURRENT_DATE() 
                order by h.open_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSOpenAreaScheduleDetailById_old($id)
    {
        $sql = "select id, open_id, building_id, hall_id
        , open_date_start, open_date_end
        , open_time_start, open_time_end
        , total_slots, reservable_slots
        , car_type_json
        , GROUP_CONCAT(car_type_name ORDER BY car_type_id ASC SEPARATOR ',') as car_type_name_lists
        from ( 
            select id, open_id, building_id, hall_id
            , open_date_start, open_date_end, open_time_start, open_time_end
            , total_slots, reservable_slots
            , car_type_json
            , car_type_id, car_type_name
            from (
                select id, open_id, building_id, hall_id
                , min(reservable_date) open_date_start, max(reservable_date) open_date_end
                , open_time_start, open_time_end
                , total_slots, reservable_slots
                , car_type_json
                from ( select id, open_id, building_id, hall_id, reservable_date
                    , min(reservable_time) open_time_start
                    , max(reservable_time) open_time_end
                    , total_slots, reservable_slots
                    , car_type_json
                    from tbl_open_area_period_detail
                    where id = :id
                    group by id, open_id, building_id, hall_id, reservable_date, total_slots, reservable_slots, car_type_json
                    ) tmp1
                group by id, open_id, building_id, hall_id, open_time_start, open_time_end, total_slots, reservable_slots, car_type_json
            )tmp2
            LEFT JOIN tbl_car_type 
                ON JSON_CONTAINS(car_type_json, (tbl_car_type.car_type_id), '$')
        ) tmp3
        group by id, open_id, building_id, hall_id, open_date_start, open_date_end, open_time_start, open_time_end, total_slots, reservable_slots, car_type_json
        ";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function getRSOpenAreaScheduleDetailById($id)
    {
        $sql = "select id, open_date_start, open_date_end, open_time_start, open_time_end
        , reservable_slots, car_type_json
        from tbl_open_area_schedule_detail
        where id = :id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }



    function diff2time($time_a, $time_b)
    {
        $start = strtotime($time_a);
        $end = strtotime($time_b);
        $mins = ($end - $start) / 60;
        // $time_diff_m = floor(($time_diff % 3600) / 60); // จำนวนนาทีที่ต่างกัน
        echo '<br>(f)Start = ' . $start;
        echo '<br>(f)End = ' . $end;
        echo '<br>(f)Diff = ' . $mins;
        return $mins;
    }
}