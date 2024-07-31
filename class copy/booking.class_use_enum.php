<?php
require_once APP_PATH . 'class/db.class.php';
require_once APP_PATH . 'class/car_type.class.php';
require_once APP_PATH . 'class/building.class.php';
require_once APP_PATH . 'class/hall.class.php';
require_once APP_PATH . 'class/open_area.class.php';

// namespace ropa;

// use ropa\Db;

enum TimelineType
{
    const PAST = -1;
    const TODAY = 0;
    const FUTURE = 1;
    const ALL = 9;
}

enum StatusType
{
    const WAITING = 0;
    const CALLING = 1;
    const ACCEPT = 2;
    const LOADING = 3;
    const COMPLETED = 4;
}

class Booking extends Db
{
    public function getAllRecord($username, $getTimelineType = TimelineType::ALL)
    {
        $sql = "SELECT book.id, book.username, book.car_license_number, book.car_type_id, book.open_id, book.boot, book.building_id, book.hall_id
                , book.driver_name, book.driver_phone, book.booking_date, book.booking_time, book.queue_number, book.running_number
                , book.booking_data, book.qr_code_image, book.ref_id, book.ref_json, book.status
                , car.car_type_name, car.take_time_minutes, car.parking_fee
                , building.building_name
                , hall.hall_name
                , header.event_name, header.total_slots, header.reservable_slots
                FROM tbl_booking book
                inner join tbl_car_type car
                    on book.car_type_id = car.car_type_id
                inner join tbl_building building
                    on book.building_id = building.building_id
                inner join tbl_hall hall
                    on book.hall_id = hall.hall_id
                inner join tbl_open_area_schedule_header header
                    on book.open_id = header.open_id
                where username = :username";

        if ($getTimelineType == TimelineType::PAST) :
            $sql .= " and booking_date < curdate()";
        elseif ($getTimelineType == TimelineType::TODAY) :
            $sql .= " and booking_date = curdate()";
        elseif ($getTimelineType == TimelineType::FUTURE) :
            $sql .= " and booking_date > curdate()";
        endif;

        $sql .= " order by booking_date, booking_time";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSBookingDate($username)
    {
        $sql = "SELECT booking_date
        FROM tbl_booking booking
        inner join tbl_building building
            on booking.building_id = building.building_id
        inner join tbl_hall hall
            on booking.hall_id = hall.hall_id
        inner join tbl_car_type ct
            on booking.car_type_id = ct.car_type_id
        where username = :username
        and booking_date>= curdate()
        group by booking_date
        order by booking_date";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSHallToday()
    {
        $sql = "SELECT booking.hall_id, hall.hall_name, booking.building_id, building_name
        FROM tbl_booking booking
        inner join tbl_building building
            on booking.building_id = building.building_id
        inner join tbl_hall hall
            on booking.hall_id = hall.hall_id
        where booking_date = curdate()
        -- where booking_date = '2023-08-21'
        and status <> 4
        group by hall_id, building_id
        order by hall_id, building_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSHistoryBookingDate($username)
    {
        $sql = "SELECT booking_date
        FROM tbl_booking booking
        inner join tbl_building building
            on booking.building_id = building.building_id
        inner join tbl_hall hall
            on booking.hall_id = hall.hall_id
        inner join tbl_car_type ct
            on booking.car_type_id = ct.car_type_id
        where username = :username
        and booking_date < curdate()
        group by booking_date
        order by booking_date";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSBookingToday($getHallId = '%', $getStatus = StatusType::WAITING)
    {
        $sql = "SELECT book.id, book.username, book.car_license_number, book.car_type_id, book.open_id, book.boot, book.building_id, book.hall_id
                , book.driver_name, book.driver_phone, book.booking_date, book.booking_time, book.queue_number, book.running_number
                , book.booking_data, book.qr_code_image, book.ref_id, book.ref_json, book.status
                , car.car_type_name, car.take_time_minutes, car.parking_fee
                , building.building_name
                , hall.hall_name
                , header.event_name, header.total_slots, header.reservable_slots
                FROM tbl_booking book
                inner join tbl_car_type car
                    on book.car_type_id = car.car_type_id
                inner join tbl_building building
                    on book.building_id = building.building_id
                inner join tbl_hall hall
                    on book.hall_id = hall.hall_id
                inner join tbl_open_area_schedule_header header
                    on book.open_id = header.open_id
                where booking_date = curdate()
                -- where booking_date = '2023-08-21'
                and book.status = :status
                and book.hall_id in (:hall_id)
                order by queue_number, hall_id, building_id";
        // if (strlen(trim($getHallId)) <> 0) :
        // else:
        // endif;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $getStatus, PDO::PARAM_INT);
        $stmt->bindParam(':hall_id', $getHallId, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSBookingListByDate($username, $booking_date)
    {
        $sql = "SELECT book.id, book.username, book.car_license_number, book.car_type_id, book.open_id, book.boot, book.building_id, book.hall_id
                , book.driver_name, book.driver_phone, book.booking_date, book.booking_time, book.queue_number, book.running_number
                , book.booking_data, book.qr_code_image, book.ref_id, book.ref_json, book.status
                , car.car_type_name, car.take_time_minutes, car.parking_fee
                , building.building_name
                , hall.hall_name
                , header.event_name, header.total_slots, header.reservable_slots
                FROM tbl_booking book
                inner join tbl_car_type car
                    on book.car_type_id = car.car_type_id
                inner join tbl_building building
                    on book.building_id = building.building_id
                inner join tbl_hall hall
                    on book.hall_id = hall.hall_id
                inner join tbl_open_area_schedule_header header
                    on book.open_id = header.open_id
                where username = :username
                and booking_date = :booking_date
                order by booking_date, booking_time";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
        // $stmt->bindParam(':username', 'nathapat', PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSBooking($getData)
    {
        $username = $getData['username'];
        $sql = "select * 
                from tbl_booking
                where username = :username
                order by booking_date, booking_time";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }


    public function getRSGroup()
    {
        $sql = "SELECT booking.building_id, building_name, booking.hall_id, hall_name, booking_date
        FROM tbl_booking booking
        inner join tbl_hall hall
            on booking.building_id = hall.building_id and booking.hall_id = hall.hall_id 
        inner join tbl_building building
            on hall.building_id = building.building_id 
        where (booking.booking_date >= curdate()) 
        and booking.is_deleted = false
        group by building_id, hall_id, booking_date
        order by booking.booking_date, booking.hall_id, booking.building_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }


    public function getRSCountCarByBookingDateAndArea($booking_date, $building_id, $hall_id, $car_type_id)
    {
        $sql = "SELECT b.building_id, b.hall_id, hall_name, b.car_type_id, c.car_type_name, b.booking_date, count(*) as count_car 
        FROM tbl_booking b 
        inner join tbl_building bd 
            on b.building_id = bd.building_id 
        inner join tbl_hall h
            on b.building_id = h.building_id and b.hall_id = h.hall_id 
        inner join tbl_car_type c
            on b.car_type_id = c.car_type_id 

        where (b.booking_date >= curdate()) and b.is_deleted = false
        group by building_id, hall_name, car_type_name, booking_date
        having b.booking_date = :booking_date
        and b.building_id = :building_id
        and b.hall_id = :hall_id
        and b.car_type_id = :car_type_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function insertData($getData)
    {
        $username = $getData['username'];
        $car_license_number = $getData['car_license_number'];
        $car_type_id = $getData['car_type_id'];
        $open_id = $getData['open_id'];
        $boot = $getData['boot'];
        $building_id = $getData['building_id'];
        $hall_id = $getData['hall_id'];
        $driver_name = $getData['driver_name'];
        $driver_phone = $getData['driver_phone'];
        $booking_date = $getData['txtDate'];
        $booking_time = $getData['txtTime'];
        $queue_number = 'hhmm_0000';
        $running_number = '0000';
        $booking_data = '';
        $ref_id = '';
        $uniqid = uniqid('ID', true);

        try {
            //หา txtQueueNumber และ running_number
            $sql = "select max(queue_number) as queue_number, max(running_number) as running_number 
                    from tbl_booking
                    where building_id = :building_id
                    and hall_id = :hall_id
                    and booking_date = :booking_date
                    and booking_time = :booking_time
                    ";

            $stmt = $this->db->prepare($sql);
            // กำหนด parameter
            // $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);//พื้นที่ setup เดียวกันอาจจะมีหลายงาน  ดังนั้นจะใช้การกำหนดคิวตามพื้นที่โดยไม่เอางานเข้ามาเกี่ยวข้อง
            $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
            $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
            $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
            $stmt->bindParam(':booking_time', $booking_time, PDO::PARAM_STR);
            // $stmt->bindParam(':queue_number', $queue_number, PDO::PARAM_STR);
            // $stmt->bindParam(':booking_data', $booking_data, PDO::PARAM_STR);

            $stmt->execute();
            $rsBooking = $stmt->fetchall(PDO::FETCH_ASSOC);

            if (count($rsBooking)) {
                // $_SESSION['selected'] =  'tbl_booking: Data can selected.';
                $number = (int)substr($rsBooking[0]['queue_number'], -4);
                $number = $number + 1;
                $queue_number =  date('Hi', strtotime($booking_time)) . "_" . str_pad($number, 4, '0', STR_PAD_LEFT);
                // $queue_number = $rsBooking[0]['queue_number'];

                //แบบใหม่
                $number = (int)substr($rsBooking[0]['running_number'], -4);
                $number = $number + 1;
                $running_number =  str_pad($number, 4, '0', STR_PAD_LEFT);
            } else {
                $number = 1;
                $queue_number =  date('Hi', strtotime($booking_time)) . "_" . str_pad($number, 4, '0', STR_PAD_LEFT);
                $running_number =  str_pad($number, 4, '0', STR_PAD_LEFT);
            }

            //หาเวลาที่ใช้ในการ Loading (ตามประเภทรถ)
            $rs = new Car_type;
            $rsCarType = $rs->getRecordById($car_type_id);

            //กำหนดค่าเริ่มต้นของเวลาที่ใช้อย่างน้อย 10 นาที
            $take_time_minutes = 10;
            if (count($rsCarType)) :
                $take_time_minutes = $rsCarType[0]['take_time_minutes'];
                $take_time_minutes = (int)($take_time_minutes / 10);
                $car_type_name = $rsCarType[0]['car_type_name'];
                $parking_fee = $rsCarType[0]['parking_fee'];
            endif;

            // หา Event name
            unset($rs);
            $rs = new OpenArea;
            $event_name = $rs->getEventNameByOpenId($open_id);

            // หา Building name
            unset($rs);
            $rs = new Building;
            $rsBuilding = $rs->getRecordById($building_id);

            if (count($rsBuilding)) :
                $building_name = $rsBuilding[0]['building_name'];
            else :
                $building_name = $building_id;
            endif;

            // หา hall name
            unset($rs);
            $rs = new Hall;
            $rsHall = $rs->getRecordById($building_id, $hall_id);

            if (count($rsHall)) :
                $hall_name = $rsHall[0]['hall_name'];
            else :
                $hall_name = $hall_id;
            endif;

            //สร้าง Array
            $data = array();
            $data['id'] = $uniqid;
            $data['username'] = $username;
            $data['car_license_number'] = $car_license_number;
            $data['event_name'] = $event_name;
            $data['building_id'] = $building_id;
            $data['building_name'] = $building_name;
            $data['hall_id'] = $hall_id;
            $data['hall_name'] = $hall_name;
            $data['queue_number'] = $queue_number;
            $data['running_number'] = $running_number;
            $data['car_type_id'] = $car_type_id;
            $data['car_type_name'] = $car_type_name;
            $data['booking_date'] = $booking_date;
            $data['booking_time'] = $booking_time;
            $data['take_time_minutes'] = strval($take_time_minutes * 10);
            $data['parking_fee'] = strval($parking_fee);
            $data['ref_id'] = $ref_id;

            $ref_id = $open_id . $building_id . $hall_id . $booking_date . $booking_time . $running_number;

            //แปลง array เป็น JSON(ก็คือเป็น String ในรูปแบบ json)
            $ref_json = json_encode($data, JSON_UNESCAPED_UNICODE);

            //insert ข้อมูลลง tbl_booking
            $sql = 'insert into tbl_booking(id, username, car_license_number, car_type_id, open_id, boot
                    , building_id, hall_id, driver_name, driver_phone, booking_date, booking_time
                    , queue_number, running_number, booking_data, ref_id, ref_json)
                    values(:id, :txtUsername, :car_license_number, :car_type_id, :open_id, :boot
                    , :building_id, :hall_id, :driver_name, :driver_phone, :booking_date, :booking_time
                    , :queue_number, :running_number, :booking_data, :ref_id, :ref_json)';

            $stmt = $this->db->prepare($sql);

            // กำหนด parameter
            $stmt->bindParam(':id', $uniqid, PDO::PARAM_STR);
            $stmt->bindParam(':txtUsername', $username, PDO::PARAM_STR);
            $stmt->bindParam(':car_license_number', $car_license_number, PDO::PARAM_STR);
            $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
            $stmt->bindParam(':open_id', $open_id, PDO::PARAM_STR);
            $stmt->bindParam(':boot', $boot, PDO::PARAM_STR);
            $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
            $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
            $stmt->bindParam(':driver_name', $driver_name, PDO::PARAM_STR);
            $stmt->bindParam(':driver_phone', $driver_phone, PDO::PARAM_STR);
            $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
            $stmt->bindParam(':booking_time', $booking_time, PDO::PARAM_STR);
            $stmt->bindParam(':queue_number', $queue_number, PDO::PARAM_STR);
            $stmt->bindParam(':running_number', $running_number, PDO::PARAM_STR);
            $stmt->bindParam(':booking_data', $booking_data, PDO::PARAM_STR);
            $stmt->bindParam(':ref_id', $ref_id, PDO::PARAM_STR);
            $stmt->bindParam(':ref_json', $ref_json, PDO::PARAM_STR);

            if ($stmt->execute()) :
                //ถ้า insert ข้อมูลลง tbl_booking สำเร็จ
                // จะทำการ update ข้อมูล ใน tbl_open_area_schedule_sub_detail
                // filed: number_slots_already_booked + 1 
                // condition: ตามวันที่และเวลาจอง  โดยที่เวลาจองจะเป็นข่วงเวลาตามประเภทรถที่กำหนดเวลาไว้้
                $rsOpenArea = new OpenArea;
                $rsOpenArea->updateNumberSlotsAlreadyBooked($_REQUEST, $take_time_minutes);
                // $rsOpenArea = new OpenArea;
                // if ($rsOpenArea->updateNumberSlotsAlreadyBooked($_REQUEST, $take_time_minutes)) {
                //     // ทำการ update ข้อมูล tbl_open_area_period สำเร็จ
                //     //ทำการส่งค่ากลับไปในรูปแบบ JSON ซึ่งจะอยู่ในรูป {"ตัวแปร1":ค่าที่1,"ตัวแปร2":ค่าที่2,"ตัวแปร3":ค่าที่3}
                //     // echo json_encode($data, JSON_UNESCAPED_UNICODE);
                //     echo $ref_json;
                // }

                // header("location:javascript://history.go(-1)");
                echo $ref_json;
            // return "ABC";
            else :
                // echo "Error";
                echo "{'Error':'error','Error2':'Error2','Error3':'Error2'}";
            endif;
        } catch (PDOException $e) {
            // $_SESSION['tbl_booking'] =  'tbl_booking: Data can not inserted.';
            $_SESSION['tbl_booking'] =  'error >>> ' . $e->getCode() . " === " . $e->getMessage();
            // echo '<script>';
            // echo 'alert("มีบางอย่างผิดพลาด ไม่สามารถบันทึกข้อมูลได้ในขณะนี้!"); ';
            // echo 'window.history.back();';
            // echo '</script>';
            echo "{'Error':'error','Error2':'Error2','Error3':'Error2'}";
        }
    }

    public function updateStatus($getId, $getStatus)
    {
        $sql = "update tbl_booking
                set status = :status
                where id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $getId, PDO::PARAM_STR);
        $stmt->bindParam(':status', $getStatus, PDO::PARAM_INT);
        $stmt->execute();
        // $affected = $stmt->execute();
    }
}
