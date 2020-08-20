<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

$iddanhsachtraphong=$_GET["iddanhsachtraphong"];
$query="delete from danhsachtraphong where ID_DANHSACHTRAPHONG='".$iddanhsachtraphong."'";
$result=mysql_query($query, $link);
    
header("Location: ktx_danhsachsinhvientraphong.php");