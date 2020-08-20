<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idviphamnoiquylt=$_POST["idviphamnoiquylt"];
    $ngayvipham=$_POST["ngayvipham"];
    $hinhthucvipham=$_POST["hinhthucvipham"];
    
    $query="Update viphamnoiquylt set NGAYVIPHAM='$ngayvipham',HINHTHUCVIPHAM='$hinhthucvipham'  "
            . "where ID_VIPHAMNOIQUYLT=$idviphamnoiquylt"; 
//    echo $query;
    mysql_query($query, $link);
    
    header("Location: ktx_danhsachsinhvienviphamnoiquylt.php");
?>