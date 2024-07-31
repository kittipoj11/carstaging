<?php
session_start();

require_once '../config.php';
require_once '../class/LineLogin.class.php';

$line = new LineLogin();
$state = $line->getState();
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- <meta name="description" content=""> -->
        <!-- <meta name="author" content=""> -->

        <title>Car Staging Booking</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link href="../_uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Sweet Alert2 -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script> -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

        <!-- <link rel="stylesheet" href="_css/login.css"> -->
        <!-- <link rel="stylesheet" href="_css/styles.css" /> -->

        <script>
        var check = function() {
            // console.log(document.getElementById('enter_password').value);
            // console.log(document.getElementById('confirm_password').value);
            if (document.getElementById('enter_password').value == document.getElementById('confirm_password')
                .value) {
                // console.log('EQ');
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = '';
            } else {
                // console.log('Not EQ');
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }
        </script>

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
            /* background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)), url("_images/impact-muang-thong-thani.png"); */
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

        #button {
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
        }

        #button_logout {
            background-color: #06C755;
            /* color: white; */
            /* text-decoration: none; */
            cursor: pointer;
            /* max-width: 160px; */
            max-width: 100%;
            height: 36px;
            /* margin: 0 0 50px 0; */
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 5px;
            padding-left: 10px;
            /* border: 1px solid blue; */
        }

        #button:hover {
            background-color: #07ad4c;
            opacity: 0.9;
        }

        #button:active {
            background-color: #067935;
            opacity: 0.7;
        }

        #img {
            content: url("_images/Line_Login_Button_Image/images/DeskTop/1x/32dp/btn_base.png");
            /* margin: auto auto; */
            margin-right: 10px;
        }

        #button:hover #img {
            content: url("_images/Line_Login_Button_Image/images/DeskTop/1x/32dp/btn_hover.png");
            opacity: 0.9;
        }

        #button:active #img {
            content: url("_images/Line_Login_Button_Image/images/DeskTop/1x/32dp/btn_press.png");
            opacity: 0.7;
        }

        #lineSignin,
        #lineSignup {
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


    <body>
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="http://www.impact.co.th/">
                    <img src="../_images/logo-impact.svg" alt="Impact" width="100px"
                        class="d-inline-block align-text-top">
                </a>

                <!-- Hamburger bar -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#!" data-bs-toggle="modal"
                                data-bs-target="#registrationForm">Sign Up</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!" data-bs-toggle="modal"
                                data-bs-target="#loginForm">Sign In</a></li>
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
                    <!-- <div class="col-lg-6"> -->
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
                            <div class="col-sm-12 d-none d-md-block mb-4" id="image-sub">
                                <img src="../_images/impact-muang-thong-thani.png" class="img-fluid rounded-2" />
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-2">
                                <label class="form-label" for="username">User Name</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    autocomplete="off" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-2">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>

                            <div class="form-outline my-3">
                                <!-- Submit button -->
                                <button type="submit" name="signin" id="signin"
                                    class="btn btn-primary btn-block form-control div_text">เข้าสู่ระบบ</button>
                            </div>
                        </form>

                        <div class="mb-4 align-items-center d-flex justify-content-center">
                            <div class="w-50 border border-2 border-dark-subtle border-opacity-10"></div>
                            <small class="text-black-50 py-0 px-3 text-uppercas">หรือ</small>
                            <div class="w-50 border border-2 border-dark-subtle border-opacity-10"></div>
                        </div>
                        <div id='button'>
                            <?php
                        if (!isset($_SESSION['profile'])) :
                            $_SESSION['line_event'] = 'signin';
                            $link = $line->getLink($state);
                            echo "
                                <a href='{$link}' id='lineSignin'>
                                    <img class='image' id='img'>
                                    <div class='div_text'>เข้าสู่ระบบด้วย Line</div>
                                </a>";
                        endif;
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Registration Form -->
        <div class="modal fade modal-md" id="registrationForm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">สร้างบัญชีผู้ใช้งานใหม่</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmMemberRegistration" id="frmMemberRegistration" action="" method=""
                            class="row g-3 needs-validation" novalidate>
                            <!-- <input type="hidden" name="action" id="" value='insertdata'> -->
                            <!-- <div class="col-sm-12 d-none d-md-block" id="image-sub" style="border:1px solid gray;"> -->
                            <div class="col-sm-12 d-none d-md-block mb-3" id="image-sub">
                                <img src="../_images/impact-muang-thong-thani.png" class="img-fluid rounded-2" />
                            </div>

                            <!-- <div class="col-sm-12"> -->
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12 mb-1">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text" for="firstname">Firstname</label>
                                            <input type="text" name="firstname" id="firstname"
                                                class="form-control form-control-sm" required />
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
                                            <input type="text" name="lastname" id="lastname"
                                                class="form-control form-control-sm" required />
                                            <div class="invalid-feedback">
                                                Please enter a lastname.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-1">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text" for="username">Username</label>
                                            <input type="text" name="username" id="username"
                                                class="form-control form-control-sm" required />
                                            <div class="invalid-feedback">
                                                Please enter a username.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-1">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text" for="password">Password</label>
                                            <!-- <input type="password" name="password" id="password" class="form-control form-control-sm" onkeyup='check();' required /> -->
                                            <input type="text" name="enter_password" id="enter_password"
                                                class="form-control form-control-sm" onkeyup='check();' required />
                                            <div class="invalid-feedback">
                                                Please enter a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-1">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text" for="confirm_password">Confirm
                                                password</label>
                                            <!-- <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm" onkeyup='check();' required /> -->
                                            <input type="text" name="confirm_password" id="confirm_password"
                                                class="form-control form-control-sm" onkeyup='check();' required />
                                            <div id='message' class="invalid-feedback">
                                                Please enter a confirm password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline my-3">
                                    <!-- Submit button -->
                                    <button type="submit" name="login" id="login"
                                        class="btn btn-primary btn-block form-control div_text">สมัครสมาชิก</button>
                                </div>
                        </form>

                        <div class="mb-4 align-items-center d-flex justify-content-center">
                            <div class="w-50 border border-2 border-dark-subtle border-opacity-10"></div>
                            <small class="text-black-50 py-0 px-3 text-uppercas">หรือ</small>
                            <div class="w-50 border border-2 border-dark-subtle border-opacity-10"></div>
                        </div>

                        <?php
                    if (!isset($_SESSION['profile'])) :
                        $_SESSION['line_event'] = 'addfriend';

                        $link = $line->getLinkAddFriend($state);
                        echo "<div id='button'>
                                <a href='{$link}' id='lineSignup'>
                                    <img class='image' id='img'>
                                    <div class='div_text'>สมัครสมาชิกด้วย Line</div>
                                </a>
                            </div>";
                    // echo "<div class='button'><a href='{$link}'><img class='image'><div class='div_text'>สมัครสมาชิกด้วย Line</div></a></div>";
                    // echo '<a class='button' href='' , $link, ''><img class='image'>สมัครสมาชิกด้วย Line</a>';
                    endif;
                    ?>


                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
        </script>

        <script src="../_js/jquery-3.7.0.min.js"></script>


        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin-2.min.js"></script>
        <script src="signinup.js"></script>

        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        </script>

        <script>
        $(document).ready(function() {
            // Open modal on page load
            // $("#registrationForm").modal('show');

            // Close modal on button click
            $(".signup").click(function() {
                $("#registrationForm").modal('hide');
            });
        });
        </script>

    </body>

</html>