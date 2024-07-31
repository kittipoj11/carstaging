<?php
@session_start();

// include('library/php_qr_code/qrlib.php'); // Include a library for PHP QR code
require_once 'library/php_qr_code/qrlib.php'; // Include a library for PHP QR code

$qr_code_file_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'qr_assets' . DIRECTORY_SEPARATOR;
$set_qr_code_path = 'qr_assets/';

// If directory is not created, the create a new directory 
if (!file_exists($qr_code_file_path)) {
	mkdir($qr_code_file_path);
}

//Set a file name of each generated QR code
$filename	=	time() . '.png';
// $data	=	'Nathapat Soontornpurmsap';
$data = $_POST['ref_json'];

$errorCorrectionLevel = 'L';
$matrixPointSize = 4;

// After getting all the data, now pass all the value to generate QR code.
QRcode::png($data, $qr_code_file_path . $filename, $errorCorrectionLevel, $matrixPointSize, 2);
// echo $filename; //Error: Not allowed to load local resource -> D:\xampp\htdocs\myProject\_car_staging\booking\qr_assets\1695367688.png

echo $set_qr_code_path . $filename;
