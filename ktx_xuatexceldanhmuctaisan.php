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
    
    $workSheet->mergeCells('D1:G1');
    $workSheet->getStyle('D1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('D2:G2');
    $workSheet->getStyle('D2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(3, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:C1');
    $workSheet->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:C2');
    $workSheet->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CT-HSSV');
    $workSheet->mergeCells('A3:C3');
    $workSheet->getStyle('A3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, 'BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ');
    $workSheet->mergeCells('A5:G5');
    $workSheet->getStyle('A5:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH MỤC TÀI SẢN');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MÃ TÀI SẢN');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'TÊN TÀI SẢN');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'KIỂU MẪU');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'NĂM SẢN XUẤT');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'NƯỚC SẢN XUẤT');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'ĐƠN VỊ TÍNH');
    $query="select * from taisan";
    $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setAutoSize(true);
    $workSheet->getColumnDimension('B')->setAutoSize(true);
    $workSheet->getColumnDimension('C')->setAutoSize(true);
    $workSheet->getColumnDimension('D')->setAutoSize(true);
    $workSheet->getColumnDimension('E')->setAutoSize(true);
    $workSheet->getColumnDimension('F')->setAutoSize(true);
    $workSheet->getColumnDimension('G')->setAutoSize(true);

    while($row=mysql_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MATAISAN);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TENTAISAN);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->KIEUMAU);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->NAMSANXUAT);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->NUOCSANXUAT);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->DONVITINH);

        $tuDong++; $stt++;
    }    
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
    $name="danhmuctaisan.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>