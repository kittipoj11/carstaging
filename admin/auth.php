<?php
@session_status();
// or can used
// if (session_status() !== PHP_SESSION_ACTIVE) session_start();
// or can used
// if(session_status() === PHP_SESSION_NONE) session_start();

// require_once '../config.php';
// print_r($_SESSION);
if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] == false) :
    $message = "คุณยังไม่ได้ Login!";
    $_SESSION['message'] = $message;
    // echo '<script>';
    echo 'alert(' . $message . '); ';
    // echo '</script>';
    // header('location: /myProject/_carstaging_test/login.php');
    // header('location: signin.php');
    header('location: index.php');
    exit;
else :
    $_SESSION['message'] = "Login already";
//     // $_SESSION['login_status'] = true;
//     $username = $_SESSION['username'];
//     $fname = $_SESSION['fname'];
//     $lname = $_SESSION['lname'];
//     $password = $_SESSION['password'];
//     $role = $_SESSION['role'];
endif;