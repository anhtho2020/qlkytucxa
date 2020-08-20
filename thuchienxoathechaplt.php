<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $idthechaplt=$_GET["idthechaplt"];
    
 
    $query="delete from thechaplt where ID_THECHAPLT='".$idthechaplt."'";
    $result=mysqli_query($link,$query);
    

   header("Location: ktx_danhsachthechaplt.php");  
    ?>
    