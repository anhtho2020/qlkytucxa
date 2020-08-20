<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
    $iddssvltnoitru=$_GET["iddssvltnoitru"];
    $query_dsnoitru="delete from dssvltnoitru where ID_DSSVLTNOITRU='".$iddssvltnoitru."'";
    $result_dsnoitru=mysql_query($query_dsnoitru, $link);
    header("Location: ktx_danhsachsinhvienlt_muonphong.php");  
?>
    
    
