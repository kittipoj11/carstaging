<?php
@session_start();
date_default_timezone_set("Asia/Bangkok");
require_once  'class/booking.class.php';
//copy Channel access token ตอนที่ตั้งค่ามาใส่
$accessToken = 'ChizDIGCgyi5xhw+JStzP7VSRPwhtKFaD0F3u4msvPtwrqi6mfU1mtc7YTmHh4TPnBD0U7kNTVohBCo/t4qci0zW7FU8VeaUvXe9Wks+sdMF+57qtetgawK7d5HkT6QaAwMjZbm3fcBPa4Tl7eRoggdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";

//รับข้อความจากผู้ใช้
$eventType = $arrayJson['events'][0]['type'];
$data = $arrayJson['events'][0]['postback']['data'];
$message = $arrayJson['events'][0]['message']['text']; #ตัวอย่าง Message Type "Text"
$id = $arrayJson['events'][0]['source']['userId']; //รับ id ของผู้ใช้
$destination = $arrayJson['destination']; //รับ id ของผู้ใช้
$type = $arrayJson['events'][0]['source']['type']; //รับ id ของผู้ใช้

if ($eventType == 'message') :
  if ($message == "สวัสดี") :
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
    replyMsg($arrayHeader, $arrayPostData);

  #ตัวอย่าง Message Type "Sticker"
  elseif ($message == "ฝันดี") :
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "sticker";
    $arrayPostData['messages'][0]['packageId'] = "2";
    $arrayPostData['messages'][0]['stickerId'] = "46";
    replyMsg($arrayHeader, $arrayPostData);

  #ตัวอย่าง Message Type "Image"
  elseif ($message == "รูปน้องแมว") :
    $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "image";
    $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
    $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
    replyMsg($arrayHeader, $arrayPostData);

  #ตัวอย่าง Message Type "Location"
  elseif ($message == "พิกัดสยามพารากอน") :
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "location";
    $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
    $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
    $arrayPostData['messages'][0]['latitude'] = "13.7465354";
    $arrayPostData['messages'][0]['longitude'] = "100.532752";
    replyMsg($arrayHeader, $arrayPostData);

  #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
  elseif ($message == "ลาก่อน") :
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
    $arrayPostData['messages'][1]['type'] = "sticker";
    $arrayPostData['messages'][1]['packageId'] = "1";
    $arrayPostData['messages'][1]['stickerId'] = "131";
    replyMsg($arrayHeader, $arrayPostData);
  elseif (strtoupper($message) == "X") :
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "Hello, user";
    $arrayPostData['messages'][1]['type'] = "text";
    $arrayPostData['messages'][1]['text'] = "May I help you?";

    replyMsg($arrayHeader, $arrayPostData);
  elseif (strtoupper($message) == "R") :
    $json_text = <<<EOD
                  {
                    "messages":[
                        {
                            "type":"text",
                            "text":"Hello, user"
                        },
                        {
                            "type":"text",
                            "text":"May I help you?"
                        }
                    ]
                  }
                  EOD;
    $arrayPostData = json_decode($json_text, true);
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    replyMsg($arrayHeader, $arrayPostData);
  elseif (strtoupper($message) == "P") :
    $json_text = <<<EOD
                  {
                      "messages":[
                          {
                              "type":"text",
                              "text":"Hello, world1 {$eventType}"
                          },
                          {
                              "type":"text",
                              "text":"Hello, world2 {$id}"
                          }
                      ]
                  }
                  EOD;

    $arrayPostData = json_decode($json_text, true);
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['to'] = $id;
    pushMsg($arrayHeader, $arrayPostData);
  elseif (strtoupper($message) == "T") :
    $json_text = <<<EOD
                  {
                    "messages": [
                      {
                        "type": "template",
                        "altText": "this is a confirm template",
                        "template": {
                          "type": "confirm",
                          "actions": [
                            {
                              "type": "message",
                              "label": "ตกลง",
                              "text": "Yes"
                            },
                            {
                              "type": "message",
                              "label": "ยกเลิก",
                              "text": "No"
                            }
                          ],
                          "text": "คุณ {$id}({$eventType}) ถึงเวลาที่จองไว้แล้ว  ตอนนี้ให้เข้ามาที่ช่องโหลดได้"
                        }
                      }
                    ]
                  }
                  EOD;

    $arrayPostData = json_decode($json_text, true);
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['to'] = $id;
    // print_r($arrayPostData);
    // exit();
    templateMsg($arrayHeader, $arrayPostData);
  elseif (strtoupper($message) == "B") :
    $datetime_in = date_create()->getTimestamp();
    $json_text = <<<EOD
                  {
                    "messages": [
                      {
                        "type": "template",
                        "altText": "This is a buttons template",
                        "template": {
                          "type": "buttons",
                          "thumbnailImageUrl": "https://picsum.photos/200/300.jpg",
                          "imageAspectRatio": "rectangle",
                          "imageSize": "cover",
                          "imageBackgroundColor": "#FFFFFF",
                          "title": "ถึงเวลาที่จองไว้แล้ว",
                          "text": "เจ้าของรถนำรถเข้ามาที่ช่องโหลดได้",
                          "defaultAction": {
                            "type": "uri",
                            "label": "View detail",
                            "uri": "http://www.impact.co.th/"
                          },
                          "actions": [
                            {
                              "type": "postback",
                              "label": "ตกลง",
                              "data": "action=ตกลง&datetime_in={$datetime_in}"
                            },
                            {
                              "type": "postback",
                              "label": "ข้ามไปก่อน",
                              "data": "action=ข้ามไปก่อน&datetime_in={$datetime_in}"
                            },
                            {
                              "type": "postback",
                              "label": "ยกเลิก",
                              "data": "action=ยกเลิก&datetime_in={$datetime_in}"
                            },
                            {
                              "type": "uri",
                              "label": "www.impact.co.th",
                              "uri": "http://www.impact.co.th/"
                            }
                          ]
                        }
                      }
                    ]
                  }
                  EOD;

    $arrayPostData = json_decode($json_text, true);
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['to'] = $id;
    // print_r($arrayPostData);
    // exit();
    replyMsg($arrayHeader, $arrayPostData);
  elseif (strtoupper($message) == "YES") :
    $json_text = <<<EOD
                  {
                    "messages":[
                        {
                            "type":"text",
                            "text":"You click 'Yes' {$eventType}"
                        }
                    ]
                  }
                  EOD;

    $arrayPostData = json_decode($json_text, true);
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['to'] = $id;
    // print_r($arrayPostData);
    // exit();
    replyMsg($arrayHeader, $arrayPostData);
  else :
  endif;
elseif ($eventType == 'postback') :
  $booking = new Booking;

  $postback_data = $arrayJson['events'][0]['postback']['data'];
  parse_str($postback_data, $params); //นำค่าที่ได้ไปใส่ที่ $params
  $time_in = $params['datetime_in'];
  $time_action = date_create()->getTimestamp();
  $minute_diff = ($time_action - $time_in) / 60;
  $id = $params['id'];
  $action = $params['action'];
  if ($minute_diff <= 10) :
    $action_time = date("H:i:s");
    // $a = addslashes($content);
    switch ($action):
      case 'yes':
        $selectedText = "คุณยืนยันในการเข้าพื้นที่ตอนนี้";
        $booking->update_time($id, date("H:i:s"), 4);
        $booking->updateStatus($id, 3);
        break;
      case 'skip':
        $selectedText = "คุณได้ขอเลื่อนเวลาออกไป 30 นาที";
        $booking->update_time($id, date("H:i:s"), -1);
        $booking->updateStatus($id, 2);
        break;
      case 'cancel':
        $selectedText = "คุณขอยกเลิกหรือไม่เข้าพื้นที่โหลด";
        $booking->update_time($id, date("H:i:s"), 4);
        $booking->updateStatus($id, -2);
        break;
      default:
        $booking->update_time($id, date("H:i:s"), 4);
        $booking->updateStatus($id, -2);
    endswitch;
    $json_text = <<<EOD
                  {
                    "messages":[
                    {
                      "type":"text",
                      "text":"{$selectedText}"
                    }
                    ]
                  }
                  EOD;
  else :
    $json_text = <<<EOD
                  {
                    "messages":[
                    {
                      "type":"text",
                      "text":"หมดเวลา คุณถูกยกเลิกคิว"
                    }
                    ]
                  }
                  EOD;
    $booking->update_time($id, date("H:i:s"), 4);
    $booking->updateStatus($id, -2);
  endif;
  $arrayPostData = json_decode($json_text, true);
  $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
  // $arrayPostData['to'] = $id;
  replyMsg($arrayHeader, $arrayPostData);




endif;















function replyMsg($arrayHeader, $arrayPostData)
{
  $strUrl = "https://api.line.me/v2/bot/message/reply";
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
function templateMsg($arrayHeader, $arrayPostData)
{
  $strUrl = "https://api.line.me/v2/bot/message/reply";
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
