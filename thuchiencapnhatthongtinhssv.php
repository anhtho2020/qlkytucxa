<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();
 
    $idhssvnoitru=$_POST["idhssvnoitru"];
    $mahssv=$_POST["mahssv"];
    $cmnd=$_POST["cmnd"];
    $hodem=$_POST["hodem"];
    $ten = $_POST["ten"];
    $phai=$_POST["phai"];
    $ngaysinh=$_POST["ngaysinh"];
    
    $noisinh=$_POST["noisinh"];
    $diachi=$_POST["diachi"];
    $email=$_POST["email"];
    $dienthoai=$_POST["dienthoai"];
    $query="Update hssvnoitru set MASV='$mahssv',CMND='$cmnd',HODEM='$hodem',TEN='$ten',PHAI=$phai,NGAYSINH='$ngaysinh',NOISINH='$noisinh',DIACHI='$diachi',EMAIL='$email',DIENTHOAI='$dienthoai'  where ID_HSSVNOITRU=$idhssvnoitru"; //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_nhaphssvnoitru.php");