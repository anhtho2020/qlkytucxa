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
    
//    $tungay=$_POST["tungay"];
//    $denngay=$_POST["denngay"];
    $hocky=$_POST["hocky"];
    $namhoc=$_POST["namhoc"];
    $tongsotien=0;
//    if(isset($_POST["tungay"])){
//             $dtn=$_POST["tungay"];
//             $tn=explode("/", $dtn);
//             $tungay=$tn[2]."-".$tn[1]."-".$tn[0];//echo $ngaynoitru;
//        }
//        else echo " ";
//        if(isset($_POST["denngay"])){
//             $ddn=$_POST["denngay"];
//             $dn=explode("/", $ddn);
//             $denngay=$dn[2]."-".$dn[1]."-".$dn[0];//echo $ngaynoitru;
//        }
//        else echo " ";
    
    $workSheet->mergeCells('E1:G1');
    $workSheet->getStyle('E1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:G2');
    $workSheet->getStyle('E2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:D1');
    $workSheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:D2');
    $workSheet->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CT-HSSV');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, 'BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ');
    $workSheet->mergeCells('A5:G5');
    $workSheet->getStyle('A5:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'THỐNG KÊ HSSV CHƯA NỘP TIỀN PHÒNG HỌC KỲ '.$hocky.' NĂM HỌC '.$namhoc);
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    $workSheet->mergeCells('A6:G6');
    $workSheet->getStyle('A6:G6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//    $workSheet->setCellValueByColumnAndRow(0, 6, 'Từ ngày '.$tungay.' đến ngày '.$denngay);
    $workSheet->getStyle('A6')->getFont()->setSize(14);
    $workSheet->getStyle('A6')->getFont()->setBold(true);
    $workSheet->getStyle('A6')->getFont()->setItalic(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MÃ HSSV');
    $workSheet->mergeCells('C7:D7');
    $workSheet->getStyle('C7:D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ VÀ TÊN');
    //$workSheet->setCellValueByColumnAndRow(4, 7, 'LỚP');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'DÃY');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'SỐ TIỀN');
    
    $query ="select b.ID_DSHSSV,b.MAHSSV,b.HODEM,b.TEN,b.NGAYSINH,c.TENPHONG,LEFT(c.TENPHONG,1) as DAY"
            . " from dshssv b, phong c, danhsachnoitrum d "
            . "where d.ID_SINHVIEN=b.ID_DSHSSV and c.ID_PHONG=d.ID_PHONG and "
            . " b.ID_DSHSSV not in (select ID_SINHVIEN from thutienphongsinhvien2017 where HOCKY='$hocky' and NAMHOC='$namhoc' and ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
    //echo $query;
    
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    

    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(4);
    $workSheet->getColumnDimension('B')->setWidth(13);
    $workSheet->getColumnDimension('C')->setWidth(20);
    $workSheet->getColumnDimension('D')->setWidth(8);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(8);
    $workSheet->getColumnDimension('G')->setWidth(6);
    //$workSheet->getColumnDimension('H')->setWidth(12);
//    $workSheet->getColumnDimension('I')->setWidth(12);
//    $workSheet->getColumnDimension('I')->setAutoSize(true);
//    $workSheet->getColumnDimension('J')->setAutoSize(true);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MAHSSV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TEN);
        //$workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->MALOPCHUYENNGANH);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->DAY);
//        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->HOCKY);
        
//        $tongsotien=$tongsotien+$row->DONGIA;
        
        $tuDong++; $stt++;
    } 
    $stt=$stt-1;
    $workSheet->mergeCells("A".(8+$somautin).":G".(8+$somautin));
//    $workSheet->getStyle("A".(8+$somautin).":G".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'Danh sách gồm: '.$stt.' học sinh sinh viên.');
//    $workSheet->setCellValueByColumnAndRow(7, $tuDong, $tongsotien);
    
    //$workSheet->mergeCells("B".(11+$somautin).":C".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("D".(10+$somautin).":G".(10+$somautin));
    $workSheet->getStyle("D".(10+$somautin).":G".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("D".($tuDong+2))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("D".(11+$somautin).":G".(11+$somautin));
    $workSheet->getStyle("D".(11+$somautin).":G".(11+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, $tuDong+3, 'Người lập bảng' );
    
    $workSheet->mergeCells("B".(10+$somautin).":C".(10+$somautin));
//    $workSheet->setCellValueByColumnAndRow(1, $tuDong+1, 'Bằng chữ: '.convert_number_to_words($tongsotien));
    
    
    $khoi="A7:G".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="tk_sv_chua_nop_tienphong_hk_nh.xls";
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