<?php
@session_start();

require_once '../config.php';
require_once 'auth.php';
require_once  '../class/customer.class.php';

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

    <script>
        var check = function() {
            if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = '';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }
    </script>

    <style>
        .bdr {
            border-radius: 5px;
            overflow: hidden;
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">เปลี่ยนรหัสผ่าน</h1>
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
                                                <input type="hidden" class="username" name="username" id="username" value="<?php echo $_SESSION['username'] ?>">

                                                <div class="row">
                                                    <div class="mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text col-sm-6" for="password">Password</label>
                                                            <input type="password" name="password" id="password" class="form-control" onkeyup='check();' required />
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="mb-1">
                                                        <div class="input-group input-group-sm mb-2">
                                                            <label class="input-group-text col-sm-6" for="confirm_password">Confirm password</label>
                                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" onkeyup='check();' required />
                                                            <div id='message' class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end pt-1">
                                                    <a type="button" name="btnChangePassword" id="btnChangePassword" class="btn btn-primary btn-md ms-2">ตกลง</a>
                                                    <a type="button" class="btn btn-secondary btn-md ms-2 btnClose">ยกเลิก</a>
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