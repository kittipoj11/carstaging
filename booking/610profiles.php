<?php
@session_start();

require_once '../config.php';
require_once 'auth.php';
require_once '../class/customer.class.php';
require_once '../class/LineLogin.class.php';
//Car type
$line = new LineLogin();
$state = $line->getState();
$customer = new Customer;

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

    <style>
        .bdr {
            border-radius: 5px;
            overflow: hidden;
        }

        #image-sub img {
            width: 100%;
            object-fit: cover;
        }

        .button {
            /* color: white; */
            /* text-decoration: none; */
            cursor: pointer;
            /* max-width: 160px; */
            /* max-width: 100%; */
            height: 36px;
            /* margin: 0 auto; */
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 5px;
            padding-left: 10px;
            /* border: 1px solid red; */
        }

        #button_line {
            background-color: #06C755;
            /* color: white; */
            /* text-decoration: none; */
            cursor: pointer;
            /* max-width: 160px; */
            max-width: 100%;
            height: 36px;
            margin: 0 auto;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 5px;
            padding-left: 10px;
            /* border: 1px solid red; */
        }

        #button_line:hover {
            background-color: #07ad4c;
            opacity: 0.9;
        }

        #button_line:active {
            background-color: #067935;
            opacity: 0.7;
        }

        #img {
            content: url("../_images/Line_Login_Button_Image/images/DeskTop/1x/32dp/btn_base.png");
            /* margin: auto auto; */
            margin-right: 10px;
        }

        #button_line:hover #img {
            content: url("../_images/Line_Login_Button_Image/images/DeskTop/1x/32dp/btn_hover.png");
            opacity: 0.9;
        }

        #button_line:active #img {
            content: url("../_images/Line_Login_Button_Image/images/DeskTop/1x/32dp/btn_press.png");
            opacity: 0.7;
        }

        #a_line {
            display: flex;
            text-decoration: none;
            /* border: 1px solid red; */
            text-align: center;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .div_text {
            font-family: 'Helvetica', 'sans-serif';
            font-weight: bold;
            font-size: 12px;
            /* background-color: #06C755; */
            color: white;
            /* text-decoration: none; */
            cursor: pointer;
            /* max-width: 160px; */
            max-width: 100%;
            height: 36px;
            /* margin: 0 auto; */
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            border: none;

            /* border-radius: 5px; */
            /* border: 1px solid red; */
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
                <?php
                include "topbar.php";
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-0 text-gray-800">Blank Page</h1> -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">ข้อมูลของฉัน</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="row justify-content-center">
                            <div class="col col-12 col-md-6 border border-1 border-primary rounded">

                                <div class="card m-2 p-0 border border-1 border-success">
                                    <div class="card-body">
                                        <form name="frmEdit" id="frmEdit" action="" method="" class="row g-3 needs-validation" novalidate>
                                            <!-- <input type="text" name="action" id="" value='editdata'> -->

                                            <!-- <div class="col-sm-12"> -->
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text" for="username">Username</label>
                                                            <input type="hidden" class="username" name="username" id="username" value="<?php echo $_SESSION['username'] ?>">
                                                            <input type="input" class="form-control form-control-sm fst-italic username" value="<?php echo $_SESSION['username'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text" for="firstname">Firstname</label>
                                                            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" required />
                                                            <div class="invalid-feedback">
                                                                Please enter a firstname.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text" for="lastname">Lastname</label>
                                                            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" required />
                                                            <div class="invalid-feedback">
                                                                Please enter a lastname.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text" for="address">Address</label>
                                                            <input type="text" name="address" id="address" class="form-control form-control-sm" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text" for="phone">Phone</label>
                                                            <input type="text" name="phone" id="phone" class="form-control form-control-sm" required />
                                                            <div class="invalid-feedback">
                                                                Please enter a phone.
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text" for="email">Email</label>
                                                            <input type="email" name="email" id="email" class="form-control form-control-sm" required />
                                                            <div class="invalid-feedback">
                                                                Please enter a correct email.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-start pt-1">
                                                    <div class="col-sm-4 mb-1">
                                                        <!-- <a type="button" name="btnAddLine" id="btnAddLine" class="btn btn-success btn-md ms-2">เพิ่มเพื่อน</a> -->
                                                        <?php
                                                        if (!isset($_SESSION['profile'])) :
                                                            $link = $line->getLinkAddFriend($state);
                                                            echo "<div id='button_line' class='d-none'><a href='{$link}' id='a_line'><img class='image' id='img'><div class='div_text'>เพิ่มเพื่อน Line</div></a></div>";
                                                        // echo "<div class='button'><a href='http://line.me/ti/p/~U7a2c24d345d2667c442c95c3a34ba241'><img class='image'><div class='div_text'>สมัครสมาชิกด้วย Line</div></a></div>";
                                                        // echo '<a class='button' href='' , $link, ''><img class='image'>เข้าระบบด้วย Line</a>';
                                                        endif;
                                                        ?>
                                                        <!-- <div class="line-it-button" data-lang="th" data-type="friend" data-env="REAL" data-count="true" data-home="true" data-lineId="@605hmuvn" style="display: none;"></div> -->
                                                        <!-- <div class="line-it-button" data-lang="th" data-type="friend" data-env="REAL" data-lineId="@605hmuvn" style="display: none;"></div>
                                    <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script> -->
                                                    </div>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                    <div class="d-flex col-sm-8 justify-content-end pt-1">
                                                        <a class="btn btn-secondary btn-md ms-2 btnClose button">
                                                            <div class='div_text'>ยกเลิก</div>
                                                        </a>
                                                        <!-- <button type="submit" name="signup" id="signup" class="btn btn-warning btn-lg ms-2" data-bs-dismiss="modal" aria-label="Close">Submit form</button> -->
                                                        <a type="button" name="btnUpdateData" id="btnUpdateData" class="btn btn-primary btn-md ms-2 button">
                                                            <div class='div_text'>บันทึก</div>
                                                        </a>


                                                        <!-- <a type="button" name="btnCall" id="btnCall" class="btn btn-primary btn-md ms-2">Test Call</a> -->
                                                    </div>
                                                </div>

                                            </div>
                                        </form>

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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="610profile.js"></script>
</body>

</html>