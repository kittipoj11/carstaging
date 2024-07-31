<?php
@session_start();

require_once 'config.php';
require_once 'class/booking.class.php';

try {

    $booking = new Booking;
    $rsTodayBooking = $booking->getRsTodayBooking();
} catch (PDOException $e) {
    echo 'Data not found!';
}

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/activity.css" rel="stylesheet">
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
                <?php
                include "topbar.php";
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-0 text-gray-800">Blank Page</h1> -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Loading Info</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
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

                            // for ($x = 1; $x <= 12; $x++) :
                            //     $building_name = "";
                            //     if (rand(0, 1) == 1) :
                            //         $bg = "success";
                            //     else :
                            //         $bg = "secondary";
                            //         continue;
                            //     endif;

                            //     $booking_total = rand(200, 500);
                            //     $total_slot = rand(50, 100);
                            //     $loading_slot = rand(0, $total_slot);
                            //     $available_slot = $total_slot - $loading_slot;
                            //     $waiting = rand(0, $booking_total - $loading_slot);
                            //     $complete = rand(0, $booking_total - ($loading_slot + $waiting));
                            //     switch ($x):
                            //         case 1:
                            //         case 2:
                            //         case 3:
                            //             $building_name = "Imact Challenger";
                            //             break;
                            //         case 4:
                            //             $building_name = "Impact Forum";
                            //             break;
                            //         default:
                            //             $building_name = "Impact Exhibition";
                            //     endswitch;
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
                                            <i class="fa fa-braille"><span class="d-none d-sm-inline"> ช่องโหลดว่าง:
                                                </span></i>

                                            <!-- <span class="fs-6 fs-sm-4"> ช่องโหลดว่าง: </span> -->
                                            <span class="badge bg-danger rounded-pill"><?= $available_slot ?></span>
                                        </li>
                                        <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                            <i class="fa fa-hourglass-half"><span class="d-none d-sm-inline">
                                                    รอเรียกคิว:
                                                </span></i>

                                            <!-- <span class="fs-6 fs-sm-4"> รอ Load: </span> -->
                                            <span class="badge bg-danger rounded-pill"><?= $waiting ?></span>
                                        </li>
                                        <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                            <i class="fa fa-bullhorn"><span class="d-none d-sm-inline"> กำลังเรียก:
                                                </span></i>

                                            <!-- <span class="fs-6 fs-sm-4"> กำลังเรียก: </span> -->
                                            <span class="badge bg-danger rounded-pill"><?= $calling ?></span>
                                        </li>
                                        <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                            <i class="fa fa-truck-loading"><span class="d-none d-sm-inline"> กำลัง Load:
                                                </span></i>

                                            <!-- <span class="fs-6 fs-sm-4"> กำลัง Load: </span> -->
                                            <span class="badge bg-danger rounded-pill"><?= $loading_slot ?></span>
                                        </li>
                                        <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                            <i class="fa fa-flag-checkered"><span class="d-none d-sm-inline"> Load
                                                    เสร็จแล้ว: </span></i>

                                            <!-- <span class="fs-6 fs-sm-4"> Load เสร็จแล้ว: </span> -->
                                            <span class="badge bg-danger rounded-pill"><?= $complete ?></span>
                                        </li>
                                        <li class="list-group-item list-group-item-<?php echo $bg ?> d-flex justify-content-between">
                                            <i class="fa fa-car"><span class="d-none d-sm-inline"> ยอดจองทั้งหมด:
                                                </span></i>

                                            <!-- <span class="fs-6 fs-sm-4"> ยอดจองทั้งหมด: </span> -->
                                            <span class="badge bg-danger rounded-pill"><?= $booking_total ?></span>
                                        </li>
                                    </ul>

                                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                                </div>
                                <div class="card-footer text-bg-<?php echo $bg ?> d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal1" id="panel-link">
                                        More Info
                                    </button>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        // endfor
                        ?>

                        <!-- </div> -->
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include "footer.php";
            ?>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>