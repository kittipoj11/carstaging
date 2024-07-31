<?php
@session_start();
// require $_SERVER['DOCUMENT_ROOT'] . '/myProject/_carstaging_test/auth.php';
require_once '../config.php';
require_once  '../class/open_area.class.php';
require_once  '../class/booking.class.php';

try {
    $open_area = new OpenArea;
    $rsData = $open_area->getRSOpenTimeJson($_REQUEST);
    $booking = new Booking;
    $rsBookingTime = $booking->getBookingTime($_REQUEST);

    $book_time = [];
    foreach ($rsData as $row) :
        // ทำการรวมเวลาหลายๆช่วงให้อยู่ในตัวแปรอาร์เรย์เดียว
        $book_time = array_merge($book_time, json_decode($row['open_time_json'], TRUE));
    endforeach;
    // $book_time = json_decode($rsData[0]['open_time_json'], TRUE);
    // $_SESSION['book_time']= $book_time;
    // var_dump($book_time);

    $is_success = true;
    $myHtml = '';
    $myHtml .= '<div class="TimeSection">';

    foreach ($rsData as $row) :
        // ต้องแก้ไขเมื่อมีการดึงข้อมูลมามากกว่า 1 row /แก้ไขแล้ว
        // กำหนดช่วงเวลา($period) ในการสร้างปุ่มให้เลือกเวลา
        $open_time_start = new DateTime($row['open_time_start']);
        $open_time_end = new DateTime($row['open_time_end']);
        $take_time_minutes = $row['take_time_minutes'] * -1;
        $open_time_end->modify($take_time_minutes . ' minutes');
        $open_time_end->modify('+1 minutes');
        $interval = new DateInterval('PT30M'); //P=period 30 นาที, PT=period time
        // or $interval = DateInterval::createFromDateString('30 minute');

        // Disabled ปุ่ม
        // กำหนดช่วงเวลาที่ทำให้ปุ่มเลือกเวลาเป็น disabled($period_disabled) ในการสร้างปุ่มให้เลือกเวลา
        // echo "take_time_minutes = {$take_time_minutes} \n";
        foreach ($rsBookingTime as $row) :
            // echo "booking_time = {$row['booking_time']} \n";
            $booking_time_start = new DateTime($row['booking_time']);
            $booking_time_start->modify(-180 . ' minutes');
            // echo "booking_time_start = {$booking_time_start->format("H:i")} \n";
            $booking_time_end = new DateTime($row['booking_time']);
            $booking_time_end->modify((($take_time_minutes * -1) + 180) . ' minutes');
            // $booking_time_end->modify('+1 minutes');
            // echo "booking_time_end = {$booking_time_end->format("H:i")} \n";
            $interval_disable = new DateInterval('PT10M'); //P=period 30 นาที, PT=period time
            // or $interval_disable = DateInterval::createFromDateString('30 minute');
            $period_disable = new DatePeriod($booking_time_start, $interval_disable, $booking_time_end);
            foreach ($period_disable as $time) :
                $book_time[$time->format("H:i")] = 0;
            endforeach;
        endforeach;
        
        // ใช้กับ PHP 8.2 -> $period = new DatePeriod($open_time_start, $interval, $open_time_end, DatePeriod::INCLUDE_END_DATE);
        $period = new DatePeriod($open_time_start, $interval, $open_time_end);

        foreach ($period as $time) :
            // var_dump($book_time);
            if ($book_time[$time->format("H:i")] <= 0) :
                $myHtml .= '<div class="pojTimeInactive" name="txt' . $time->format("H:i") . '" id="txt' . $time->format("H:i") . '" class="value" data-value="' . $time->format("H:i") . '" iid="' . $time->format("H:i") . '">';
            else :
                // echo $time->format("H:i") . 'remian' . $book_time[$time->format("H:i")] . "<br>";
                $myHtml .= '<div class="pojTime" name="txt' . $time->format("H:i") . '" id="txt' . $time->format("H:i") . '" class="value" data-value="' . $time->format("H:i") . '" iid="' . $time->format("H:i") . '">';
            endif;

            $myHtml .= $time->format("H:i");
            $myHtml .= '</div>';
        endforeach;
    endforeach;

    $myHtml .= '</div>';

    echo $myHtml;
} catch (PDOException $e) {
    // echo "error exe open_date >>>" . $open_date . "<br>";
    $is_success = false;
    echo 'false';
}

// } 