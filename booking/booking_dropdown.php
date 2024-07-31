<?php
@session_start();
require_once '../config.php';
require_once '../class/open_area.class.php';

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'select_open_id') :
    $open_id = $_REQUEST["open_id"];
    $rsObj = new OpenArea;

    $rsBuilding = $rsObj->getRSBuildingByOpenId($open_id);
    $building_arr = array();
    foreach ($rsBuilding as $rs) {
        array_push($building_arr, $rs);
    }
    echo json_encode($building_arr);
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'select_building_id') :
    $open_id = $_REQUEST["open_id"];
    $building_id = $_REQUEST["building_id"];
    $rsObj = new OpenArea;

    $rsHall = $rsObj->getRSHallByOpenIdAndBuildingId($open_id, $building_id);
    $hall_arr = array();
    foreach ($rsHall as $rs) {
        array_push($hall_arr, $rs);
    }
    echo json_encode($hall_arr);
// elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deletedata') :
//     print_r($_REQUEST);
//     // exit;
//     $obj->deleteData($_REQUEST);
//     getAllRecord($obj);
// elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'approved_by') :
//     // print_r($_REQUEST);
//     // exit;
//     $obj->updateApprovedBy($_REQUEST);
//     getCustomerApproveWaiting($obj);
// elseif (isset($_REQUEST['edit_id'])) :
//     // print_r($_REQUEST);
//     // exit;
//     $rs = $obj->getRecordByUsername($_REQUEST['edit_id']);
//     echo json_encode($rs);
// elseif (isset($_REQUEST['delete_id'])) :
//     // print_r($_REQUEST);
//     // exit;
//     $obj->deleteData($_REQUEST);
//     getAllRecord($obj);
endif;