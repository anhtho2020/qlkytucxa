<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
    $idsinhvien=$_GET["idsinhvien"];
    $query_dsnoitru="delete from danhsachnoitru where ID_SINHVIEN='".$idsinhvien."'";
    $result_dsnoitru=mysql_query($query_dsnoitru, $link);
    header("Location: ktx_capnhatdienchinhsach.php");  
?>
    
    
