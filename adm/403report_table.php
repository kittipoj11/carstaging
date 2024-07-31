   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    require_once  '../class/open_area.class.php';
    // // include APP_PATH . '/connect.php';
    $open_area = new OpenArea;
    $rsOpenId = $open_area->getRSOpenId();

    ?>

   <!-- Content Wrapper. Contains page content -->
   <!-- <div id="content-wrapper" class="d-flex flex-column"> -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <h4>รายงานจำนวนรถตามวันในแต่ละช่วงเวลา</h4>
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
                               <h3 class="card-title">ประเภทรถ</h3>
                           </div> -->
                           <!-- /.card-header -->
                           <div class="card-body">
                               <form name="frmReport" id="frmReport">
                                   <div class="d-flex col-12 col-sm-6 p-0">
                                       <div class="input-group input-group-sm mb-2">
                                           <div class="d-flex flex-fill mb-2">
                                               <span class="input-group-text">วันที่จอง:</span>
                                               <input type="date" name="date_start" class="form-control" id="date_start" value="<?php echo date('Y-m-d'); ?>">
                                               <!-- <span class="input-group-text">ถึง</span>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                    value="< ?php echo date('Y-m-d'); ?>"> -->
                                           </div>

                                       </div>
                                   </div>
                                   <div class="d-flex col-12 col-sm-6 align-items-end p-0 mb-3 flex-fill">
                                       <!-- <div class="input-group input-group-sm"> -->
                                       <a name="btnDisplay" id="btnDisplay" class="btn btn-primary ">แสดงรายงาน</a>
                                       <a name="btnPrint" id="btnPrint" class="btn btn-info d-none" target="_blank">พิมพ์รายงาน</a>
                                       <!-- </div> -->
                                   </div>

                               </form>

                               <div class="">
                                   <div class="table-responsive" id="report_data">

                                   </div>
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