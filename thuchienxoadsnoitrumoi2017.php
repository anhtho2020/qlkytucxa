<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
    $iddshssv=$_GET["iddshssv"];
    $query="delete from danhsachnoitrum where ID_SINHVIEN='".$iddshssv."'";
    $result=mysql_query($query, $link);
    header("Location: ktx_danhsachsinhviennoitru2017.php");
?>