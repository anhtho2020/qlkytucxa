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
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CHÍNH TRỊ- HSSV');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, ' BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ ');
    $workSheet->mergeCells('A5:J5');
    $workSheet->getStyle('A5:J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH SVLT TRẢ TIỀN PHÒNG ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MASVLT');
    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ TÊN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'NGÀY SINH');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'ĐƠN GIÁ');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'NGÀY THU');
    $workSheet->setCellValueByColumnAndRow(7, 7, ' HỌC KỲ ');
    $workSheet->setCellValueByColumnAndRow(8, 7, ' NĂM HỌC ');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'NGƯỜI THU');
    //$query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.DONGIA,a.NGAYTHU,a.SOTHANG,a.THANHTIEN,a.NGUOITHU from thutienphongsinhvien a, sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN";
    //$query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.DONGIA,a.NGAYTHU,a.SOTHANG,a.THANHTIEN,a.NGUOITHU from thutienphongsinhvien a, sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN";
    //$query.="from thutienphongsinhvien a, sinhvien b "; 
    //$query.="where a.ID_SINHVIEN=b.ID_SINHVIEN ";
    $query ="select a.ID_TIENPHONGSINHVIENLT,a.ID_LIENTHONG,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,d.TENPHONG from ";
        $query.= "tienphongsinhvienlt a,lienthong b,dssvltnoitru c, phong d where ";
        $query.="a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_LIENTHONG=c.ID_LIENTHONG and c.ID_PHONG=d.ID_PHONG ";
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(6);
    $workSheet->getColumnDimension('B')->setWidth(10);
    $workSheet->getColumnDimension('C')->setWidth(20);
    $workSheet->getColumnDimension('D')->setWidth(8);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(12);
    $workSheet->getColumnDimension('H')->setWidth(8);
    $workSheet->getColumnDimension('I')->setWidth(12);
    $workSheet->getColumnDimension('J')->setWidth(15);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MASV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->NGAYSINH);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->DONGIA);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->HOCKY);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NAMHOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->NGUOITHU);
        $tongsotien=$tongsotien+$row->DONGIA;
        $tuDong++; $stt++;
    }   
    
    $workSheet->mergeCells("A".(8+$somautin).":E".(8+$somautin));
    $workSheet->getStyle("A".(8+$somautin).":E".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(5, $tuDong, $tongsotien);
    
    //$workSheet->mergeCells("B".(11+$somautin).":C".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("E".(10+$somautin).":I".(10+$somautin));
    $workSheet->getStyle("E".(10+$somautin).":I".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("E".($tuDong+2))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("E".(11+$somautin).":I".(11+$somautin));
    $workSheet->getStyle("E".(11+$somautin).":I".(11+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+3, 'Người lập bảng' );
    
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
    $name="dssvnoptienphonglt.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>