<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();
 
    $idthechap=$_POST["idthechap"];
    $sotien=$_POST["sotien"];
    
    $query="Update thechap set SOTIEN=$sotien where ID_THECHAP=$idthechap";
    mysql_query($query, $link);
    
    header("Location: ktx_tratienthechap.php");