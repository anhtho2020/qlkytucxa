<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idsinhvien=$_POST["idsinhvien"];
    $hodem=$_POST["hodem"];
    $ten=$_POST["ten"];
    $dienchinhsach=$_POST["dienchinhsach"];
    $query="Update sinhvien set HODEM='$hodem',TEN='$ten',DIENCHINHSACH='$dienchinhsach'"
            . " where ID_SINHVIEN=$idsinhvien"; //echo $query;
    mysql_query($query, $link);
    header("Location: ktx_capnhatdienchinhsach.php");
?>
