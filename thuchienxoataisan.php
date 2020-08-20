<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idtaisan=$_GET["idtaisan"];
    
    
    
    $query="delete from taisan where ID_TAISAN='".$idtaisan."'";
    $result=mysql_query($query, $link);
    
    header("Location: ktx_taisan.php");
