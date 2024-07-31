<?php
@session_start();
require_once 'config.php';
require_once 'class/customer.class.php';

$user = new Customer;

$result = $user->checkLogin($_POST);
$_SESSION['result'] = $result;

echo $result;

exit;
// ไม่ใช้อันด้านล่างแล้ว   เปลี่ยนไปใช้ ajax แทน
if ($result) {
    header("location:520booking.php");
} else {
    header("location:signinup.php");
}
exit;

















if (isset($_POST['signin'])) {
    $strUsername = $_POST['txtUsername1'];
    $strPassword = $_POST['txtPassword1'];

    $stmt = $conn->prepare('select * from tbl_member where username = :username and password = :password');
    // $stmt = $conn->prepare("select * from tbl_Seller where username = ':username'");
    $stmt->bindParam(':username', $strUsername, PDO::PARAM_STR);
    $stmt->bindParam(':password', $strPassword, PDO::PARAM_STR);
    $stmt->execute();


    try {
        if ($stmt->rowCount() >= 1) {

            $rs = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $rs['username'];
            $_SESSION['fname'] = $rs['fname'];
            $_SESSION['lname'] = $rs['lname'];
            $_SESSION['password'] = $rs['password'];
            $_SESSION['role'] = $rs['role'];
            $_SESSION['email'] = $rs['email'];
            $_SESSION['login_status'] = true;
            // echo $stmt->rowCount();
            // print_r($_SESSION);
            // session_destroy();
            // exit();
            if ($_SESSION['role'] == 'admin') {
                // header('Location: impact/live.php');
                header('Location: main.php');
            } else {
                // header('Location: guest/booking_list.php');
                header('Location: guest.php');
            }
        } else {
            //Username or Password invalid!
            echo '<script>';
            echo 'alert("Username หรือ password ไม่ถูกต้อง!"); ';
            echo 'window.history.back();';
            echo '</script>';
            // print_r($rs);
        }
    } catch (PDOException $e) {
        echo 'Code: ' . $e->getCode() . " -> Message: " . $e->getMessage();
        // if ($e->getCode() == 23000) {
        // alert "ไม่สามารถเพิ่มรายการนี้ได้ เนื่องจากข้อมูล ID Card Number หรือ User Name มีค่าซ้ำ!!!";
        // echo "<script type='text/javascript'>alert('ไม่สามารถเพิ่มรายการนี้ได้ เนื่องจากข้อมูล ID Card Number หรือ User Name มีค่าซ้ำ!!!');</script>";
        // header('Location: index.php?page=area_table');
        // } else {
        // echo $e->getCode()."Data can not added!!! " . $e->getMessage();
        // header('Location: index.php?page=area_table#area_add');
        // }
    }
} else if (isset($_POST['signup'])) {
    // print_r($_POST);
    $strUsername = $_POST['txtUsername2'];
    $strPassword = $_POST['txtPassword2'];
    $strRole = 'guest';
    $strEmail = $_POST['txtEmail'];
    $strFname = $_POST['txtFirstname'];
    $strLname = $_POST['txtLastname'];
    $strAddress = $_POST['txtAddress'];
    $strPhone = $_POST['txtPhone'];
    $strLineid = $_POST['txtLineid'];

    $stmt = $conn->prepare('insert into tbl_member(username, password, role, email, fname, lname, address, phone, line_id) 
    values(:username, :password, :role, :email, :fname, :lname, :address, :phone, :line_id)');
    $stmt->bindParam(':username', $strUsername, PDO::PARAM_STR);
    $stmt->bindParam(':password', $strPassword, PDO::PARAM_STR);
    $stmt->bindParam(':role', $strRole, PDO::PARAM_STR);
    $stmt->bindParam(':email', $strEmail, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $strFname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $strLname, PDO::PARAM_STR);
    $stmt->bindParam(':address', $strAddress, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $strPhone, PDO::PARAM_STR);
    $stmt->bindParam(':line_id', $strLineid, PDO::PARAM_STR);

    try {
        if ($stmt->execute()) {
            // $_SESSION['message'] =  'Data added successfully.';
            echo '<script>';
            echo 'alert("สมัครสมาชิกเรียบร้อยแล้ว"); ';
            echo 'window.history.back();';
            echo '</script>';
            // header('Location: menu/');
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            // $_SESSION['message'] =  'ไม่สามารถใช้ Username นี้ได้  เนื่องจากมี Username นี้อยู่แล้ว!';
            echo '<script>';
            echo 'alert("ไม่สามารถใช้ Username นี้ได้  เนื่องจากมี Username นี้อยู่แล้ว!"); ';
            echo 'window.history.back();';
            echo '</script>';
        } else {
            // $_SESSION['message'] =  'Something wrong. Cannot add data';
            echo '<script>';
            echo 'alert("มีบางอย่างผิดพลาด ไม่สามารถสมัครได้ในขณะนี้!"); ';
            echo 'window.history.back();';
            echo '</script>';
            // echo $e->getCode()."Data can not added!!! " . $e->getMessage();
            // header('Location: index.php?page=shop_owner_table#shop_owner_add');
        }
    }
} else if (isset($_POST['btnUpdate'])) {
    // print_r($_POST);
    $strUsername = $_POST['txtUsername'];
    $strEmail = $_POST['txtEmail'];
    $strFname = $_POST['txtFirstname'];
    $strLname = $_POST['txtLastname'];
    $strAddress = $_POST['txtAddress'];
    $strPhone = $_POST['txtPhone'];
    $strLineid = $_POST['txtLineid'];

    $stmt = $conn->prepare('update tbl_member
    set email = :email
    , fname = :fname
    , lname = :lname
    , address = :address
    , phone = :phone
    , line_id = :line_id
    where username = :username; ');
    $stmt->bindParam(':username', $strUsername, PDO::PARAM_STR);
    $stmt->bindParam(':email', $strEmail, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $strFname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $strLname, PDO::PARAM_STR);
    $stmt->bindParam(':address', $strAddress, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $strPhone, PDO::PARAM_STR);
    $stmt->bindParam(':line_id', $strLineid, PDO::PARAM_STR);

    try {
        if ($stmt->execute()) {
            // $_SESSION['message'] =  'Data added successfully.';
            echo '<script>';
            echo 'alert("บันทึกข้อมูลเรียบร้อยแล้ว"); ';
            echo 'window.history.back();';
            echo '</script>';
            // header('Location: menu/');
        }
    } catch (PDOException $e) {
        echo '<script>';
        echo 'alert("มีบางอย่างผิดพลาด ไม่สามารถบันทึกข้อมูลได้ในขณะนี้!"); ';
        echo 'window.history.back();';
        echo '</script>';
    }
}
