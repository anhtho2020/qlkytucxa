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
    
    $query="Update taisan set MATAISAN='$mataisan',TENTAISAN='$tentaisan',KIEUMAU='$kieumau',NAMSANXUAT='$namsanxuat',NUOCSANXUAT='$nuocsanxuat',"
		."DONVITINH='$donvitinh' where ID_TAISAN=$idtaisan";// echo $query;
    mysql_query($query, $link);
    header("Location: ktx_taisan.php");


