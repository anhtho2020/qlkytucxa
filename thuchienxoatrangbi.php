<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idtrangbi=$_GET["idtrangbi"];
    
    
    
    $query_trangbi="delete from trangbi where ID_TRANGBI='".$idtrangbi."'";
    $result_trangbi=mysql_query($query_trangbi, $link);
    //echo $query_trangbi;
    header("Location: ktx_trangbi.php");