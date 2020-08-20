<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idtaisan=$_POST["idtaisan"];
    $mataisan=$_POST["mataisan"];
    $tentaisan=$_POST["tentaisan"];
    $kieumau = $_POST["kieumau"];
    $namsanxuat=$_POST["namsanxuat"];
    $nuocsanxuat=$_POST["nuocsanxuat"];
    $donvitinh=$_POST["donvitinh"];
    $ghichu=$_POST["ghichu"];
    $query="Update taisan set MATAISAN='$mataisan',TENTAISAN='$tentaisan',KIEUMAU='$kieumau',NAMSANXUAT='$namsanxuat',NUOCSANXUAT='$nuocsanxuat',DONVITINH='$donvitinh',GHICHU='$ghichu' where ID_TAISAN=$idtaisan"; echo $query;
    mysql_query($link,$query);
    
    //header("Location: ktx_phong.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

