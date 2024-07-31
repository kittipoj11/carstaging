<?php
// session_start();

require_once '../config.php';
require_once  '../class/customer.class.php';
// require APP_PATH . 'connect.php';
// $_SESSION['edit_id'] = ($_REQUEST['edit_id']);
// exit;
$customer = new Customer();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'updatedata') {
    $customer->updateData($_REQUEST);
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'changepassword') {
    $customer->changePassword($_REQUEST);
} elseif (isset($_REQUEST['edit_id'])) {
    $rs = $customer->getRecordByUsername($_REQUEST['edit_id']);
    $_SESSION['rs'] = $rs;
    echo json_encode($rs);
}


//หลังทำการ Insert, Update หรือ Delete แล้วทำการ fetch ข้อมูลมาแสดงใหม่