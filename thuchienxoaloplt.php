<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idloplt=$_GET["idloplt"];
    $query="delete from loplt where ID_LOPLT='".$idloplt."'";
    $result_phong=mysqli_query($link,$query);

    header("Location: ktx_nhap_loplt.php");
?>
