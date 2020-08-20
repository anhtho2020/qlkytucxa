<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

        $idthudiennuoc=$_GET["idthudiennuoc"];
        $query_vpnq="delete from thutiendiennuoc where ID_THUTIENDIENNUOC='".$idthudiennuoc."'";
        $result_vpnq=mysql_query($query_vpnq, $link);
    

        header("Location: ktx_bangkethutiendiennuocthangnamday.php");  
    ?>