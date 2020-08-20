<?php
    include("Classes/PHPExcel.php");
    include 'dbcon.php';
    ob_end_clean();
    ob_start();
    $connect=  clsConnet::DBConnect();
    $objReader=new PHPExcel_Reader_Excel5();
    $objPHPExcel=new PHPExcel();
    $workSheet=$objPHPExcel->getActiveSheet();
//    $connect=mysql_connect("localhost", "root", "");
//    mysql_select_db("ktxdatabase", $connect);
//    mysql_query("SET CHARACTER SET utf8",$connect);
    
    $query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.NGAYNOITRU, c.TENPHONG from danhsachnoitru a, sinhvien b, phong c where (a.ID_SINHVIEN=b.ID_SINHVIEN) and (a.ID_PHONG=c.ID_PHONG)";
    //$query="select * from sinhvien where ID_SINHVIEN in (select ID_SINHVIEN from danhsachnoitru)";// where ID_DAY=$idday and ID_PHONG=$idphong)";  
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    $workSheet->mergeCells('E1:G1');
    $workSheet->getStyle('E1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:G2');
    $workSheet->getStyle('E2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:D1');
    $workSheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:D2');
    $workSheet->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, ' PHÒNG CÔNG TÁC CT-HSSV');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, ' BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ ');
    $workSheet->mergeCells('A5:G5');
    $workSheet->getStyle('A5:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, ' DANH SÁCH HSSV NỘI TRÚ ');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MASV');
    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'HỌ TÊN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'NGÀY SINH');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'NGÀY NỘI TRÚ');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'TÊN PHÒNG');
    
//    $workSheet->mergeCells("C".(9+$somautin).":G".(9+$somautin));
//    $workSheet->setCellValueByColumnAndRow(3, 9+$somautin, 'Cần thơ, ngày     tháng    năm 2015');
//    $workSheet->mergeCells("C".(10+$somautin).":G".(10+$somautin));
//    $workSheet->setCellValueByColumnAndRow(3, 10+$somautin, 'Người lập bảng');
    
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
       
    $workSheet->getColumnDimension('A')->setWidth(5);
    $workSheet->getColumnDimension('B')->setWidth(15);
    $workSheet->getColumnDimension('C')->setWidth(22);
    $workSheet->getColumnDimension('D')->setWidth(12);
    $workSheet->getColumnDimension('E')->setWidth(15);
    $workSheet->getColumnDimension('F')->setWidth(15);
    $workSheet->getColumnDimension('G')->setWidth(12);
//    $workSheet->getColumnDimension('H')->setWidth(8);
//    $workSheet->getColumnDimension('I')->setWidth(15);
//    $workSheet->getColumnDimension('J')->setWidth(15);
//    $workSheet->getColumnDimension('K')->setWidth(15);
    
    while($row=mysqli_fetch_object($result)){
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MASV);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->NGAYSINH);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->NGAYNOITRU);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->TENPHONG);
        $tuDong++; $stt++;
    }    
    $stt=$stt-1;
    $workSheet->mergeCells("A".(9+$somautin).":B".(9+$somautin));
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'Danh sách có '.$stt.' học sinh sinh viên ');
    
    $workSheet->mergeCells("A".(10+$somautin).":D".(10+$somautin));
    
    $workSheet->getStyle("A".(10+$somautin).":D".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong+2, 'Phòng công tác CT-HSSV');
    $workSheet->getStyle("A".(10+$somautin))->getFont()->setSize(14);
    $workSheet->getStyle("A".(10+$somautin))->getFont()->setBold(true);
    
    $now = getdate(); 
    $workSheet->mergeCells("E".(10+$somautin).":G".(10+$somautin));
    $workSheet->getStyle("E".(10+$somautin).":G".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("E".(10+$somautin))->getFont()->setItalic(true);
    
    $khoi="A7:G".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    
    
    
    header('Content-Type: application/vnd.ms-excel');
    $name="dssinhviennoitru.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>