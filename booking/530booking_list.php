<?php
@session_start();

require_once '../config.php';
require_once 'auth.php';
require_once  '../class/booking.class.php';

$username = $_SESSION['username'];
$booking = new Booking;
$rsBookDate = $booking->getRSBookingDate($username);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="description" content=""> -->
    <!-- <meta name="author" content=""> -->

    <title>Car Staging</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../_uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/booking_list.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../css/counter.css"> -->

    <!-- Sweet Alert2 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <style>
        .className {
            max-width: 100%;
            max-height: 100%;
            bottom: 0;
            left: 0;
            margin: auto;
            overflow: auto;
            position: fixed;
            right: 0;
            top: 0;
            -o-object-fit: contain;
            object-fit: contain;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include "sidebar.php";
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">รายการการจอง</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="d-flex flex-sm-row flex-md-row flex-column">
                        <div class="col col-sm-6 col-md-2">
                            <form action="" method="post" name="frmBooking_list" id="frmBooking_list">
                                <div class="booking-date-title"> วันที่ทำการจอง</div>
                                <div class="">
                                    <?php
                                    foreach ($rsBookDate as $row) :
                                        $strDate = $row['booking_date'];
                                        $myHtml = "";
                                        $myHtml .= "<div class='booking-date' iid='{$strDate}' data-value='{$strDate}'>";
                                        $myHtml .= $strDate;
                                        $myHtml .= "</div>";
                                        echo $myHtml;
                                    endforeach;
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="col col-sm-6 col-md-10">
                            <div class="item-lists">
                                <!-- ส่วนที่แสดง Badge: รายการการจอง -->
                            </div>
                        </div>


                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    $bg = "warning";
    ?>
    <!-- QRcode Modal -->
    <div id="qrcodeModal" class="qrcodeModal">
        <div class="d-flex flex-row align-items-center justify-content-center bg-dark">

            <div class="d-flex flex-column align-items-center justify-content-center bg-dark p-2">
                <p class="w-100 m-0 py-1 rounded-top-1 text-center text-bg-<?php echo $bg ?>">
                    โปรดนำมาแสดงในการเข้าพื้นที่</p>

                <div id="qrcode" class="qrcode">
                    <div class="d-flex justify-content-center">
                        <img id="imgQrCode" class="d-flex" src="">
                    </div>

                    <div class="d-flex w-100 justify-content-center">
                        <a id="aDownload" href="" class="btn btn-block m-0 p-0 rounded-0 text-center text-bg-<?php echo $bg ?>" download="">Download</a>
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-evenly align-items-stretch w-100">
                    <a class="btn btn-success flex-grow-1" onclick='javascript:print()' style="border-bottom-left-radius: 0.5rem;border-bottom-right-radius: 0rem;border-top-left-radius: 0;border-top-right-radius: 0;">Print</a>
                    <a class="btn btn-secondary flex-grow-1" id="btnClose" style="border-bottom-left-radius: 0rem; border-bottom-right-radius: 0.5rem;border-top-left-radius: 0;border-top-right-radius: 0;">Close</a>

                    <!-- <input type='button' onclick='javascript:print()' value='พิมพ์'> -->
                </div>

            </div>

            <div id="qrdetail" class="d-md-flex d-none  flex-column align-items-center justify-content-center bg-dark p-2">
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="530booking_list.js"></script>
</body>

</html>