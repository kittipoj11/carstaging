<?php
@session_start();

require_once '../config.php';
require_once  '../class/customer.class.php';

$obj = new Customer();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'insertdata') {
    // print_r($_REQUEST);
    // exit;
    $obj->insertData($_REQUEST);
    getAllRecord($obj);
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'updatedata') {
    // print_r($_REQUEST);
    // exit;
    $obj->updateData($_REQUEST);
    getAllRecord($obj);
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deletedata') {
    // print_r($_REQUEST);
    // exit;
    $obj->deleteData($_REQUEST);
    getAllRecord($obj);
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'approved_by') {
    // print_r($_REQUEST);
    // exit;
    $obj->updateApprovedBy($_REQUEST);
    getCustomerApproveWaiting($obj);
} elseif (isset($_REQUEST['edit_id'])) {
    // print_r($_REQUEST);
    // exit;
    $rs = $obj->getRecordByUsername($_REQUEST['edit_id']);
    echo json_encode($rs);
} elseif (isset($_REQUEST['delete_id'])) {
    // print_r($_REQUEST);
    // exit;
    $obj->deleteData($_REQUEST);
    getAllRecord($obj);
}


//หลังทำการ Insert, Update หรือ Delete แล้วทำการ fetch ข้อมูลมาแสดงใหม่
function getAllRecord($getObj)
{
    try {
        $rs = $getObj->getAllRecord();

        // foreach ($rs as $key => $row) :
        foreach ($rs as $row) :
            $check = (isset($row['approved_by']) && strlen(trim($row['approved_by'])) > 0) ? 'checked' : '';
            echo "<tr>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['firstname']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['register_datetime']}</td>";
            echo "<td class='text-center'><input class='form-check-input' type='checkbox' $check onclick='return false;''></td>";
            echo "<td class='text-center'>";
            echo "<div class='btn-group-sm'>";
            echo "<a class='btn btn-warning btn-sm btnEdit' data-bs-toggle='modal' data-toggle='tooltip' data-placement='right' title='Edit' data-bs-target='#modalEdit' id='{$row['username']}' style='margin: 0px 5px 5px 5px;'>";
            echo "<i class='fa-regular fa-pen-to-square'></i>";
            echo "</a>";
            echo "<a class='btn btn-danger btn-sm btnDelete' data-bs-toggle='modal' data-toggle='tooltip' data-placement='right' title='Delete' data-bs-target='#modalDelete' id='{$row['username']}' style='margin: 0px 5px 5px 5px;'>";
            echo "<i class='fa-regular fa-trash-can'></i>";
            echo "</a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        endforeach;
        // print_r($rs);
    } catch (PDOException $e) {
        echo 'Data not found!';
    }
}

function getCustomerApproveWaiting($getObj)
{
    try {
        $rs = $getObj->getCustomerApproveWaiting();

        // foreach ($rs as $key => $row) :
        foreach ($rs as $row) :
            $check = (isset($row['approved_by']) && strlen(trim($row['approved_by'])) > 0) ? 'checked' : '';
            echo "<tr>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['firstname']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['register_datetime']}</td>";
            echo "<td class='text-center'><input class='form-check-input' type='checkbox' $check onclick='return false;''></td>";
            echo "<td class='text-center'>";
            echo "<div class='btn-group-sm'>";
            echo "<a class='btn btn-warning btn-sm btnEdit' data-bs-toggle='modal' data-toggle='tooltip' data-placement='right' title='Edit' data-bs-target='#modalEdit' id='{$row['username']}' style='margin: 0px 5px 5px 5px;'>";
            echo "<i class='fa-regular fa-pen-to-square'></i>";
            echo "</a>";
            echo "<a class='btn btn-danger btn-sm btnDelete' data-bs-toggle='modal' data-toggle='tooltip' data-placement='right' title='Delete' data-bs-target='#modalDelete' id='{$row['username']}' style='margin: 0px 5px 5px 5px;'>";
            echo "<i class='fa-regular fa-trash-can'></i>";
            echo "</a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        endforeach;
        // print_r($rs);
    } catch (PDOException $e) {
        echo 'Data not found!';
    }
}
