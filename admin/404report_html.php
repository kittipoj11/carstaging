<?php
@session_start();

require_once '../class/mypdo.class.php';
require_once '../class/open_area.class.php';
require_once '../class/car_type.class.php';
require_once '../class/myfunction.php';

// print_r($_POST);
// exit;
$DB = new MyConnection;
$open_id = $_POST['open_id'];
$open_area = new OpenArea;
$rsOpenId = $open_area->getRSOpenId($open_id);

$car_type = new Car_type;
$rsCarType = $car_type->getAllRecord();

$date_from = $_POST['date_start'];
$date_to = $_POST['date_end'];
// $time_from = $_POST['time_start'];
// $time_to = $_POST['time_end'];


if ($open_id == 0) :
    $condition = " and (hd.open_id = :open_id OR True)";
else :
    $condition = " and hd.open_id = :open_id";
endif;


// ********************************************
// ข้อมูล Grouping จากตาราง tbl_booking
// ********************************************

$sqlOpenArea = <<<EOD
                SELECT sd.open_id, sd.building_id, sd.hall_id, sd.event_name, sd.open_date
                , hd.open_time_start, hd.open_time_end, h.hall_name, bd.building_name
                FROM tbl_open_area_schedule_sub_details sd
                INNER JOIN tbl_open_area_schedule_detail dt
                    ON sd.open_id = dt.open_id AND dt.open_date_start = sd.open_date_start AND dt.open_date_end = sd.open_date_end
                    AND dt.open_time_start = sd.open_time_start AND dt.open_time_end = sd.open_time_end
                INNER JOIN tbl_open_area_schedule_header hd
                    ON dt.open_id = hd.open_id   
                LEFT JOIN tbl_hall h
                    ON hd.hall_id = h.hall_id
                LEFT JOIN tbl_building bd
                    ON hd.building_id = bd.building_id   
                WHERE hd.is_deleted = false
                    {$condition}
                    AND (sd.open_date BETWEEN :date_from AND :date_to)
                GROUP BY sd.open_id, sd.building_id, sd.hall_id, sd.event_name, sd.open_date
                , hd.open_time_start, hd.open_time_end, h.hall_name, bd.building_name;
EOD;

$stmtOpenArea = $DB->myPdo->prepare($sqlOpenArea);
$stmtOpenArea->bindParam(':open_id', $open_id, PDO::PARAM_INT);
$stmtOpenArea->bindParam(':date_from', $date_from, PDO::PARAM_STR);
$stmtOpenArea->bindParam(':date_to', $date_to, PDO::PARAM_STR);
$stmtOpenArea->execute();

// ********************************************
// ข้อมูล List จากตาราง tbl_booking
// ********************************************
if ($open_id == 0) :
    $condition = " and (b.open_id = :open_id OR True)";
else :
    $condition = " and b.open_id = :open_id";
endif;
$sqlBooking = <<<EOD
                SELECT open_id, booking_date, booking_time, b.car_type_id, c.car_type_name , count(*) as count_booking
                FROM tbl_booking b
                INNER JOIN tbl_car_type c 
                	ON b.car_type_id = c.car_type_id
                WHERE b.is_deleted = false
                GROUP BY open_id, c.car_type_id, c.car_type_name, booking_date, booking_time
                HAVING (booking_date = :booking_date)
                    {$condition}
                ORDER BY open_id, booking_date, booking_time, car_type_id
EOD;

$stmtBooking = $DB->myPdo->prepare($sqlBooking);
// ********************************************// ********************************************

// $html = "<p>Number of daily bookings by events</p>";
if ($stmtOpenArea->rowCount() > 0) :
    $rsOpenArea = $stmtOpenArea->fetchAll();

    // สร้าง column header ตามจำนวนประเภทรถ
    $car_type = "";
    foreach ($rsCarType as $row) :
        $car_type .= "<th>{$row['car_type_name']}</th>";
    endforeach;

    $html = "<style>
            table,
            th,
            tr,
            td {
                border-style: none;
                border-spacing: 5px;
                border-collapse: separate;
                text-align:center;
                border-radius: 5px;
                margin-top: 10px;
            }
            th {
                background: #cfcfcf;
                
            }
            td {
                background: #e5e5e5;
            }
        </style>";
    //     $html .= "<div class='border border-1 border-dark bg-primary'>
    // xxxxxxx";
    foreach ($rsOpenArea as $row) :
        $stmtBooking->bindParam(':open_id', $row['open_id'], PDO::PARAM_INT);
        $stmtBooking->bindParam(':booking_date', $row['open_date'], PDO::PARAM_STR);
        // $stmtBooking->bindParam(':booking_time', $row['booking_time'], PDO::PARAM_STR);
        $stmtBooking->execute();
        $rsBooking = $stmtBooking->fetchAll();

        // Step 1: Setting the Start and End Dates
        // $time_range = getBookingData($row['open_time_start'], 'PT30M', $row['open_time_end']);
        $time_range = array();
        $open_time_start = new DateTime($row['open_time_start']);
        $open_time_end = new DateTime($row['open_time_end']);
        $open_time_end->modify('+1 minutes');

        // Step 2: Defining the Date Interval
        $interval_range = new DateInterval('PT30M');

        // Step 3: Creating the Date Range
        // $period = new DatePeriod($open_time_start, $interval_range, $open_time_end, DatePeriod::INCLUDE_END_DATE);//ใช้ไม่ได้
        $period = new DatePeriod($open_time_start, $interval_range, $open_time_end);

        foreach ($period as $date) :
            foreach ($rsCarType as $row2) :
                $time_range[$date->format('H:i')][$row2['car_type_name']] = 0;
            endforeach;
            $time_range[$date->format('H:i')]['รวมทั้งหมด'] = 0;
        // $time_range[$date->format('H:i')][] = ["open_slot" => 0, "booking_total" => 0, "come_total" => 0, "cancel_total" => 0];
        endforeach;

        // สร้าง array ของการ booking
        $booking_array = array();
        if ($stmtBooking->rowCount() > 0) :
            $date_string = "";
            $total = 0;
            foreach ($rsBooking as $row3) :
                if ($date_string != $row3['booking_time']) :
                    $total = 0;
                    $date_string = $row3['booking_time'];
                    $date = new DateTime($date_string);
                endif;
                $booking_array[$date->format('H:i')][$row3['car_type_name']] = $row3['count_booking'];
                $total += $row3['count_booking'];
                $booking_array[$date->format('H:i')]['รวมทั้งหมด'] =  $total;

            endforeach;
        endif;

        $time_range = merge_2_levels_deep_array($time_range, $booking_array);
        $html .= "<p>อีเวนต์ : {$row['event_name']}</p>
                <p>อาคาร : {$row['building_name']}</p>
                <p>พื้นที่ : {$row['hall_name']}</p>
                <p>วันที่เปิดจอง: {$row['open_date']}</p>";

        $html .= "<table cellspacing=0 cellpadding=5 class='container-fluid mb-5'>
                    <tr>
                    <th>เวลาเปิดจอง</th>
                    {$car_type}
                    <th>รวมทั้งหมด</th>
                    </tr>";
        foreach ($time_range as $key => $value) :
            $html .=  "<tr>";
            $html .=  "<td>{$key}</td>";
            foreach ($value as $k => $v) :
                $html .=  "<td>{$v}</td>";
            endforeach;
            $html .=  "</tr>";
        endforeach;
        $html .= "</table>";

    endforeach;
// $html .= "</div>";

// exit;

else :
    $html = <<<EOD
            <p>ไม่พบข้อมูล</p>
            EOD;
endif;

echo $html;
