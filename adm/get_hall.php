<?php
require '../class/hall.class.php';

$hall = new Hall;
$rs = $hall->getRecordByBuildingId($_REQUEST['building_id']);

$json = array();
foreach ($rs as $row) {
    array_push($json, $row);
}
echo json_encode($json);
