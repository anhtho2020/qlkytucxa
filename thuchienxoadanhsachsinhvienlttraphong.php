<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

$iddanhsachtraphonglt=$_GET["iddanhsachtraphonglt"];
$query="delete from dstraphonglt where ID_DSTRAPHONGLT='".$iddanhsachtraphonglt."'";
$result=mysql_query($query, $link);
    
header("Location: ktx_danhsachsinhvientraphonglt.php");