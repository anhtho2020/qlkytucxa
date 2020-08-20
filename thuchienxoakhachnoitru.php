<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idkhach=$_GET["idkhach"];
    
    //$query="delete from khach where ID_KHACH='".$idkhach."'";
    //$result=mysql_query($query, $link);
    
    $query_dsnoitru="delete from danhsachnoitru where ID_KHACH='".$idkhach."'";
    $result_dsnoitru=mysql_query($query_dsnoitru, $link);
    
    header("Location: ktx_danhsachkhachthuephong.php");
    ?>
    
    
