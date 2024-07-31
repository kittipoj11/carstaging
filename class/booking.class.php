<?php
require_once 'myPdo.class.php';
require_once 'car_type.class.php';
require_once 'building.class.php';
require_once 'hall.class.php';
require_once 'open_area.class.php';

// namespace ropa;
// use ropa\Db;

class Booking extends MyConnection
{
    public function getAllRecord($username, $getTimelineType = 9)
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

        if ($getTimelineType == -1) :
            $sql .= " and booking_date < curdate()";
        elseif ($getTimelineType == 0) :
            $sql .= " and booking_date = curdate()";
        elseif ($getTimelineType == 1) :
            $sql .= " and booking_date > curdate()";
        endif;

        $sql .= " order by booking_date, booking_time";

        $stmt = $this->myPdo->prepare($sql);
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

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    // แสดงรายการ Hall ที่มีการเปิดให้จองพื้นที่ในวันปัจจุบัน
    // ถ้ามีรายการ Hall แต่ไม่มีรายการคิว  แสดงว่า
    // 1. ยังไม่มีรถเข้ามาในพื้นที่ status ยังเป็น 0
    // 2. รถมีการ Loading เสร็จหมดแล้ว status จะเป็น 5
    public function getRSHallToday()
    {
        $sql = "SELECT booking.hall_id, hall.hall_name, booking.building_id, building.building_name
        FROM tbl_booking booking
        inner join tbl_building building
            on booking.building_id = building.building_id
        inner join tbl_hall hall
            on booking.hall_id = hall.hall_id
        where booking_date = curdate()
        -- where booking_date = '2023-08-21'
        -- and status <> 5
        group by hall_id, building_id
        order by hall_id, building_id";

        $stmt = $this->myPdo->prepare($sql);
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

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRSBookingToday($getHallId = '%', $getStatus = 0)
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

        $stmt = $this->myPdo->prepare($sql);
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

        $stmt = $this->myPdo->prepare($sql);
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

        $stmt = $this->myPdo->prepare($sql);
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

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function getRSGroupHistory()
    {
        $sql = "SELECT booking.building_id, building_name, booking.hall_id, hall_name, booking_date
        FROM tbl_booking booking
        inner join tbl_hall hall
            on booking.building_id = hall.building_id and booking.hall_id = hall.hall_id 
        inner join tbl_building building
            on hall.building_id = building.building_id 
        where (booking.booking_date <= curdate()) 
        -- where 1=1
        and booking.is_deleted = false
        group by building_id, hall_id, booking_date
        order by booking.booking_date, booking.hall_id, booking.building_id";

        $stmt = $this->myPdo->prepare($sql);
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
        and b.car_type_id = :car_type_id
        order by and b.car_type_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function getRSCountCarByBookingDateAndHallByCar($booking_date, $building_id, $hall_id, $car_type_id)
    {
        $sql = "SELECT b.building_id, b.hall_id, hall_name, b.car_type_id, c.car_type_name, b.booking_date, count(*) as count_car 
        FROM tbl_booking b 
        inner join tbl_building bd 
            on b.building_id = bd.building_id 
        inner join tbl_hall h
            on b.building_id = h.building_id and b.hall_id = h.hall_id 
        inner join tbl_car_type c
            on b.car_type_id = c.car_type_id 

        -- where (b.booking_date >= curdate()) and b.is_deleted = false
        where b.is_deleted = false
        group by building_id, hall_name, car_type_name, booking_date
        having b.booking_date = :booking_date
        and b.building_id = :building_id
        and b.hall_id = :hall_id
        and b.car_type_id = :car_type_id
        order by b.car_type_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function getRSCountCarByBookingDateAndHall($booking_date, $building_id, $hall_id)
    {
        $sql = "SELECT b.building_id, b.hall_id, hall_name, b.car_type_id, c.car_type_name, b.booking_date, count(*) as count_car 
        FROM tbl_booking b 
        inner join tbl_building bd 
            on b.building_id = bd.building_id 
        inner join tbl_hall h
            on b.building_id = h.building_id and b.hall_id = h.hall_id 
        inner join tbl_car_type c
            on b.car_type_id = c.car_type_id 

        -- where (b.booking_date < curdate()) and b.is_deleted = false
        where b.is_deleted = false
        group by building_id, hall_name, car_type_name, booking_date
        having b.booking_date = :booking_date
        and b.building_id = :building_id
        and b.hall_id = :hall_id
        order by b.car_type_id";

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function getRsByBookingId($getBookingId)
    {
        $id = $getBookingId;
        $sql = "SELECT book.id, book.username, book.car_license_number, book.car_type_id, book.open_id, book.boot, book.building_id, book.hall_id
                , book.driver_name, book.driver_phone, book.booking_date, book.booking_time, book.queue_number, book.running_number
                , book.booking_data, book.qr_code_image, book.ref_id, book.ref_json, book.status
                , book.take_time_minutes, book.parking_rate, book.time_in, book.time_out, book.parking_time, book.parking_fee
                , car.car_type_name
                -- , car.take_time_minutes, car.parking_fee
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
                where book.id = :id";
        //ID64e33ca3c07272.14958659
        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function getRsTodayBooking()
    {
        $sql = "SELECT b.building_id,b.hall_id,b.booking_date, oh.total_slots
                , bd.building_name, h.hall_name
                , sum(b.waiting) as sum_waiting
                , sum(b.calling) as sum_calling
                , sum(b.loading) as sum_loading
                , sum(b.complete) as sum_complete
                , count(*) as total_booking
                FROM (
                SELECT open_id, building_id,hall_id,booking_date
                , CASE
                    WHEN status = 1 THEN 1
                    ELSE 0
                END as waiting
                , CASE
                    WHEN status = 2 or status = 3 THEN 1
                    ELSE 0
                END as calling
                , CASE
                    WHEN status = 4 THEN 1
                    ELSE 0
                END as loading
                , CASE
                    WHEN status = 5 THEN 1
                    ELSE 0
                END as complete
                FROM tbl_booking
                WHERE booking_date = CURDATE()  
                ) b 
                INNER JOIN tbl_open_area_schedule_header oh
                    ON b.open_id = oh.open_id
                INNER JOIN tbl_building bd
                    ON b.building_id = bd.building_id
                INNER JOIN tbl_hall h
                    ON b.hall_id = h.hall_id
                group by building_id,hall_id,building_name,hall_name,booking_date,total_slots
                order by hall_name";
        $stmt = $this->myPdo->prepare($sql);
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

            $stmt = $this->myPdo->prepare($sql);
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
                $running_number =  str_pad($number, 4, '0', STR_PAD_LEFT);
            } else {
                $number = 1;
                $queue_number =  date('Hi', strtotime($booking_time)) . "_" . str_pad($number, 4, '0', STR_PAD_LEFT);
                $running_number =  str_pad($number, 4, '0', STR_PAD_LEFT);
            }

            //หาเวลาที่ใช้ในการ Loading (ตามประเภทรถ)
            $rs = new Car_type;
            $rsCarType = $rs->getRecordById($car_type_id);

            //กำหนดจำนวน Slot
            $number_of_slot = 0;
            //กำหนดค่าเริ่มต้นของการจองต้องมีอย่างน้อย 10 นาที
            $take_time_minutes = 10;
            if (count($rsCarType)) :
                $take_time_minutes = $rsCarType[0]['take_time_minutes'];
                $car_type_name = $rsCarType[0]['car_type_name'];
                $parking_fee = $rsCarType[0]['parking_fee'];
            endif;

            //หาจำนวน Slot ที่จะบันทึกลงในช่วงเวลา
            $number_of_slot = (int)($take_time_minutes / 10); //หาจำนวนช่องทุก 10 นาที
            // $number_of_slot = $take_time_minutes; //หาจำนวนช่องทุก 10 นาที

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
            // $data['username'] = $username;
            $data['ทะเบียนรถ'] = $car_license_number;
            $data['ชื่องาน'] = $event_name;
            $data['รหัสอาคาร'] = $building_id;
            $data['ชื่ออาคาร'] = $building_name;
            // $data['hall_id'] = $hall_id;
            $data['พื้นที่'] = $hall_name;
            $data['เลขคิว'] = $queue_number;
            // $data['running_number'] = $running_number;
            // $data['car_type_id'] = $car_type_id;
            $data['ประเภทรถ'] = $car_type_name;
            $data['วันที่จอง'] = $booking_date;
            $data['เวลาจอง'] = $booking_time;
            $data['เวลาที่ใช้'] = $take_time_minutes;
            $data['ค่าปรับ'] = strval($parking_fee);
            // $data['ref_id'] = $ref_id;

            $ref_id = $open_id . $building_id . $hall_id . $booking_date . $booking_time . $running_number;

            //แปลง array เป็น JSON(ก็คือเป็น String ในรูปแบบ json)
            $ref_json = json_encode($data, JSON_UNESCAPED_UNICODE);

            // update ข้อมูล ใน tbl_open_area_schedule_sub_details
            // condition: ตามวันที่และเวลาจอง  โดยที่เวลาจองจะเป็นข่วงเวลาตามประเภทรถที่กำหนดเวลาไว้้
            // คืนค่ากลับมาเป็น booking_time_json
            $rsOpenArea = new OpenArea;
            $booking_time_json = $rsOpenArea->updateSlotsBooked($_REQUEST, $number_of_slot);

            //insert ข้อมูลลง tbl_booking
            $sql = 'insert into tbl_booking(id, username, car_license_number, car_type_id, open_id, boot
                    , building_id, hall_id, driver_name, driver_phone, booking_date, booking_time
                    , take_time_minutes
                    , parking_rate
                    , queue_number, running_number
                    , booking_data
                    , ref_id, ref_json
                    , booking_time_json)
                    values(:id, :txtUsername, :car_license_number, :car_type_id, :open_id, :boot
                    , :building_id, :hall_id, :driver_name, :driver_phone, :booking_date, :booking_time
                    , :take_time_minutes
                    , :parking_rate
                    , :queue_number, :running_number
                    , :booking_data
                    , :ref_id, :ref_json
                    , :booking_time_json)';

            $stmt = $this->myPdo->prepare($sql);

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
            $stmt->bindParam(':take_time_minutes', $take_time_minutes, PDO::PARAM_INT);
            $stmt->bindParam(':parking_rate', $parking_fee, PDO::PARAM_INT);
            $stmt->bindParam(':booking_time_json', $booking_time_json, PDO::PARAM_STR);

            // $_SESSION['ref_json'] = $ref_json;
            if ($stmt->execute()) :
                $_SESSION['tbl_booking'] = 'Insert to [tbl_booking] completed';
                // ถ้า insert ข้อมูลลง tbl_booking สำเร็จ
                echo $ref_json;
            // echo $uniqid;
            else :
                // echo "Error";
                $_SESSION['tbl_booking'] = 'Can not insert';
                echo "{'Error':'error','Error2':'Error2','Error3':'Error2'}";
            endif;
        } catch (PDOException $e) {
            // $_SESSION['tbl_booking'] =  'tbl_booking: Data can not inserted.';
            $_SESSION['tbl_booking'] =  'error >>> ' . $e->getCode() . " : " . $e->getMessage();
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

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':id', $getId, PDO::PARAM_STR);
        $stmt->bindParam(':status', $getStatus, PDO::PARAM_INT);
        $stmt->execute();
        // $affected = $stmt->execute();
    }

    public function updateStatusAfterScan($getData)
    {
        $ref_json = json_encode($getData['data1'][0], JSON_UNESCAPED_UNICODE);
        $ref_data = $_POST['data1'][0];
        $status = $getData['data1'][1];
        $id = $ref_data['id'];

        if ($status == 1) :
            $sql = "update tbl_booking
                set status = :status
                , time_in_area = NOW()
                -- WHERE ref_json = :ref_json
                WHERE id = :id";

            $stmt = $this->myPdo->prepare($sql);
            // กำหนด parameter
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            // $stmt->bindParam(':ref_json', $ref_json, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        elseif ($status == 4) :
            $sql = "update tbl_booking
                set status = :status
                , time_in = NOW()
                -- WHERE ref_json = :ref_json
                WHERE id = :id";

            $stmt = $this->myPdo->prepare($sql);
            // กำหนด parameter
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            // $stmt->bindParam(':ref_json', $ref_json, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        elseif ($status == 5) :
            $sql = "update tbl_booking
                set status = :status
                , time_out = NOW()
                , time_out_area = NOW()
                , parking_time = TIMEDIFF(time_out,time_in)
                , parking_overtime = if(DATE_ADD(parking_time, INTERVAL (-1*take_time_minutes) MINUTE) > 0 , DATE_ADD(parking_time, INTERVAL (-1*take_time_minutes) MINUTE),0)
                , parking_overtime_hours = CEILING(time_to_sec(parking_overtime)/3600)
                , parking_fee = parking_overtime_hours * parking_rate
                -- WHERE ref_json = :ref_json
                WHERE id = :id";

            $stmt = $this->myPdo->prepare($sql);
            // กำหนด parameter
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            // $stmt->bindParam(':ref_json', $ref_json, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        else :
            $sql = "update tbl_booking
                set status = :status
                -- WHERE ref_json = :ref_json
                WHERE id = :id";

            $stmt = $this->myPdo->prepare($sql);
            // กำหนด parameter
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            // $stmt->bindParam(':ref_json', $ref_json, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        endif;

        $is_success = true;
        try {
            $this->myPdo->beginTransaction();
            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['Error >>> '] = $e->getMessage();
            // echo "e >>" . $e->getMessage();
            $is_success = false;
        } finally {
            if ($is_success == true) {
                // echo "before commit >>> <br>";
                $this->myPdo->commit();
                $return = true;
            } else {
                // echo "before rollback >>> <br>";
                $this->myPdo->rollBack();
                $return = false;
            }
        }

        return $return;
    }

    public function getBookingTime($getData)
    {
        $open_id = $getData['open_id'];
        $building_id = $getData['building_id'];
        $hall_id = $getData['hall_id'];
        $car_type_id = $getData['car_type_id'];
        $car_license_number = $getData['car_license_number'];
        $book_date = $getData['txtDate'];

        $sql = 'select *
                from tbl_booking
                where open_id = :open_id
                and building_id = :building_id
                and hall_id = :hall_id
                and car_type_id = :car_type_id
                and car_license_number = :car_license_number
                and booking_date = :book_date';

        $stmt = $this->myPdo->prepare($sql);
        $stmt->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_STR);
        $stmt->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $stmt->bindParam(':car_type_id', $car_type_id, PDO::PARAM_INT);
        $stmt->bindParam(':car_license_number', $car_license_number, PDO::PARAM_STR);
        $stmt->bindParam(':book_date', $book_date, PDO::PARAM_STR);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function call_every30minute()
    {
        $sql = <<<SQL
                SELECT id, username, car_license_number,driver_name,booking_time
                -- ,CURRENT_TIME(), TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                FROM tbl_booking
                WHERE booking_date = CURDATE()
                -- AND TIME_FORMAT(CURRENT_TIME(), "%H:%i") = booking_time
                -- AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                AND TIME_FORMAT(ADDTIME(booking_time, "-0:30"), "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(ADDTIME(booking_time, "-0:15"), "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(booking_time, "%H:%i") = "09:00"
                AND time_1st_alert IS NULL AND time_2nd_alert IS NULL AND time_3rd_alert IS NULL
        SQL;

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }

    public function call_every15minute()
    {
        $sql = <<<SQL
                SELECT id, username, car_license_number,driver_name,booking_time
                -- ,CURRENT_TIME(), TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                FROM tbl_booking
                WHERE booking_date = CURDATE()
                -- AND TIME_FORMAT(CURRENT_TIME(), "%H:%i") = booking_time
                -- AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                AND TIME_FORMAT(ADDTIME(booking_time, "-0:15"), "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(ADDTIME(booking_time, "-0:15"), "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(booking_time, "%H:%i") = "09:00"
                AND time_2nd_alert IS NULL AND time_3rd_alert IS NULL
        SQL;

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function call_everyontime()
    {
        $sql = <<<SQL
                SELECT id, username, car_license_number,driver_name,booking_time
                -- ,CURRENT_TIME(), TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                FROM tbl_booking
                WHERE booking_date = CURDATE()
                -- AND TIME_FORMAT(CURRENT_TIME(), "%H:%i") = booking_time
                -- AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(ADDTIME(booking_time, "-0:15"), "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(booking_time, "%H:%i") <= TIME_FORMAT(CURRENT_TIME(), "%H:%i")
                -- AND TIME_FORMAT(booking_time, "%H:%i") = "09:00"
                AND time_3rd_alert IS NULL
        SQL;

        $stmt = $this->myPdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return $rs;
    }
    public function update_time($id = '', $timealert = '', $noti_times = 1)
    {
        if ($noti_times == 1) :
            $sql = <<<SQL
                        update tbl_booking
                        set time_1st_alert = :timealert
                        WHERE id = :id
            SQL;
        elseif ($noti_times == 2) :
            $sql = <<<SQL
                        update tbl_booking
                        set time_2nd_alert = :timealert
                        WHERE id = :id
            SQL;
        elseif ($noti_times == 3) :
            $sql = <<<SQL
                        update tbl_booking
                        set time_3rd_alert = :timealert
                        WHERE id = :id
            SQL;
        elseif ($noti_times == 4) :
            $sql = <<<SQL
                        update tbl_booking
                        set time_accept = :timealert
                        WHERE id = :id
            SQL;
        elseif ($noti_times == -1) :
            $sql = <<<SQL
                        update tbl_booking
                        set time_3rd_alert = null
                        , time_accept = null
                        WHERE id = :id
                        AND (:timealert = :timealert) 
            SQL;
        endif;

        try {
            $stmt = $this->myPdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':timealert', $timealert, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $_SESSION['message'] =  'data has been update successfully.';
            }
        } catch (PDOException $e) {
            // if ($e->getCode() == 23000) {
            //     $_SESSION['message'] =  'This item could not be added.Because the data has duplicate values!!!';
            // } else {
            // }
            $_SESSION['message'] =  'Something is wrong.Can not update data.';
        }

        //         $rs = $stmt->fetchAll();
        //         return $rs;
    }
}