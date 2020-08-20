<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddsnoitru=$_POST["iddsnoitru"];
    $mahssv=$_POST["mahssv"];
    $tenphong=$_POST["tenphong"];
    $ngaynoitru=$_POST["ngaynoitru"];
    
    $ghichu=$_POST["ghichu"];
    
    $totalRows_masv = 0;       
    $query_masv ="select * from dshssv  where MAHSSV='$mahssv'";
    $result_masv = mysql_query($query_masv, $link);  
    $totalRows_masv=mysql_num_rows($result_masv);
    $row_masv = mysql_fetch_array ($result_masv);
    $idsv=$row_masv["ID_DSHSSV"];

    $totalRows_ph = 0;       
    $query_ph ="select * from phong  where TENPHONG='$tenphong'";
    $result_ph = mysql_query($query_ph, $link);  
    $totalRows_ph=mysql_num_rows($result_ph);
    $row_ph = mysql_fetch_array ($result_ph);
    $idphong=$row_ph["ID_PHONG"];
    

    $query="Update danhsachnoitrum set ID_SINHVIEN=$idsv,ID_PHONG='$idphong',"
            . " GHICHU='$ghichu' where ID_DANHSACHNOITRU=$iddsnoitru"; //echo $query;
    mysql_query($query, $link);
    header("Location: ktx_danhsachsinhviennoitru2017.php");
?>