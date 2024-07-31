   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once '../class/hall.class.php';
    require_once '../class/building.class.php';
    // include APP_PATH . '/connect.php';

    $hall = new Hall;
    $rs = $hall->getAllRecord();

    $building = new Building;
    $rsBuilding = $building->getAllRecord();

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>พื้นที่</h1>
                       <a class="btn btn-success btn-sm btnNew" data-toggle="modal" data-placement="right" title="เพิ่มข้อมูล" data-target="#insertModal" style="margin: 0px 5px 5px 5px;">
                           <i class="fa-solid fa-plus"></i>
                       </a>
                   </div>
               </div>
           </div><!-- /.container-fluid -->
       </section>

       <!-- Main content -->
       <section class="content">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-12">

                       <div class="card">
                           <!-- <div class="card-header">
                               <h3 class="card-title">ชื่อพื้นที่</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body" id="card-body">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                       <tr>
                                           <th class="text-center">รหัสพื้นที่</th>
                                           <th class="text-center">ชื่อพื้นที่</th>
                                           <th class="text-center">อาคาร</th>
                                           <th class="text-center">จำนวนช่องโหลดที่เปิดให้จอง</th>
                                           <th class="text-center">จำนวนช่องโหลดทั้งหมด</th>
                                           <th class="text-center">ตั้งค่าเวลาจองเริ่มต้น</th>
                                           <th class="text-center">ตั้งค่าเวลาจองสิ้นสุด</th>
                                           <th class="text-center" style="width: 120px;">Action</th>
                                       </tr>
                                   </thead>
                                   <tbody id="tbody">
                                       <?php foreach ($rs as $row) {
                                            $html = <<<EOD
                                        <tr>
                                            <td>{$row['hall_id']}</td>
                                            <td>{$row['hall_name']}</td>
                                            <td>{$row['building_name']}</td>
                                            <td>{$row['reservable_slots']}</td>
                                            <td>{$row['total_slots']}</td>
                                            <td>{$row['start_time']}</td>
                                            <td>{$row['end_time']}</td>
                                            <td align='center'>
                                                <div class='btn-group-sm'>
                                                    <a class='btn btn-warning btn-sm btnEdit' data-toggle='modal' data-toggle='tooltip' data-placement='right' title='Edit' data-target='#editModal' iid='{$row['hall_id']}' style='margin: 0px 5px 5px 5px'>
                                                        <i class='fa-regular fa-pen-to-square'></i>
                                                    </a>
                                                    <a class='btn btn-danger btn-sm btnDelete' data-toggle='modal' data-toggle='tooltip' data-placement='right' title='Delete' data-target='#deleteModal' iid='{$row['hall_id']}' style='margin: 0px 5px 5px 5px'>
                                                        <i class='fa-regular fa-trash-can'></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        EOD;
                                            echo $html;
                                        } ?>

                                   </tbody>

                               </table>
                           </div>
                           <!-- /.card-body -->
                       </div>
                       <!-- /.card -->
                   </div>
                   <!-- /.col -->
               </div>
               <!-- /.row -->
           </div>
           <!-- /.container-fluid -->
       </section>
       <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ส่วน Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Logout Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- logout.php -->

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Insert data Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- <div class="container-fluid table-responsive-sm p-0"> -->
   <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h1 class="modal-title fs-5">เพิ่มข้อมูลใหม่</h1>
                   <a class="btn-close" data-dismiss="modal" aria-label="Close">
                       <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                       <i class="fa-solid fa-xmark"></i>
                   </a>
               </div>

               <form name="frmInsert" id="frmInsert" action="" method="">
                   <div class="modal-body">

                       <!-- <div class="row m-3">
                           <label for="hall_id" class="col-sm-6 col-form-label">ซัมเมอร์โน๊ต</label>
                           <textarea id="summernote">
                                Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                       </div> -->

                       <div class="row m-3">
                           <label for="hall_id" class="col-sm-4 col-form-label">รหัสพื้นที่</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm fst-italic" name="hall_id">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="hall_name" class="col-sm-4 col-form-label">ชื่อพื้นที่</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="hall_name">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="building_id" class="col-sm-4 col-form-label">อาคาร</label>
                           <div class="col-sm-8">
                               <select class="form-select form-control form-control-sm building_id" name="building_id">
                                   <?php
                                    foreach ($rsBuilding as $row) :
                                        echo "<option value='{$row['building_id']}'>{$row['building_name']}</option>";
                                    endforeach ?>
                               </select>
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="reservable_slots" class="col-sm-4 col-form-label">จำนวนช่องโหลดที่เปิดให้จอง</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="reservable_slots">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="total_slots" class="col-sm-4 col-form-label">จำนวนช่องโหลดทั้งหมด</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="total_slots">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="start_time" class="col-sm-4 col-form-label">ตั้งค่าเวลาจองเริ่มต้น</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm time" name="start_time">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="end_time" class="col-sm-4 col-form-label">ตั้งค่าเวลาจองสิ้นสุด</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm time" name="end_time">
                           </div>
                       </div>

                       <!-- <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="input-group input-group-sm mb-1">
                                            <span class="input-group-text">Active</span>
                                            <label class="switch ms-2"><input type="checkbox" name='is_active_i' checked>
                                            <span class="slider round"></span></label>
                                        </div>
                                    </div>
                                </div> -->
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                       <button type="button" name="btnInsertData" id="btnInsertData" class="btn btn-primary" data-dismiss="modal">Save</button>
                   </div>
               </form>

           </div>
       </div>
   </div>

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Edit data Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- <div class="container-fluid table-responsive-sm p-0"> -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h1 class="modal-title fs-5" id="modal">แก้ไขข้อมูล</h1>
                   <a class="btn-close" data-dismiss="modal" aria-label="Close">
                       <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                       <i class="fa-solid fa-xmark"></i>
                   </a>
               </div>

               <form name="frmEdit" id="frmEdit" action="" method="">
                   <!-- <input type="text" name="action" id="action"> -->
                   <div class="modal-body">
                       <div class="row m-3">
                           <label for="hall_id" class="col-sm-4 col-form-label">รหัสพื้นที่</label>
                           <div class="col-sm-8">
                               <!-- <input type="hidden" class="hall_id" name="hall_id"> -->
                               <input type="input" class="form-control form-control-sm fst-italic hall_id" id="hall_id" readonly name="hall_id">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="hall_name" class="col-sm-4 col-form-label">ชื่อพื้นที่</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="hall_name" id="hall_name">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="hall_name" class="col-sm-4 col-form-label">อาคาร</label>
                           <div class="col-sm-8">
                               <select class="form-select form-control form-control-sm building_id" name="building_id" id="building_id">
                                   <?php
                                    foreach ($rsBuilding as $row) :
                                        echo "<option value='{$row['building_id']}'>{$row['building_name']}</option>";
                                    endforeach; ?>
                               </select>
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="reservable_slots" class="col-sm-4 col-form-label">จำนวนช่องโหลดที่เปิดให้จอง</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="reservable_slots" id="reservable_slots">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="total_slots" class="col-sm-4 col-form-label">จำนวนช่องโหลดทั้งหมด</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="total_slots" id="total_slots">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="start_time" class="col-sm-4 col-form-label">ตั้งค่าเวลาจองเริ่มต้น</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm time" name="start_time" id="start_time">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="end_time" class="col-sm-4 col-form-label">ตั้งค่าเวลาจองสิ้นสุด</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm time" name="end_time" id="end_time">
                           </div>
                       </div>

                       <!-- <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <div class="input-group input-group-sm mb-1">
                                        <span class="input-group-text">Active</span>
                                        <label class="switch ms-2"><input type="checkbox" name='is_active_i' checked>
                                        <span class="slider round"></span></label>
                                    </div>
                                </div>
                            </div> -->
                       <!-- เตรียมไว้สำหรับการตั้งค่าเวลาตามที่กำหนดเองโดยไม่ต้อง fix ค่าในโปรแกรม -->
                       <input type="hidden" id="test" value="08:00">
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                       <button type="button" name="btnUpdateData" id="btnUpdateData" class="btn btn-primary" data-dismiss="modal">Save</button>
                   </div>
               </form>

           </div>
       </div>
   </div>