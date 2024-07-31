<?php
@session_start();
require_once '../config.php';
require_once 'auth.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Car Staging | Test</title>


    <!-- Bootstrap 5.3.3 add by Poj-->
    <!-- <link rel="stylesheet" href="../plugins/bootstrap-5.3.3-dist/css/bootstrap.min.css"> -->
    <!-- Custom fonts for this template-->
    <!-- <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="../plugins/fontawesome-free-6.5.1-web/css/all.min.css" type="text/css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <!-- flaticon dist\bootstrap-icons-1.11.3\font\bootstrap-icons.min.css-->
    <link rel="stylesheet" href="../dist/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="../plugins/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- jQuery Timepicker -->
    <link rel="stylesheet" href="../plugins/jquery-timepicker-1.3.5/jquery.timepicker-master.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Custom styles for this template-->
    <!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- mycss -->
    <link rel="stylesheet" href="../plugins/mycss/live.css">
    <link rel="stylesheet" href="../plugins/mycss/scan.css">
    <link rel="stylesheet" href="../plugins/mycss/today.css">

</head>


<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <!-- <body id="page-top" class="hold-transition sidebar-mini layout-fixed"> -->

    <!-- Page Wrapper -->
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="../dist/img/mypic.jpg" alt="mypic" height="60" width="60">
            </div> -->
        <!-- <img class="animation__wobble" src="../dist/img/mypic.jpg" alt="mypic" height="60" width="60"> -->