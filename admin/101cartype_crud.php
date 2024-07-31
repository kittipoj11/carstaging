<?php
// @session_start();

require_once '../config.php';
require_once '../class/car_type.class.php';

$obj = new Car_type();
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
} elseif (isset($_REQUEST['edit_id'])) {
    // print_r($_REQUEST);
    // exit;
    $rs = $obj->getRecordById($_REQUEST['edit_id']);
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
        $html = <<<EOD
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th class="text-center" width="30%">ประเภทรถ</th>
                                <th class="text-center">กำหนดเวลาที่ใช้(นาที)</th>
                                <th class="text-center">ค่าปรับเกินเวลา(บาท/ชั่วโมง)</th>
                                <th class="text-center" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
            EOD;
        echo $html;
        foreach ($rs as $row) {
            $html = <<<EOD
                        <tr>
                            <td>{$row['car_type_id']}</td>
                            <td>{$row['car_type_name']}</td>
                            <td align='right'>{$row['take_time_minutes']}</td>
                            <td align='right'>{$row['parking_fee']}</td>
                            <td align='center'>
                                <div class='btn-group-sm'>
                                    <a class='btn btn-warning btn-sm btnEdit' data-toggle='modal' data-placement='right' title='Edit' data-target='#editModal' iid='{$row['car_type_id']}' style='margin: 0px 5px 5px 5px'>
                                        <i class='fa-regular fa-pen-to-square'></i>
                                    </a>
                                    <a class='btn btn-danger btn-sm btnDelete' data-toggle='modal' data-placement='right' title='Delete' data-target='#deleteModal' iid='{$row['car_type_id']}'  style='margin: 0px 5px 5px 5px'>
                                        <i class='fa-regular fa-trash-can'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    EOD;
            echo $html;
        }
        $html = <<<EOD
                </tbody>
            </table>
        EOD;
        echo $html;
        // print_r($rs);
    } catch (PDOException $e) {
        echo 'Data not found!';
    }
}
