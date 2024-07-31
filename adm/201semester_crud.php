<?php
@session_start();
require_once '../config.php';
require_once '../class/open_area.class.php';
// require APP_PATH . 'connect.php';
// $_SESSION['edit_id'] = ($_REQUEST['edit_id']);
// exit;
$open_area = new OpenArea();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'insertdata') {
    // print_r($_REQUEST);
    // exit;
    $open_area->insertSchedule($_REQUEST);
    // getAllRecord($open_area);
    // header(APP_PATH . 'main.php?page=open_area_schedule');
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deletedata') {
    // print_r($_REQUEST);
    // exit;
    return $open_area->deleteSchedule($_REQUEST);
    // header('main.php?page=open_area_schedule');
}
