<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idkhach=$_POST["idkhach"];
    $makhach=$_POST["makhach"];
    $hodem=$_POST["hodem"];
    $ten = $_POST["ten"];
    $phai=$_POST["phai"];
    $ngaysinh=$_POST["ngaysinh"];
    $cmnd=$_POST["cmnd"];
    
    $diachi=$_POST["diachi"];
    
    $dienthoai=$_POST["dienthoai"];
    $query="Update khach set MAKHACH='$makhach',HODEM='$hodem',TEN='$ten',PHAI=$phai,NGAYSINH='$ngaysinh',"
            . "CMND='$cmnd',DIACHI='$diachi',DIENTHOAI='$dienthoai'  "
            . " where ID_KHACH=$idkhach"; //echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_khach.php");
?>