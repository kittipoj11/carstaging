<?php
require_once '../config.php';
require APP_PATH . 'connect.php';

// $strBuildingId = $_REQUEST["building_id"];
$stmt = $conn->prepare("SELECT * FROM tbl_hall where building_id = '{$_GET['building_id']}'");
// $stmt = $conn->prepare("SELECT * FROM tbl_hall where building_id = ':building_id'");
// $stmt->bindParam(':building_id', $strBuildingId, PDO::PARAM_STR);
// $stmt->bindParam(':building_id', $_GET['building_id'], PDO::PARAM_STR);
$stmt->execute();
$query = $stmt->fetchall(PDO::FETCH_ASSOC);
$json = array();
foreach ($query as $rs) {
    array_push($json, $rs);
}
echo json_encode($json);
