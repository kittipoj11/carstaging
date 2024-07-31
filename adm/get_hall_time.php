<?php
require '../class/hall.class.php';

$hall = new Hall;
$rs = $hall->getRecordById($_REQUEST['building_id'], $_REQUEST['hall_id']);

$json = array();
foreach ($rs as $row) {
    array_push($json, $row);
}
echo json_encode($json);
