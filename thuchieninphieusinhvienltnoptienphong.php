﻿<?php
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
    $connect=  clsConnet::DBConnect();
    $workSheet->getPageMargins()->setTop(0.5);
    $workSheet->getPageMargins()->setLeft(0.5);
    $workSheet->getPageMargins()->setRight(0.5);

    $idthutienphongsinhvienlt=$_GET["idthutienphongsinhvienlt"];
$now = getdate(); 
    $ngayinphieu=$now["year"].'-'.$now["mon"].'-'.$now["mday"] ;
    
    $query_kt ="select * from dsphieutienphongsinhvienlt where ID_TIENPHONGSINHVIENLT=$idthutienphongsinhvienlt";  //echo $query_kt;
   $result_kt=mysqli_query($connect,$query_kt);
    $somautin_kt=  mysqli_num_rows($result_kt);
    //echo $somautin_kt;
//if($somautin_kt==0)
//{
    $tiennop=0;

    $workSheet->mergeCells('D1:G1');
    $workSheet->getStyle('D1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, 1, 'Mẫu số : C30-BB');
    $workSheet->getStyle('D1')->getFont()->setSize(13);
    $workSheet->getStyle('D1')->getFont()->setBold(true);
    
    $workSheet->mergeCells('D2:G2');
    $workSheet->getStyle('D2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, 2, '(Ban hành theo QĐ số : 19/2006/QĐ-BTC');
//    $workSheet->getStyle('B5')->getFont()->setSize(14);
    $workSheet->getStyle('D2')->getFont()->setItalic(true);
    
    $workSheet->mergeCells('D3:G3');
    $workSheet->getStyle('D3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, 3, 'ngày 30/03/2006 của Bộ Trưởng Bộ Tài Chính)');
//    $workSheet->getStyle('B5')->getFont()->setSize(14);
    $workSheet->getStyle('D3')->getFont()->setItalic(true);
    
    $workSheet->mergeCells('A1:C1');
    $workSheet->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CĐ KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->getStyle('A1')->getFont()->setSize(14);
    $workSheet->getStyle('A1')->getFont()->setBold(true);
    
    $workSheet->mergeCells('A2:C2');
    $workSheet->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'Số 9, Cách Mạng Tháng 8, Q. Ninh Kiều, TP. Cần Thơ');
    $workSheet->mergeCells('A3:C3');
    $workSheet->getStyle('A3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//    $workSheet->setCellValueByColumnAndRow(0, 3, 'BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ');
    $workSheet->mergeCells('B5:E5');
    $workSheet->getStyle('B5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(1, 5, 'PHIẾU THU');
    $workSheet->getStyle('B5')->getFont()->setSize(14);
    $workSheet->getStyle('B5')->getFont()->setBold(true);
    
    $now = getdate(); 
//    $workSheet->mergeCells("H".(11+$somautin).":K".(11+$somautin));
    
    $workSheet->mergeCells('B6:E6');
    $workSheet->getStyle('B6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//    $workSheet->setCellValueByColumnAndRow(1, 6, 'Ngày '.);
    $workSheet->setCellValueByColumnAndRow(1, 6, 'Ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
//    $workSheet->getStyle('B6')->getFont()->setSize(14);
    $workSheet->getStyle('B6')->getFont()->setItalic(true);
    
//    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
//    $workSheet->mergeCells('I7:J7');
    $workSheet->setCellValueByColumnAndRow(5, 5, 'SỐ PHIẾU:');
//    $workSheet->mergeCells('A8:B8');
    $workSheet->setCellValueByColumnAndRow(0, 8, 'Họ & tên người nộp:');
//    $workSheet->mergeCells('A9:B9');
    $workSheet->setCellValueByColumnAndRow(0, 9, 'Địa chỉ (phòng):');
//    $workSheet->mergeCells('A10:B10');
    $workSheet->setCellValueByColumnAndRow(0, 10, 'Lý do nộp:');
//    $workSheet->mergeCells('A11:B11');
    $workSheet->setCellValueByColumnAndRow(0, 11, 'Số tiền:');
//    $workSheet->mergeCells('A12:B12');
    $workSheet->setCellValueByColumnAndRow(0, 12, 'Bằng chữ:');
//    $workSheet->mergeCells('A13:B13');
    $workSheet->setCellValueByColumnAndRow(0, 13, 'Kèm theo:');

    $query ="select a.ID_TIENPHONGSINHVIENLT,a.ID_LIENTHONG,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,"
            . "b.ID_LIENTHONG,b.MASV,b.HODEM,"
            . "b.TEN,c.TENPHONG from tienphongsinhvienlt a,lienthong b,phong c,dssvltnoitru d "
            . "where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_LIENTHONG=d.ID_LIENTHONG "
            . "and d.ID_PHONG=c.ID_PHONG and a.ID_TIENPHONGSINHVIENLT='".$idthutienphongsinhvienlt."'";  
    //echo $query;
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
$query_ins ="select a.ID_TIENPHONGSINHVIENLT,a.ID_LIENTHONG,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,"
        . "b.ID_LIENTHONG,b.MASV,b.HODEM,"
            . "b.TEN,c.TENPHONG from tienphongsinhvienlt a,lienthong b,phong c,dssvltnoitru d "
            . "where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_LIENTHONG=d.ID_LIENTHONG "
            . "and d.ID_PHONG=c.ID_PHONG and a.ID_TIENPHONGSINHVIENLT='".$idthutienphongsinhvienlt."'";  
    //echo $query;
    $result_ins=mysqli_query($connect,$query_ins);
    $somautin_ins=  mysqli_num_rows($result_ins);
    
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(19);
    $workSheet->getColumnDimension('B')->setWidth(15);
    $workSheet->getColumnDimension('C')->setWidth(20);
    $workSheet->getColumnDimension('D')->setWidth(4);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(12);
    $workSheet->getColumnDimension('H')->setWidth(12);
    $workSheet->getColumnDimension('I')->setWidth(12);
    
    $workSheet->getColumnDimension('J')->setWidth(12);
    
    //Thực hiên cập nhật
    $row_insert = mysqli_fetch_array ($result_ins);
    $idlt_insert=$row_insert["ID_LIENTHONG"];
    $dongia_insert=$row_insert["DONGIA"];
    $ngaythu_insert=$row_insert["NGAYTHU"];
    $hocky_insert=$row_insert["HOCKY"];
    $namhoc_insert=$row_insert["NAMHOC"];
    $nguoithu_insert=$row_insert["NGUOITHU"];
    $query_insert="insert into dsphieutienphongsinhvienlt (ID_TIENPHONGSINHVIENLT,ID_LIENTHONG,DONGIA,NGAYTHU,NGAYINPHIEU,"
            . "HOCKY,NAMHOC,NGUOITHU) "
            . "Values($idthutienphongsinhvienlt,$idlt_insert,$dongia_insert,'$ngaythu_insert','$ngayinphieu',"
            . "'$hocky_insert','$namhoc_insert','$nguoithu_insert')";
    mysqli_query($connect,$query_insert);
    //echo $query_insert;
    
    while($row=mysqli_fetch_object($result)){
        $workSheet->setCellValueByColumnAndRow(6, 5, $row->ID_TIENPHONGSINHVIENLT);
//        $workSheet->setCellValueByColumnAndRow(2, 8, $row->MASV);
        $workSheet->setCellValueByColumnAndRow(1, 8, $row->HODEM.' '.$row->TEN);
//        $workSheet->setCellValueByColumnAndRow(3, 9, $row->TEN);
        $workSheet->setCellValueByColumnAndRow(1, 9, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow(1, 10, 'Tiền phòng');
        $workSheet->setCellValueByColumnAndRow(1,11, $row->DONGIA);
        $workSheet->setCellValueByColumnAndRow(1,12, convert_number_to_words($row->DONGIA));
        $workSheet->setCellValueByColumnAndRow(1,13,  '');
        $tiennop=$row->DONGIA;
//        $workSheet->setCellValueByColumnAndRow(1,14, '');
    }   
    
//        $workSheet->mergeCells("A".(8+$somautin).":G".(8+$somautin));
//        $workSheet->getStyle("A".(8+$somautin).":G".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
//        $workSheet->setCellValueByColumnAndRow(7, $tuDong, $tongsotien);

        //$workSheet->mergeCells("B".(11+$somautin).":C".(11+$somautin));
    
    $workSheet->mergeCells("A14:B14");
        $workSheet->getStyle("A14:B14")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $workSheet->setCellValueByColumnAndRow(0, 14, ' Thủ Trưởng đơn vị ' );
        
        $workSheet->mergeCells("C14:D14");
        $workSheet->getStyle("C14:D14")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $workSheet->setCellValueByColumnAndRow(2, 14, ' Kế toán trưởng ' );
        
        $workSheet->mergeCells("E14:G14");
        $workSheet->getStyle("E14:G14")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $workSheet->setCellValueByColumnAndRow(4, 14, ' Người lập ' );

        $workSheet->setCellValueByColumnAndRow(0, 18, 'Đã nhận đủ số tiền: ');

        $workSheet->mergeCells("B18:G18");
        $workSheet->setCellValueByColumnAndRow(1, 18, convert_number_to_words($tiennop));
        $workSheet->getStyle("B18")->getFont()->setItalic(true);
        
        $workSheet->mergeCells("A20:B20");
        $workSheet->getStyle("A20:B20")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $workSheet->setCellValueByColumnAndRow(0, 20, ' Người nộp ' );
        
         $workSheet->mergeCells("C20:G20");
        $workSheet->getStyle("C20:G20")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $workSheet->setCellValueByColumnAndRow(2, 20, ' Thủ quỹ ' );
        
        $now = getdate(); 
        $workSheet->mergeCells("C19:G19");
        $workSheet->getStyle("C19:G19")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $workSheet->setCellValueByColumnAndRow(2, 19, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
        $workSheet->getStyle("C19")->getFont()->setItalic(true);

    header('Content-Type: application/vnd.ms-excel');
    $name="phieuthutienphongsinhvien.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
//}
//else {
    echo "<script>";
    echo "alert('Phieu nay in roi, chon tiep tuc');";
    echo "</script>";
    echo "<a  href=\"ktx_ds_svlt_tienphong.php\"> Tiep tuc </a>";
//}
    
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