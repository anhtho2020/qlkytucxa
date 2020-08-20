<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idthechap=$_POST["idthechap"];
    $ngaythechap=$_POST["ngaythechap"];
    $sotien=$_POST["sotien"];
    $mahssv=$_POST["mahssv"];
    $nguoithu=$_POST["nguoithu"];
   
    $totalRows_masv = 0;       
    $query_masv ="select * from dshssv  where MAHSSV='$mahssv'";
    $result_masv = mysql_query($query_masv, $link);  
    $totalRows_masv=mysql_num_rows($result_masv);
    $row_masv = mysql_fetch_array ($result_masv);
    $idsv=$row_masv["ID_DSHSSV"];
    
    $query="Update thechap2017 set ID_SINHVIEN=$idsv,NGAYTHECHAP='$ngaythechap',SOTIEN=$sotien,NGUOITHU='$nguoithu' where ID_THECHAP=$idthechap"; //echo $query;
//    echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_inphieuthuthechap2017.php");