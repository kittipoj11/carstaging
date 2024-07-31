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
$rs = $booking->call_everyontime();
foreach ($rs as $row) :
  $username =    $row['username'];
  $driver_name =    $row['driver_name'];
  $car_license_number =    $row['car_license_number'];

  // หาค่า line_user_id เพื่อนำมาส่งข้อความออกไปหา line_user_id นี้
  // unset($rs);
  // $rs = $customer->getRecordByUsername($username);
  // $line_user_id = $rs[0]['line_user_id'];
  // $line_user_id = 'Uead3fc1bacb477985924b342c33f19d1'; //P30Pro
  // $line_user_id = 'U004f3c6e382c5d0d0f56d59bfec97bc5'; //iPhone6s
  $line_user_id = $username; //iPhone6s
  $arrayPostData['to'] = $line_user_id;
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "คุณ {$driver_name} / ทะเบียนรถ {$car_license_number} นำรถเข้ามาในช่องโหลดได้เลยจ้า";
  $arrayPostData['messages'][1]['type'] = "sticker";
  $arrayPostData['messages'][1]['packageId'] = "6325";
  $arrayPostData['messages'][1]['stickerId'] = "10979917";
  // echo pushMsg($arrayHeader, $arrayPostData);
  if (pushMsg($arrayHeader, $arrayPostData)) :
  endif;
  $booking->update_time($row['id'], date("H:i"), 3);

endforeach;

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
