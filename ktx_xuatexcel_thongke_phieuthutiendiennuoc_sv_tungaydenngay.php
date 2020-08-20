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
    
    $workSheet->mergeCells('E1:J1');
    $workSheet->getStyle('E1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:J2');
    $workSheet->getStyle('E2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
    $workSheet->mergeCells('A5:J5');
    $workSheet->getStyle('A5:J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH PHIẾU THU TIỀN ĐIỆN NƯỚC HSSV');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->mergeCells('A6:J6');
    $workSheet->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 6, 'Từ ngày '.$tungay.' đến ngày '.$denngay);
    $workSheet->getStyle('A6')->getFont()->setSize(12);
//    $workSheet->getStyle('A6')->getFont()->setBold(true);
    $workSheet->getStyle('A6')->getFont()->setItalic(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MASV');
//    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ VÀ TÊN');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'NGÀY THU');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'NGÀY IN PHIẾU');
    $workSheet->setCellValueByColumnAndRow(7, 7, ' THÁNG NỘP');
    $workSheet->setCellValueByColumnAndRow(8, 7, 'NGƯỜI THU');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'SỐ PHIẾU');
    //$workSheet->setCellValueByColumnAndRow(10, 7, ' SỐ PHIẾU');
    //$query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.DONGIA,a.NGAYTHU,a.SOTHANG,a.THANHTIEN,a.NGUOITHU from thutienphongsinhvien a, sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN";
    $query="select a.ID_DSPHIEUTHUTIENDIENNUOC, a.ID_THUTIENDIENNUOC,a.GIADIEN,a.CSDIENCU,CSDIENMOI,a.GIANUOC,A.CSNUOCCU,"
                . "a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.NGAYINPHIEU,a.THANGNOP,a.NGUOITHU,b.MASV,b.HODEM,b.TEN,d.TENPHONG "
                . "from dsphieuthutiendiennuoc a,sinhvien b, phong d "
                . "where a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_PHONG=d.ID_PHONG and "  
            . "(a.NGAYINPHIEU>='$tungay' and a.NGAYINPHIEU<='$denngay')";
    //echo $query;
    //$query.="from thutienphongsinhvien a, sinhvien b "; 
    //$query.="where a.ID_SINHVIEN=b.ID_SINHVIEN ";
    $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
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
    $workSheet->getColumnDimension('I')->setWidth(14);
    $workSheet->getColumnDimension('J')->setWidth(14);
    //$workSheet->getColumnDimension('K')->setWidth(14);
    //$workSheet->getColumnDimension('L')->setWidth(14);
    while($row=mysql_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MASV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM." ".$row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->THANHTIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->NGAYINPHIEU);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->THANGNOP);
        //$workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NAMHOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->ID_THUTIENDIENNUOC);
        $tongsotien=$tongsotien+$row->THANHTIEN;
        $tuDong++; $stt++;
    } 
    
    $workSheet->mergeCells("A".(8+$somautin).":D".(8+$somautin));
    $workSheet->getStyle("A".(8+$somautin).":D".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(4, $tuDong, $tongsotien);
    
    //$workSheet->mergeCells("B".(11+$somautin).":C".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+1, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("E".(9+$somautin).":J".(9+$somautin));
    $workSheet->getStyle("E".(9+$somautin).":J".(9+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+1, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("E".($tuDong+1))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("E".(10+$somautin).":J".(10+$somautin));
    $workSheet->getStyle("E".(10+$somautin).":J".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+2, 'Người lập bảng' );
    
    $khoi="A7:J".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="dsphieuthutiendiennuochssvtungaydenngay.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>