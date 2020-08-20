<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

$iddstrathechap=$_GET["iddstrathechap"];
$query="delete from dstrathechap where ID_DSTRATHECHAP='".$iddstrathechap."'";
$result=mysql_query($query, $link);
    
header("Location: ktx_inphieuchitienthechap.php");
