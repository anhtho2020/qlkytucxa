<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idsinhvien=$_POST["idsinhvien"];
    $hodem=$_POST["hodem"];
    $ten=$_POST["ten"];
    $phai=$_POST["phai"];
    $cmnd=$_POST["cmnd"];
    $diachi=$_POST["diachi"];
    $dienchinhsach=$_POST["dienchinhsach"];
    $query="Update sinhvien set HODEM='$hodem',TEN='$ten',PHAI=$phai,DIENCHINHSACH='$dienchinhsach',"
            . " CMND='$cmnd',DIACHI='$diachi' where ID_SINHVIEN=$idsinhvien"; //echo $query;
    mysql_query($query, $link);
    header("Location: ktx_capnhatdienchinhsach.php");
?>

