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

$date_from = $_REQUEST['date_start'];
// $date_from = '2024-01-24';

// กำหนดคุณสมบัติของไฟล์ PDF เช่น ผู้สร้างไฟล์ หัวข้อไฟล์ คำค้น 
$pdf->SetTitle('Car Staging Report');
$pdf->SetSubject('Booking');
$pdf->SetKeywords('Nathapat, booking');

$pdf->SetHeaderData('impact_logo.png', PDF_HEADER_LOGO_WIDTH, 'Car Staging', 'Booking', array(0, 64, 255), array(0, 64, 128));

// ได้จาก Get หรือ Post

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
$stmtDetail = $DB->myPdo->prepare($sqlDetail);

// ********************************************// ********************************************

// $html = "<p>Number of daily bookings by events</p>";
if ($stmtHeader->rowCount() > 0) :
    $rsHeader = $stmtHeader->fetchAll();

    foreach ($rsHeader as $row) :
        $stmtDetail->bindParam(':open_id', $row['open_id'], PDO::PARAM_INT);
        $stmtDetail->bindParam(':booking_date', $row['booking_date'], PDO::PARAM_STR);
        $stmtDetail->execute();
        $rsDetail = $stmtDetail->fetchAll();

        $html = "<style>
                    table, th, td {
                    text-align: center;
                    border: 1px solid black;
                    border-radius: 10px;
                    padding: 5px;
                    background-color: #ffffff;
                    }
                </style>";

        $html .= "<p>รายงานจำนวนรถตามวันในแต่ละช่วงเวลา</p>";
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
                    <th width="100">จำนวนที่มาไม่ตรงเวลา</th>
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
        // ได้มาจาก tbl_booking
        // $open_time_object =  json_decode($row3['open_time_json']);
        // foreach ($open_time_object as $time) :
        endforeach;
        // $_SESSION['booking'] = $booking;

        $html .= "</table>";
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, false, false, '');
    endforeach;
// exit;

else :
    $html = "";
    $html .= "<p>รายงานจำนวนรถตามวันในแต่ละช่วงเวลา</p>";
    $html .= "<p>ไม่พบข้อมูล</p>";
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, false, false, '');
endif;

// $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// กำหนดการชื่อเอกสาร และรูปแบบการแสดงผล
$pdf->Output('Booking2.pdf', 'I');
