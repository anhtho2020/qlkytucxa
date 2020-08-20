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
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH MỤC LỚP LIÊN THÔNG');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'MÃ LỚP');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'TÊN LỚP');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'BẬC HỌC');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'NGÀNH HỌC');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'TRƯỜNG');
//    $workSheet->setCellValueByColumnAndRow(6, 7, 'ĐƠN VỊ TÍNH');
    $query="select a.MALOPLT,a.TENLOPLT,b.TENBACHOC,c.TENNGANH,d.TENTRUONG"
            . " from loplt a,bachoclt b,nganhlt c,truong d "
            . " where a.ID_BACHOC=b.ID_BACHOC and a.ID_NGANH=c.ID_NGANH and a.ID_TRUONG=d.ID_TRUONG "; 
    //echo $query;
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setAutoSize(true);
    $workSheet->getColumnDimension('B')->setAutoSize(true);
    $workSheet->getColumnDimension('C')->setAutoSize(true);
    $workSheet->getColumnDimension('D')->setAutoSize(true);
    $workSheet->getColumnDimension('E')->setAutoSize(true);
    $workSheet->getColumnDimension('F')->setAutoSize(true);
//    $workSheet->getColumnDimension('G')->setAutoSize(true);

    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->MALOPLT);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TENLOPLT);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->TENBACHOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->TENNGANH);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->TENTRUONG);
//        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->DONVITINH);

        $tuDong++; $stt++;
    }    
    $khoi="A7:F".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="danhmucloplt.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>