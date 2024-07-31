   <?php
    // require_once '../config.php';
    // require_once '../auth.php';
    $status = $_GET['next_status'];

    ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
           <div class="container-fluid">
               <div class="row mb-2">
                   <div class="col-sm-6 d-flex">
                       <?php if ($status == 1) : ?>
                           <h1>Scan เข้ามาในพื้นที่ </h1>
                       <?php elseif ($status == 4) : ?>
                           <h1>Scan เข้าช่องโหลด</h1>
                       <?php elseif ($status == 5) : ?>
                           <h1>Scan ออกจากช่องโหลด</h1>
                           <!-- < ?php else : ?> -->
                           <!-- <h5>Scan N/A...</h5> -->
                       <?php endif; ?>
                   </div>
               </div>
           </div><!-- /.container-fluid -->
       </section>

       <!-- Main content -->
       <section class="content">
           <div class="container-fluid">

               <!-- Content Row -->
               <div class="row">
                   <form action="#" method="post" id="frmQrcode">
                       <div class="wrap-qrcode-scanner">
                           <!-- <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div> -->
                           <div id="loadingMessage">🎥 Loading video stream (please make sure you have a webcam
                               enabled)</div>
                           <canvas id="canvas" hidden></canvas>
                           <div id="output" hidden>
                               <!-- <div id="outputMessage">No QR code detected.</div> -->
                               <!-- <div hidden><b>Data:</b> <span id="outputData"></span></div> -->
                               <!-- <div><b>Result:</b> <span id="outputResult"></span></div> -->
                               <div id="outputMessage"></div>
                               <div hidden><span id="outputData"></span></div>
                               <div>
                                   <span class='outputResult' id="outputResultx">
                                   </span>
                               </div>
                           </div>
                           <audio id="beepsound" controls>
                               <source src="sound/scanner-beeps-barcode.mp3" type="audio/mpeg">
                               Your browser does not support the audio tag.
                           </audio>
                           <img id="outputqrcode">
                           <canvas id="canvas2"></canvas>
                           <!-- <input type="text" name="txtStatus" id="txtStatus" value="< ?= $_GET[' status']; ?>"> -->
                           <input type="hidden" name="txtStatus" id="txtStatus" value="<?= $status ?>">
                       </div>
                   </form>

                   <!-- QR Detail Modal -->
                   <div class="modal fade" id="modalQrdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered outputResult">
                           <div class="modal-content text-bg-success">
                               <div class="modal-header">
                                   <h1 class="modal-title fs-5" id="modal">ข้อมูลคิว</h1>
                                   <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                               </div>

                               <div class="modal-body">

                               </div>
                               <button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>
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