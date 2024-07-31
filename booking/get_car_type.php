<?php
require_once '../config.php';
require '../class/car_type.class.php';

$car_type = new Car_type;
$rs = $car_type->getRecordById($_REQUEST['car_type_id']);

$json = array();
foreach ($rs as $row) {
    array_push($json, $row);
}
echo json_encode($json);
