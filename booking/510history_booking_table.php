<?php
@session_start();
require_once '../config.php';
require_once 'auth.php';
require_once '../class/booking.class.php';

try {
    $username = $_SESSION['username'];
    $booking = new Booking;
    $rsBookDate = $booking->getRSHistoryBookingDate($username);
    // $rsBookDate = $booking->getRSHistoryBookingDate('cust1');
    // print_r($rsBookDate);
} catch (PDOException $e) {
    echo 'Data not found!';
    print 'e:' . $e->getMessage();
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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../_uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweet Alert2 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- <link rel='stylesheet' href='css/live.css'> -->
    <style>
        .booking-date-title {
            font-family: Courier, "Segoe UI", "Century Gothic", Impact;
            font-weight: bold;
            display: block;
            border: 3px solid black;

            /* background-color: black; */
            background-color: rgba(255, 215, 0, 0.9);
            font-size: 16px;
            color: black;
            text-align: center;
            cursor: default;
        }

        .booking-date {
            font-family: Courier, "Segoe UI", "Century Gothic", Impact;
            font-weight: bold;
            display: block;
            border: 3px solid gold;
            /* background-color: black; */
            background-color: rgba(0, 0, 0, 0.9);
            font-size: 16px;
            color: gold;
            text-align: center;
        }

        .booking-date:hover {
            border: 3px solid black;
            cursor: pointer;
            color: black;
            background-color: rgba(255, 215, 0, 0.9);
        }

        .booking-date:focus,
        .booking-date:active {
            border: 3px solid gold;
            color: black;
            background-color: rgba(255, 215, 0, 0.9);
        }

        .booking-date.pojselected {
            border: 3px solid black;
            color: black;
            background-color: rgba(255, 215, 0, 0.9);
        }

        table,
        th,
        tr,
        td {
            border-style: hidden;
            border-spacing: 2px;
            border-collapse: separate;
        }

        tr {
            border-radius: 5px;
            /* background-color: red; */
            margin-top: 10px;
        }

        th {
            border-radius: 5px;
            background-color: gray;
            margin-top: 10px;
            cursor: default;
        }

        td {
            background: yellowgreen;
            border-radius: 5px;
            /* background-color: aqua; */
            margin-top: 10px;
            cursor: pointer;
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
                    <div class="d-sm-flex align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">ประวัติการจอง</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row border-1 border-dark">
                        <div class="col-4 col-lg-2">
                            <div class="row">

                                <div>
                                    <div class="booking-date-title rounded m-2 p-2">วันที่ทำการจอง</div>
                                    <input type="hidden" name="txtDate" id="txtDate">
                                    <div class="border border-0 border-dark">
                                        <?php
                                        foreach ($rsBookDate as $row) :
                                            $strDate = $row['booking_date'];
                                            $myHtml = "";
                                            $myHtml .= "<div class='booking-date rounded m-3 p-1' name='txt{$strDate}' iid='{$strDate}' data-value='{$strDate}'>";
                                            $myHtml .= $strDate;
                                            $myHtml .= "</div>";
                                            echo $myHtml;
                                        endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-8 col-lg-10">
                            <div class="row">
                                <div class="card m-0 p-0">
                                    <div class="card-body text-primary m-0 p-0">
                                        <div class="container-fluid table-responsive-sm m-0 p-0">
                                            <table class="table table-bordered table-hover bdr m-0 p-0">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th class="text-center">ทะเบียนรถ</th>
                                                        <th class="text-center d-none d-lg-table-cell">ประเภทรถ</th>
                                                        <th class="text-center d-none d-lg-table-cell">ชื่องาน</th>
                                                        <th class="text-center d-none d-lg-table-cell">บูท</th>
                                                        <th class="text-center d-none d-lg-table-cell">อาคาร</th>
                                                        <th class="text-center">พื้นที่ Setup</th>
                                                        <th class="text-center">วันที่จอง</th>
                                                        <th class="text-center">เวลาที่จอง</th>
                                                    </tr>
                                                </thead>
                                                <!-- <form name="frmView" id="frmView" action="" method=""> -->
                                                <tbody id="tbody">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

                <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
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

    <script src='510history_booking.js'></script>
</body>

</html>