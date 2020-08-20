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
    
    $workSheet->mergeCells('E1:I1');
    $workSheet->getStyle('E1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:I2');
    $workSheet->getStyle('E2:I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:D1');
    $workSheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:D2');
    $workSheet->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, ' PHÒNG CÔNG TÁC CHÍNH TRỊ- HSSV');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, ' BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ ');
    $workSheet->mergeCells('A5:I5');
    $workSheet->getStyle('A5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH HSSV_HSNH Ở KÝ TÚC XÁ ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MA HSSV');
    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ TÊN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'PHÁI');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'NGÀY SINH');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'CMND');
//    $workSheet->setCellValueByColumnAndRow(7, 7, 'NƠI SINH');
    $workSheet->setCellValueByColumnAndRow(7, 7, 'ĐỊA CHỈ');
//    $workSheet->setCellValueByColumnAndRow(9, 7, 'EMAIL');
    $workSheet->setCellValueByColumnAndRow(8, 7, 'SỐ ĐIỆN THOẠI');
    //$query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.DONGIA,a.NGAYTHU,a.SOTHANG,a.THANHTIEN,a.NGUOITHU from thutienphongsinhvien a, sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN";
    $query="select * from hssvnoitru";
    //$query.="from thutienphongsinhvien a, sinhvien b "; 
    //$query.="where a.ID_SINHVIEN=b.ID_SINHVIEN ";
    $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(6);
    $workSheet->getColumnDimension('B')->setWidth(12);
    $workSheet->getColumnDimension('C')->setWidth(17);
    $workSheet->getColumnDimension('D')->setWidth(8);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(22);
    
    
    $workSheet->getColumnDimension('H')->setWidth(17);
    $workSheet->getColumnDimension('I')->setWidth(17);
//    $workSheet->getColumnDimension('J')->setWidth(17);
//    $workSheet->getColumnDimension('K')->setWidth(17);
    while($row=mysql_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MASV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->PHAI);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->NGAYSINH);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->CMND);
//        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->NOISINH);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->DIACHI);
//        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->EMAIL);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->DIENTHOAI);
        $tuDong++; $stt++;
    }  
    $stt=$stt-1;
    $workSheet->mergeCells("A".(9+$somautin).":B".(9+$somautin));
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'Danh sách có '.$stt.' hssv ');
    
    $workSheet->mergeCells("B".(10+$somautin).":E".(10+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    $workSheet->getStyle("B".(10+$somautin))->getFont()->setSize(14);
    $workSheet->getStyle("B".(10+$somautin))->getFont()->setBold(true);
    
    $now = getdate(); 
    $workSheet->mergeCells("G".(10+$somautin).":I".(10+$somautin));
    $workSheet->getStyle("G".(10+$somautin).":I".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(6, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("G".(10+$somautin))->getFont()->setItalic(true);
    
    $khoi="A7:I".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="dshssvnoitru_hsnh.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>