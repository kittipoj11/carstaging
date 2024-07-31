   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once 'class/booking.class.php';
    require_once 'class/car_type.class.php';
    require_once 'class/open_area.class.php';

    //Car type
    $car_type = new Car_type;
    $rsCarType = $car_type->getAllRecord();

    // unset($rsObj);
    //OpenId
    $open_area = new OpenArea;
    $rsOpenId = $open_area->getRSOpenId();

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>จองวันและเวลาเข้าพื้นที่ Setup</h1>
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
                               <h3 class="card-title">ชื่อประเภท</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body" id="card-body">

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm">
                                           <span class="input-group-text">ทะเบียนรถ</span>
                                           <input type="text" name="car_license_number" id="car_license_number" class="form-control" data-type="ทะเบียนรถ">
                                       </div>
                                       <small>Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">ประเภทรถ</span>
                                           <select name="car_type_id" id="car_type_id" class="form-select form-select-sm form-control" data-type="ประเภทรถ">
                                               <!-- <option value="">-- เลือกประเภทรถ --</option> -->
                                               <option value="">...</option>
                                               <?php
                                                foreach ($rsCarType as $row) :
                                                    echo "<option value={$row['car_type_id']}>{$row['car_type_name']}</option>";
                                                endforeach;
                                                ?>
                                           </select>
                                           <input type="hidden" name="take_time_minutes" id="take_time_minutes">
                                       </div>
                                       <small class="mt-3 mb-5">Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">ชื่อคนขับรถ</span>
                                           <input type="text" name="driver_name" id="driver_name" class="form-control">
                                       </div>
                                       <small style="color:black">Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">โทรศัพท์คนขับรถ</span>
                                           <input type="text" name="driver_phone" id="driver_phone" class="form-control">
                                       </div>
                                       <small style="color:black">Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">ชื่องาน</span>
                                           <!-- เมื่อมีการกดเลือกรายการอีเวนต์ จะส่งค่า id="open_id" ให้กับ function ในไฟล์ script.js-->
                                           <select name="open_id" id="open_id" class="form-select form-select-sm form-control" data-type="ชื่องาน">
                                               <!-- <option value="">-- เลือกอีเวนต์ --</option> -->
                                               <option value="">...</option>
                                               <?php foreach ($rsOpenId as $row) :
                                                    echo "<option value='{$row['open_id']}'>{$row['event_name']}</option>";
                                                endforeach; ?>
                                           </select>
                                       </div>
                                       <small class="mt-3 mb-5">Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">เลขที่บูท</span>
                                           <input type="text" name="boot" id="boot" class="form-control" data-type="เลขที่บูท">
                                       </div>
                                       <small class="mt-3 mb-5">Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">อาคาร</span>
                                           <!-- เมื่อมีการกดเลือกรายการอาคาร จะส่งค่า id="building_id" ให้กับ function ในไฟล์ building.js-->
                                           <select name="building_id" id="building_id" class="form-select form-select-sm form-control" data-type="อาคาร">
                                               <!-- <option value="">-- เลือกอาคาร --</option> -->
                                               <option value="">...</option>
                                               <?php foreach ($rsBuilding as $row) :
                                                    echo "<option value='{$row['building_id']}'>{$row['building_name']}</option>";
                                                endforeach; ?>
                                           </select>
                                       </div>
                                       <small class="mt-3 mb-5">Error message!</small>
                                   </div>
                               </div>

                               <div class="row m-1">
                                   <div class="col-12 form_control">
                                       <div class="input-group input-group-sm ">
                                           <span class="input-group-text">พื้นที่ Setup</span>
                                           <select name="hall_id" id="hall_id" class="form-select form-select-sm form-control" data-type="พื้นที่ Setup">
                                               <option value="">...</option>
                                           </select>
                                       </div>
                                       <small class="mt-3 mb-5">Error message!</small>
                                   </div>
                               </div>
                           </div>
                           <!-- /.card-body -->
                           <div class="card-footer text-muted row">
                               <!-- ปุ่มเลือกวันที่และเวลา -->
                               <button name="btnSelectDateTime" id="btnSelectDateTime" type="button" class="btn btn-primary d-flex justify-content-center" data-toggle="tooltip" data-placement="right" title="ทำการเลือกวันที่และเวลาที่จะจอง">
                                   <img src="https://cdn.pixabay.com/photo/2016/07/31/20/54/calendar-1559935__340.png" alt="Booking" id="imgSelectDateTime">
                                   <!-- <img src="https://cdn.pixabay.com/photo/2017/06/26/00/46/flat-2442462__340.png" width='5%' alt="Booking"> -->
                               </button>
                           </div>
                           <!-- /.card-footer -->
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

   <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Booking Modal >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
   <!-- The Day and Time Modal -->
   <div id="myModal" class="myModal">
       <!-- Modal content -->
       <div class="myModalContent" id="DateTimeSection" name="DateTimeSection">
           <!-- <div class="modal-body"> -->
           <input type="hidden" name="txtDate" id="txtDate">
           <input type="hidden" name="txtTime" id="txtTime">
           <div class="DateSectionHead" id="DateSectionHead">

           </div>
           <div class="TimeSectionHead" id="TimeSectionHead">

           </div>
           <div class="row">
               <div class="col-8 mt-2 mb-2">
                   <!-- <div class="col-8"> -->
                   <button name="btnBooking" id="btnBooking" class="btn btn-primary btn-block form-control">จอง</button>
               </div>
               <div class="col-4 mt-2 mb-2">
                   <!-- <div class="col-4"> -->
                   <a href="#" id="btnCancel" class="btn btn-secondary btn-block form-control">ยกเลิก</a>
               </div>
           </div>
           <!-- </div> -->
       </div>
   </div>

   <!-- Confirm booking Modal -->
   <div id="myModal_Confirm" class="myModal_Confirm">
       <!-- Modal content -->
       <div class="myModalContent_Confirm">
           <div class="confirmBox">
               <h3>
                   การยืนยันการจองคิวในการเข้าพื้นที่
               </h3>
               <h3>
                   จะไม่สามารถกลับมาทำการแก้ไขการจองนี้ได้อีก
               </h3>
               <hr>
               <h3>
                   กดปุ่ม <strong>ตกลง</strong> เพื่อยืนยันการจอง
               </h3>

               <div id="confirm" class="confirmBox">
                   <div class="row">
                       <div class="col-sm-4 mt-2 mb-2">
                           <!-- <a href="test_get.php?subject=PHP&web=W3schools.com">Test $GET</a> -->
                           <!-- <a id="btnConfirm" class="btn btn-primary btn-block form-control" href="booking_crud.php" role="button">ตกลง</a> -->
                           <button name="btnConfirm" type="submit" id="btnConfirm" class="btn btn-primary btn-block form-control">ตกลง</button>
                       </div>
                       <div class="col-sm-8 mt-2 mb-2">
                           <button id="btnCancelConfirm" class="btn btn-secondary btn-block form-control">ยกเลิก</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <!-- QRcode Modal -->
   <?php
    $bg = "warning";
    ?>
   <div id="qrcodeModal" class="qrcodeModal">
       <div class="d-flex flex-row align-items-center justify-content-center bg-dark">

           <div class="d-flex flex-column align-items-center justify-content-center bg-dark p-2">
               <p class="w-100 m-0 py-1 rounded-top-1 text-center text-bg-<?php echo $bg ?>">
                   โปรดนำมาแสดงในการเข้าพื้นที่</p>

               <div id="qrcode" class="qrcode">
                   <div class="d-flex justify-content-center">
                       <img id="imgQrCode" class="d-flex" src="qr_assets/1704794884.png">
                   </div>

                   <div class="d-flex w-100 justify-content-center">
                       <a id="aDownload" href="qr_assets/1704794884.png" class="btn btn-block m-0 p-0 rounded-0 text-center text-bg-<?php echo $bg ?>" download=" qr_assets/1704794884.png">Download</a>
                   </div>
               </div>

               <div class="d-flex flex-row justify-content-evenly align-items-stretch w-100">

                   <a class="btn btn-success flex-grow-1" onclick='javascript:print()' style="border-bottom-left-radius: 0.5rem;border-bottom-right-radius: 0rem;border-top-left-radius: 0;border-top-right-radius: 0;">Print</a>
                   <!-- <a class="btn btn-secondary flex-grow-1" id="btnClose"
                                                style="border-bottom-left-radius: 0rem; border-bottom-right-radius: 0.5rem;border-top-left-radius: 0;border-top-right-radius: 0;">Close</a> -->
                   <a href="#" class="btn btn-secondary flex-grow-1" id="btnClose" style="border-bottom-left-radius: 0rem; border-bottom-right-radius: 0.5rem;border-top-left-radius: 0;border-top-right-radius: 0;">Close</a>
                   <!-- <input type='button' onclick='javascript:print()' value='พิมพ์'> -->
               </div>
           </div>

           <div id="qrdetail" class="d-md-flex d-none  flex-column align-items-center justify-content-center bg-dark p-2">
           </div>
       </div>
   </div>