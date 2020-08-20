<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddstraphong=$_POST["iddstraphong"];
    $totalRows_svtraphong = 0;       
    $query_svtraphong ="select * from danhsachtraphong  where ID_DANHSACHTRAPHONG='$iddstraphong'";
                                        
    $result_svtraphong = mysql_query($query_svtraphong, $link);  
    $totalRows_svtraphong=mysql_num_rows($result_svtraphong);
//    if($totalRows_truong)
//    {
        $row_svtraphong = mysql_fetch_array ($result_svtraphong);
        $idhssvcu=$row_svtraphong["ID_SINHVIEN"];
        $phonghssvcu=$row_svtraphong["ID_PHONG"];
        $ngnthssvcu=$row_svtraphong["NGAYNOITRU"];
        
        
//    }
//    $totalRows_svtraphong_dsnt = 0;       
//    $query_svtraphong_dsnt ="select * from danhsachtraphong where ID_DANHSACHTRAPHONG='$iddstraphong'";
//                                        
//    $result_svtraphong_dsnt = mysql_query($query_svtraphong_dsnt, $link);  
//    $totalRows_svtraphong_dsnt=mysql_num_rows($result_svtraphong_dsnt);
//    if($totalRows_truong)
//    {
//        $row_svtraphong_dsnt = mysql_fetch_array ($result_svtraphong_dsnt);
//        $idltcu=$row_svtraphong["ID_SINHVIEN"];
//    }
      $query_dshssvnt="insert into danhsachtnoitru (ID_SINHVIEN,ID_PHONG,NGAYNOITRU ) "
                    . "values($idhssvcu,$phonghssvcu,'$ngnthssvcu')";echo $query_dshssvnt;
            mysql_query($query_dshssvnt, $link);  
        
        
    
    $mahssv=$_POST["mahssv"];
//    $idlienthong=$_POST["idlienthong"];
    
//    $phong=$_POST["phong"];
    
    $ngaytraphong=$_POST["ngaytraphong"];
    
//    $idloplt=$_POST["idloplt"];
//    
//    $maloplt=$_POST["maloplt"];
    
    $totalRows_hssv = 0;       
    $query_hssv ="select * from sinhvien  where MASV='$mahssv'";
                                        
    $result_hssv = mysql_query($query_hssv, $link);  
    $totalRows_hssv=mysql_num_rows($result_hssv);
//    if($totalRows_truong)
//    {
        $row_hssv = mysql_fetch_array ($result_hssv);
        $idhssv=$row_hssv["ID_SINHVIEN"];
//    }
    
    
    $totalRows_dssvltnoitru = 0;       
    $query_dssvltnoitru ="select * from danhsachnoitru  where ID_SINHVIEN='$idhssv'";
                                        
    $result_dssvltnoitru = mysql_query($query_dssvltnoitru, $link);  
    $totalRows_dssvltnoitru=mysql_num_rows($result_dssvltnoitru);
//    if($totalRows_truong)
//    {
        $row_dssvltnoitru = mysql_fetch_array ($result_dssvltnoitru);
        $ph=$row_dssvltnoitru["ID_PHONG"];
        $ngnt=$row_dssvltnoitru["NGAYNOITRU"];
//    }
    
//    echo "ma sinh viên".$mt;
//    echo " ma nganh".$mng;
    $query="Update danhsachtraphong set ID_SINHVIEN=$idhssv,ID_PHONG=$ph,"
            . "NGAYNOITRU='$ngnt',NGAYTRAPHONG='$ngaytraphong' where ID_DANHSACHTRAPHONG='$iddstraphong'"; echo $query;
    mysql_query($query, $link);
    header("Location: ktx_danhsachsinhvientraphong.php");
