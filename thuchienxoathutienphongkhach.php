<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
    $idthutienphongkhach=$_GET["idthutienphongkhach"];
    $query_dsnoitru="delete from thutienphongkhach where ID_THUTIENPHONGKHACH='".$idthutienphongkhach."'";
    $result_dsnoitru=mysql_query($query_dsnoitru, $link);
    header("Location: ktx_danhsachphongkhachdathutien.php");
?>
    
