<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $ididthutiendiennuoc=$_GET["idthutiendiennuoc"];

    $query="delete from thutiendiennuoc where ID_THUTIENDIENNUOC='".$ididthutiendiennuoc."'";
    $result=mysql_query($query, $link);
    header("Location: ktx_danhsachsinhviennoptiendiennuoc.php");  
    ?>