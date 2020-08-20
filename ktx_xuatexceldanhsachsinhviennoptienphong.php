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
//    
    $tongsotien=0;
    
    $workSheet->mergeCells('E1:K1');
    $workSheet->getStyle('E1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:K2');
    $workSheet->getStyle('E2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
    $workSheet->mergeCells('A5:K5');
    $workSheet->getStyle('A5:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH HSSV NỘP TIỀN PHÒNG ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MASV');
    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ TÊN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'ĐƠN GIÁ');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'NGÀY THU');
    $workSheet->setCellValueByColumnAndRow(7, 7, ' HỌC KỲ ');
    $workSheet->setCellValueByColumnAndRow(8, 7, ' NĂM HỌC ');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'NGƯỜI THU');
    $workSheet->setCellValueByColumnAndRow(10, 7, 'GHI CHÚ');
    
    $query ="select a.ID_THUTIENPHONGSINHVIEN,a.ID_SINHVIEN,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,a.GHICHU,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,d.TENPHONG from ";
        $query.= "thutienphongsinhvien a,sinhvien b,danhsachnoitru c, phong d where ";
        $query.="a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_SINHVIEN=c.ID_SINHVIEN and c.ID_PHONG=d.ID_PHONG ";
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(5);
    $workSheet->getColumnDimension('B')->setWidth(12);
    $workSheet->getColumnDimension('C')->setWidth(20);
    $workSheet->getColumnDimension('D')->setWidth(8);
    $workSheet->getColumnDimension('E')->setWidth(8);
    $workSheet->getColumnDimension('F')->setWidth(10);
    $workSheet->getColumnDimension('G')->setWidth(12);
    $workSheet->getColumnDimension('H')->setWidth(8);
    $workSheet->getColumnDimension('I')->setWidth(12);
    $workSheet->getColumnDimension('J')->setWidth(15);
    $workSheet->getColumnDimension('K')->setWidth(25);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MASV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->DONGIA);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->HOCKY);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NAMHOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->GHICHU);
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
    $workSheet->mergeCells("E".(10+$somautin).":K".(10+$somautin));
    $workSheet->getStyle("E".(10+$somautin).":K".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("E".($tuDong+2))->getFont()->setItalic(true);
    
    $workSheet->mergeCells("E".(11+$somautin).":K".(11+$somautin));
    $workSheet->getStyle("E".(11+$somautin).":K".(11+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+3, 'Người lập bảng' );
    
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
    $name="dssvnoptienphong.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>