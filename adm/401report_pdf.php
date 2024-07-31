<?php
@session_start();
// เรียกไฟล์ TCPDF Library เข้ามาใช้งาน กำหนดที่อยู่ตามที่แตกไฟล์ไว้
require_once '../config.php';
require_once '../class/myfunction.php';
require_once '../class//mypdo.class.php';
require_once('../class/ipdf.class.php');
// include APP_PATH . '/connect.php';

$DB = new MyConnection;
$pdf = new IPDF();

// กำหนดคุณสมบัติของไฟล์ PDF เช่น ผู้สร้างไฟล์ หัวข้อไฟล์ คำค้น 
$pdf->SetTitle('Car Staging Report');
$pdf->SetSubject('Booking');
$pdf->SetKeywords('Nathapat, booking');

$pdf->SetHeaderData('impact_logo.png', PDF_HEADER_LOGO_WIDTH, 'Car Staging', 'Booking', array(0, 64, 255), array(0, 64, 128));

// ได้จาก Get หรือ Post

$open_id = $_GET['open_id'];
if ($open_id == 0) :
    $condition = " and (open_id = :open_id OR True)";
else :
    $condition = " and open_id = :open_id";
endif;

// ********************************************
// ข้อมูลจากตาราง tbl_open_area_schedule_header
// ********************************************
$sqlHeader = "select head.id, head.open_id, head.hall_id, head.building_id, head.event_name, head.total_slots, head.reservable_slots
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
    order by head.open_id, head.open_date_start, head.open_date_end, head.open_time_start, head.open_time_end";

// ********************************************
// ข้อมูลจากตาราง tbl_open_area_schedule_detail
// ********************************************
$sqlDetail = "SELECT open_date_start, open_date_end, open_time_start, open_time_end, reservable_slots, car_type_json
            FROM tbl_open_area_schedule_detail
            WHERE event_name = :event_name
            {$condition}
            AND building_id = :building_id
            AND hall_id = :hall_id
            ORDER BY open_date_start, open_date_end, open_time_start, open_time_end";

// ********************************************
// ข้อมูลจากตาราง tbl_open_area_schedule_sub_detail
// ********************************************
$sqlSubdetail = "SELECT open_date, open_date_start, open_date_end
            , open_time_start, open_time_end,reservable_slots, open_time_json, car_type_json
            FROM tbl_open_area_schedule_sub_details 
            WHERE building_id = :building_id
            AND hall_id = :hall_id
            {$condition}
            -- AND open_date_start = :open_date_start
            -- AND open_date_end = :open_date_end
            -- AND open_time_start = :open_time_start
            -- AND open_time_end = :open_time_end
            ORDER BY open_date, open_time_start, open_time_end";

// ********************************************
// ข้อมูลจากตาราง tbl_booking
// ********************************************
if ($open_id == 0) :
    $condition = " and (b.open_id = :open_id OR True)";
else :
    $condition = " and b.open_id = :open_id";
endif;
$sqlBooking = "SELECT h.event_name, b.building_id, b.hall_id, b.booking_date, b.booking_time
            , COUNT(*) as booking_total, SUM(if(b.status > 0, 1, 0))as come_total, 
            SUM(if(b.status= 0,1,0))as cancel_total
            FROM tbl_booking b
            INNER JOIN tbl_open_area_schedule_header h
            ON b.open_id = h.open_id
            WHERE b.building_id = :building_id
            AND b.hall_id = :hall_id
            AND b.booking_date = :booking_date
            {$condition}
            GROUP BY h.event_name, b.building_id, b.hall_id, b.booking_date, b.booking_time";

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

    foreach ($rsHeader as $row1) :
        $stmtSubdetail->bindParam(':open_id', $row1['open_id'], PDO::PARAM_INT);
        $stmtSubdetail->bindParam(':building_id', $row1['building_id'], PDO::PARAM_STR);
        $stmtSubdetail->bindParam(':hall_id', $row1['hall_id'], PDO::PARAM_STR);
        // $stmtSubdetail->bindParam(':open_time_start', $row2['open_time_start'], PDO::PARAM_STR);
        // $stmtSubdetail->bindParam(':open_time_end', $row2['open_time_end'], PDO::PARAM_STR);
        $stmtSubdetail->execute();
        $rsSubDetail = $stmtSubdetail->fetchAll();


        foreach ($rsSubDetail as $row3) :
            // สร้าง array ของ เวลาทุก 30 นาที
            // $date_range = getTimeFromRange($row3['open_time_start'], 'PT30M', $row3['open_time_end']);
            $date_range = getBookingData($row3['open_time_start'], 'PT30M', $row3['open_time_end']);

            // Step 4: Looping Through the Date Range
            $stmtBooking->bindParam(':open_id', $row1['open_id'], PDO::PARAM_INT);
            $stmtBooking->bindParam(':building_id', $row1['building_id'], PDO::PARAM_STR);
            $stmtBooking->bindParam(':hall_id', $row1['hall_id'], PDO::PARAM_STR);
            $stmtBooking->bindParam(':booking_date', $row3['open_date'], PDO::PARAM_STR);
            // $stmtBooking->bindParam(':open_time_end', $row2['open_time_end'], PDO::PARAM_STR);
            $stmtBooking->execute();
            $rsBooking = $stmtBooking->fetchAll();

            $booking_array = array();
            if ($stmtBooking->rowCount() > 0) :
                foreach ($rsBooking as $row) :
                    $date = new DateTime($row['booking_time']);
                    $booking_array[$date->format('H:i')] = ["open_slot" => 0, "booking_total" => $row['booking_total'], "come_total" => $row['come_total'], "cancel_total" => $row['cancel_total']];
                endforeach;
            endif;

            $date_range = merge_2_levels_deep_array($date_range, $booking_array);

            $html = "<style>
                    table, th, td {
                    text-align: center;
                    border: 1px solid black;
                    border-radius: 10px;
                    padding: 5px;
                    background-color: #ffffff;
                    }
                    </style>";

            $html .= "<p>รายงานจำนวนการจองรายวันแยกตามอีเวนต์</p>";
            $html .= "<p>อีเวนต์ : {$row1['event_name']}</p>";
            $html .= "<p>พื้นที่ : {$row1['hall_name']}(อาคาร {$row1['building_name']})</p>";

            // $html .= "<p>ช่วงวันที่เปิดจอง : {$row2['open_date_start']} - {$row2['open_date_end']}</p>";
            // $html .= "<p>ช่วงเวลา : {$row2['open_time_start']} - {$row2['open_time_end']}</p>";

            $html .= "<p>วันที่จอง: {$row3['open_date']}</p>";
            $html .= "<p>ช่วงเวลา : {$row3['open_time_start']} - {$row3['open_time_end']}</p>";
            $html .= '<table cellspacing="0" cellpadding="5">';

            $html .= '<tr>';
            $html .= '<th>เวลา</th>';
            $html .= '<th>จำนวนเปิดให้จอง</th>';
            $html .= '<th>จำนวนที่จอง</th>';
            $html .= '<th>จำนวนที่เข้ามา</th>';
            $html .= '<th>จำนวนที่ไม่ได้เข้ามา</th>';
            $html .= '</tr>';

            foreach ($date_range as $key => $value) :
                $html .=  "<tr>";
                $html .=  "<td>{$key}</td>";
                $html .=  "<td>{$row3["reservable_slots"]}</td>";
                // $html .=  "<td>{$value["open_slot"]}</td>";
                $html .=  "<td>{$value["booking_total"]}</td>";
                $html .=  "<td>{$value["come_total"]}</td>";
                $html .=  "<td>{$value["cancel_total"]}</td>";
                $html .=  "</tr>";
            // ได้มาจาก tbl_booking
            // $open_time_object =  json_decode($row3['open_time_json']);
            // foreach ($open_time_object as $time) :
            endforeach;
            // $_SESSION['booking'] = $booking;

            $html .= "</table>";
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, false, false, '');
        endforeach;
    endforeach;
// exit;

else :
    $html = "";
    $html .= "<p>รายงานจำนวนการจองรายวันแยกตามอีเวนต์</p>";
    $html .= "<p>ไม่พบข้อมูล</p>";
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, false, false, '');
endif;

// $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// กำหนดการชื่อเอกสาร และรูปแบบการแสดงผล
$pdf->Output('Booking.pdf', 'I');