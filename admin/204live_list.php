<?php
// @session_start();
// require_once 'config.php';
require_once '../class/booking.class.php';


try {
    $hall_id = $_POST['hall_id'];
    $status = $_POST['status'];
    $_SESSION['hall-id'] = $_POST['hall_id'];
    $booking = new Booking;
    $rsHall = $booking->getRSHallToday();
    $rsWaiting = $booking->getRSBookingToday($hall_id, 1);
    $rsCalling = $booking->getRSBookingToday($hall_id, 2);
    $rsAccept = $booking->getRSBookingToday($hall_id, 3);
    $rsLoading = $booking->getRSBookingToday($hall_id, 4);

    $myHtml = '';
    if ($status == 1) :
        //  กล่อง waiting 
        foreach ($rsWaiting as $row) :
            $myHtml .= '<div class="div-item-waiting border border-1 border-dark rounded m-2 btn-outline-danger" id=' . $row['id'] . '>';
            $myHtml .= '<label class="" for="' . $row['id'] . '">';
            $myHtml .= '<h5>คิว: ' . $row['queue_number'] . '</h5>';
            $myHtml .= 'ทะเบียนรถ: ' . $row['car_license_number'];
            $myHtml .= '<sup>';
            $myHtml .= '<br>[' . $row['car_type_name'] . ']';
            $myHtml .= '</sup>';
            $myHtml .= '</label>';
            $myHtml .= '<i class="fa-solid fa-bullhorn btn-call"></i>';
            $myHtml .= '</div>';
        endforeach;
    elseif ($status == 2) :
        //  กล่อง calling 
        foreach ($rsCalling as $row) :
            $myHtml .= '<div class="div-item-calling border border-1 border-dark rounded m-2 btn-outline-warning" id=' . $row['id'] . '>';
            $myHtml .= '<label class="" for="' . $row['id'] . '">';
            $myHtml .= '<h5>คิว: ' . $row['queue_number'] . '</h5>';
            $myHtml .= 'ทะเบียนรถ: ' . $row['car_license_number'];
            $myHtml .= '<sup>';
            $myHtml .= '<br>[' . $row['car_type_name'] . ']';
            $myHtml .= '</sup>';
            $myHtml .= '</label>';
            $myHtml .= '<i class="fa-solid fa-right-to-bracket btn-load"></i>';
            $myHtml .= '</div>';
        endforeach;

        foreach ($rsAccept as $row) :
            $myHtml .= '<div class="div-item-calling border border-1 border-dark rounded m-2 btn-outline-warning" id=' . $row['id'] . '>';
            $myHtml .= '<label class="" for="' . $row['id'] . '">';
            $myHtml .= '<h5>คิว: ' . $row['queue_number'] . '</h5>';
            $myHtml .= 'ทะเบียนรถ: ' . $row['car_license_number'];
            $myHtml .= '<sup>';
            $myHtml .= '<br>[' . $row['car_type_name'] . ']';
            $myHtml .= '</sup>';
            $myHtml .= '</label>';
            $myHtml .= '<i class="fa-solid fa-right-to-bracket btn-load"></i>';
            $myHtml .= '</div>';
        endforeach;
    elseif ($status == 4) :
        // กล่อง loading
        foreach ($rsLoading as $row) :
            $myHtml .= '<div class="div-item-loading border border-1 border-dark rounded m-2 btn-outline-success" id=' . $row['id'] . '>';
            $myHtml .= '<label class="" for="' . $row['id'] . '">';
            $myHtml .= '<h5>คิว: ' . $row['queue_number'] . '</h5>';
            $myHtml .= 'ทะเบียนรถ: ' . $row['car_license_number'];
            $myHtml .= '<sup>';
            $myHtml .= '<br>[' . $row['car_type_name'] . ']';
            $myHtml .= '</sup>';
            $myHtml .= '</label>';
            $myHtml .= '<i class="fa-solid fa-right-from-bracket btn-complete"></i>';
            $myHtml .= '</div>';
        endforeach;

    else :
    endif;
    echo $myHtml;
} catch (PDOException $e) {
    $_SESSION['live_list'] = 'error >>> ' . $e->getCode() . " === " . $e->getMessage();
    $is_success = false;
    echo 'false';
}

// }