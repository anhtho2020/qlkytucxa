<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idthechap=$_POST["idthechap"];
    $ngaythechap=$_POST["ngaythechap"];
    $sotien=$_POST["sotien"];
    //$hocky=$_POST["hocky"];
    //$namhoc=$_POST["namhoc"];
   
    $nguoithu=$_POST["nguoithu"];
    
    $masv=$_POST["masv"];
    $tenphong=$_POST["tenphong"];
//    $email=$_POST["email"];
//    $dienthoai=$_POST["dienthoai"];
    
    $totalRows_masv = 0;       
    $query_masv ="select * from sinhvien  where MASV='$masv'";
    $result_masv = mysql_query($query_masv, $link);  
    $totalRows_masv=mysql_num_rows($result_masv);
    $row_masv = mysql_fetch_array ($result_masv);
    $idsv=$row_masv["ID_SINHVIEN"];
    
    $totalRows_phong = 0;       
    $query_phong ="select * from phong  where TENPHONG='$tenphong'";
    $result_phong = mysql_query($query_phong, $link);  
    $totalRows_masv=mysql_num_rows($result_masv);
    $row_phong = mysql_fetch_array ($result_phong);
    $idphong=$row_phong["ID_PHONG"];
    
    $query="Update thechap set ID_SINHVIEN=$idsv,ID_PHONG=$idphong, NGAYTHECHAP='$ngaythechap',SOTIEN=$sotien,NGUOITHU='$nguoithu' where ID_THECHAP=$idthechap"; //echo $query;
    //
    //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_danhsachthutienthechap.php");