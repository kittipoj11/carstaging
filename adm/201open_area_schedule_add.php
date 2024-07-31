   <?php
    require_once '../class/hall.class.php';
    require_once '../class/building.class.php';
    require_once '../class/car_type.class.php';

    if (isset($SESSION['_POST'])) :
        echo "<div class='alert alert-danger' role='alert'></div>";
        unset($_SESSION['_POST']);
    endif;

    $car_type = new Car_type;
    $rsCarType =    $car_type->getAllRecord();

    $hall = new Hall;
    $rsHall =    $hall->getAllRecord();

    $building = new Building;
    $rsBuilding =    $building->getAllRecord();
    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1 class="h3 mb-0 text-gray-800">วัน/เวลาเปิดพื้นที่ Setup: เพิ่มรายการใหม่</h1>
                       <!-- <a href="201open_area_schedule_add_main.php" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="เพิ่มรายการ" style="margin: 0px 5px 5px 5px;">
                           <i class="fa-solid fa-plus"></i>
                       </a> -->
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
                           <div class="card-body">
                               <form name="myForm" id="myForm">
                                   <div class="row">
                                       <div class="col-sm-4 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <label for="building_id" class="input-group-text">อาคาร</label>
                                               <div class="col">
                                                   <select name="building_id" id="building_id" class="form-select form-select-sm form-control">
                                                       <!-- <option value="">-- เลือกอีเวนต์ --</option> -->
                                                       <option value="">...</option>
                                                       <?php foreach ($rsBuilding as $row) { ?>
                                                           <option value="<?php echo $row['building_id'] ?>">
                                                               <?php echo $row['building_name'] ?></option>
                                                       <?php } ?>
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-4 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <label for="hall_id" class="input-group-text">พื้นที่</label>
                                               <div class="col">
                                                   <select name="hall_id" id="hall_id" class="form-select form-select-sm form-control">
                                                       <!-- <option value="">-- เลือกพื้นที่ --</option> -->
                                                       <option value="">...</option>
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-4 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <label for="total_slots" class="input-group-text">Total Slots</label>
                                               <div class="col">
                                                   <input type="number" name='total_slots' id='total_slots' class="form-control">
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-12 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">ชื่องาน(Event)</span>
                                               <div class="col">
                                                   <input type="text" name='event_name' id='event_name' class="form-control" oncut="alert('123')">
                                               </div>
                                           </div>
                                       </div>
                                   </div>


                                   <div class="row inline d-none">
                                       <!-- ค่า Default ที่ดึงจาก tbl_hall-->
                                       <div class="col-sm-3 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">Time Start</span>
                                               <div class="col">
                                                   <input type="time" name="time_start_header" id="time_start_header" class="form-control">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-3 px-0">
                                           <div class="input-group input-group-sm mb-1">
                                               <span class="input-group-text">Time End</span>
                                               <div class="col">
                                                   <input type="time" class="form-control" name="time_end_header" id="time_end_header">
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="card border border-1 border-dark mt-3" style="display:none" id="div_open_area_schedule">
                                       <!-- <div class="card-header" style="display: flex;"> -->
                                       <div class="card-header p-2">
                                           <h6>ช่วงเวลาเปิดพื้นที่</h6>
                                           <a id="btnAdd" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" style="margin: 0px 5px 5px 5px;" title="เพิ่มรายการ">
                                               Add
                                           </a>
                                           <!-- <a id="btnDeleteListx" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" style="margin: 0px 5px 5px 5px;display:none" title="ลบรายการล่าสุด">
                                               Delete
                                           </a> -->

                                           <a id="btnClear" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" style="margin: 0px 5px 5px 5px;" title="ลบรายการทั้งหมด">
                                               Clear
                                           </a>
                                       </div>

                                       <div class="card-body p-0">
                                           <!-- สร้าง Table ตามปกติ -->
                                           <table class="table table-bordered justify-content-center text-center">
                                               <thead>
                                                   <tr>
                                                       <th width="10%">วันที่เปิด</th>
                                                       <th width="10%">วันที่ปิด</th>
                                                       <th width="10%">เวลาเปิด</th>
                                                       <th width="10%">เวลาปิด</th>
                                                       <th width="15%">จำนวน Slots ที่เปิด</th>
                                                       <th>ประเภทรถ</th>
                                                       <th width="5%">Action</th>
                                                       <th style="display:none">id</th>
                                                   </tr>
                                               </thead>
                                               <tbody id="tableBody">
                                                   <tr class="firstTr">
                                                       <td class="p-1"><input type="date" name="date_start[]" class="form-control date_start" value="<?php echo date_format(new DateTime('tomorrow'), "Y-m-d"); ?>" min="<?php echo date_format(new DateTime('tomorrow'), "Y-m-d"); ?>" required>
                                                       </td>
                                                       <td class="p-1"><input type="date" name="date_end[]" class="form-control date_end" value="<?php echo date_format(new DateTime('tomorrow'), "Y-m-d"); ?>" min="<?php echo date_format(new DateTime('tomorrow'), "Y-m-d"); ?>" required>
                                                       </td>
                                                       <td class="p-1"><input type="text" name="time_start[]" class="form-control time_start" required></td>
                                                       <td class="p-1"><input type="text" name="time_end[]" class="form-control time_end" required></td>
                                                       <td class="p-1"><input type="number" name="reservable_slots[]" class="form-control reservable_slots" require>
                                                       </td>
                                                       <td class="p-1">
                                                           <?php foreach ($rsCarType as $dr) :
                                                                echo "<div class='form-check form-check-inline'>";
                                                                echo "<input type='checkbox' name='chkCarType0[]' 
                                                                class='form-check-input checkbox' value='{$dr['car_type_id']}' checked>";
                                                                echo "<label class='form-check-label' for='chkCarType{$dr['car_type_id']}'>{$dr['car_type_name']}</label>";
                                                                echo "</div>";
                                                            endforeach; ?>
                                                       </td>
                                                       <td class="p-1 align-content-center">
                                                           <a class="btn btn-outline-danger btn-sm btnDeleteList align-self-center" data-toggle="tooltip" data-placement="right" style="display:none;" title="ลบรายการนี้"><i class="fi fi-rr-cross-small"></i></a>
                                                       </td>
                                                       <td style="display:none"><input type="text" name="id[]" class="form-control id" value="0"></td>
                                                   </tr>
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>

                                   <div class="modal-footer">
                                       <a type="submit" name="btnSave" id="btnSave" class="btn btn-primary">บันทึก</a>
                                       <a type="button" name="btnCancel" id="btnCancel" class="btn btn-secondary">ยกเลิก</a>
                                   </div>

                               </form>
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