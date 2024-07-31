   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once  '../class/booking.class.php';
    // // include APP_PATH . '/connect.php';
    try {

        $booking = new Booking;
        $rsTodayBooking = $booking->getRsTodayBooking();
    } catch (PDOException $e) {
        echo 'Data not found!';
    }

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h1>Loading Info</h1>
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
                               <h3 class="card-title">ชื่ออาคาร</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body">
                               <div class="row">
                                   <?php
                                    foreach ($rsTodayBooking as $row) :
                                        $building_name = $row['building_name'];
                                        $hall_name = $row['hall_name'];
                                        $booking_total = $row['total_booking'];
                                        $total_slot = $row['total_slots'];
                                        $waiting = $row['sum_waiting'];
                                        $calling = $row['sum_calling'];
                                        $loading_slot = $row['sum_loading'];
                                        $complete = $row['sum_complete'];
                                        $available_slot = $total_slot - $loading_slot;
                                        $bg = "success";
                                    ?>


                                       <!-- <div class="card-deck"> -->
                                       <div class="card col-12 col-lg-6 col-xl-4 text-bg-<?php echo $bg ?>">
                                           <div class="card-header text-bg-<?php echo $bg ?>">
                                               <h1 class="text-center font-weight-bold"> <?= $hall_name ?></h1>
                                               <h6 class="text-center font-weight-bold"><sup><?= $building_name ?></sub></h6>
                                           </div>
                                           <div class="card-body font-weight-bold fs-4">
                                               <ul class="list-group">
                                                   <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                                       <!-- <i class="nav-icon bi bi-ui-checks-grid text-danger"> -->
                                                       <i class="nav-icon fi-rr-braille text-danger">
                                                           <span class="d-none d-sm-inline text-danger"> ช่องโหลดว่าง: </span>
                                                       </i>
                                                       <!-- <span class="fs-6 fs-sm-4"> ช่องโหลดว่าง: </span> -->
                                                       <span class="badge bg-danger"><?= $available_slot ?></span>
                                                   </li>
                                                   <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                                       <i class="nav-icon fa-solid fa-hourglass-half text-danger">
                                                           <span class="d-none d-sm-inline text-danger">
                                                               รอเรียกคิว:
                                                           </span>
                                                       </i>

                                                       <!-- <span class="fs-6 fs-sm-4"> รอ Load: </span> -->
                                                       <span class="badge bg-danger"><?= $waiting ?></span>
                                                   </li>
                                                   <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                                       <!-- <i class="nav-icon fa-solid fa-bullhorn text-danger"> -->
                                                       <i class="nav-icon fi-rr-megaphone text-danger">
                                                           <span class="d-none d-sm-inline text-danger"> กำลังเรียก:
                                                           </span></i>

                                                       <!-- <span class="fs-6 fs-sm-4"> กำลังเรียก: </span> -->
                                                       <span class="badge bg-danger"><?= $calling ?></span>
                                                   </li>
                                                   <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                                       <i class="nav-icon fa-solid fa-truck-ramp-box text-danger">
                                                           <i class="nav-icon fi-rr-truck-couch text-danger"></i>
                                                           <i class="nav-icon fi-rr-percent-100 text-danger"></i>
                                                           <span class="d-none d-sm-inline text-danger"> กำลัง Load:
                                                           </span></i>

                                                       <!-- <span class="fs-6 fs-sm-4"> กำลัง Load: </span> -->
                                                       <span class="badge bg-danger"><?= $loading_slot ?></span>
                                                   </li>
                                                   <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                                       <i class="nav-icon fa-solid fa-flag-checkered text-danger">
                                                           <i class="nav-icon fi-rr-user-cowboy text-danger"></i>
                                                           <span class="d-none d-sm-inline text-danger"> Load เสร็จแล้ว: </span>
                                                       </i>

                                                       <!-- <span class="fs-6 fs-sm-4"> Load เสร็จแล้ว: </span> -->
                                                       <span class="badge bg-danger"><?= $complete ?></span>
                                                   </li>
                                                   <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                                       <i class="fi fi-rr-car-bus text-danger"><span class="d-none d-sm-inline text-danger"> ยอดจองทั้งหมด:
                                                           </span></i>

                                                       <!-- <span class="fs-6 fs-sm-4"> ยอดจองทั้งหมด: </span> -->
                                                       <span class="badge bg-danger"><?= $booking_total ?></span>
                                                   </li>
                                               </ul>

                                               <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                                           </div>
                                           <!-- <div class="card-footer text-bg-< ?php echo $bg ?> d-flex justify-content-center">
                                               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal1" id="panel-link">
                                                   More Info
                                               </button>
                                           </div> -->
                                       </div>
                                   <?php
                                    endforeach;
                                    // endfor
                                    ?>

                                   <!-- </div> -->
                               </div>
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