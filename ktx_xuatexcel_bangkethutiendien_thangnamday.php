<?php
    include("Classes/PHPExcel.php");
    include 'dbcon.php';
    ob_end_clean();
    ob_start();
    $connect=  clsConnet::DBConnect();
    //$objReader=new PHPExcel_Reader_Excel2007();
    $objReader=new PHPExcel_Reader_Excel5();
    $objPHPExcel=new PHPExcel();
    $workSheet=$objPHPExcel->getActiveSheet();
//    $connect=mysql_connect("localhost", "root", "");
//    mysql_select_db("ktxdatabase", $connect);
//    mysql_query("SET CHARACTER SET utf8",$connect);
    
    $thang=$_POST["thang"];
    $nam=$_POST["nam"];
    $day=$_POST["day"];
    
    $tongkwtieuthu=0;
    $tongthanhtiendien=0;
    $tongm3tieuthu=0;
    $tongthanhtiennuoc=0;
    $tongcong=0;
    
    $workSheet->mergeCells('G1:K1');
    $workSheet->getStyle('G1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('G2:K2');
    $workSheet->getStyle('G2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:F1');
    $workSheet->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CĐ KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:F2');
    $workSheet->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'TRƯỜNG CAO ĐẲNG');
    $workSheet->mergeCells('A3:F3');
    $workSheet->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, 'KINH TẾ - KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A5:K5');
    $workSheet->getStyle('A5:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'BẢNG KÊ THU ĐIỆN - NƯỚC THÁNG '.$thang.' NĂM '.$nam);
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    $workSheet->mergeCells('A6:K6');
    $workSheet->getStyle('A6:K6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 6, 'KHU KÝ TÚC XÁ SINH VIÊN DÃY '.$day);
    $workSheet->getStyle('A6')->getFont()->setSize(14);
    $workSheet->getStyle('A6')->getFont()->setBold(true);
    
    $workSheet->mergeCells('B7:E7');
    $workSheet->getStyle('B7:E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(1, 7, 'ĐIỆN');
    
    $workSheet->mergeCells('F7:I7');
    $workSheet->getStyle('F7:I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(5, 7, 'NƯỚC');
    
    $workSheet->mergeCells('A7:A8');
    $workSheet->getStyle('A7:A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 7, 'PHÒNG');
    
    $workSheet->mergeCells('J7:J8');
    $workSheet->getStyle('J6:J8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(9, 7, 'TỔNG CỘNG');
    
    $workSheet->mergeCells('K7:K8');
    $workSheet->getStyle('K7:K8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(10,7, 'KÝ NỘP');
    
    $workSheet->setCellValueByColumnAndRow(1, 8, 'SỐ CŨ');
    //$workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 8, 'SỐ MỚI');
    $workSheet->setCellValueByColumnAndRow(3, 8, 'KW TIÊU THỤ');
    $workSheet->setCellValueByColumnAndRow(4, 8, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(5, 8, 'SỐ CŨ');
    $workSheet->setCellValueByColumnAndRow(6, 8, 'SỐ MỚI');
    $workSheet->setCellValueByColumnAndRow(7, 8, 'SỐ M3 TIÊU THỤ');
    $workSheet->setCellValueByColumnAndRow(8, 8, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(9, 8, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(10, 8, 'KÝ NỘP');
    
    $query="select a.ID_THUTIENDIENNUOC,a.ID_PHONG, b.TENPHONG, a.GIADIEN,a.CSDIENCU,a.CSDIENMOI,a.GIANUOC,a.CSNUOCCU,a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.THANGNOP,a.NGUOITHU from thutiendiennuoc a, phong b where (a.ID_PHONG=b.ID_PHONG) and (LEFT(a.THANGNOP,1)='$thang') and (RIGHT(a.THANGNOP,4)='$nam') and (LEFT(b.TENPHONG,1)='$day')";  
//  echo $query;
    
    $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
    
    $tuDong=9; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(8);
    $workSheet->getColumnDimension('B')->setWidth(8);
    $workSheet->getColumnDimension('C')->setWidth(8);
    $workSheet->getColumnDimension('D')->setWidth(15);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(8);
    $workSheet->getColumnDimension('G')->setWidth(8);
    $workSheet->getColumnDimension('H')->setWidth(15);
    $workSheet->getColumnDimension('I')->setWidth(15);
    $workSheet->getColumnDimension('J')->setWidth(15);
    $workSheet->getColumnDimension('K')->setWidth(15);
    while($row=mysql_fetch_object($result)){
        $kwtieuthu=$row->CSDIENMOI-$row->CSDIENCU;   
        $thanhtiendien=$kwtieuthu*$row->GIADIEN;
        
        $m3tieuthu=$row->CSNUOCMOI-$row->CSNUOCCU;
        $thanhtiennuoc=$m3tieuthu*$row->GIANUOC;
        
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->CSDIENCU);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->CSDIENMOI);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $kwtieuthu);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $thanhtiendien);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->CSNUOCCU);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->CSNUOCMOI);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $m3tieuthu);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $thanhtiennuoc);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->THANHTIEN);
//        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->NGUOINOP);
        $tongkwtieuthu=$tongkwtieuthu+$kwtieuthu;
        $tongm3tieuthu=$tongm3tieuthu+$m3tieuthu;
        $tongthanhtiendien=$tongthanhtiendien+$thanhtiendien;
        $tongthanhtiennuoc=$tongthanhtiennuoc+$thanhtiennuoc;
        
        
        
        
        $tuDong++; $stt++;
    }  
//    $workSheet->setCellValueByColumnAndRow(9, $tuDong, $tongthanhtiendien);
    $workSheet->setCellValueByColumnAndRow(3, $tuDong, $tongkwtieuthu);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong, $tongthanhtiendien);
    $workSheet->setCellValueByColumnAndRow(7, $tuDong, $tongm3tieuthu);
    $workSheet->setCellValueByColumnAndRow(8, $tuDong, $tongthanhtiennuoc);
    $workSheet->setCellValueByColumnAndRow(9, $tuDong, $tongthanhtiennuoc+$tongthanhtiendien);
    
    $workSheet->mergeCells("A".(9+$somautin).":B".(9+$somautin));
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    
    $workSheet->mergeCells("B".(11+$somautin).":E".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("H".(11+$somautin).":K".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(7, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    
    $workSheet->mergeCells("B".(10+$somautin).":K".(10+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+1, 'Bằng chữ: '.convert_number_to_words($tongthanhtiennuoc+$tongthanhtiendien));
    //echo convert_number_to_words($tongthanhtiennuoc);
    
    $khoi="A7:K".(9+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    
//    $now = getdate();
//    $currentTime = $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"];
//    $currentDate = $now["mday"] . "." . $now["mon"] . "." . $now["year"];
//    $currentWeek = $now["wday"] . ".";  
//    echo $currentTime;
//    echo $currentDate;
//    echo $currentWeek;
//    
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="bangkethutiendiennuocthangnamday.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
    
    
function convert_number_to_words($number) {
 
$hyphen      = ' ';
$conjunction = '  ';
$separator   = ' ';
$negative    = 'âm ';
$decimal     = ' phẩy ';
$dictionary  = array(
0                   => 'Không',
1                   => 'Một',
2                   => 'Hai',
3                   => 'Ba',
4                   => 'Bốn',
5                   => 'Năm',
6                   => 'Sáu',
7                   => 'Bảy',
8                   => 'Tám',
9                   => 'Chín',
10                  => 'Mười',
11                  => 'Mười một',
12                  => 'Mười hai',
13                  => 'Mười ba',
14                  => 'Mười bốn',
15                  => 'Mười năm',
16                  => 'Mười sáu',
17                  => 'Mười bảy',
18                  => 'Mười tám',
19                  => 'Mười chín',
20                  => 'Hai mươi',
30                  => 'Ba mươi',
40                  => 'Bốn mươi',
50                  => 'Năm mươi',
60                  => 'Sáu mươi',
70                  => 'Bảy mươi',
80                  => 'Tám mươi',
90                  => 'Chín mươi',
100                 => 'trăm',
1000                => 'ngàn',
1000000             => 'triệu',
1000000000          => 'tỷ',
1000000000000       => 'nghìn tỷ',
1000000000000000    => 'ngàn triệu triệu',
1000000000000000000 => 'tỷ tỷ'
);
 
if (!is_numeric($number)) {
return false;
}
 
if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
trigger_error(
'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
E_USER_WARNING
);
return false;
}
 
if ($number < 0) {
return $negative . convert_number_to_words(abs($number));
}
 
$string = $fraction = null;
 
if (strpos($number, '.') !== false) {
list($number, $fraction) = explode('.', $number);
}
 
switch (true) {
case $number < 21:
$string = $dictionary[$number];
break;
case $number < 100:
$tens   = ((int) ($number / 10)) * 10;
$units  = $number % 10;
$string = $dictionary[$tens];
if ($units) {
$string .= $hyphen . $dictionary[$units];
}
break;
case $number < 1000:
$hundreds  = $number / 100;
$remainder = $number % 100;
$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
if ($remainder) {
$string .= $conjunction . convert_number_to_words($remainder);
}
break;
default:
$baseUnit = pow(1000, floor(log($number, 1000)));
$numBaseUnits = (int) ($number / $baseUnit);
$remainder = $number % $baseUnit;
$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
if ($remainder) {
$string .= $remainder < 100 ? $conjunction : $separator;
$string .= convert_number_to_words($remainder);
}
break;
}
 
if (null !== $fraction && is_numeric($fraction)) {
$string .= $decimal;
$words = array();
foreach (str_split((string) $fraction) as $number) {
$words[] = $dictionary[$number];
}
$string .= implode(' ', $words);
}
 
return $string;
}
?>

