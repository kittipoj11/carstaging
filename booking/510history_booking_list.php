<?php
session_start();
// require $_SERVER['DOCUMENT_ROOT'] . '/myProject/_carstaging_test/auth.php';
require_once '../config.php';
// require_once  'auth.php';
require_once '../class/booking.class.php';

//ข้อมูลที่ส่งมาจากหน้า booking_list: หลังจากกดปุ่มวันที่ทำการจอง
// $username = $_SESSION['username'];
$username = 'cust1';
$booking_date = $_POST['booking_date'];

$booking = new Booking;
$rs = $booking->getRSBookingListByDate($username, $booking_date);

foreach ($rs as $row) :
    echo "<tr>";
    echo "<td class='text-center'>{$row['car_license_number']}</td>";
    echo "<td class='text-center d-none d-lg-table-cell'>{$row['car_type_name']}</td>";
    echo "<td class='text-center d-none d-lg-table-cell'>{$row['event_id']}</td>";
    echo "<td class='text-center d-none d-lg-table-cell'>{$row['boot']}</td>";
    echo "<td class='text-center d-none d-lg-table-cell'>{$row['building_name']}</td>";
    echo "<td class='text-center'>{$row['hall_name']}</td>";
    // echo "<td class='text-center d-none d-lg-flex'>{$row['queue_number']}</td>";
    echo "<td class='text-center'>{$row['booking_date']}</td>";
    echo "<td class='text-center'>{$row['booking_time']}</td>";
    echo "</tr>";
endforeach;