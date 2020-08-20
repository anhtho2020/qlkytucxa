<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idthechap=$_GET["idthechap"];
    
 
    $query="delete from thechap2017 where ID_THECHAP='".$idthechap."'";
    $result=mysqli_query($link,$query);
    

   header("Location: ktx_danhsachthechap2017.php");  
    ?>
    