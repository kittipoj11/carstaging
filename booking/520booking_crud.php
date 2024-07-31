<?php
@session_start();

require_once '../config.php';
require_once '../class/booking.class.php';
// print_r($_REQUEST);
// $_SESSION['_REQUEST'] = $_REQUEST;
$booking = new Booking();
$booking->insertData($_REQUEST);
// if ($obj->insertData($_REQUEST)) :
//     echo $obj->getAllRecord($username, BookingType::ALL);
// else :
//     echo "Error";
// endif;