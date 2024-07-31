<?php
@session_start();

require_once '../class/mypdo.class.php';
require_once '../class/open_area.class.php';
require_once '../class/myfunction.php';

// print_r($_POST);
// exit;
$DB = new MyConnection;
$open_id = $_POST['open_id'];
$open_area = new OpenArea;
$rsOpenId = $open_area->getRSOpenId($open_id);

if ($open_id == 0) :
    $condition = " and (open_id = :open_id OR True)";
else :
    $condition = " and open_id = :open_id";
endif;

// ********************************************
// ข้อมูลจากตาราง tbl_open_area_schedule_header
// ********************************************
$sqlHeader = <<<EOD
                select head.id, head.open_id, head.hall_id, head.building_id, head.event_name, head.total_slots, head.reservable_slots
                , head.open_date_start, head.open_date_end
                , head.open_time_start, head.open_time_end
                , hall.hall_name, b.building_name
                from tbl_open_area_schedule_header head
                left join tbl_hall hall
                on head.hall_id = hall.hall_id
                left join tbl_building b
                on hall.building_id = b.building_id
                where head.is_deleted = false
                {$condition}
                order by head.open_id, head.open_date_start, head.open_date_end, head.open_time_start, head.open_time_end
            EOD;

// ********************************************
// ข้อมูลจากตาราง tbl_open_area_schedule_detail
// ********************************************
$sqlDetail = <<<EOD
                SELECT open_date_start, open_date_end, open_time_start, open_time_end, reservable_slots, car_type_json
                FROM tbl_open_area_schedule_detail
                WHERE is_deleted = false
                {$condition}
                AND building_id = :building_id
                AND hall_id = :hall_id
                ORDER BY open_date_start, open_date_end, open_time_start, open_time_end
            EOD;
// ********************************************
// ข้อมูลจากตาราง tbl_open_area_schedule_sub_detail
// ********************************************
$sqlSubdetail = <<<EOD
                SELECT open_date, open_date_start, open_date_end
                , open_time_start, open_time_end,reservable_slots, open_time_json, car_type_json
                FROM tbl_open_area_schedule_sub_details 
                WHERE is_deleted = false
                {$condition}
                AND building_id = :building_id
                AND hall_id = :hall_id
                -- AND open_date_start = :open_date_start
                -- AND open_date_end = :open_date_end
                -- AND open_time_start = :open_time_start
                -- AND open_time_end = :open_time_end
                ORDER BY open_date, open_time_start, open_time_end
            EOD;

if ($open_id == 0) :
    $condition = " and (b.open_id = :open_id OR True)";
else :
    $condition = " and b.open_id = :open_id";
endif;
// ********************************************
// ข้อมูลจากตาราง tbl_booking
// ********************************************
$sqlBooking = <<<EOD
                SELECT h.event_name, b.building_id, b.hall_id, b.booking_date, b.booking_time
                , COUNT(*) as booking_total, SUM(if(b.status > 0, 1, 0))as come_total, 
                SUM(if(b.status= 0,1,0))as cancel_total
                FROM tbl_booking b
                INNER JOIN tbl_open_area_schedule_header h
                ON b.open_id = h.open_id
                WHERE b.is_deleted = false
                {$condition}
                AND b.building_id = :building_id
                AND b.hall_id = :hall_id
                AND b.booking_date = :booking_date
                GROUP BY h.event_name, b.building_id, b.hall_id, b.booking_date, b.booking_time
            EOD;

// ********************************************// ********************************************
$stmtHeader = $DB->myPdo->prepare($sqlHeader);
$stmtHeader->bindParam(':open_id', $open_id, PDO::PARAM_INT);
$stmtHeader->execute();

// $html = "<p>Number of daily bookings by events</p>";
if ($stmtHeader->rowCount() > 0) :
    $rsHeader = $stmtHeader->fetchAll();

    $stmtDetail = $DB->myPdo->prepare($sqlDetail);
    $stmtSubdetail = $DB->myPdo->prepare($sqlSubdetail);
    $stmtBooking = $DB->myPdo->prepare($sqlBooking);

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
    foreach ($rsHeader as $row1) :
        $stmtSubdetail->bindParam(':open_id', $open_id, PDO::PARAM_INT);
        $stmtSubdetail->bindParam(':building_id', $row1['building_id'], PDO::PARAM_STR);
        $stmtSubdetail->bindParam(':hall_id', $row1['hall_id'], PDO::PARAM_STR);
        // $stmtSubdetail->bindParam(':open_time_start', $row2['open_time_start'], PDO::PARAM_STR);
        // $stmtSubdetail->bindParam(':open_time_end', $row2['open_time_end'], PDO::PARAM_STR);
        $stmtSubdetail->execute();
        $rsSubDetail = $stmtSubdetail->fetchAll();


        foreach ($rsSubDetail as $row3) :
            // สร้าง array ของ เวลาทุก 30 นาที
            // $time_range = getTimeFromRange($row3['open_time_start'], 'PT30M', $row3['open_time_end']);
            $time_range = getBookingData($row3['open_time_start'], 'PT30M', $row3['open_time_end']);

            // Step 4: Looping Through the Date Range
            $stmtBooking->bindParam(':open_id', $open_id, PDO::PARAM_INT);
            $stmtBooking->bindParam(':building_id', $row1['building_id'], PDO::PARAM_STR);
            $stmtBooking->bindParam(':hall_id', $row1['hall_id'], PDO::PARAM_STR);
            $stmtBooking->bindParam(':booking_date', $row3['open_date'], PDO::PARAM_STR);
            // $stmtBooking->bindParam(':open_time_end', $row2['open_time_end'], PDO::PARAM_STR);
            $stmtBooking->execute();
            $rsBooking = $stmtBooking->fetchAll();

            // สร้าง array ของการ booking
            $booking_array = array();
            if ($stmtBooking->rowCount() > 0) :
                foreach ($rsBooking as $row4) :
                    $date = new DateTime($row4['booking_time']);
                    $booking_array[$date->format('H:i')] = ["open_slot" => 0, "booking_total" => $row4['booking_total'], "come_total" => $row4['come_total'], "cancel_total" => $row4['cancel_total']];
                endforeach;
            endif;

            $time_range = merge_2_levels_deep_array($time_range, $booking_array);

            $html .= "<p>อีเวนต์ : {$row1['event_name']}</p>
                    <p>พื้นที่ : {$row1['hall_name']}(อาคาร {$row1['building_name']})</p>
                    <p>วันที่จอง: {$row3['open_date']}</p>
                    <p>ช่วงเวลา : {$row3['open_time_start']} - {$row3['open_time_end']}</p>";

            $html .= '<table cellspacing=0 cellpadding=5 class="container-fluid mb-5 text-primary">
                    <tr>
                    <th>เวลา</th>
                    <th>จำนวนเปิดให้จอง</th>
                    <th>จำนวนที่จอง</th>
                    <th>จำนวนที่เข้ามา</th>
                    <th>จำนวนที่ไม่ได้เข้ามา</th>
                    </tr>';

            foreach ($time_range as $key => $value) :
                $html .=  "<tr>";
                $html .=  "<td>{$key}</td>";
                $html .=  "<td>{$row3['reservable_slots']}</td>";
                // $html .=  "<td>{$value['open_slot']}</td>";
                $html .=  "<td>{$value['booking_total']}</td>";
                $html .=  "<td>{$value['come_total']}</td>";
                $html .=  "<td>{$value['cancel_total']}</td>";
                $html .=  "</tr>";
            endforeach;
            // $_SESSION['booking'] = $booking;
            $html .= "</table>";

        endforeach;
    endforeach;
// $html .= "</div>";

// exit;

else :
    $html = <<<EOD
            <p>รายงานจำนวนการจองรายวันแยกตามอีเวนต์</p>
            <p>ไม่พบข้อมูล</p>
            EOD;
endif;

echo $html;