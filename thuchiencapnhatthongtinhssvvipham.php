<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idviphamnoiquy=$_POST["idviphamnoiquy"];
    $ngayvipham=$_POST["ngayvipham"];
    $hinhthucvipham=$_POST["hinhthucvipham"];
    
    $query="Update viphamnoiquy set NGAYVIPHAM='$ngayvipham',HINHTHUCVIPHAM='$hinhthucvipham'  "
            . "where ID_VIPHAMNOIQUY=$idviphamnoiquy"; 
//    echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_danhsachsinhvienviphamnoiquy.php");
?>