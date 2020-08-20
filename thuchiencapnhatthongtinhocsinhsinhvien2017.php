<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddshssv=$_POST["iddshssv"];
    $mahssv=$_POST["mahssv"];
    $hodem=$_POST["hodem"];
    $ten = $_POST["ten"];
    $phai=$_POST["phai"];
    $ngaysinh=$_POST["ngaysinh"];
    $cmnd=$_POST["cmnd"];
    $diachi=$_POST["diachi"];
    $email=$_POST["email"];
    $dienthoai=$_POST["dienthoai"];
    $dienchinhsach=$_POST["dienchinhsach"];
    $ghichu=$_POST["ghichu"];
    $query="Update dshssv set MAHSSV='$mahssv',HODEM='$hodem',TEN='$ten',PHAI=$phai,NGAYSINH='$ngaysinh',"
            . "CMND='$cmnd',DIACHI='$diachi',EMAIL='$email',DIENTHOAI='$dienthoai',DIENCHINHSACH='$dienchinhsach',GHICHU='$ghichu'  "
            . " where ID_DSHSSV=$iddshssv"; //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_nhapdanhsachhssv2017.php");
?>