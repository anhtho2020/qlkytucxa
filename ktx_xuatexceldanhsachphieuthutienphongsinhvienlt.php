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
    
    $tongsotien=0;
    
    $workSheet->mergeCells('G1:L1');
    $workSheet->getStyle('G1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('G2:L2');
    $workSheet->getStyle('G2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:F1');
    $workSheet->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:F2');
    $workSheet->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CHÍNH TRỊ- HSSV');
    $workSheet->mergeCells('A3:F3');
    $workSheet->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, ' BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ ');
    $workSheet->mergeCells('A5:L5');
    $workSheet->getStyle('A5:L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH PHIẾU THU TIỀN PHÒNG SINH VIÊN ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'SỐ PHIẾU');
//    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'HỌ TÊN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'NGÀY NỘI TRÚ');
//    $workSheet->setCellValueByColumnAndRow(5, 7, ' SỐ NGÀY');
    $workSheet->setCellValueByColumnAndRow(5, 7, ' ĐƠN GIÁ');
    $workSheet->setCellValueByColumnAndRow(6, 7, ' NGÀY THU ');
    $workSheet->setCellValueByColumnAndRow(7, 7, ' NGÀY IN PHIẾU ');
    $workSheet->setCellValueByColumnAndRow(8, 7, ' NGƯỜI THU');
    $workSheet->setCellValueByColumnAndRow(9, 7, ' HỌC KỲ ');
    $workSheet->setCellValueByColumnAndRow(10, 7, ' NĂM HỌC ');
//    $workSheet->setCellValueByColumnAndRow(12, 7, 'THÁNG NỘP');
//    $workSheet->setCellValueByColumnAndRow(13, 7, 'NGƯỜI THU');
//   
    
    $query ="select a.ID_TIENPHONGSINHVIENLT,a.ID_LIENTHONG,a.DONGIA,a.NGAYTHU,a.NGAYINPHIEU,a.HOCKY,"
            . "a.NAMHOC,a.NGUOITHU,b.HODEM,b.TEN,c.TENPHONG,e.NGAYNOITRU "
            . " from dsphieutienphongsinhvienlt a, lienthong b, phong c,dssvltnoitru e "
            . " where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_LIENTHONG=e.ID_LIENTHONG and e.ID_PHONG=c.ID_PHONG";
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    //echo $query;
    
//    $query_dem ="select a.ID_THUTIENPHONGKHACH,a.ID_KHACH,a.ID_PHONG,a.NGAYMUON,a.SONGAY,a.DONGIA,"
//            . "a.THANHTIEN,a.NGAYTHU,a.NGAYINPHIEU,a.NGUOITHU,a.DIENGIAI, b.HODEM,b.TEN,c.TENPHONG"
//            . " from dsphieuthutienphongkhach a, khach b, phong c "
//            . " where a.ID_KHACH=b.ID_KHACH and a.ID_PHONG=c.ID_PHONG";
//    
//    $result_dem=mysql_query($query_dem, $connect);
//    $somautin_dem=  mysql_num_rows($result_dem);
    
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(4);
    $workSheet->getColumnDimension('B')->setWidth(8);
    $workSheet->getColumnDimension('C')->setWidth(8);
    $workSheet->getColumnDimension('D')->setWidth(20);
    $workSheet->getColumnDimension('E')->setWidth(15);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(12);
    $workSheet->getColumnDimension('H')->setWidth(12);
    $workSheet->getColumnDimension('I')->setWidth(18);
    $workSheet->getColumnDimension('J')->setWidth(8);
    $workSheet->getColumnDimension('K')->setWidth(10);
//    $workSheet->getColumnDimension('L')->setWidth(8);
//    $workSheet->getColumnDimension('M')->setWidth(12);
//    $workSheet->getColumnDimension('N')->setWidth(15);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->ID_TIENPHONGSINHVIENLT);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->HODEM." ".$row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->NGAYNOITRU);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->DONGIA);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->NGAYINPHIEU);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->HOCKY);
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->NAMHOC);
//        $workSheet->setCellValueByColumnAndRow($tuCot+11, $tuDong, $row->DIENGIAI);
//        $workSheet->setCellValueByColumnAndRow($tuCot+12, $tuDong, $row->);
//        $workSheet->setCellValueByColumnAndRow($tuCot+13, $tuDong, $row->NGUOITHU);
        $tongsotien=$tongsotien+$row->DONGIA;
        $tuDong++; $stt++;
        
    }   
//    $tt=0;
//    echo "So mau tin la ".$somautin_dem;
//    while($row_dem = mysql_fetch_array ($result_dem))
//    {
//        
//        $tt++;
//        echo" <br>";
//         echo $row_dem["THANHTIEN"]."-"; echo "Tong la: ".$tongsotien; echo" <br>";
//    }
//    echo "STT la".$tt;
    $workSheet->mergeCells("A".(8+$somautin).":F".(8+$somautin));
    $workSheet->getStyle("A".(8+$somautin).":F".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(6, $tuDong, $tongsotien);
    
    $workSheet->mergeCells("C".(9+$somautin).":K".(9+$somautin));
//    $workSheet->getStyle("C".(9+$somautin).":L".(9+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong+1, ' Bằng chữ: ');
    $workSheet->setCellValueByColumnAndRow(2, $tuDong+1, convert_number_to_words($tongsotien));
    
    $workSheet->mergeCells("A".(10+$somautin).":F".(10+$somautin));
    $workSheet->getStyle("A".(10+$somautin).":F".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("G".(10+$somautin).":K".(10+$somautin));
    $workSheet->getStyle("G".(10+$somautin).":K".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("G".($tuDong+2))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("G".(11+$somautin).":L".(11+$somautin));
    $workSheet->getStyle("G".(11+$somautin).":L".(11+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, $tuDong+3, 'Người lập bảng' );
    
    $khoi="A7:K".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="dsphieuthutienphong_svlt.xls";
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