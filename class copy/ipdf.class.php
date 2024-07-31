<?php
// เรียกไฟล์ TCPDF Library เข้ามาใช้งาน กำหนดที่อยู่ตามที่แตกไฟล์ไว้
require_once('tcpdf/tcpdf.php');

// สร้าง Class ใหม่ขึ้นมา กำหนดให้สืบทอดจาก Class ของ TCPDF
class IPDF extends TCPDF
{

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);

        // กำหนดคุณสมบัติของไฟล์ PDF เช่น ผู้สร้างไฟล์ หัวข้อไฟล์ คำค้น 
        $this->SetCreator('Nathapat');
        $this->SetAuthor('Nathapat Developer');
        $this->SetTitle('Building Report');
        $this->SetSubject('Building');
        $this->SetKeywords('Nathapat, building');

        // กำหนดรายละเอียดของหัวกระดาษ สีข้อความและสีของเส้นใต้
        // PDF_HEADER_LOGO = ไฟล์รูปภาพโลโก้
        // PDF_HEADER_LOGO_WIDTH = ขนาดความกว้างของโลโก้
        // $this->SetHeaderData('Nathapat.png', 20, 'Nathapat World Header', 'This is PDF Header', array(0, 64, 255), array(0, 64, 128));
        $this->SetHeaderData(
            'impact_logo.png',
            PDF_HEADER_LOGO_WIDTH,
            'Car Staging Application',
            'To change report name is here!!!',
            array(0, 64, 255),
            array(0, 64, 128)
        );

        // กำหนดรายละเอียดของท้ายกระดาษ สีข้อความและสีของเส้น
        $this->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // กำหนดตัวอักษร รูปแบบและขนาดของตัวอักษร (ตัวอักษรดูได้จากโฟลเดอร์ fonts)
        // PDF_FONT_NAME_MAIN = ชื่อตัวอักษร helvetica
        // PDF_FONT_SIZE_MAIN = ขนาดตัวอักษร 10
        $this->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // กำหนดระยะขอบกระดาษ
        // PDF_MARGIN_LEFT = ขอบกระดาษด้านซ้าย 15mm
        // PDF_MARGIN_TOP = ขอบกระดาษด้านบน 27mm
        // PDF_MARGIN_RIGHT = ขอบกระดาษด้านขวา 15mm
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // กำหนดระยะห่างจากขอบกระดาษด้านบนมาที่ส่วนหัวกระดาษ
        // PDF_MARGIN_HEADER = 5mm
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);

        // กำหนดระยะห่างจากขอบกระดาษด้านล่างมาที่ส่วนท้ายกระดาษ
        // PDF_MARGIN_FOOTER = 10mm
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // กำหนดให้ขึ้นหน้าใหม่แบบอัตโนมัติ เมื่อเนื้อหาเกินระยะที่กำหนด
        // PDF_MARGIN_BOTTOM = 25mm นับจากขอบล่าง
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // กำหนดตัวอักษรสำหรับส่วนเนื้อหา ชื่อตัวอักษร รูปแบบและขนาดตัวอักษร
        $this->SetFont('freeserif', '', 10);

        // // กำหนดให้สร้างหน้าเอกสาร
        // // จะไปกำหนดที่หน้า Object ที่สร้างจากคลาสนี้
        // $this->AddPage();
    }
}
