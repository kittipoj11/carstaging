<?php
function sum($a = 0, $b = 0)
{
    $sum = $a + $b;
    return $sum;
}

function getTimeFromRange($start, $interval = 'PT30M', $end, $format = 'H:i')
{
    $array = array();

    // แบบที่ 1 ส่งค่ามาเป็น DateTime object และ DateInterval object
    // $end->modify('+1 minutes');
    // $period = new DatePeriod($start, $interval, $end);

    //แบบที่ 2 ส่งค่ามาเป็น string
    // Step 1: Setting the Start and End Dates
    $open_time_start = new DateTime($start);
    $open_time_end = new DateTime($end);
    $open_time_end->modify('+1 minutes');

    // Step 2: Defining the Date Interval
    $interval_range = new DateInterval($interval);

    // Step 3: Creating the Date Range
    // $period = new DatePeriod($open_time_start, $interval_range, $open_time_end, DatePeriod::INCLUDE_END_DATE);//ใช้ไม่ได้
    $period = new DatePeriod($open_time_start, $interval_range, $open_time_end);

    foreach ($period as $date) {
        $array[$date->format($format)] = 0;
    }

    return $array;
}

function getBookingData($start, $interval = 'PT30M', $end, $format = 'H:i')
{
    $array = array();

    // แบบที่ 1 ส่งค่ามาเป็น DateTime object และ DateInterval object
    // $end->modify('+1 minutes');
    // $period = new DatePeriod($start, $interval, $end);

    //แบบที่ 2 ส่งค่ามาเป็น string
    // Step 1: Setting the Start and End Dates
    $open_time_start = new DateTime($start);
    $open_time_end = new DateTime($end);
    $open_time_end->modify('+1 minutes');

    // Step 2: Defining the Date Interval
    $interval_range = new DateInterval($interval);

    // Step 3: Creating the Date Range
    // $period = new DatePeriod($open_time_start, $interval_range, $open_time_end, DatePeriod::INCLUDE_END_DATE);//ใช้ไม่ได้
    $period = new DatePeriod($open_time_start, $interval_range, $open_time_end);

    foreach ($period as $date) {
        $array[$date->format($format)] = ["open_slot" => 0, "booking_total" => 0, "come_total" => 0, "cancel_total" => 0];
    }

    return $array;
}

// Not used
function merge_arrayx($arr1, $arr2)
{
    //$newarray = array();
    // print_r($arr1);
    // print_r($arr2);
    $newarray = $arr1;

    foreach ($arr2 as $k => $v) {
        if (isset($newarray[$k])) :
            if (isset($newarray[$k]['open_slot']) && isset($arr2[$k]['open_slot'])) :
                $newarray[$k]['open_slot'] += $v['open_slot'];
            endif;
            if (isset($newarray[$k]['booking_total']) && isset($arr2[$k]['booking_total'])) :
                $newarray[$k]['booking_total'] += $v['booking_total'];
            endif;
            if (isset($newarray[$k]['come_total']) && isset($arr2[$k]['come_total'])) :
                $newarray[$k]['come_total'] += $v['come_total'];
            endif;
            if (isset($newarray[$k]['cancel_total']) && isset($arr2[$k]['cancel_total'])) :
                $newarray[$k]['cancel_total'] += $v['cancel_total'];
            endif;
        endif;
    }
    ksort($newarray);
    // print_r($newarray);

    return $newarray;
}

function merge_2_levels_deep_array($arr1, $arr2)
{
    // รูปแบบ array ที่ส่งมา: array(key=>array(key=>value,key=>value,key=>value,...))
    // array("8:00"=>array("open_slot"=>10,"booking_total"=>20,"come_total"=>30,"cancel_total"=>40))

    //$newarray = array();
    // สร้างตัวแปร array เพื่อสร้าง array ใหม่ที่มีการรวมกันแล้ว
    // โดยกำหนดค่าเริ่มต้นให้เป็น arr1 ก่อน
    $newarray = $arr1;

    // ทำการ Loop $arr2 เพื่อ update ค่าใน $newarray
    foreach ($arr2 as $k1 => $v1) {
        // ตรวจสอบว่า $newarray[$k] มีการ set ค่าไว้หรือไม่
        if (isset($newarray[$k1])) :
            foreach ($v1 as $k2 => $v2) {
                $newarray[$k1][$k2] += $v2;
            }
        endif;
    }
    ksort($newarray);
    // echo "---------------------------------------------- ";
    // echo "<br>";
    // print_r($newarray);
    return $newarray;
}

// create_array_from_mysql
function create_array_from_mysql($mysql)
{
}
function Example()
{
    // -----------------------------------------------------------------------------
    // Example ---------------------------------------------------------------------
    //แบบที่เป็นอาร์เรย์ซ้อนอาร์เรย์
    $array =  array(array('08:00' => 1, '09:00' => 3, '10:00' => 9), array('08:00' => 3, '10:30' => 1, '14:00' => 1), array('09:00' => 1, '14:00' => 5, '15:00' => 2), array('08:30' => 2, '10:00' => 3, '15:00' => 5));
    $newarray = array();
    foreach ($array as $key => $values) {
        foreach ($values as $n_k => $n_v) {
            if (!isset($newarray[$n_k]))
                $newarray[$n_k] = 0;
            $newarray[$n_k] += $n_v;
        }
    }
    print_r($newarray);

    // -----------------------------------------------------------------------------
    //แบบที่เป็นแต่ล่ะอาร์เรย์แยกกัน
    $keys2 = [];
    $a = array("x1" => 1, "x2" => 3, "x5" => 9);
    $b = array("x1" => 3, "x4" => 1, "x5" => 1);
    $c = array("x1" => 1, "x8" => 5, "x5" => 2);
    $d = array("x1" => 2, "x10" => 3, "x5" => 5);

    //สร้างอาร์เรย์ของ key จากอาร์เรย์ทั้งหมดที่ต้องการ
    $keys2 = array_merge($keys2, array_keys($a));
    $keys2 = array_merge($keys2, array_keys($b));
    $keys2 = array_merge($keys2, array_keys($c));
    $keys2 = array_merge($keys2, array_keys($d));

    print_r($keys2);
    echo nl2br("\n");

    //สร้างอาร์เรย์ใหม่โดย sum ค่าที่มี key เหมือนกันจากทุกอาร์เรย์
    $newarray = array();
    foreach ($a as $n_k => $n_v) {
        if (!isset($newarray[$n_k])) $newarray[$n_k] = 0;
        $newarray[$n_k] += $n_v;
    }
    foreach ($b as $n_k => $n_v) {
        if (!isset($newarray[$n_k])) $newarray[$n_k] = 0;
        $newarray[$n_k] += $n_v;
    }
    foreach ($c as $n_k => $n_v) {
        if (!isset($newarray[$n_k])) $newarray[$n_k] = 0;
        $newarray[$n_k] += $n_v;
    }
    foreach ($d as $n_k => $n_v) {
        if (!isset($newarray[$n_k])) $newarray[$n_k] = 0;
        $newarray[$n_k] += $n_v;
    }
    print_r($newarray);

    // -----------------------------------------------------------------------------
    $open_time_start = new DateTime('10:00');
    $open_time_end = new DateTime('16:00');
    $open_time_end->modify('+1 minutes');

    // Step 2: Defining the Date Interval
    $interval = new DateInterval('PT30M');

    // Step 3: Creating the Date Range
    // $date_range = new DatePeriod($open_time_start, $interval, $open_time_end, DatePeriod::INCLUDE_END_DATE);//ใช้ไม่ได้
    $date_range = new DatePeriod($open_time_start, $interval, $open_time_end);
    //var_dump($date_range);
    //print_r($date_range);
    foreach ($date_range as $date) :
        $booking[$date->format('H:i')] = 1;

    // ได้มาจาก tbl_booking
    // $open_time_object =  json_decode($row3['open_time_json']);
    // foreach ($open_time_object as $time) :
    endforeach;
    //print_r($booking);

    $open_area_date = array("08:00" => 1, "08:30" => 2, "09:00" => 3, "09:30" => 4, "10:00" => 5, "10:30" => 6, "11:00" => 7, "11:30" => 8, "12:00" => 9, "12:30" => 10, "13:00" => 11, "13:30" => 12, "14:00" => 13);

    //print_r($open_area_date);

    $newarray = array();
    foreach ($booking as $n_k => $n_v) {
        if (!isset($newarray[$n_k])) $newarray[$n_k] = 0;
        $newarray[$n_k] += $n_v;
    }
    foreach ($open_area_date as $n_k => $n_v) {
        if (!isset($newarray[$n_k])) $newarray[$n_k] = 0;
        $newarray[$n_k] += $n_v;
    }


    //print_r($newarray);

    ksort($newarray);
    print_r($newarray);

    // -----------------------------------------------------------------------------
    $age = ["Peter" => ["4" => "35", "6" => "37", "10" => "39"], "Ben" => ["4" => "20", "6" => "40", "10" => "60"], "Joe" => ["4" => "33", "6" => "44", "10" => "66"]];

    foreach ($age as $x => $x_value) {
        echo "Key=" . $x . ", 4 ล้อ=" . $x_value['4'] . ", 6  ล้อ=" . $x_value['6'] . ", 10  ล้อ =" . $x_value['10'];
        echo "<br>";
    }
}