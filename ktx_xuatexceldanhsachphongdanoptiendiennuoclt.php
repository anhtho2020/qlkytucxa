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
    
    $workSheet->mergeCells('G1:N1');
    $workSheet->getStyle('G1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('G2:N2');
    $workSheet->getStyle('G2:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
    $workSheet->mergeCells('A5:N5');
    $workSheet->getStyle('A5:N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH PHIẾU THU TIỀN ĐIỆN NƯỚC ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'SỐ PHIẾU');
//    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'GIÁ ĐIỆN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'CS ĐIỆN CŨ');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'CS ĐIỆN MỚI');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'GIÁ NƯỚC');
    $workSheet->setCellValueByColumnAndRow(7, 7, ' CS NƯỚC CŨ ');
    $workSheet->setCellValueByColumnAndRow(8, 7, ' CS NƯỚC MỚI ');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(10, 7, ' NGÀY THU ');
    $workSheet->setCellValueByColumnAndRow(11, 7, ' NGÀY IN PHIẾU ');
    $workSheet->setCellValueByColumnAndRow(12, 7, 'THÁNG NỘP');
    $workSheet->setCellValueByColumnAndRow(13, 7, 'NGƯỜI THU');
   
    
    $query ="select a.ID_THUTIENDIENNUOCLT,a.ID_LIENTHONG,a.ID_PHONG,a.GIADIEN,a.CSDIENCU ,a.CSDIENMOI,"
            . "a.GIANUOC,a.CSNUOCCU,a.CSNUOCMOI,a.THANHTIEN, a.NGAYTHU,a.NGAYINPHIEU,a.THANGNOP,a.NGUOITHU, "
            . "b.TENPHONG from dsphieuthutiendiennuoclt a, phong b where a.ID_PHONG=b.ID_PHONG";
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(6);
    $workSheet->getColumnDimension('B')->setWidth(10);
    $workSheet->getColumnDimension('C')->setWidth(5);
    $workSheet->getColumnDimension('D')->setWidth(8);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(12);
    $workSheet->getColumnDimension('H')->setWidth(8);
    $workSheet->getColumnDimension('I')->setWidth(12);
    $workSheet->getColumnDimension('J')->setWidth(15);
    $workSheet->getColumnDimension('K')->setWidth(12);
    $workSheet->getColumnDimension('L')->setWidth(8);
    $workSheet->getColumnDimension('M')->setWidth(12);
    $workSheet->getColumnDimension('N')->setWidth(15);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->ID_THUTIENDIENNUOCLT);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->GIADIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->CSDIENCU);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->CSDIENMOI);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->GIANUOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->CSNUOCCU);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->CSNUOCMOI);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->THANHTIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+11, $tuDong, $row->NGAYINPHIEU);
        $workSheet->setCellValueByColumnAndRow($tuCot+12, $tuDong, $row->THANGNOP);
        $workSheet->setCellValueByColumnAndRow($tuCot+13, $tuDong, $row->NGUOITHU);
        $tongsotien=$tongsotien+$row->THANHTIEN;
        $tuDong++; $stt++;
    }   
    
    $workSheet->mergeCells("A".(8+$somautin).":I".(8+$somautin));
    $workSheet->getStyle("A".(8+$somautin).":I".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(9, $tuDong, $tongsotien);
    
    $workSheet->mergeCells("A".(10+$somautin).":F".(10+$somautin));
    $workSheet->getStyle("A".(10+$somautin).":F".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("H".(10+$somautin).":N".(10+$somautin));
    $workSheet->getStyle("H".(10+$somautin).":N".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(7, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("H".($tuDong+2))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("H".(11+$somautin).":N".(11+$somautin));
    $workSheet->getStyle("H".(11+$somautin).":N".(11+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(7, $tuDong+3, 'Người lập bảng' );
    
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
    $name="dssvnoptiendiennuoc.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>