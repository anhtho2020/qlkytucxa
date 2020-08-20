<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $mahssv=$_POST["mahssv"];
    $cmnd=$_POST["cmnd"];
    $hodem = $_POST["hodem"];
    $ten=$_POST["ten"];
    $phai=$_POST["phai"];
    $ngaysinh=$_POST["ngaysinh"];
    $noisinh=$_POST["noisinh"];
    $diachi=$_POST["diachi"];
    $email=$_POST["email"];
    $sodienthoai=$_POST["sodienthoai"];
    $query="insert into hssvnoitru(MASV,CMND,HODEM,TEN,PHAI,NGAYSINH,NOISINH,DIACHI,EMAIL,DIENTHOAI) "
            . "Values('$mahssv','$cmnd','$hodem','$ten','$phai','$ngaysinh','$noisinh','$diachi','$email',"
            . "'$sodienthoai')";
    mysql_query($query, $link);
    
    header("Location: ktx_nhaphssvnoitru.php");


