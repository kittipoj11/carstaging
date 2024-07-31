  <?php
    session_start();
    require_once 'config.php';
    require_once  'class/customer.class.php';
    // include APP_PATH . '/connect.php';

    $customer = new Customer;

    // Access Token
    $access_token = 'ChizDIGCgyi5xhw+JStzP7VSRPwhtKFaD0F3u4msvPtwrqi6mfU1mtc7YTmHh4TPnBD0U7kNTVohBCo/t4qci0zW7FU8VeaUvXe9Wks+sdMF+57qtetgawK7d5HkT6QaAwMjZbm3fcBPa4Tl7eRoggdB04t89/1O/w1cDnyilFU=';
    // รับค่าที่ส่งมา
    $content = file_get_contents('php://input');
    // แปลงเป็น JSON
    $events = json_decode($content, true);
    if (!empty($events['events'])) {
        file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
        foreach ($events['events'] as $event) {
            // การขอ add friend หรือ unblock
            // $_SESSION['userId'] = $event['source']['userId'];
            if ($event['type'] == 'follow') :
                $customer->updateLineUserId($event['source']['userId']);
                // ร่วมกับ USER ID ของไลน์ที่เราต้องการใช้ในการตอบกลับ
                //แบบ Text Message
                $messages = array(
                    'type' => 'text',
                    'text' => 'User ID ### ' . $event['message']['text'] . "\n" . $event['source']['userId'],
                );
                $post = json_encode(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array($messages),
                ));



                // URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
                $url = 'https://api.line.me/v2/bot/message/reply';
                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $result = curl_exec($ch);
                curl_close($ch);
                echo $result;
            elseif ($event['type'] == 'message' && $event['message']['type'] == 'text') :
                // ข้อความที่ส่งกลับ มาจาก ข้อความที่ส่งมา
                // ร่วมกับ USER ID ของไลน์ที่เราต้องการใช้ในการตอบกลับ
                $customer->updateLineUserId($event['source']['userId']);
                $messages = array(
                    'type' => 'text',
                    'text' => 'Reply message : ' . $event['message']['text'] . "\nUser ID : " . $event['source']['userId'],
                );
                $post = json_encode(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array($messages),
                ));
                // URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
                $url = 'https://api.line.me/v2/bot/message/reply';
                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $result = curl_exec($ch);
                curl_close($ch);
                echo $result;
            endif;
        }
    }
