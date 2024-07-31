<?php
// (A) LOAD QR CODE LIBRARY
@session_start();
require_once '../config.php';
// require 'connect.php';

// require '../vendor/autoload.php';
// require 'vendor/autoload.php';//สำหรับบน server
// require 'vendor/autoload.php';
require_once '../vendor_qr/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelQuartile;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Label\Label;


// foreach ($_POST as $key => $value) {
//   $_SESSION[$key] = $value;
// }
// exit;


// (B) CREATE QR CODE
$qr = QrCode::create("http://www.impact.co.th");
// $qr = QrCode::create("00001CHhall12023-04-1709:4000001");
/*
$data = array();
$data['id'] = $uniqid;
// $data['username'] = $username;
$data['ทะเบียนรถ'] = $car_license_number;
$data['ชื่องาน'] = $event_name;
// $data['building_id'] = $building_id;
$data['ชื่ออาคาร'] = $building_name;
// $data['hall_id'] = $hall_id;
$data['พื้นที่'] = $hall_name;
$data['เลขคิว'] = $queue_number;
// $data['running_number'] = $running_number;
// $data['car_type_id'] = $car_type_id;
$data['ประเภทรถ'] = $car_type_name;
$data['วันที่จอง'] = $booking_date;
$data['เวลาจอง'] = $booking_time;
$data['เวลาที่ใช้'] = $take_time_minutes;
$data['ค่าปรับ'] = strval($parking_fee);
*/

// $Data = $_GET['ref_id'];
// $qr = QrCode::create($Data);

// //ทดสอบการส่งแบบ POST(ยังไม่สำเร็จ)
// $jsonStr = $_POST['json']; //json คือ ค่าที่ส่งมาในรูปแบบ JSON
// $json = json_decode($jsonStr); //นำมาทำการ decode 
// foreach ($json as $key => $value) {
//   $_SESSION[$key] = $value;
// }

// (B1) CORRECTION LEVEL
// ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
$qr->setErrorCorrectionLevel(new ErrorCorrectionLevelMedium())
    // ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())

    // (B2) SIZE & MARGIN
    ->setSize(400)
    ->setMargin(0)


    // (B3) COLORS
    ->setForegroundColor(new Color(0, 0, 255))
    ->setBackgroundColor(new Color(255, 255, 255));
// ->setWriterByName('svg');
// (B4) ATTACH LOGO
// $logo = Logo::create(__DIR__ . "/code-boxx.png")//png, jpg
$logo = Logo::create(__DIR__ . "/_images/truck4.png")
    ->setResizeToWidth(75);

// (B5) ATTACH LABEL
// $label = Label::create("Please scan")->setTextColor(new Color(0, 0, 0));

// (C) OUTPUT QR CODE
$writer = new PngWriter();
// $result = $writer->write($qr, $logo, $label);
$result = $writer->write($qr, $logo);
header("Content-Type: " . $result->getMimeType());



$result->saveToFile(__DIR__ . "/qr.png");

// $_SESSION['res'] = $result->getString();
echo $result->getString();



// echo $result->writeString();
// $dataUri = $result->writeDataUri();
// echo $dataUri;