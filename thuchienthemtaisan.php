<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $mataisan=$_POST["mataisan"];
    $tentaisan = $_POST["tentaisan"];
    $kieumau=$_POST["kieumau"];
    $namsanxuat=$_POST["namsanxuat"];
    $nuocsanxuat=$_POST["nuocsanxuat"];
    $donvitinh=$_POST["donvitinh"];
    $ghichu=$_POST["ghichu"];
    $query="insert into taisan(MATAISAN,TENTAISAN,KIEUMAU,NAMSANXUAT,NUOCSANXUAT,DONVITINH,GHICHU) Values('$mataisan','$tentaisan','$kieumau','$namsanxuat','$nuocsanxuat','$donvitinh','$ghichu')";
    mysql_query($query, $link);
    
    header("Location: ktx_taisan.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

