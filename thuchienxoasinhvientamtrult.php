<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();
 
    
    $iddangkytamtrult=$_GET["iddangkytamtrult"];
    
    
    
    $query="delete from dangkytamtrult where ID_DANGKYTAMTRULT='".iddangkytamtrult."'";
    $result=mysqli_query($link,$query);
    

   header("Location: ktx_danhsachsinhvienltdangkytamtru.php");  