<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idlienthong=$_GET["idlienthong"];
    
 
    $query="delete from lienthong where ID_LIENTHONG='".$idlienthong."'";
    $result=mysqli_query($link,$query);
    

   header("Location: ktx_danhsachsinhvienlt.php");  
    ?>
    
    
