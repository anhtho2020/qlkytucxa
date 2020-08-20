<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idthechap=$_GET["idthechap"];
    
 
    $query="delete from thechap where ID_THECHAP='".$idthechap."'";
    $result=mysql_query($link,$query);
    

   header("Location: ktx_danhsachthechap.php");  
    ?>
    