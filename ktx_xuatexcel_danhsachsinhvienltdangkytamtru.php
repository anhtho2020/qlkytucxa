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
    
    //$namhoc=$_POST["namhoc"];
    
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
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CT-HSSV');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, ' BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ ');
    $workSheet->mergeCells('A5:K5');
    $workSheet->getStyle('A5:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, ' DANH SÁCH SVLT Ở KÝ TÚC XÁ ĐĂNG KÝ TẠM TRÚ ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->mergeCells('B7:C7');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'HỌ VÀ TÊN');
//    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ TÊN');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'NGÀY SINH');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'CMND');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'ĐỊA CHỈ');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'LỚP');
    $workSheet->setCellValueByColumnAndRow(7, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(8, 7, ' NGÀY NỘI TRÚ ');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'NGÀY TẠM TRÚ');
    $workSheet->setCellValueByColumnAndRow(10, 7, 'GHI CHÚ');
    
    //$query ="select a.ID_SINHVIEN,a.ID_PHONG,a.NGAYNOITRU, b.MASV, b.HODEM,b.TEN, b.NGAYSINH,b.CMND,b.NOISINH,c.TENPHONG,d.MALOPCHUYENNGANH,a.GHICHU from danhsachnoitru a,sinhvien b, phong c, lopchuyennganh d  where ID_LOAINOITRU=1 and (a.ID_SINHVIEN=b.ID_SINHVIEN) and (a.ID_PHONG=c.ID_PHONG) and (b.ID_LOPCHUYENNGANH=d.ID_LOPCHUYENNGANH)";  
    $query ="select a.ID_LIENTHONG,a.NGAYTAMTRU,b.ID_PHONG,b.NGAYNOITRU, c.MASV, c.HODEM,c.TEN, c.NGAYSINH,"
            . "c.CMND,c.DIACHI,d.TENPHONG,e.MALOPLT,b.GHICHU from dangkytamtrult a,"
            . "dssvltnoitru b, lienthong c, phong d, loplt e  "
            . "where  (a.ID_LIENTHONG=b.ID_LIENTHONG) and (a.ID_LIENTHONG=c.ID_LIENTHONG) and "
            . "(b.ID_PHONG=d.ID_PHONG) and (c.ID_LOP=e.ID_LOPLT)";  
    $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
        
    $workSheet->getColumnDimension('A')->setWidth(5);
    $workSheet->getColumnDimension('B')->setWidth(22);
    $workSheet->getColumnDimension('C')->setWidth(8);
    $workSheet->getColumnDimension('D')->setWidth(12);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(15);
    $workSheet->getColumnDimension('G')->setWidth(10);
    $workSheet->getColumnDimension('H')->setWidth(8);
    $workSheet->getColumnDimension('I')->setWidth(15);
    $workSheet->getColumnDimension('J')->setWidth(15);
    $workSheet->getColumnDimension('K')->setWidth(15);
    
    while($row=mysql_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->NGAYSINH);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->CMND);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->DIACHI);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->MALOPLT);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NGAYNOITRU);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->NGAYTAMTRU);
        
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->GHICHU);
        
        $tuDong++; $stt++;
    }    
    
    $workSheet->mergeCells("A".(9+$somautin).":B".(9+$somautin));
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'Danh sách có '.$stt.' học sinh sinh viên ');
    
    $workSheet->mergeCells("B".(11+$somautin).":E".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    
    $now = getdate(); 
    $workSheet->mergeCells("H".(11+$somautin).":K".(11+$somautin));
    $workSheet->setCellValueByColumnAndRow(7, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    
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
    $name="dssinhvienltdangkytamtru.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>