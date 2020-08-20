<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();
 
    $tenphong = $_POST["tenphong"];
    $mataisan=$_POST["mataisan"];
    $soluong=$_POST["soluong"];
    
    
    //$ngaytrangbi=$_POST["ngaytrangbi"];
    
    if(isset($_POST["ngaytrangbi"])){
             $dtb=$_POST["ngaytrangbi"];
             $d=explode("/", $dtb);
             $ngaytrangbi=$d[2]."-".$d[1]."-".$d[0];//echo $ngayviphamnoiquy;
        }
        else echo " ";
    
//    $ghichu=$_POST["ghichu"];
    $query="insert into trangbi(TENPHONG,MATAISAN,SOLUONG,NGAYTRANGBI) "
            . "Values('$tenphong','$mataisan',$soluong,'$ngaytrangbi')";
    echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_trangbi.php");
