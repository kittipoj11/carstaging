<?php
@session_start();
//copy Channel access token ตอนที่ตั้งค่ามาใส่
$accessToken = 'ChizDIGCgyi5xhw+JStzP7VSRPwhtKFaD0F3u4msvPtwrqi6mfU1mtc7YTmHh4TPnBD0U7kNTVohBCo/t4qci0zW7FU8VeaUvXe9Wks+sdMF+57qtetgawK7d5HkT6QaAwMjZbm3fcBPa4Tl7eRoggdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";
$message = $arrayJson['events'][0]['message']['text']; //รับข้อความจากผู้ใช้
$id = $arrayJson['events'][0]['source']['userId']; //รับ id ของผู้ใช้
#ตัวอย่าง Message Type "Text + Sticker"
if ($message == "Hi") {
  $arrayPostData['to'] = $id;
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "Hi จ้าาา {$id}";
  $arrayPostData['messages'][1]['type'] = "sticker";
  $arrayPostData['messages'][1]['packageId'] = "2";
  $arrayPostData['messages'][1]['stickerId'] = "34";
  pushMsg($arrayHeader, $arrayPostData);
} else {
  $id =  'Uead3fc1bacb477985924b342c33f19d1';
  $arrayPostData['to'] = $id;
  $arrayPostData['messages'][0]['type'] = "text";
  $arrayPostData['messages'][0]['text'] = "สวัสดี...{$id}";
  $arrayPostData['messages'][1]['type'] = "sticker";
  $arrayPostData['messages'][1]['packageId'] = "2";
  $arrayPostData['messages'][1]['stickerId'] = "35";
  pushMsg($arrayHeader, $arrayPostData);
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
exit;
