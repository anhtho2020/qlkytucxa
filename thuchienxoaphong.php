<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idphong=$_GET["idphong"];
    $query="delete from phong where ID_PHONG='".$idphong."'";
    $result_phong=mysql_query($query, $link);

    header("Location: ktx_phong.php");
?>
    
  

