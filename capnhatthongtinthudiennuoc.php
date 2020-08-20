<?php

require("dbcon.php");  
$link=  clsConnet::DBConnect();
    $idhssvnoitru=$_POST["idthutiendiennuoc"];
    $giadien=$_POST["giadien"];
    $csdiencu=$_POST["csdiencu"];
    $csdienmoi=$_POST["csdienmoi"];
    $gianuoc=$_POST["gianuoc"];
    $csnuoccu=$_POST["csnuoccu"];
    $csnuocmoi=$_POST["csnuocmoi"];
    $thanhtien = $_POST["thanhtien"];
    $thangnop=$_POST["thangnop"];
    $ngaythu=$_POST["ngaythu"];
    $nguoithu=$_POST["nguoithu"];
    
//    $noisinh=$_POST["noisinh"];
//    $diachi=$_POST["diachi"];
//    $email=$_POST["email"];
//    $dienthoai=$_POST["dienthoai"];
    $query="Update thutiendiennuoc set GIADIEN=$giadien,CSDIENCU=$chisodiencu,CSDIENMOI=$chisodienmoi,GIANUOC=$gianuoc,CSNUOCCU=$chisonuoccu,CSNUOCMOI=$chisonuocmoi,THANHTIEN=$thanhtien,NGAYTHU=$ngaythu,THANGNOP=$thangnop,NGUOITHU=$nguoithu  where ID_THUTIENDIENNUOC=$idthudiennuoc"; //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_danhsachphongdanoptiendiennuoc.php");