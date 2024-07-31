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
// $_SESSION['rs'] = $rs;
foreach ($rs as $row) :

  // $arrayPostData = createButtonTemplate($arrayJson, $row);
  // if (pushMsg($arrayHeader, $arrayPostData)) :
  // endif;

  // unset($arrayPostData);
  // $arrayPostData = createStickerTemplate($arrayJson, $row);
  // if (pushMsg($arrayHeader, $arrayPostData)) :
  // endif;

  $booking->update_time($row['id'], date("H:i"), 3);

endforeach;

function createButtonTemplate($arrayJson, $row)
{
  $line_user_id = $row['username']; //iPhone6s
  $driver_name = $row['driver_name'];
  $id = $row['id'];
  $car_license_number = $row['car_license_number'];
  $datetime_in = date_create()->getTimestamp();
  $json_text = <<<EOD
                  {
                    "messages": [
                      {
                        "type": "template",
                        "altText": "ถึงเวลาที่จองไว้แล้ว กรุณายืนยันการเข้าพื้นที่โหลด",
                        "template": {
                          "type": "buttons",
                          "thumbnailImageUrl": "https://picsum.photos/200/300.jpg",
                          "imageAspectRatio": "rectangle",
                          "imageSize": "cover",
                          "imageBackgroundColor": "#FFFFFF",
                          "title": "ถึงเวลาที่จองไว้แล้ว",
                          "text": "คุณ {$driver_name} / ทะเบียนรถ {$car_license_number} กรุณายืนยันการเข้าพื้นที่โหลด",
                          "defaultAction": {
                            "type": "uri",
                            "label": "View detail",
                            "uri": "http://www.impact.co.th/"
                          },
                          "actions": [
                            {
                              "type": "postback",
                              "label": "ตกลง",
                              "data": "id={$id}&action=yes&datetime_in={$datetime_in}"
                            },
                            {
                              "type": "postback",
                              "label": "เลื่อนไป 30 นาที",
                              "data": "id={$id}&action=skip&datetime_in={$datetime_in}"
                            },
                            {
                              "type": "postback",
                              "label": "ยกเลิก(ไม่มา)",
                              "data": "id={$id}&action=cancel&datetime_in={$datetime_in}"
                            }
                          ]
                        }
                      }
                    ]
                  }
                  EOD;

  $arrayPostData = json_decode($json_text, true);
  $arrayPostData['to'] = $line_user_id;

  return $arrayPostData;
}

function createStickerTemplate($arrayJson, $row)
{
  $line_user_id = $row['username']; //iPhone6s
  $driver_name =    $row['driver_name'];
  $car_license_number =    $row['car_license_number'];
  $datetime_in = date_create()->getTimestamp();

  $arrayPostData['to'] = $line_user_id;
  $arrayPostData['messages'][0]['type'] = "sticker";
  $arrayPostData['messages'][0]['packageId'] = "6325";
  $arrayPostData['messages'][0]['stickerId'] = "10979917";
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