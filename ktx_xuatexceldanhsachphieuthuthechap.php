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
    //echo $tungay;
    /*
    if(isset($_POST["tungay"])){
             $tn=$_POST["tungay"];
             $x=explode("/", $tn);
             $tungay=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
    if(isset($_POST["denngay"])){
             $dn=$_POST["denngay"];
             $x=explode("/", $dn);
             $denngay=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
     */
     
    $denngay=$_POST["denngay"];
    //echo $denngay;
    $tongsotien=0;
    
    
    $workSheet->mergeCells('F1:J1');
    $workSheet->getStyle('F1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(5, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('F2:J2');
    $workSheet->getStyle('F2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(5, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:E1');
    $workSheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CAO ĐẲNG KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:E2');
    $workSheet->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CHÍNH TRỊ- HSSV');
    $workSheet->mergeCells('A3:E3');
    $workSheet->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, ' BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ ');
    $workSheet->mergeCells('A5:I5');
    $workSheet->getStyle('A5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH PHIẾU THU TIỀN THẾ CHẤP TỪ '.$tungay.' ĐẾN '.$denngay);
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->setCellValueByColumnAndRow(1, 7, ' SỐ PHIẾU');
//    $workSheet->mergeCells('C7:D7');
    $workSheet->setCellValueByColumnAndRow(2, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(3, 7, 'SỐ TIỀN');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'NGÀY THẾ CHẤP');
    $workSheet->setCellValueByColumnAndRow(5, 7, ' NGÀY IN PHIẾU');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'NGƯỜI NỘP');
    $workSheet->setCellValueByColumnAndRow(7, 7, ' NGƯỜI THU ');
    $workSheet->setCellValueByColumnAndRow(8, 7, ' HỌC KỲ ');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'NĂM HỌC');
   
    $query="select a.ID_THECHAP,a.ID_SINHVIEN,a.NGAYTHECHAP,a.SOTIEN,a.HOCKY,a.NAMHOC,a.NGUOITHU,"
            . "a.NGAYINPHIEU,"
            . "b.MASV,b.HODEM,b.TEN,b.PHAI,b.NGAYSINH,d.TENPHONG "
            . "from dsphieuthuthechap a,sinhvien b,thechap c,phong d "
            . "where a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_SINHVIEN=c.ID_SINHVIEN and "
            . "c.ID_PHONG=d.ID_PHONG and (a.NGAYINPHIEU>='$tungay' and a.NGAYINPHIEU<='$denngay')";
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
//    echo $query;
    
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(6);
    $workSheet->getColumnDimension('B')->setWidth(10);
    $workSheet->getColumnDimension('C')->setWidth(10);
    $workSheet->getColumnDimension('D')->setWidth(8);
    $workSheet->getColumnDimension('E')->setWidth(12);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(18);
    $workSheet->getColumnDimension('H')->setWidth(18);
    $workSheet->getColumnDimension('I')->setWidth(8);
    $workSheet->getColumnDimension('J')->setWidth(12);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->ID_THECHAP);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->SOTIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->NGAYTHECHAP);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->NGAYINPHIEU);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->HODEM.' '.$row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->HOCKY);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->NAMHOC);
        $tongsotien=$tongsotien+$row->SOTIEN;
        $tuDong++; $stt++;
    }   
    
    $workSheet->mergeCells("A".(8+$somautin).":C".(8+$somautin));
    $workSheet->getStyle("A".(8+$somautin).":C".(8+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'TỔNG CỘNG');
    $workSheet->setCellValueByColumnAndRow(3, $tuDong, $tongsotien);
    
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
    $name="dsphieuthutienthechaptungaydenngay.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
     
     
?>