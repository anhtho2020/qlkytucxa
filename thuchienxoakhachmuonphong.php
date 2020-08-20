<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idkhach=$_GET["idkhach"];
    
    //$query="delete from khach where ID_KHACH='".$idkhach."'";
    //$result=mysql_query($query, $link);
    
    $query_khach="delete from dskhachnoitru where ID_KHACH='".$idkhach."'";
    $result_khach=mysql_query($query_khach, $link);
    
    header("Location: ktx_danhsachkhachmuonphong.php");