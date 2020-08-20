<?php

require("dbcon.php");  
$link=  clsConnet::DBConnect();
    $idthutienphongkhach=$_POST["idthutienphongkhach"];
    $songay=$_POST["songay"];
    $dongia=$_POST["dongia"];
    
    $thanhtien = $_POST["thanhtien"];
   
    $ngaythu=$_POST["ngaythu"];
//    $nguoithu=$_POST["nguoithu"];
//    
//    $noisinh=$_POST["noisinh"];
//    $diachi=$_POST["diachi"];
//    $email=$_POST["email"];
//    $dienthoai=$_POST["dienthoai"];
    $query="Update thutienphongkhach set SONGAY=$songay,DONGIA=$dongia,THANHTIEN=$thanhtien,NGAYTHU=$ngaythu  where ID_THUTIENPHONGKHACH=$idthutienphongkhach"; //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_danhsachphongkhachdathutien.php");