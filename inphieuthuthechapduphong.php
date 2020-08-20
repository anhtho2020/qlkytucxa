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
    
    $workSheet->getPageMargins()->setTop(1);
    $workSheet->getPageMargins()->setLeft(0.5);
    $workSheet->getPageMargins()->setRight(0.5);

    $idthechaplt=$_GET["idthechaplt"];
    $query_kt ="select * from dsphieuthechaplt where ID_THECHAPLT=$idthechaplt";  //echo $query_kt;
   $result_kt=mysql_query($query_kt, $connect);
    $somautin_kt=  mysql_num_rows($result_kt);
    //echo $somautin_kt;
if($somautin_kt==0)
{
        
    
//    $ngaythechap=$_POST["ngaythechap"];
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
    $workSheet->setCellValueByColumnAndRow(0, 9, 'Địa chỉ:');
//    $workSheet->mergeCells('A10:B10');
    $workSheet->setCellValueByColumnAndRow(0, 10, 'Lý do nộp:');
//    $workSheet->mergeCells('A11:B11');
    $workSheet->setCellValueByColumnAndRow(0, 11, 'Số tiền:');
//    $workSheet->mergeCells('A12:B12');
    $workSheet->setCellValueByColumnAndRow(0, 12, 'Bằng chữ:');
//    $workSheet->mergeCells('A13:B13');
    $workSheet->setCellValueByColumnAndRow(0, 13, 'Kèm theo:');

    $query ="select a.ID_THECHAPLT,a.ID_LIENTHONG,a.SOTIEN,a.NGAYTHECHAP,a.SOTIEN,a.HOCKY,a.NAMHOC,"
            . "a.GHICHU, b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,c.MALOPLT from thechaplt a, lienthong b ,"
            . "loplt c where a.ID_LIENTHONG=b.ID_LIENTHONG and b.ID_LOP=c.ID_LOPLT and a.ID_THECHAPLT=$idthechaplt";  
    //echo $query;
    
   $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
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
    $row_insert = mysql_fetch_array ($result);
    $idlt_insert=$row_insert["ID_LIENTHONG"];
    $ngthechap_insert=$row_insert["NGAYTHECHAP"];
    $sotien_insert=$row_insert["SOTIEN"];
    $hk_insert=$row_insert["HOCKY"];
    $nh_insert=$row_insert["NAMHOC"];
    
    $query_insert="insert into DSPHIEUTHECHAPLT(ID_THECHAPLT,ID_LIENTHONG,NGAYTHECHAP,SOTIEN,HOCKY,NAMHOC) "
            . "Values($idthechaplt,$idlt_insert,'$ngthechap_insert',$sotien_insert,'$hk_insert','$nh_insert')";
    mysql_query($query_insert, $connect);
    //echo $query_insert;
    
    
    //Thực hiện in phiếu
    while($row=mysql_fetch_object($result)){
        $workSheet->setCellValueByColumnAndRow(6, 5, $row->ID_THECHAPLT);

        $workSheet->setCellValueByColumnAndRow(1, 8, $row->HODEM.' '.$row->TEN);

        $workSheet->setCellValueByColumnAndRow(1, 9, $row->MALOPLT);
        $workSheet->setCellValueByColumnAndRow(1, 10, 'Nộp tiền thế chấp');
        $workSheet->setCellValueByColumnAndRow(1,11, $row->SOTIEN);
        $workSheet->setCellValueByColumnAndRow(1,12, convert_number_to_words($row->SOTIEN));
        $workSheet->setCellValueByColumnAndRow(1,13,  '');
        $tiennop=$row->SOTIEN;

    }   

    //Thực hiện xóa
    
    $query_xoa="delete from thechaplt where ID_THECHAPLT='".$idthechaplt."'";
    $result_xoa=mysql_query($query_xoa, $connect);
    

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
    $name="phieuthutienpthechaplt.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
    
}    
else {
    echo "<script>";
    echo "alert('Phieu nay in roi, chon tiep tuc');";
    echo "</script>";
    echo "<a  href=\"ktx_danhsachthechaplt.php\"> Tiep tuc </a>";
}

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