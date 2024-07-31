<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="description" content=""> -->
    <!-- <meta name="author" content=""> -->

    <title>Car Staging</title>

    <!-- Bootstrap 5 add by Poj-->
    <link rel="stylesheet" href="../plugins/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../plugins/fontawesome-free-6.5.1-web/css/all.min.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- flaticon -->
    <link rel="stylesheet" href="../plugins/uicons-regular-rounded/css/uicons-regular-rounded.css">

    <!-- sb-admin-2 template-->
    <link rel="stylesheet" href="../css/sb-admin-2.min.css">


    <style>
        * {
            margin: 0;
            padding: 0;
            /* border: 1px red; */
            box-sizing: border-box;
        }

        html,
        body {
            /* height: 100vh;
            width: 100%;
            background-color: #fbfbfb; */
            height: 100%;
        }

        .impact-image {
            /* background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)), url("../_images/impact-muang-thong-thani.png"); */
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)), url("../_images/impact_muangthong.jpg");
            /* height: 100%; */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* .impact-image {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
        } */

        #image-sub {
            /* border: 1px solid red; */
            height: 20%;
            /* position: absolute; */
            /* left: 0; */
            /* bottom: 0; */
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        .navbar-custom {
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar-custom .navbar-brand {
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 0.1rem;
            font-weight: 700;
        }

        .navbar-custom .navbar-nav .nav-item .nav-link {
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.1rem;
        }
    </style>
</head>


<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top"> 
    <div class="text-end">
        <a href="#" type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginForm">ลงชื่อเข้าใช้</a>
    </div>        
    -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <a class="navbar-brand" href="http://www.impact.co.th/">
                <img src="../_images/logo-impact.svg" alt="Impact" width="100px" class="d-inline-block align-text-top">
            </a>

            <!-- Hamburger bar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item"><a class="nav-link" href="#!">Sign
                            Up</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#loginForm">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column  justify-content-end align-items-center min-vh-100 impact-image p-5">
        <!-- <div class="p-4 p-md-5 mx-3 mt-2 text-bg-dark impact-image"> -->
        <!-- <h1 class="display-4 fw-bold text-body-emphasis">Centered screenshot</h1> -->
        <div class="row text-start text-bg-dark bg-transparent">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic fw-bold">Car Staging</h1>
                <p class="lead my-3 ">
                    Car Staging
                    เป็นระบบการจองคิวในการนำรถเข้ามาเพื่อขนถ่ายสินค้าและอุปกรณ์ตามวันและเวลาในการจองคิวไว้
                    และทำให้ลดความแออัดของการจราจรภายในเมืองทองได้
                </p>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-evenly text-start text-bg-dark bg-transparent min-vw-100">
                <div class="col">
                    <img src="../_images/impact_chalenger1.jpg" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <img src="../_images/impact_forum1.jpg" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <img src="../_images/impact_exhibition1.jpg" class="card-img-top" alt="...">
                </div>

            </div>

        </div>
    </div>

    <!-- ส่วน footer -->
    <div class="row d-sm-flex fixed-bottom">
        <div class="col col-sm-12">
            <?php include 'footer.php' ?>

        </div>
    </div>

    <!-- Modal: Login Form -->
    <div class="modal fade" id="loginForm" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <div class="modal-content opacity-75"> -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LoginModalLabel">ลงชื่อเข้าใช้</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="frmLogin" id="frmLogin" action="check_login.php" method="POST">
                        <!-- Username input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="username">User Name</label>
                            <input type="text" name="username" id="username" class="form-control" autocomplete="off" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>

                        <div class="form-outline mb-2">
                            <!-- Submit button -->
                            <button type="submit" name="login" id="login" class="btn btn-primary btn-block form-control">Log in</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
    </script>

    <script src="_js/jquery-3.7.0.min.js"></script>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 add by Poj-->
    <script src="../plugins/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- <script src="../vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="index.js"></script>

</body>

</html>