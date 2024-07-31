<?php
@session_start();
require_once 'config.php';
require_once  'class/customer.class.php';
require_once  'class/booking.class.php';
// include APP_PATH . '/connect.php';

$customer = new Customer;
$booking = new Booking;

//รับค่า id มาจากหน้าที่ Call
$id = $_POST['id'];
// $id = 'ID65c8eabccfa4a6.25281903';

$rs = $booking->getRsByBookingId($id);

$username =    $rs[0]['username'];
$driver_name =    $rs[0]['driver_name'];
$car_license_number =    $rs[0]['car_license_number'];

// หาค่า line_user_id เพื่อนำมาส่งข้อความออกไปหา line_user_id นี้
unset($rs);
$rs = $customer->getRecordByUsername($username);
$line_user_id = $rs[0]['line_user_id'];
$line_user_id = 'Uead3fc1bacb477985924b342c33f19d1'; //P30Pro
$line_user_id = 'U004f3c6e382c5d0d0f56d59bfec97bc5'; //iPhone6s

// เริ่มต้นกำหนดค่าให้ Messaging API เพื่อส่งข้อความออกไป
//copy Channel access token ตอนที่ตั้งค่ามาใส่
$accessToken = 'ChizDIGCgyi5xhw+JStzP7VSRPwhtKFaD0F3u4msvPtwrqi6mfU1mtc7YTmHh4TPnBD0U7kNTVohBCo/t4qci0zW7FU8VeaUvXe9Wks+sdMF+57qtetgawK7d5HkT6QaAwMjZbm3fcBPa4Tl7eRoggdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

// ส่วนของ Header
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";

// ส่วนของ Message
$arrayPostData['to'] = $line_user_id;
$arrayPostData['messages'][0]['type'] = "text";
$arrayPostData['messages'][0]['text'] = "คุณ{$driver_name} / ทะเบียนรถ {$car_license_number} นำรถเข้ามาที่พื้นที่ Loading ได้เลยจ้าาาาาาาา";
$arrayPostData['messages'][1]['type'] = "sticker";
$arrayPostData['messages'][1]['packageId'] = "11539";
$arrayPostData['messages'][1]['stickerId'] = "52114146";
pushMsg($arrayHeader, $arrayPostData);

function pushMsg($arrayHeader, $arrayPostData)
{
  $strUrl = "https://api.line.me/v2/bot/message/push";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $strUrl);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
}
exit;