<?php
@session_start();

require_once '../class/mypdo.class.php';
require_once '../class/myfunction.php';

// print_r($_POST);
// exit;
$DB = new MyConnection;
$date_from = $_POST['date_start'];
// $date_to = $_POST['date_end'];
$time_from = $_POST['time_start'];
$time_to = $_POST['time_end'];

// ********************************************
// ข้อมูล Grouping จากตาราง tbl_booking
// ********************************************

$sqlHeader = <<<EOD
                SELECT b.open_id, b.booking_date, b.booking_time, bd.building_name, h.hall_name
                , hd.event_name
                FROM tbl_booking b
                INNER JOIN tbl_open_area_schedule_header hd
                    ON b.open_id = hd.open_id     
                left join tbl_hall h
                    ON b.hall_id = h.hall_id
                LEFT JOIN tbl_building bd
                    ON b.building_id = bd.building_id
                    -- WHERE (b.booking_date BETWEEN :date_from AND :date_to)
                    WHERE (b.booking_date = :date_from)
                    AND (b.booking_time BETWEEN :time_from AND :time_to)
                    GROUP BY b.open_id, b.booking_date, b.booking_time, bd.building_name, h.hall_name, hd.event_name       
            EOD;

$stmtHeader = $DB->myPdo->prepare($sqlHeader);
$stmtHeader->bindParam(':date_from', $date_from, PDO::PARAM_STR);
// $stmtHeader->bindParam(':date_to', $date_to, PDO::PARAM_STR);
$stmtHeader->bindParam(':time_from', $time_from, PDO::PARAM_STR);
$stmtHeader->bindParam(':time_to', $time_to, PDO::PARAM_STR);
$stmtHeader->execute();

// ********************************************
// ข้อมูล List จากตาราง tbl_booking
// ********************************************
$sqlDetail = <<<EOD
                SELECT car_license_number, car_type_name, booking_time, IFNULL(time_in_area,'') as time_in_area
                , IFNULL(time_in,'') as time_in, IFNULL(time_out,'') as time_out
                , IFNULL(parking_time,'') as parking_time, IFNULL(parking_overtime,'') as parking_overtime
                FROM tbl_booking b
                LEFT JOIN tbl_car_type c	
                    ON b.car_type_id = c.car_type_id
                WHERE b.open_id = :open_id
                AND booking_date = :booking_date
                -- AND (booking_time BETWEEN :time_from AND :time_to)
                AND booking_time = :booking_time
            EOD;

$stmtDetail = $DB->myPdo->prepare($sqlDetail);
// ********************************************// ********************************************

// $html = "<p>Number of daily bookings by events</p>";
if ($stmtHeader->rowCount() > 0) :
    $rsHeader = $stmtHeader->fetchAll();

    $stmtDetail = $DB->myPdo->prepare($sqlDetail);

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
    foreach ($rsHeader as $row) :
        $stmtDetail->bindParam(':open_id', $row['open_id'], PDO::PARAM_INT);
        $stmtDetail->bindParam(':booking_date', $row['booking_date'], PDO::PARAM_STR);
        $stmtDetail->bindParam(':booking_time', $row['booking_time'], PDO::PARAM_STR);
        // $stmtDetail->bindParam(':time_from', $time_from, PDO::PARAM_STR);
        // $stmtDetail->bindParam(':time_to', $time_to, PDO::PARAM_STR);
        $stmtDetail->execute();
        $rsDetail = $stmtDetail->fetchAll();

        $html .= "<p>วันที่จอง: {$row['booking_date']}</p>
                <p>เวลาจอง : {$row['booking_time']}</p>
                <p>อีเวนต์ : {$row['event_name']}</p>
                <p>อาคาร : {$row['building_name']}</p>
                <p>พื้นที่ : {$row['hall_name']}</p>";

        $html .= '<table cellspacing=0 cellpadding=5 class="container-fluid mb-5">
                    <tr>
                    <th>ทะเบียนรถ</th>
                    <th>ประเภทรถ</th>
                    <th>เวลาที่จอง</th>
                    <th>เวลาที่เข้าพื้นที่</th>
                    <th>เวลาที่เข้าโหลด</th>
                    <th>เวลาที่โหลดเสร็จ</th>
                    <th>ใช้เวลาโหลด</th>
                    <th>เกินเวลา</th>
                    </tr>';

        foreach ($rsDetail as $row2) :
            $html .=  "<tr>";
            $html .=  "<td>{$row2['car_license_number']}</td>";
            $html .=  "<td>{$row2['car_type_name']}</td>";
            $html .=  "<td>{$row2['booking_time']}</td>";
            $html .=  "<td>{$row2['time_in_area']}</td>";
            $html .=  "<td>{$row2['time_in']}</td>";
            $html .=  "<td>{$row2['time_out']}</td>";
            $html .=  "<td>{$row2['parking_time']}</td>";
            $html .=  "<td>{$row2['parking_overtime']}</td>";
            $html .=  "</tr>";
        endforeach;
        // $_SESSION['booking'] = $booking;
        $html .= "</table>";

    endforeach;
// $html .= "</div>";

// exit;

else :
    $html = <<<EOD
            <p>รายงานการจองรายวันตามวันที่จอง</p>
            <p>ไม่พบข้อมูล</p>
            EOD;
endif;

echo $html;