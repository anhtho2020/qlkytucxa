<?php

require("dbcon.php");  
$link=  clsConnet::DBConnect();
    $idtrangbi=$_POST["idtrangbi"];
    $tenphong=$_POST["tenphong"];
    $mataisan=$_POST["mataisan"];
    $soluong = $_POST["soluong"];
    if(isset($_POST["ngaytrangbi"])){
        $dtb=$_POST["ngaytrangbi"];
        $d=explode("/", $dtb);
        $ngaytrangbi=$d[2]."-".$d[1]."-".$d[0];//echo $ngayviphamnoiquy;
    }
    else echo " ";
    $query="Update trangbi set TENPHONG='$tenphong',MATAISAN='$mataisan',SOLUONG=$soluong,NGAYTRANGBI='$ngaytrangbi' where ID_TRANGBI=$idtrangbi"; //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_trangbi.php");

