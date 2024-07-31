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
// $qr = QrCode::create("http://www.impact.co.th");

// $_SESSION['POST'] = $_POST;
$ref_array = json_decode($_POST['ref_json'], true);
$Data = 'เลขคิว : ' . $ref_array['เลขคิว'];
$Data .= "\r\n" . 'ทะเบียนรถ : ' . $ref_array['ทะเบียนรถ'];
$Data .= "\r\n" . 'วันที่จอง : ' . $ref_array['วันที่จอง'];
$Data .= "\r\n" . 'เวลาจอง : ' . $ref_array['เวลาจอง'];
$Data .= "\r\n" . 'ชื่องาน : ' . $ref_array['ชื่องาน'];
$Data .= "\r\n" . 'อาคาร : ' . $ref_array['ชื่ออาคาร'];
$Data .= "\r\n" . 'พื้นที่ : ' . $ref_array['พื้นที่'];
$Data .= "\r\n" . 'ประเภทรถ : ' . $ref_array['ประเภทรถ'];
$Data .= "\r\n" . 'เวลาที่ใช้ : ' . $ref_array['เวลาที่ใช้'] . ' นาที';
$Data .= "\r\n" . 'เกินเวลาเสียค่าปรับ(ต่อชั่วโมง) : ' . $ref_array['ค่าปรับ'] . ' บาท';

// $qr = QrCode::create($Data);//แสดงข้อมูลเป็นระเบียบแต่นำไปสแกนแล้วไม่เปลี่ยน Status
$qr = QrCode::create($_POST['ref_json']);

// (B1) CORRECTION LEVEL
// $qr->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
// $qr->setErrorCorrectionLevel(new ErrorCorrectionLevelMedium())
$qr->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())

    // (B2) SIZE & MARGIN
    ->setSize(300)
    ->setMargin(0)

    // (B3) COLORS
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));
// ->setWriterByName('svg');
// (B4) ATTACH LOGO
// $logo = Logo::create(__DIR__ . "/code-boxx.png")//png, jpg
if ($ref_array['รหัสอาคาร'] == 'CH') :
    $logo = Logo::create(__DIR__ . "/_images/impact_chalenger1.jpg")
        ->setResizeToWidth(75);
elseif ($ref_array['รหัสอาคาร'] == 'IF') :
    $logo = Logo::create(__DIR__ . "/_images/impact_forum1.jpg")
        ->setResizeToWidth(75);
elseif ($ref_array['รหัสอาคาร'] == 'IEC') :
    $logo = Logo::create(__DIR__ . "/_images/impact_exhibition1.jpg")
        ->setResizeToWidth(75);
endif;

// (B5) ATTACH LABEL
// $label = Label::create("Please scan")->setTextColor(new Color(0, 0, 0));

// (C) OUTPUT QR CODE
$writer = new PngWriter();
// $result = $writer->write($qr, $logo, $label);
$result = $writer->write($qr, $logo);
header("Content-Type: " . $result->getMimeType());

$qr_code_file_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'qr_assets' . DIRECTORY_SEPARATOR;
$set_qr_code_path = 'qr_assets/';

// If directory is not created, the create a new directory 
if (!file_exists($qr_code_file_path)) {
    mkdir($qr_code_file_path);
}

//Set a file name of each generated QR code
$filename    =    time() . '.png';

// $result->saveToFile(__DIR__ . "/" . $filename);
$result->saveToFile($set_qr_code_path . $filename);

// echo $result->getString();
$detail = getDetail($ref_array);

$data = array();
$data['img_file'] = $set_qr_code_path . $filename;
$data['detail'] = $detail;

$json = json_encode($data);
echo $json;

function getDetail($array)
{
    $id = $array['id'];
    $building_name = $array['ชื่ออาคาร'];
    $hall_name = $array['พื้นที่'];
    $event_name = $array['ชื่องาน'];
    $car_license_number = $array['ทะเบียนรถ'];
    $car_type_name = $array['ประเภทรถ'];
    $queue_number = $array['เลขคิว'];
    $booking_date = $array['วันที่จอง'];
    $booking_time = $array['เวลาจอง'];
    $take_time_minutes = $array['เวลาที่ใช้'];
    $parking_fee = $array['ค่าปรับ'];
    $bg = "warning";

    $html = "
<div class='card col-12 text-bg-{$bg}'>
<div class='card-header text-bg-{$bg}'>
    <h2 class='text-center font-weight-bold'> {$hall_name}</h2>
    <h6 class='text-center font-weight-bold'>
        <sup>{$building_name}</sub>
    </h6>
    <h6 class='text-center font-weight-bold overflow-hidden'><sup>Event:
            {$event_name}</sub></h6>
</div>
<div class='card-body font-weight-bold fs-6 p-3'>
    <ul class='list-group'>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>เลขคิว: {$queue_number}</span>
        </li>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>ทะเบียนรถ:
                {$car_license_number}</span>
        </li>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>ประเภทรถ: {$car_type_name}</span>
        </li>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>วันที่จอง: {$booking_date}</span>
        </li>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>เวลาจอง: {$booking_time}</span>
        </li>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>เวลาที่ใช้:
                {$take_time_minutes} นาที</span>
        </li>
        <li class='list-group-item list-group-item-{$bg} d-flex justify-content-between p-1'>
            <span class='d-sm-inline'>ค่าปรับ: {$parking_fee} บาท/ชั่วโมง</span>
        </li>
    </ul>

    <!-- <p class='card-text'>With supporting text below as a natural lead-in to additional content.</p> -->
</div>
</div>
";
    return $html;
}

// echo $result->writeString();
// $dataUri = $result->writeDataUri();
// echo $dataUri;