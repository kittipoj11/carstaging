<?php
// session_start();
// require_once '../config.php';
require_once '../class/booking.class.php';

try {
    $booking = new Booking;
    $booking->updateStatus($_POST['id'], $_POST['status']);

    $_SESSION['live_status'] =  "id={$_POST['id']} / status=[{$_POST['status']}]: >>>Data updated successfully.";

    // foreach ($rsData as $datarow) {
    //     $myHtml .= '<div>' . $datarow['queue_number'] . '<sup><br>' . $datarow['car_license_number'] . '</sup></div>';
    // }
    echo "success";
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
