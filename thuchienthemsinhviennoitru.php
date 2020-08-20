<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idphong = $_POST["phong"];
    $idsinhvien=$_POST["idsinhvien"];
    
    $idloainoitru=$_POST["idloainoitru"];
    $ngaynoitru=$_POST["ngaynoitru"];
    
    $ghichu=$_POST["ghichu"];
    $query="insert into danhsachnoitru(ID_SINHVIEN,ID_PHONG,ID_LOAINOITRU,NGAYNOITRU,GHICHU) "
            . "Values($idsinhvien,'$idphong','$idloainoitru',$ngaynoitru,'$ghichu')";
    mysql_query($query, $link);
    
    header("Location: ktx_sinhvien.php");