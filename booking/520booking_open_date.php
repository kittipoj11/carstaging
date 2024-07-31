<?php
@session_start();
// require $_SERVER['DOCUMENT_ROOT'] . '/myProject/_carstaging_test/auth.php';
require_once '../config.php';
require_once '../class/open_area.class.php';

//ข้อมูลที่ส่งมาจากหน้า booking: หลังจากกดปุ่ม btnSelectDateTime
try {
    $open_area = new OpenArea;
    $rsDataHeader = $open_area->getRSOpenDate($_REQUEST);

    $is_success = true;
    $myHtml = '';
    if (count($rsDataHeader) > 0) {
        $open_date = new DateTime($rsDataHeader[0]['open_date']);

        // echo  '<script>alert(' . print_r($rsDataHeader) . ');</script>';

        $monthName = $open_date->format('M.');

        $myHtml = '<div class="DateSectionHead" id="myDivMonth">';
        $myHtml .= $monthName;
        $myHtml .= '</div>';
        $myHtml .= '<div class="DaySection">';
        foreach ($rsDataHeader as $datarow) {
            unset($open_date);
            $open_date = new DateTime($datarow['open_date']);
            $day = $open_date->format('j');
            $dayAbbr = $open_date->format('D');
            $open_date_string = $open_date->format('Y-m-d');

            $myHtml .= '<div class="pojDay" name="txt' . $open_date_string . '" id="txt' . $open_date_string . '" iid="' . $open_date_string . '" data-value="' . $open_date_string . '">';
            $myHtml .= '<div><sup>' . $dayAbbr . '</sup><br></div>' . $day;
            $myHtml .= '</div>';
        }
        $myHtml .= '</div>';
    } else {
        $myHtml = '<div class="DateSectionHead" id="myDivMonth">';
        $myHtml .= 'ยังไม่เปิดพื้นที่ให้จองหรือไม่สามารถจองพื้นที่ซ้ำวันได้';
        $myHtml .= '</div>';
    }
    echo $myHtml;
} catch (PDOException $e) {
    // echo "error exe open_date >>>" . $open_date . "<br>";
    //$e->getCode()." >>>" . $e->getMessage();
    $_SESSION['execute'] =  ">>> " .    $e->getCode() . " >>>" . $e->getMessage();
    $is_success = false;
    echo 'ยังไม่เปิดพื้นที่ให้จองหรือไม่สามารถจองพื้นที่ซ้ำวันได้';
}


// } 