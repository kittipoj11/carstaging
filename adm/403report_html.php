<?php
@session_start();

require_once '../class/mypdo.class.php';
require_once '../class/myfunction.php';

// print_r($_POST);
// exit;
$DB = new MyConnection;
$date_from = $_POST['date_start'];
// $date_to = $_POST['date_end'];
// $time_from = $_POST['time_start'];
// $time_to = $_POST['time_end'];


// if ($open_id == 0) :
//     $condition = " and (open_id = :open_id OR True)";
// else :
//     $condition = " and open_id = :open_id";
// endif;

// ********************************************
// ข้อมูล Grouping จากตาราง tbl_booking
// ********************************************
$sqlHeader = <<<EOD
                SELECT b.open_id, b.booking_date, bd.building_name, h.hall_name, hd.event_name
                FROM tbl_booking b
                INNER JOIN tbl_open_area_schedule_header hd
                ON b.open_id = hd.open_id     
                left join tbl_hall h
                ON b.hall_id = h.hall_id
                LEFT JOIN tbl_building bd
                ON b.building_id = bd.building_id
                GROUP BY b.open_id, b.booking_date, bd.building_name, h.hall_name, hd.event_name 
                HAVING booking_date = :date_from
                ORDER BY b.open_id, b.booking_date
            EOD;

$stmtHeader = $DB->myPdo->prepare($sqlHeader);
$stmtHeader->bindParam(':date_from', $date_from, PDO::PARAM_STR);
// $stmtHeader->bindParam(':date_to', $date_to, PDO::PARAM_STR);
// $stmtHeader->bindParam(':time_from', $time_from, PDO::PARAM_STR);
// $stmtHeader->bindParam(':time_to', $time_to, PDO::PARAM_STR);
$stmtHeader->execute();

// ********************************************
// ข้อมูล List จากตาราง tbl_booking
// ********************************************
$sqlDetail = <<<EOD
                SELECT b.booking_time
                , COUNT(*) as count_booking
                , SUM(if(b.status > 0, 1, 0))as come_total
                , SUM(if(b.time_in_area <= booking_time, 1, 0))as ontime_total
                , SUM(if(b.time_in_area > booking_time, 1, 0))as latetime_total
                , SUM(if(b.status= 0,1,0))as cancel_total
                FROM tbl_booking b
                INNER JOIN tbl_open_area_schedule_header hd
                ON b.open_id = hd.open_id     
                left join tbl_hall h
                ON b.hall_id = h.hall_id
                LEFT JOIN tbl_building bd
                ON b.building_id = bd.building_id
                GROUP BY b.open_id, b.booking_date, b.booking_time, bd.building_name, h.hall_name, hd.event_name 
                HAVING booking_date = :booking_date
                AND b.open_id = :open_id
                ORDER BY b.open_id, b.booking_date, b.booking_time
            EOD;
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
        // $stmtDetail->bindParam(':booking_time', $row['booking_time'], PDO::PARAM_STR);
        // $stmtDetail->bindParam(':time_from', $time_from, PDO::PARAM_STR);
        // $stmtDetail->bindParam(':time_to', $time_to, PDO::PARAM_STR);
        $stmtDetail->execute();
        $rsDetail = $stmtDetail->fetchAll();

        $html .= "<p>วันที่จอง: {$row['booking_date']}</p>
                <p>อีเวนต์ : {$row['event_name']}</p>
                <p>อาคาร : {$row['building_name']}</p>
                <p>พื้นที่ : {$row['hall_name']}</p>";

        $html .= '<table cellspacing=0 cellpadding=5 class="container-fluid mb-5">
                    <tr>
                    <th>เวลาที่จอง</th>
                    <th>จำนวนจอง</th>
                    <th>จำนวนที่มา</th>
                    <th>จำนวนที่มาตามเวลา</th>
                    <th>จำนวนที่มาไม่ตรงเวลา</th>
                    <th>จำนวนที่ไม่มา</th>
                    </tr>';

        foreach ($rsDetail as $row2) :
            $html .=  "<tr>";
            $html .=  "<td>{$row2['booking_time']}</td>";
            $html .=  "<td>{$row2['count_booking']}</td>";
            $html .=  "<td>{$row2['come_total']}</td>";
            $html .=  "<td>{$row2['ontime_total']}</td>";
            $html .=  "<td>{$row2['latetime_total']}</td>";
            $html .=  "<td>{$row2['cancel_total']}</td>";
            $html .=  "</tr>";
        endforeach;
        // $_SESSION['booking'] = $booking;
        $html .= "</table>";

    endforeach;
// $html .= "</div>";

// exit;

else :
    $html = <<<EOD
            <p>รายงานจำนวนรถตามวันในแต่ละช่วงเวลา</p>
            <p>ไม่พบข้อมูล</p>
            EOD;
endif;

echo $html;
