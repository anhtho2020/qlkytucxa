<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idsinhvien=$_GET["idsinhvien"];
    
    //$query="delete from sinhvien where ID_SINHVIEN='".$idsinhvien."'";
    
    //echo $query;
    //$result=mysql_query($query, $link);
    
    $query_dsnoitru="delete from danhsachnoitru where ID_SINHVIEN='".$idsinhvien."'";
    $result_dsnoitru=mysql_query($query_dsnoitru, $link);
    
//    if($result)
//            echo "đã xóa";
   header("Location: ktx_danhsachsinhviennoitru.php");  
    ?>
    
    
