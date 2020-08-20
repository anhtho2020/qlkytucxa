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
    
    $workSheet->mergeCells('E1:N1');
    $workSheet->getStyle('E1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:N2');
    $workSheet->getStyle('E2:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
    $workSheet->mergeCells('A5:N5');
    $workSheet->getStyle('A5:N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH HSSV NỘP TIỀN PHÒNG ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->mergeCells('A6:N6');
    $workSheet->getStyle('A6:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 6, 'Từ ngày '.$tungay.' đến ngày '.$denngay);
    $workSheet->getStyle('A6')->getFont()->setSize(12);
//    $workSheet->getStyle('A6')->getFont()->setBold(true);
    $workSheet->getStyle('A6')->getFont()->setItalic(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MASV');
//    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ VÀ TÊN');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'SỐ THÁNG');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'MỨC GIẢM');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(7, 7, 'NGÀY THU');
    $workSheet->setCellValueByColumnAndRow(8, 7, 'NGÀY IN PHIẾU');
    $workSheet->setCellValueByColumnAndRow(9, 7, ' HỌC KỲ');
    $workSheet->setCellValueByColumnAndRow(10, 7, 'NĂM HỌC');
    $workSheet->setCellValueByColumnAndRow(11, 7, 'NGƯỜI THU');
    $workSheet->setCellValueByColumnAndRow(12, 7, ' SỐ PHIẾU');
    $workSheet->setCellValueByColumnAndRow(13, 7, ' GHI CHÚ');
    /*
    $query="select a.ID_THUTIENPHONGSINHVIEN,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,a.NGAYINPHIEU,a.MASV,a.HODEM,a.TEN,a.TENPHONG,e.GHICHU,e.SOTHANGNOP,e.DONGIATHANG,e.MUCGIAM "
                . "from dsphieuthutienphongsinhvien a, sinhvien b,danhsachnoitru c, phong d , thutienphongsinhvien e "
                . "where a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_SINHVIEN=c.ID_SINHVIEN and a.ID_SINHVIEN=e.ID_SINHVIEN and c.ID_PHONG=d.ID_PHONG and "  
            . "(a.NGAYINPHIEU>='$tungay' and a.NGAYINPHIEU<='$denngay') ORDER BY a.ID_THUTIENPHONGSINHVIEN ASC";
    */
    $query="select a.ID_THUTIENPHONGSINHVIEN,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,a.NGAYINPHIEU,c.MASV,c.HODEM,c.TEN,a.TENPHONG,b.GHICHU,b.SOTHANGNOP,b.DONGIATHANG,b.MUCGIAM "
                . "from dsphieuthutienphongsinhvien a, thutienphongsinhvien b, sinhvien c "
                . "where a.ID_THUTIENPHONGSINHVIEN=b.ID_THUTIENPHONGSINHVIEN  and b.ID_SINHVIEN=c.ID_SINHVIEN and "  
            . "(a.NGAYINPHIEU>='$tungay' and a.NGAYINPHIEU<='$denngay') ORDER BY a.ID_THUTIENPHONGSINHVIEN ASC";
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
    $workSheet->getColumnDimension('D')->setWidth(10);
    $workSheet->getColumnDimension('E')->setWidth(10);
    $workSheet->getColumnDimension('F')->setWidth(10);
    $workSheet->getColumnDimension('G')->setWidth(10);
    $workSheet->getColumnDimension('H')->setWidth(6);;
    $workSheet->getColumnDimension('I')->setWidth(14);
    $workSheet->getColumnDimension('J')->setWidth(6);
    $workSheet->getColumnDimension('K')->setWidth(14);
    $workSheet->getColumnDimension('L')->setWidth(14);
    $workSheet->getColumnDimension('M')->setWidth(6);
    $workSheet->getColumnDimension('N')->setWidth(14);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MASV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM." ".$row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->SOTHANGNOP);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->MUCGIAM);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->DONGIA);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NGAYINPHIEU);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->HOCKY);
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->NAMHOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+11, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+12, $tuDong, $row->ID_THUTIENPHONGSINHVIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+13, $tuDong, $row->GHICHU);
        $tongsotien=$tongsotien+$row->DONGIA;
        $tuDong++; $stt++;
    } 
    
    $workSheet->mergeCells("A".(8+$somautin).":F".(8+$somautin));
    $workSheet->getStyle("A".(8+$somautin).":F".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(6, $tuDong, $tongsotien);
    
    //$workSheet->mergeCells("B".(11+$somautin).":C".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+1, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("F".(9+$somautin).":N".(9+$somautin));
    $workSheet->getStyle("F".(9+$somautin).":N".(9+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(5, $tuDong+1, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("F".($tuDong+1))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("F".(10+$somautin).":N".(10+$somautin));
    $workSheet->getStyle("F".(10+$somautin).":N".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(5, $tuDong+2, 'Người lập bảng' );
    
    $khoi="A7:N".(7+$somautin);
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
?>