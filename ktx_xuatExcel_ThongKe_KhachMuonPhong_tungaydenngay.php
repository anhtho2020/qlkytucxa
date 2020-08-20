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
    $tungay=$_POST["tungay"];
    $denngay=$_POST["denngay"];
    
    $workSheet->mergeCells('E1:K1');
    $workSheet->getStyle('E1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 1, 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
    $workSheet->mergeCells('E2:K2');
    $workSheet->getStyle('E2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(4, 2, 'Độc lập - Tự do - Hạnh phúc');
    
    $workSheet->mergeCells('A1:D1');
    $workSheet->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 1, 'TRƯỜNG CĐ KINH TẾ- KỸ THUẬT CẦN THƠ');
    $workSheet->mergeCells('A2:D2');
    $workSheet->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 2, 'PHÒNG CÔNG TÁC CT-HSSV ');
    $workSheet->mergeCells('A3:D3');
    $workSheet->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 3, 'BỘ PHẬN QUẢN LÝ KÝ TÚC XÁ');
    $workSheet->mergeCells('A5:K5');
    $workSheet->getStyle('A5:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 5, 'DANH SÁCH KHÁCH MƯỚN PHÒNG');
    $workSheet->getStyle('A5')->getFont()->setSize(14);
    $workSheet->getStyle('A5')->getFont()->setBold(true);
    
    $workSheet->mergeCells('A6:K6');
    $workSheet->getStyle('A6:K6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->setCellValueByColumnAndRow(0, 6, 'Từ ngày '.$tungay.' đến ngày '.$denngay);
    $workSheet->getStyle('A6')->getFont()->setSize(13);
    $workSheet->getStyle('A6')->getFont()->setItalic(true);
    
    $workSheet->setCellValueByColumnAndRow(0, 7, 'STT');
    $workSheet->mergeCells('B7:C7');
    $workSheet->setCellValueByColumnAndRow(1, 7, 'HỌ TÊN');
    
    $workSheet->setCellValueByColumnAndRow(3, 7, 'NGÀY MƯỚN PHÒNG');
    $workSheet->setCellValueByColumnAndRow(4, 7, 'SỐ NGÀY');
    $workSheet->setCellValueByColumnAndRow(5, 7, 'ĐƠN GIÁ');
    $workSheet->setCellValueByColumnAndRow(6, 7, 'THÀNH TIỀN');
    $workSheet->setCellValueByColumnAndRow(7, 7, 'NGÀY IN PHIẾU');
    $workSheet->setCellValueByColumnAndRow(8, 7, 'NGƯỜI THU');
    $workSheet->setCellValueByColumnAndRow(9, 7, 'PHÒNG');
    $workSheet->setCellValueByColumnAndRow(10, 7, 'SỐ PHIẾU');
    $query =$query ="select a.ID_THUTIENPHONGKHACH,a.ID_KHACH,a.ID_PHONG,a.NGAYMUON,a.SONGAY,a.DONGIA,a.THANHTIEN,a.NGAYTHU,a.NGAYINPHIEU"
                . ",a.NGUOITHU,b.HODEM,b.TEN,c.TENPHONG "
                . "from dsphieuthutienphongkhach a,khach b, phong c "
                . "where (a.ID_KHACH=b.ID_KHACH) and (a.ID_PHONG=c.ID_PHONG) and (a.NGAYINPHIEU>='$tungay' and a.NGAYINPHIEU<='$denngay')";
    //$query.="from danhsachnoitru a,khach b, phong c";
    //.="where (a.ID_KHACH=b.ID_KHACH) and (a.ID_PHONG=c.ID_PHONG) and (a.NGAYNOITRU>'$tungay' and a.NGAYNOITRU<'$denngay')";
    
    $result=mysqli_query($connect,$query);
    $somautin=  mysqli_num_rows($result);
    
    //echo $query;
    $tuDong=8; $tuCot=0; $stt=1;
    $workSheet->getColumnDimension('A')->setWidth(6);
    $workSheet->getColumnDimension('B')->setWidth(12);
    $workSheet->getColumnDimension('C')->setWidth(6);
    $workSheet->getColumnDimension('D')->setWidth(15);
    $workSheet->getColumnDimension('E')->setWidth(5);
    $workSheet->getColumnDimension('F')->setWidth(12);
    $workSheet->getColumnDimension('G')->setWidth(14);
    $workSheet->getColumnDimension('H')->setWidth(12);
    $workSheet->getColumnDimension('I')->setWidth(14);
    $workSheet->getColumnDimension('J')->setWidth(6);
    $workSheet->getColumnDimension('K')->setWidth(6);
//    $workSheet->getColumnDimension('H')->setAutoSize(true);
//    $workSheet->getColumnDimension('I')->setAutoSize(true);
//    $workSheet->getColumnDimension('J')->setAutoSize(true);
    while($row=mysqli_fetch_object($result)){
                
        $workSheet->setCellValueByColumnAndRow($tuCot, $tuDong, $stt);
        $workSheet->setCellValueByColumnAndRow($tuCot+1, $tuDong, $row->HODEM);
        $workSheet->setCellValueByColumnAndRow($tuCot+2, $tuDong, $row->TEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+3, $tuDong, $row->NGAYMUON);
        $workSheet->setCellValueByColumnAndRow($tuCot+4, $tuDong, $row->SONGAY);
        $workSheet->setCellValueByColumnAndRow($tuCot+5, $tuDong, $row->DONGIA);
        $workSheet->setCellValueByColumnAndRow($tuCot+6, $tuDong, $row->THANHTIEN);
        $workSheet->setCellValueByColumnAndRow($tuCot+7, $tuDong, $row->NGAYINPHIEU);
        $workSheet->setCellValueByColumnAndRow($tuCot+8, $tuDong, $row->NGUOITHU);
        $workSheet->setCellValueByColumnAndRow($tuCot+9, $tuDong, $row->TENPHONG);
        $workSheet->setCellValueByColumnAndRow($tuCot+10, $tuDong, $row->ID_THUTIENPHONGKHACH);
        $tuDong++; $stt++;
    }  
    $stt=$stt-1;
    $workSheet->mergeCells("A".(9+$somautin).":B".(9+$somautin));
    $workSheet->setCellValueByColumnAndRow(0, $tuDong, 'Danh sách có '.$stt.' khách ');
    
    $workSheet->mergeCells("B".(10+$somautin).":D".(10+$somautin));
    $workSheet->getStyle("B".(10+$somautin).":D".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->mergeCells("B".(10+$somautin).":D".(10+$somautin));
    $workSheet->setCellValueByColumnAndRow(1, $tuDong+2, 'Phòng công tác CT-HSSV');
    $workSheet->getStyle("B".(10+$somautin))->getFont()->setSize(14);
    $workSheet->getStyle("B".(10+$somautin))->getFont()->setBold(true);
    
    $now = getdate(); 
    $workSheet->mergeCells("E".(10+$somautin).":K".(10+$somautin));
    $workSheet->getStyle("E".(10+$somautin).":K".(10+$somautin))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $workSheet->mergeCells("E".(10+$somautin).":K".(10+$somautin));
    $workSheet->setCellValueByColumnAndRow(4, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
    $workSheet->getStyle("E".(10+$somautin))->getFont()->setSize(13);
    $workSheet->getStyle("E".(10+$somautin))->getFont()->setItalic(true);
    
    
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
    $name="dskhachmuontungaydenngayphong.xls";
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
?>