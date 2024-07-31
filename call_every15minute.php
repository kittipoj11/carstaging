<?php
@session_start();
require_once 'config.php';
require_once  'class/customer.class.php';
require_once  'class/booking.class.php';
// include APP_PATH . '/connect.php';

$customer = new Customer;
$booking = new Booking;

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
$rs = $booking->call_every15minute();
// $_SESSION['rs'] = $rs;
foreach ($rs as $row) :

  // $arrayPostData = createMessageTemplate($arrayJson, $row);
  // if (pushMsg($arrayHeader, $arrayPostData)) :
  // endif;
  $booking->update_time($row['id'], date("H:i:s"), 2);

endforeach;

function createMessageTemplate($arrayJson, $row)
{
  $line_user_id = $row['username']; //iPhone6s
  $driver_name =    $row['driver_name'];
  $car_license_number =    $row['car_license_number'];
  $datetime_in = date_create()->getTimestamp();

  $arrayPostData['to'] = $line_user_id;
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "คุณ {$driver_name} / ทะเบียนรถ {$car_license_number} อีก 15 นาทีเตรียมตัวเข้าช่องโหลด";
  $arrayPostData['messages'][1]['type'] = "sticker";
  $arrayPostData['messages'][1]['packageId'] = "6325";
  $arrayPostData['messages'][1]['stickerId'] = "10979917";
  return $arrayPostData;
}

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
  return $result;
}
exit;