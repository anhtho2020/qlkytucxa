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
    
    $tungay=$_POST["tungay"];
    $denngay=$_POST["denngay"];
    $tongsotien=0;
    
    $workSheet->mergeCells('E1:H1');
    $workSheet->getStyle('E1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:H2');
    $workSheet->getStyle('E2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:D1');
    $workSheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:D2');
    $workSheet->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'TRƯỜNG CAO ĐẲNG');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, 'KINH TẾ - KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A5:H5');
    $workSheet->getStyle('A5:H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH HSSV NỘP TIỀN PHÒNG ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->mergeCells('A6:H6');
    $workSheet->getStyle('A6:H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 6, 'Từ ngày '.$tungay.' đến ngày '.$denngay);
    $workSheet->getStyle('A6')->getFont()->setSize(12);
//    $workSheet->getStyle('A6')->getFont()->setBold(true);
    $workSheet->getStyle('A6')->getFont()->setItalic(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MASV');
//    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ VÀ TÊN');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'LỚP');
    //$workSheet->setCellValueByColumnAndRow(4, 7, ' DIỆN CHÍNH SÁCH');
    $workSheet->setCellValueByColumnAndRow(4, 7, ' NGÀY NỘI TRÚ');
    $workSheet->setCellValueByColumnAndRow(5, 7, ' PHÒNG');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'GHI CHÚ');
//    $workSheet->setCellValueByColumnAndRow(7, 7, 'SỐ THÁNG');
//    $workSheet->setCellValueByColumnAndRow(8, 7, 'THÀNH TIỀN');
    //$workSheet->setCellValueByColumnAndRow(8, 7, 'NGƯỜI THU');
    //$query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.DONGIA,a.NGAYTHU,a.SOTHANG,a.THANHTIEN,a.NGUOITHU from thutienphongsinhvien a, sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN";
    $query="select a.ID_SINHVIEN, b.MAHSSV,b.HODEM,b.TEN,b.DIENCHINHSACH,a.NGAYNOITRU,c.TENPHONG "
                . "from danhsachnoitrum a,dshssv b,phong c "
                . "where a.ID_SINHVIEN=b.ID_DSHSSV and a.ID_PHONG=c.ID_PHONG"
                ." and b.DIENCHINHSACH in('Con thuong binh','Con nha ngheo','Nguoi tan tat','Bo doi xuat ngu','Tu quan')"
            . " and (a.NGAYNOITRU>'$tungay' and a.NGAYNOITRU<'$denngay')";
    //echo $query;
    //$query.="from thutienphongsinhvien a, sinhvien b "; 
    //$query.="where a.ID_SINHVIEN=b.ID_SINHVIEN ";
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(4);
    $workSheet->getColumnDimension('B')->setWidth(12);
    $workSheet->getColumnDimension('C')->setWidth(22);
    $workSheet->getColumnDimension('D')->setWidth(11);
    $workSheet->getColumnDimension('E')->setWidth(10);
    $workSheet->getColumnDimension('F')->setWidth(10);
    $workSheet->getColumnDimension('G')->setWidth(10);
    $workSheet->getColumnDimension('H')->setWidth(16);;
//    $workSheet->getColumnDimension('I')->setWidth(14);
//    $workSheet->getColumnDimension('J')->setWidth(14);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MAHSSV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM." ".$row->TEN);
        //$workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->MALOPCHUYENNGANH);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->DIENCHINHSACH);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->NGAYNOITRU);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->TENPHONG);
 //       $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->NGAYTHU);
//        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->SOTHANG);
//        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->THANHTIEN);
 //       $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NGUOITHU);
  //      $tongsotien=$tongsotien+$row->DONGIA;
        $tuDong++; $stt++;
    } 
    
   // $workSheet->mergeCells("A".(8+$somautin).":B".(8+$somautin));
   // $workSheet->getStyle("A".(8+$somautin).":B".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   // $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
   // $workSheet->setCellValueByColumnAndRow(6, $tuDong, $tongsotien);
    $stt--;
    $workSheet->mergeCells("A".(9+$somautin).":D".(9+$somautin));
    //$workSheet->getStyle("A".(9+$somautin).":D".(9+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong+1, 'Danh sách gồm: '.$stt.' học sinh sinh viên.');
    
   // $workSheet->mergeCells("E".(9+$somautin).":I".(9+$somautin));
    //$workSheet->getStyle("A".(9+$somautin).":D".(9+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   // $workSheet->setCellValueByColumnAndRow(4, $tuDong+1, convert_number_to_words($tongsotien));
    
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("E".(10+$somautin).":H".(10+$somautin));
    $workSheet->getStyle("E".(10+$somautin).":H".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("E".($tuDong+1))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("E".(11+$somautin).":H".(11+$somautin));
    $workSheet->getStyle("E".(11+$somautin).":H".(11+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+3, 'Người lập bảng' );
    
    $khoi="A7:H".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="dssvnoptienphongtungaydenngay.xls";
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