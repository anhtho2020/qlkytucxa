<?php

//require("dbcon.php");  
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idkhach=$_POST["idkhach"];
    $makhach=$_POST["makhach"];
    $hodem = $_POST["hodem"];
    $ten=$_POST["ten"];
    $ngaysinh=$_POST["ngaysinh"];
    $phai=$_POST["phai"];
    $cmnd=$_POST["cmnd"];
    $query="Update khach set MAKHACH='$makhach',HODEM='$hodem',TEN='$ten', "
            . "NGAYSINH='$ngaysinh',PHAI='$phai',CMND='$cmnd' where ID_KHACH=$idkhach"; //echo $query;
    mysqli_query($link,$query);
    
    header("Location: ktx_danhsachkhachmuonphong.php");

