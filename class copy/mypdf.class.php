<?php
// เรียกไฟล์ TCPDF Library เข้ามาใช้งาน กำหนดที่อยู่ตามที่แตกไฟล์ไว้
require_once('../tcpdf/tcpdf.php');

// สร้าง Class ใหม่ขึ้นมา กำหนดให้สืบทอดจาก Class ของ TCPDF
class MYPDF extends TCPDF
{
    // สร้าง function ชื่อ Header สำหรับปรับแต่งการแสดงผลในส่วนหัวของเอกสาร
    public function Header_old()
    {
        // สร้างคำสั่ง HTML ในตัวอย่างนี้ สร้างตาราง 2 คอลัมน์ 
        // คอลัมน์แรก สำหรับแสดงรูปภาพ คำสั่ง HTML แสดงรูปภาพและต้องใช้ URL แบบเต็ม
        // คอลัมน์ที่สอง สำหรับแสดงข้อความ
        $html = '<table><tr>'
            . '<td width="70"><img src="http://Nathapat.com/images/info/Nathapat.png" width="60" /></td>'
            . '<td width="400" align="center"><h3>This is HTML</h3><p>Custom Header With HTML</p></td></tr>'
            . '</table><hr />';
        $this->writeHTMLCell('', '', '', '', $html);
    }

    // สร้าง function ชื่อ Footer สำหรับปรับแต่งการแสดงผลในส่วนท้ายของเอกสาร
    public function Footer_old()
    {
        // กำหนดตำแหน่งที่จะแสดงรูปภาพและข้อความ 15mm นับจากท้ายเอกสาร
        $this->SetY(-15);
        // คำสั่งสำหรับแทรกรูปภาพ กำหนดที่อยู่ไฟล์รูปภาพในเครื่องของเรา
        $this->Image('tcpdf_logo.png');

        // สำหรับตัวอักษรที่จะใช้คือ helvetica เป็นตัวหนา และขนาดอักษรคือ 10
        $this->SetFont('helvetica', 'B', 10);
        // คำสั่งสำหรับแสดงข้อความ โดยกำหนด ความกว้าง และ ความสูงของข้อความได้ใน 2 ช่องแรก
        // ช่องที่ 3 คือข้อความที่แสดง ส่วนค่า C คือ กำหนดให้แสดงข้อความตรงกลาง
        $this->Cell('', '', 'By Nathapat.com', 0, false, 'C');

        // สำหรับตัวอักษรที่จะใช้คือ helvetica เป็นตัวเอียง และขนาดอักษรคือ 8
        $this->SetFont('helvetica', 'I', 8);
        // คำสั่งสำหรับแสดงข้อความ โดยกำหนด ความกว้าง และ ความสูงของข้อความได้ใน 2 ช่องแรก
        // ช่องที่ 3 คือข้อความที่แสดง $this->getAliasNumPage() คือ หมายเลขหน้าปัจจุบัน และ $this->getAliasNbPages() จำนวนหน้าทั้งหมด
        // ส่วนค่า R คือ กำหนดให้แสดงข้อความชิดขวา
        $this->Cell('', '', 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R');
    }

    public function Header()
    {
        $this->SetFont('dejavusans', '', 14);
        $title = utf8_encode('title');
        $subtitle = utf8_encode('sub title');
        $this->SetHeaderMargin(40);
        $this->Line(15, 23, 405, 23);
    }

    public function Footer()
    {
        $this->SetFont('dejavusans', '', 8);
        $this->Cell(0, 5, 'Pag ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

    public static function makeHTML($json)
    {
        $html = '<table border="0.5" cellspacing="0" cellpadding="4">
        <tr>
            <th bgcolor="#DAB926" style="text-align:left"><strong>Name</strong></th>      
        </tr>';
        for ($i = 0; $i < count($json); $i++) {
            $a = $i + 1;
            $html .= '<tr>
                        <td style="text-align:left">' . $json[$i]["Name"] . '</td>
                      </tr>';
        }
        $html .= '</table>';
        return $html;
    }

    public function createReportFromHtml($getHTML)
    {
    }
}
