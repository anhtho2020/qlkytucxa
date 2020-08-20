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
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CT-HSSV');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, 'BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ');
    $workSheet->mergeCells('A5:I5');
    $workSheet->getStyle('A5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH HSSV Ở KÝ TÚC XÁ ĐĂNG KÝ TẠM TRÚ NĂM HỌC');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'TÊN PHÒNG');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'ĐƠN GIÁ ĐIỆN');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'CHỈ SỐ ĐIỆN CŨ');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'CHỈ SỐ ĐIỆN MỚI');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'ĐƠN GIÁ NƯỚC');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'CHỈ SỐ NƯỚC CŨ');
    $workSheet->setCellValueByColumnAndRow(7, 7, 'CHỈ SỐ NƯỚC MỚI');
    $workSheet->setCellValueByColumnAndRow(8, 7, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'NGÀY THU');
    $workSheet->setCellValueByColumnAndRow(10, 7, 'THÁNG NỘP');
    $workSheet->setCellValueByColumnAndRow(11, 7, 'NGƯỜI THU');
    $workSheet->setCellValueByColumnAndRow(12, 7, 'NGƯỜI NỘP');
    //$query="select a.ID_SINHVIEN, b.MASV, b.HODEM, b.TEN, b.NGAYSINH,a.DONGIA,a.NGAYTHU,a.SOTHANG,a.THANHTIEN,a.NGUOITHU from thutienphongsinhvien a, sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN";
    $query="select a.ID_PHONG, b.TENPHONG, a.GIADIEN,a.CSDIENCU,a.CSDIENMOI,a.GIANUOC,a.CSNUOCCU,a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.THANGNOP,a.NGUOITHU,a.NGUOINOP from thudiennuoc a, phong b where a.ID_PHONG=b.ID_PHONG";
    //$query.="from thutienphongsinhvien a, sinhvien b "; 
    //$query.="where a.ID_SINHVIEN=b.ID_SINHVIEN ";
    $result=mysql_query($query, $connect);
    $somautin=  mysql_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setAutoSize(true);
    $workSheet->getColumnDimension('B')->setAutoSize(true);
    $workSheet->getColumnDimension('C')->setAutoSize(true);
    $workSheet->getColumnDimension('D')->setAutoSize(true);
    $workSheet->getColumnDimension('E')->setAutoSize(true);
    $workSheet->getColumnDimension('F')->setAutoSize(true);
    $workSheet->getColumnDimension('G')->setAutoSize(true);
    $workSheet->getColumnDimension('H')->setAutoSize(true);
    $workSheet->getColumnDimension('I')->setAutoSize(true);
    $workSheet->getColumnDimension('J')->setAutoSize(true);
    $workSheet->getColumnDimension('K')->setAutoSize(true);
    $workSheet->getColumnDimension('L')->setAutoSize(true);
    $workSheet->getColumnDimension('M')->setAutoSize(true);
    while($row=mysql_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->GIADIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->CSDIENCU);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->CSDIENMOI);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->GIANUOC);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->CSNUOCCU);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->CSNUOCMOI);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->THANHTIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->NGAYTHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->THANGNOP);
        $workSheet->setCellValueByColumnAndRow($tuCot+11, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+12, $tuDong, $row->NGUOINOP);
        $tuDong++; $stt++;
    }    
    $khoi="A7:M".(7+$somautin);
    $dinhDang=array(
        'borders' => array(
             'allborders' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        
         ),
    );
    $workSheet->getStyle($khoi)->applyFromArray($dinhDang);
    header('Content-Type: application/vnd.ms-excel');
    $name="dsphongnoptiendiennuoc.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>