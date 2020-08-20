<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddangkytamtru=$_POST["iddangkytamtru"];
    $masv=$_POST["masv"];
    $ngaytamtru=$_POST["ngaytamtru"];
    
    $ghichu=$_POST["ghichu"];
    
    $totalRows_masv = 0;       
    $query_masv ="select * from sinhvien  where MASV='$masv'";
    $result_masv = mysql_query($query_masv, $link);  
    $totalRows_masv=mysql_num_rows($result_masv);
//    if($totalRows_truong)
//    {
        $row_masv = mysql_fetch_array ($result_masv);
        $idlienthong=$row_maloplt["ID_SINHVIEN"];
//    }
    

    $query="Update dangkytamtrult set ID_SINHVIEN=$idlienthong,NGAYTAMTRU='$ngaytamtru',GHICHU='$ghichu'"
            . " where ID_DANGKYTAMTRU=$iddangkytamtru"; //echo $query;
    mysql_query($query, $link);
    header("Location: ktx_danhsachsinhvienoktx_dangkytamtru.php");
?>