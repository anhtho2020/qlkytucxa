<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idviphamnoiquy=$_GET["idviphamnoiquy"];
    
 
    $query_vpnq="delete from viphamnoiquy where ID_VIPHAMNOIQUY='".$idviphamnoiquy."'";
    $result_vpnq=mysql_query($query_vpnq, $link);
    

   header("Location: ktx_danhsachsinhvienviphamnoiquy.php");  
    ?>
    
    
