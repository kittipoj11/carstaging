<?php
@session_start();
// require $_SERVER['DOCUMENT_ROOT'] . '/myProject/_carstaging_test/auth.php';
require_once '../config.php';
require_once  'auth.php';
require_once '../class/booking.class.php';

//ข้อมูลที่ส่งมาจากหน้า booking_list: หลังจากกดปุ่มวันที่ทำการจอง
$username = $_SESSION['username'];
$booking_date = $_POST['booking_date'];
// $_SESSION['POST:'] = $_POST;
$booking = new Booking;
$rs = $booking->getRSBookingListByDate($username, $booking_date);
// $_SESSION['rs'] = $rs;
try {
    $is_success = true;

    $myHtml = '';
    $myData = '';
    // $open_date = new DateTime($rsDataHeader[0]['open_date']);

    // echo  '<script>alert(' . print_r($rsDataHeader) . ');</script>';

    // $monthName = $open_date->format('M.');
    foreach ($rs as $datarow) :
        $id = $datarow['id'];
        $car_license_number = $datarow['car_license_number'];
        $car_type_name = $datarow['car_type_name'];
        $open_id = $datarow['open_id'];
        $event_name = $datarow['event_name'];
        $boot = $datarow['boot'];
        $building_id = $datarow['building_id'];
        $building_name = $datarow['building_name'];
        $hall_id = $datarow['hall_id'];
        $hall_name = $datarow['hall_name'];
        $queue_number = $datarow['queue_number'];
        $car_type_id = $datarow['car_type_id'];
        $booking_date = $datarow['booking_date'];
        $booking_time = $datarow['booking_time'];
        $take_time_minutes = $datarow['take_time_minutes'];
        $parking_fee = $datarow['parking_fee'];

        //เปลี่ยนจากการดึงข้อมูลตามรูปแบบข้างบน  เป็นการดึงข้อมูลจาก ref_json โดยตรง
        $myData = $datarow['ref_json'];

        // print($myData);
        $str_car_type_id = '';
        if ($car_type_id == 1) {
            $str_car_type_id = '<i class="fa-solid fa-truck-pickup"></i>';
        } else if ($car_type_id == 2) {
            $str_car_type_id = '<i class="fa-solid fa-truck"></i>';
        } else if ($car_type_id == 3) {
            $str_car_type_id = '<i class="fa-solid fa-truck-moving"></i>';
        } else {
            $str_car_type_id = '<i class="fa-solid fa-trailer"></i>';
        }

        $myHtml .= "<div class='booking-item' data-value='{$myData}'>";
        $myHtml .= "<div class='booking-item-icon'>{$str_car_type_id}</div>";
        $myHtml .= "<div class='booking-item-content'>";
        $myHtml .= "<h3>{$car_license_number}</h3>";
        // $myHtml .= "<h4>{$open_id}</h4>";
        $myHtml .= "<h4>{$event_name}</h4>";
        // $myHtml .= "<h4>{$building_id}</h4>";
        $myHtml .= "<h4>{$building_name}</h4>";
        $myHtml .= "<h4>{$hall_name}</h4>";
        $myHtml .= "<h4>{$booking_date}</h4>";
        $myHtml .= "<h6>เวลาที่ใช้ {$take_time_minutes} นาที</h6>";
        $myHtml .= "<h6>เกินเวลาปรับ {$parking_fee} บาท/ชั่วโมง</h6>";
        $myHtml .= "<span class='booking-item-value'>{$queue_number}</span>";
        $myHtml .= "</div>";
        $myHtml .= "</div>";
    endforeach;

    // unset($open_date);
    // $open_date = new DateTime($datarow['open_date']);
    // $day = $open_date->format('j');
    // $dayAbbr = $open_date->format('D');
    // $open_date_string = $open_date->format('Y-m-d');

    echo $myHtml;
} catch (PDOException $e) {
    $_SESSION['booking_list_detail'] =  'error >>> ' . $e->getCode() . " === " . $e->getMessage();
    $is_success = false;
    echo 'false';
}

// }