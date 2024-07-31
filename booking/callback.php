<?php
@session_start();

require_once '../config.php';
require_once  '../class/LineLogin.class.php';
require_once  '../class/customer.class.php';

// $line_event = $_SESSION['line_event'];

$line = new LineLogin();
$_SESSION['get'] = $_GET;
$get = $_GET;
$code = $get['code'];
$state = $get['state'];
$token = $line->token($code, $state);

// $_SESSION['token>>'] = $token;
// $_SESSION['line>>'] = $line;
// $_SESSION['line_event>>'] = $line_event;

if (property_exists($token, 'error')) :
    // header('location: index.php');
    header('location: signinup.php');
endif;

if ($token->id_token) :
    $profile = $line->profileFormIdToken($token);
    $_SESSION['profile'] = $profile;
    $profile2 = $line->profile($profile->access_token);
    $_SESSION['profile2'] = $profile2;

    $customer = new customer();
    // ถ้ามีการ Login เข้ามาด้วย user ปกติในตอนแรก
    if ($_SESSION['username']) :
        // ทำการผูกบัญชี Line กับ User ปกติ
        $customer->updateDataFromLine($profile2);
        header("location:520booking.php");

    //มีการเข้าระบบหรือสมัครมาด้วยบัญชี Line 
    else :
        // ตรวจสอบดูว่ามี userId ของ Line นี้ในระบบแล้วหรือไม่
        $rs = $customer->getRecordByUsername($profile2->userId);

        // ถ้ามีข้อมูลใน tbl_customer แล้ว  จะเป็นการ Login เข้ามาด้วย user_id ของ Line
        if ($rs) :
            $customer->keepCustomerSession($rs);
            $_SESSION['login_status'] = true;
            header("location:520booking.php");

        // ถ้ายังไม่มีข้อมูลใน tbl_customer จะเป็นการสมัครด้วย user_id ของ Line และเข้าระบบด้วย user_id ของ Line
        else :
            $customer->insertDataFromLine($profile, $profile2);

            $data = array();
            $data['username'] = $profile2->userId;
            $data['password'] = '';

            $result = $customer->checkLogin($data);
            $_SESSION['result'] = $result;
            header("location:520booking.php");
        endif;
    // header("location:signinup.php");
    endif;

    exit();
    if ($line_event == 'signin') :
        $customer->insertDataFromLine($profile, $profile2);

        $data = array();
        $data['username'] = $profile2->userId;
        $data['password'] = '';

        $result = $customer->checkLogin($data);
        $_SESSION['result'] = $result;
        header("location:signinup.php");
    elseif ($line_event == 'addfriend') :
        $customer->updateDataFromLine($profile2);
        header("location:520booking.php");
    else :
        header("location:signinup.php");
    endif;

// if ($result) {
//     header("location:index.php");
// } else {
//     header("location:signin.php");
// }

// echo "<p>User ID: {$profile2->userId}</p>";
// echo "<img src='{$profile->picture}'/small>";
// echo "<p>Name: {$profile->name}</p>";
// echo "<p>Email: {$profile->email}</p>";
// echo "<div class='button'><a href='logout.php'><div class='div_text'>ออกจากระบบ</div></a></div>";
endif;

## get profile by token
// $profile = $line->profile($token->access_token);