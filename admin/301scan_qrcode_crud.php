<?php
// @session_start();
// require_once 'config.php';
require_once '../class/booking.class.php';

$ref_data = $_POST['data1'][0];
$status = $_POST['data1'][1];
$booking_id = $ref_data['id'];

// $_SESSION['post'] = $_POST;
$_SESSION['booking_id'] = $booking_id;
// $booking_id = 'ID64e5bcf2e50b07.10389442';
$booking = new Booking;
$rs = $booking->getRsByBookingId($booking_id);


if ($rs) :
    $result = $booking->updateStatusAfterScan($_POST);

    $queue_number = $rs[0]['queue_number'];
    $driver_name = $rs[0]['driver_name'];
    $driver_phone = $rs[0]['driver_phone'];
    $car_license_number = $rs[0]['car_license_number'];
    $event_name = $rs[0]['event_name'];
    $building_name = $rs[0]['building_name'];
    $hall_name = $rs[0]['hall_name'];
    $booking_date = $rs[0]['booking_date'];
    $booking_time = $rs[0]['booking_time'];
    $take_time_minutes = $rs[0]['take_time_minutes'];
    $parking_rate = $rs[0]['parking_rate'];
    $time_in = $rs[0]['time_in'];
    $time_out = $rs[0]['time_out'];
    $parking_time = $rs[0]['parking_time'];
    $parking_fee = $rs[0]['parking_fee'];

    if ($result == true) :
        if ($status == 1) :
            echo "<div class='modal-content text-bg-success'>";
            echo "<div class='modal-header'>";
            echo "<h1 class='modal-title fs-5' id='modal'>ข้อมูลคิว</h1>";
            echo "<button type='button' class='btn btn-close' data-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<div class='card text-bg-success'>";
            echo "<div class='card-body list-group-item-success'>";
            echo "<h3 class='card-title'>หมายเลขคิว {$queue_number}</h3>";
            echo "<h4>ทะเบียนรถ {$car_license_number}</h4>";
            echo "<h4>ชื่อคนขับรถ {$driver_name}</h4>";
            echo "<h4>เบอร์ติดต่อ {$driver_phone}</h4>";
            echo "<h4>ชื่องาน {$event_name}</h4>";
            echo "<h4>อาคาร {$building_name}</h4>";
            echo "<h4>พื้นที่ Setup{$hall_name}</h4>";
            echo "<h4>วันที่จอง {$booking_date}</h4>";

            // echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>";
            echo "</div>";
        elseif ($status == 4) :
            echo "<div class='modal-content text-bg-success'>";
            echo "<div class='modal-header'>";
            echo "<h1 class='modal-title fs-5' id='modal'>ข้อมูลคิว</h1>";
            echo "<button type='button' class='btn btn-close' data-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<div class='card text-bg-success'>";
            echo "<div class='card-body list-group-item-success'>";
            echo "<h3 class='card-title'>หมายเลขคิว {$queue_number}</h3>";
            echo "<h4>ทะเบียนรถ {$car_license_number}</h4>";
            echo "<h4>ชื่อคนขับรถ {$driver_name}</h4>";
            echo "<h4>เบอร์ติดต่อ {$driver_phone}</h4>";
            echo "<h4>ชื่องาน {$event_name}</h4>";
            echo "<h4>อาคาร {$building_name}</h4>";
            echo "<h4>พื้นที่ Setup{$hall_name}</h4>";
            echo "<h4>วันที่จอง {$booking_date}</h4>";
            echo "<h4>เวลาจอง {$booking_time}</h4>";

            echo "<hr>";
            echo "<h6>เวลาที่กำหนด {$take_time_minutes} นาที</h6>";
            echo "<h6>ค่าปรับ {$parking_rate} บาท/ชั่วโมง เมื่อใช้เวลาเกิน</h6>";

            // echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>";
            echo "</div>";
        elseif ($status == 5) :
            echo "<div class='modal-content text-bg-success'>";
            echo "<div class='modal-header'>";
            echo "<h1 class='modal-title fs-5' id='modal'>ข้อมูลคิว</h1>";
            echo "<button type='button' class='btn btn-close' data-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<div class='card text-bg-success'>";
            echo "<div class='card-body list-group-item-success'>";
            echo "<h4>ทะเบียนรถ {$car_license_number}</h4>";
            echo "<h4>เวลาเข้า {$time_in}</h4>";
            echo "<h4>เวลาออก {$time_out}</h4>";
            echo "<h5>เวลาที่ใช้ {$parking_time} </h5>";
            echo "<h1>จำนวนเงิน {$parking_fee} บาท</h1>";

            echo "<hr>";
            echo "<h6>เวลาที่กำหนด {$take_time_minutes} นาที</h6>";
            echo "<h6>ค่าปรับ {$parking_rate} บาท/ชั่วโมง เมื่อใช้เวลาเกิน</h6>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>";
            echo "</div>";
        else :
        endif;
    else :
        echo "<div class='modal-content text-bg-danger'>";
        echo "<div class='modal-header'>";
        echo "<h1 class='modal-title fs-5' id='modal'>ข้อมูลคิว</h1>";
        echo "<button type='button' class='btn btn-close' data-dismiss='modal' aria-label='Close'></button>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo "<div class='card text-bg-danger'>";
        echo "<div class='card-body list-group-item-danger'>";
        echo "<h3 class='card-title text-center'>เกิดข้อผิดพลาด!</h3>";
        echo "<h4>เนื่องจาก:</h4>";
        echo "<h4>- ไม่พบเลขคิวนี้ในระบบ</h4>";
        echo "<h4>- เลขคิวนี้ไม่ถูกต้อง</h4>";
        // echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>";
        echo "</div>";

    endif;
else :
    echo "<div class='modal-content text-bg-danger'>";
    echo "<div class='modal-header'>";
    echo "<h1 class='modal-title fs-5' id='modal'>ข้อมูลคิว</h1>";
    echo "<button type='button' class='btn btn-close' data-dismiss='modal' aria-label='Close'></button>";
    echo "</div>";
    echo "<div class='modal-body'>";
    echo "<div class='card text-bg-danger'>";
    echo "<div class='card-body list-group-item-danger'>";
    echo "<h3 class='card-title text-center'>เกิดข้อผิดพลาด!</h3>";
    echo "<h4>เนื่องจาก:</h4>";
    echo "<h4>- ไม่พบเลขคิวนี้ในระบบ</h4>";
    echo "<h4>- เลขคิวนี้ไม่ถูกต้อง</h4>";
    // echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>";
    echo "</div>";



endif;

// header('Location: index.php?page=car_type_table');
// header('Location: car_type_table.php');