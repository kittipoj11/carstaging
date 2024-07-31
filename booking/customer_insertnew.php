<?php
@session_start();

require_once '../config.php';
require_once  '../class/customer.class.php';
// require APP_PATH . 'connect.php';
$_SESSION['action'] = ($_REQUEST['insertdata']);
// exit;
$obj = new Customer();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'insertdata') :
    $obj->insertData($_REQUEST);

endif;
