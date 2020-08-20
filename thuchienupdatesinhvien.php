<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
	//$link1=  clsConnet::DBConnect1();

        $totalRows_sv = 0;       
        $query_sv ="select * from sv ";// where MALOPCHUYENNGANH='$malop'";
        $result_sv = mysql_query($query_sv, $link);  
        $totalRows_sv=mysql_num_rows($result_sv);
        $row_sv = mysql_fetch_array ($result_sv);
        echo $totalRows_sv ." va";
    
        $totalRows_sinhvien = 0;       
        $query_sinhvien ="select * from sinhvien ";// where MALOPCHUYENNGANH='$malop'";
        $result_sinhvien = mysql_query($query_sinhvien, $link);  
        $totalRows_sinhvien=mysql_num_rows($result_sinhvien);
        //$row_sinhvien = mysql_fetch_array ($result_sinhvien);
        echo $totalRows_sinhvien;
        $arr=array();
        $arr_sinhvien=array();
//        while ($row_sinhvien = mysql_fetch_array ($result_sinhvien)) 
//        {
//            $arr[]=$row_sinhvien["ID_SINHVIEN"];
//        }
        while($row_sinhvien=mysql_fetch_array($result_sinhvien)){
                $arr_sinhvien[]=$row_sinhvien["ID_SINHVIEN"];
        }
//        foreach($arr_sv as $v){
//                    //if($arr[$i]==$v){$f=true;}
//            echo $v; echo "<br>";
//        }
        
//        for($i=0;$i<$totalRows_sv;$i++)
//        {
//            echo $arr[$i];echo "<br>";
//        }
        
    $kt=FALSE;     
//    if($totalRows_sinhvien>0)
//    {
//        while ($row_sinhvien = mysql_fetch_array ($result_sinhvien)) 
//        {
//            $idsinhvien=$row_sinhvien["ID_SINHVIEN"];
            
//            for($i=0;$i<$totalRows_sinhvien;$i++)
//            {
//                if($arr[$i] == $idsinhvien)
//                {
//                    $kt=$kt+1;//$idsv=$idsinhvien;
//                }
//   
//                     }
    
//        for($i=0;$i<$totalRows_sinhvien-1;$i++)
//        {
//            for($j=0;$j<$totalRows_sv-1;$j++){
//                if($arr[$i]==$arr_sv[$j])
//                    {
//                        $kt=TRUE;
//                        //echo $arr[$i]; echo "<br>";
//                    }
//                
//            }
//            if($kt==FALSE) 
//            {
//                echo "Không có dl trùng."; echo "<br>";
//            }
//            else {
//                echo "Có dl trùng.".$arr[$i]; echo "<br>";
//            }
//            $kt=FALSE;
//        }
            
//        }
//        
//    }
    //echo $i." va ".$j;
        
        
//    $kt=0;    
    if($totalRows_sv>0)
    {
        
        while ($row_sv = mysql_fetch_array ($result_sv)) 
        {
            $idsv=$row_sv["ID_SINHVIEN"];
//            
//            for($i=0;$i<$totalRows_sinhvien;$i++)
//            {
//                if($arr[$i] == $idsinhvien)
//                {
//                    $kt=$kt+1;//$idsv=$idsinhvien;
//                }
//            }
//            
             for($j=0;$j<$totalRows_sinhvien;$j++){
                if($idsv==$arr_sinhvien[$j])
                    {
                        $kt=TRUE;
                        //echo $arr[$i]; echo "<br>";
                    }
                
            }
                if($kt==TRUE)
                {
/*
                    $query="INSERT INTO sinhvien ("
                            . " ID_SINHVIEN,ID_QUYEN,ID_KHOA,ID_NGANH,ID_CHUYENNGANH,"
                            . " ID_LOPCHUYENNGANH,MASV,HODEM,TEN,PHAI,NGAYSINH,"
                            . " CMND,NGAYCAP,NOICAP,NOISINH,DIACHI,EMAIL,SODIENTHOAI,DIENTHOAIBAN,DANTOC,"
                            . " TONGIAO,DIENCHINHSACH,DOITUONGUUTIEN,TPGIADINH,TRINHDOVANHOA,"
                            . " NGAYKETNAPDOAN,NOIKETNAPDOAN,NGAYKETNAPDANG,NOIKETNAPDANG,NGAYVAOTRUONG,"
                            . " QUATRINHCONGTAC,DIACHILIENLAC,HOTENVOCHONG,"
                            . " NGHENGHIEPVOCHONG,HINHANH,HOTENCHA,NAMSINHCHA,DANTOCCHA,TONGIAOCHA,NGHECHA,SODIENTHOAICHA,"
                            . " HOTENME,NAMSINHME,DANTOCME,TONGIAOME,NGHEME,SODIENTHOAIME,DIACHICHAME,ID_TINH,ID_QUANHUYEN,"
                            . " NAMNHAPHOC,GHICHU,MATKHAU,XOATEN,BAOLUU,SOHOSO,DATOTNGHIEP,"
                            . " ID_BACDAOTAO,ID_HEDAOTAO,SOQDXOATEN,CANHBAOHV,THEME,HINHHOSO,HINHDAIDIEN,HOKHAU,"
                            . " created_at,updated_at,deleted_at"
                            . ")"
                            . " select ID_SINHVIEN,ID_QUYEN,ID_KHOA,ID_NGANH,ID_CHUYENNGANH,"
                            . " ID_LOPCHUYENNGANH,MASV,HODEM,TEN,PHAI,NGAYSINH,"
                            . " CMND,NGAYCAP,NOICAP,NOISINH,DIACHI,EMAIL,SODIENTHOAI,DIENTHOAIBAN,DANTOC,"
                            . " TONGIAO,DIENCHINHSACH,DOITUONGUUTIEN,TPGIADINH,TRINHDOVANHOA,"
                            . " NGAYKETNAPDOAN,NOIKETNAPDOAN,NGAYKETNAPDANG,NOIKETNAPDANG,NGAYVAOTRUONG,"
                            . " QUATRINHCONGTAC,DIACHILIENLAC,HOTENVOCHONG,"
                            . " NGHENGHIEPVOCHONG,HINHANH,HOTENCHA,NAMSINHCHA,DANTOCCHA,TONGIAOCHA,NGHECHA,SODIENTHOAICHA,"
                            . " HOTENME,NAMSINHME,DANTOCME,TONGIAOME,NGHEME,SODIENTHOAIME,DIACHICHAME,ID_TINH,ID_QUANHUYEN,"
                            . " NAMNHAPHOC,GHICHU,MATKHAU,XOATEN,BAOLUU,SOHOSO,DATOTNGHIEP,"
                            . " ID_BACDAOTAO,ID_HEDAOTAO,SOQDXOATEN,CANHBAOHV,THEME,HINHHOSO,HINHDAIDIEN,HOKHAU,"
                            . " created_at,updated_at,deleted_at"
                            . " from sv "
                            . " where ID_SINHVIEN=$idsv";
                    mysql_query($query, $link);
                    echo $query;
                }

                else {
*/
                    $idquuyen=$row_sv["ID_QUYEN"];
                    if($idquuyen==NULL){$idquuyen="NULL";} 
                    else {
                        $idquuyen=$row_sv["ID_QUYEN"];
                    }
                    $idkhoa=$row_sv["ID_KHOA"];
                    $idnganh=$row_sv["ID_NGANH"];
                    $idchuyennganh=$row_sv["ID_CHUYENNGANH"];
                    $idlopchuyennganh=$row_sv["ID_LOPCHUYENNGANH"];
                    $masv=$row_sv["MASV"];
                    $hodem=$row_sv["HODEM"];
                    $ten=$row_sv["TEN"];
                    $phai=$row_sv["PHAI"];
                    $ngaysinh=$row_sv["NGAYSINH"];
                    //$cmnd=$row_sv["CMND"];
                    $ngaycap=$row_sv["NGAYCAP"];
                    $noicap=$row_sv["NOICAP"];
                    $noisinh=$row_sv["NOISINH"];
                    //$diachi=$row_sv["DIACHI"];
                    $email=$row_sv["EMAIL"];
                    $sodienthoai=$row_sv["SODIENTHOAI"];
                    $dienthoaiban=$row_sv["DIENTHOAIBAN"];
                    $dantoc=$row_sv["DANTOC"];
                    $tongiao=$row_sv["TONGIAO"];
                    //$dienchinhsach=$row_sv["DIENCHINHSACH"];
                    $doituonguutien=$row_sv["DOITUONGUUTIEN"];
                    
                    $tpgiadinh=$row_sv["TPGIADINH"];
                    $trinhdovanhoa=$row_sv["TRINHDOVANHOA"];
                    $ngayketnapdoan=$row_sv["NGAYKETNAPDOAN"];
                    $noiketnapdoan=$row_sv["NOIKETNAPDOAN"];
                    
                    $ngayketnapdang=$row_sv["NGAYKETNAPDANG"];
                    $noiketnapdang=$row_sv["NOIKETNAPDANG"];
                    
                    $ngayvaotruong=$row_sv["NGAYVAOTRUONG"];
                    $quatrinhcongtac=$row_sv["QUATRINHCONGTAC"];
                    $diachilienlac=$row_sv["DIACHILIENLAC"];
                    $hotenvochong=$row_sv["HOTENVOCHONG"];
                    $nghenghiepvochong=$row_sv["NGHENGHIEPVOCHONG"];
                    $hinhanh=$row_sv["HINHANH"];
                    $hotencha=$row_sv["HOTENCHA"];
                    $namsinhcha=$row_sv["NAMSINHCHA"];
                    $dantoccha=$row_sv["DANTOCCHA"];
                    $tongiaocha=$row_sv["TONGIAOCHA"];
                    
                    $nghecha=$row_sv["NGHECHA"];
                    $sodienthoaicha=$row_sv["SODIENTHOAICHA"];
                    
                    $hotenme=$row_sv["HOTENME"];
                    $namsinhme=$row_sv["NAMSINHME"];
                    $dantocme=$row_sv["DANTOCME"];
                    $tongiaome=$row_sv["TONGIAOME"];
                    
                    $ngheme=$row_sv["NGHEME"];
                    $sodienthoaime=$row_sv["SODIENTHOAIME"];
                    
                    $diachichame=$row_sv["DIACHICHAME"];
                    $idtinh=$row_sv["ID_TINH"];
                    $idquanhuyen=$row_sv["ID_QUANHUYEN"];
                    $namnhaphoc=$row_sv["NAMNHAPHOC"];
                    $ghichu=$row_sv["GHICHU"];
                    $matkhau=$row_sv["MATKHAU"];
                    $xoaten=$row_sv["XOATEN"];
                    $baoluu=$row_sv["BAOLUU"];
                    
                    $sohoso=$row_sv["SOHOSO"];
                    $datotnghiep=$row_sv["DATOTNGHIEP"];
                    $idbacdaotao=$row_sv["ID_BACDAOTAO"];
                    $idhedaotao=$row_sv["ID_HEDAOTAO"];
                    $soqdxoaten=$row_sv["SOQDXOATEN"];
                    $canhbaohv=$row_sv["CANHBAOHV"];
                    
                    $theme=$row_sv["THEME"];
                    $hinhhoso=$row_sv["HINHHOSO"];
                    $hinhdaidien=$row_sv["HINHDAIDIEN"];
                    
                    $hokhau=$row_sv["HOKHAU"];
                    $created_at=$row_sv["created_at"];
                    $updated_at=$row_sv["updated_at"];
                    $deleted_at=$row_sv["deleted_at"];
                    
                    $query_update= "Update sinhvien set ID_KHOA=$idkhoa,ID_NGANH=$idnganh,ID_CHUYENNGANH=$idchuyennganh,"
                                ."ID_LOPCHUYENNGANH=$idlopchuyennganh,"
                            . " MASV='$masv',HODEM='$hodem',TEN='$ten',PHAI=$phai,NGAYSINH='$ngaysinh',NGAYCAP='$ngaycap',NOICAP='$noicap',"
                        . "NOISINH='$noisinh',EMAIL='$email',SODIENTHOAI='$sodienthoai',DIENTHOAIBAN='$dienthoaiban', "
                        . " DANTOC='$dantoc',TONGIAO='$tongiao',DOITUONGUUTIEN='$doituonguutien',TPGIADINH='$tpgiadinh',TRINHDOVANHOA='$trinhdovanhoa',"
                            ."NGAYKETNAPDOAN='$ngayketnapdoan',NOIKETNAPDOAN='$noiketnapdoan',NGAYKETNAPDANG='$ngayketnapdang',NOIKETNAPDANG='$noiketnapdang',NGAYVAOTRUONG='$ngayvaotruong',"
                            . " QUATRINHCONGTAC='$quatrinhcongtac',DIACHILIENLAC='$diachilienlac',HOTENVOCHONG='$hotenvochong',"
                            . " NGHENGHIEPVOCHONG='$nghenghiepvochong',HINHANH='$hinhanh',HOTENCHA='$hotencha',NAMSINHCHA='$namsinhcha',DANTOCCHA='$dantoccha',TONGIAOCHA='$tongiaocha',NGHECHA='$nghecha',SODIENTHOAICHA='$sodienthoaicha',"
                            . " HOTENME='$hotenme',NAMSINHME='$namsinhme',DANTOCME='$dantocme',TONGIAOME='$tongiaome',NGHEME='$ngheme',SODIENTHOAIME='$sodienthoaime',DIACHICHAME='$diachichame',ID_TINH=$idtinh,ID_QUANHUYEN=$idquanhuyen,"
                            . " NAMNHAPHOC=$namnhaphoc,GHICHU='$ghichu',MATKHAU='$matkhau',XOATEN=$xoaten,BAOLUU='$baoluu',DATOTNGHIEP=$datotnghiep,"
                            . " ID_BACDAOTAO='$idbacdaotao',ID_HEDAOTAO='$idhedaotao',SOQDXOATEN='$soqdxoaten',CANHBAOHV=$canhbaohv,THEME=$theme,HINHHOSO='$hinhhoso',HINHDAIDIEN='$hinhdaidien',"
                            . " HOKHAU='$hokhau',created_at=$created_at,updated_at=$updated_at,deleted_at=$deleted_at"
                            . " where ID_SINHVIEN=$idsv"; //echo $query;
                    mysql_query($query_update, $link);
                    echo $query_update;echo "<br>";
                }

            $kt=FALSE;
        }
    }
   
    //header("Location: ktx_update_csdl.php");
?>