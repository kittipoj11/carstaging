   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once  '../class/booking.class.php';
    // // include APP_PATH . '/connect.php';
    try {

        //Hall list from tbl_booking
        $hall_id = '';

        $booking = new Booking;
        $rsHall = $booking->getRSHallToday();
        $rsWaiting = $booking->getRSBookingToday('%', 1);
        $rsCalling = $booking->getRSBookingToday('%', 2);
        $rsAccept = $booking->getRSBookingToday('%', 3);
        $rsLoading = $booking->getRSBookingToday('%', 4);
    } catch (PDOException $e) {
        echo 'Data not found!';
    }
    $_SESSION['rsWaiting'] = $rsWaiting;
    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>รายการคิววันนี้(<?php echo date("d/m/Y");  ?>)</h1>
                   </div>
               </div>
           </div><!-- /.container-fluid -->
       </section>

       <!-- Main content -->
       <section class="content">
           <div class="container-fluid">
               <!-- Content Row -->
               <div class="row border-1 border-dark">
                   <div class="col-5 col-lg-3">
                       <div class="row">
                           <div class="col-12 border border-0 border-dark text-center">
                               <h5 class="bg-gradient text-black bg-primary m-2 p-2 rounded shadow">พื้นที่
                                   Setup</h5>
                               <input type="hidden" name="hall-id" id="hall-id">
                               <div class="border border-0 border-dark">
                                   <?php
                                    foreach ($rsHall as $row) :
                                        $myHtml = "";
                                        $hall_id = $row["hall_id"];
                                        $hall_name = $row["hall_name"];
                                        $building_name = $row["building_name"];

                                        $myHtml .= "<div class='hall-name rounded   p-2' name='txt" . $hall_id . "'";
                                        $myHtml .= " id='txt" . $hall_id . "'";
                                        $myHtml .= " iid={$hall_id}";
                                        $myHtml .= " data-value='" . $hall_id . "'>";
                                        $myHtml .= $hall_name;
                                        $myHtml .= "<h6><sub>" . $building_name . "</sub></h6>";
                                        $myHtml .= "</div>";
                                        echo $myHtml;
                                    endforeach
                                    ?>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-7 col-lg-9">
                       <div class="row">
                           <div class="col-12 col-lg-4 border border-0 border-dark text-center">
                               <h5 class="bg-gradient text-black bg-danger m-2 p-2 rounded shadow">รอเรียกคิว
                               </h5>
                               <div class="border border-0 border-dark div-title-waiting">
                                   <?php foreach ($rsWaiting as $row) : ?>
                                       <div class="div-item-waiting border border-1 border-dark rounded m-2 btn-outline-danger" id=<?= $row['id'] ?>>
                                           <label class="" for="<?php echo $row['id'] ?>">
                                               <h5><?php echo "คิว: {$row['queue_number']}" ?></h5>
                                               ทะเบียนรถ: <?php echo $row['car_license_number'] ?>
                                               <sup>
                                                   <br>[<?php echo $row['car_type_name'] ?>]
                                               </sup>
                                           </label>
                                           <i class="fa-solid fa-bullhorn btn-call"></i>
                                       </div>
                                   <?php endforeach; ?>
                               </div>
                           </div>
                           <div class="col-12 col-lg-4 border border-0 border-dark text-center">
                               <h5 class="bg-gradient text-black bg-warning m-2 p-2 rounded shadow">
                                   เรียกคิวแล้ว</h5>
                               <div class="border border-0 border-dark div-title-calling">
                                   <?php foreach ($rsCalling as $row) : ?>
                                       <div class="div-item-calling border border-1 border-dark rounded m-2 btn-outline-warning" id=<?= $row['id'] ?>>
                                           <!-- <input type="checkbox" class="btn-check" name="chkCall[]" id="< ?php echo $row['id'] ?>" autocomplete="off"> -->
                                           <label class="" for="<?php echo $row['id'] ?>">
                                               <!-- style="border: 1px solid red;" -->
                                               <h5>คิว: <?php echo $row['queue_number'] ?></h5>
                                               ทะเบียนรถ: <?php echo $row['car_license_number'] ?>
                                               <sup>
                                                   <br>[<?php echo $row['car_type_name'] ?>]
                                               </sup>
                                           </label>
                                           <i class="fa-solid fa-right-to-bracket btn-load"></i>
                                       </div>
                                   <?php endforeach ?>
                                   <?php foreach ($rsAccept as $row) : ?>
                                       <div class="div-item-calling border border-1 border-dark rounded m-2 btn-outline-warning" id=<?= $row['id'] ?>>
                                           <!-- <input type="checkbox" class="btn-check" name="chkCall[]" id="< ?php echo $row['id'] ?>" autocomplete="off"> -->
                                           <label class="" for="<?php echo $row['id'] ?>">
                                               <!-- style="border: 1px solid red;" -->
                                               <h5>คิว: <?php echo $row['queue_number'] ?></h5>
                                               ทะเบียนรถ: <?php echo $row['car_license_number'] ?>
                                               <sup>
                                                   <br>[<?php echo $row['car_type_name'] ?>]
                                               </sup>
                                           </label>
                                           <i class="fa-solid fa-right-to-bracket btn-load"></i>
                                       </div>
                                   <?php endforeach ?>

                               </div>
                           </div>
                           <div class="col-12 col-lg-4 border border-0 border-dark text-center">
                               <h5 class="bg-gradient text-black bg-success m-2 p-2 rounded shadow">กำลังโหลด
                               </h5>
                               <div class="border border-0 border-dark div-title-loading">
                                   <?php foreach ($rsLoading as $row) : ?>
                                       <div class="div-item-loading border border-1 border-dark rounded m-2 btn-outline-success" id=<?= $row['id'] ?>>
                                           <!-- <input type="checkbox" class="btn-check" name="chkLoad[]" id="< ?php echo $row['id'] ?>" autocomplete="off"> -->
                                           <label class="" for="<?php echo $row['id'] ?>">
                                               <!-- style="border: 1px solid red;" -->
                                               <h5>คิว: <?php echo $row['queue_number'] ?></h5>
                                               ทะเบียนรถ: <?php echo $row['car_license_number'] ?>
                                               <sup>
                                                   <br>[<?php echo $row['car_type_name'] ?>]
                                               </sup>
                                           </label>
                                           <i class="fa-solid fa-right-from-bracket btn-complete"></i>
                                       </div>
                                   <?php endforeach ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
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
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
               </div>

               <form name="frmInsert" id="frmInsert" action="" method="">
                   <div class="modal-body">

                       <!-- <div class="row m-3">
                           <label for="building_id" class="col-sm-6 col-form-label">ซัมเมอร์โน๊ต</label>
                           <textarea id="summernote">
                                Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                       </div> -->

                       <div class="row m-3">
                           <label for="building_id" class="col-sm-4 col-form-label">รหัสอาคาร</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm fst-italic" name="building_id">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="building_name" class="col-sm-4 col-form-label">ชื่ออาคาร</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="building_name">
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
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
               </div>

               <form name="frmEdit" id="frmEdit" action="" method="">
                   <!-- <input type="text" name="action" id="action"> -->
                   <div class="modal-body">
                       <div class="row m-3">
                           <label for="building_id" class="col-sm-4 col-form-label">รหัสอาคาร</label>
                           <div class="col-sm-8">
                               <!-- <input type="hidden" class="building_id" name="building_id"> -->
                               <input type="input" class="form-control form-control-sm fst-italic building_id" id="building_id" readonly name="building_id">
                           </div>
                       </div>

                       <div class="row m-3">
                           <label for="building_name" class="col-sm-4 col-form-label">ชื่ออาคาร</label>
                           <div class="col-sm-8">
                               <input type="input" class="form-control form-control-sm" name="building_name" id="building_name">
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
                       <button type="button" name="btnUpdateData" id="btnUpdateData" class="btn btn-primary" data-dismiss="modal">Save</button>
                   </div>
               </form>

           </div>
       </div>
   </div>