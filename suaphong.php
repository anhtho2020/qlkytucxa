<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idphong=$_POST["idphong"];
    $iday=$_POST["idday"];
    $tenphong = $_POST["tenphong"];
    $succhua=$_POST["succhua"];
    $query="Update phong set ID_DAY=$iday,TENPHONG='$tenphong',SUCCHUA=$succhua where ID_PHONG=$idphong"; //echo $query;
    mysql_query($link,$query);
    
    header("Location: ktx_phong.php");


