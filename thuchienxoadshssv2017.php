<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
    $iddshssv=$_GET["iddshssv"];
    $query="delete from dshssv where ID_DSHSSV='".$iddshssv."'";
    $result=mysql_query($link,$query);
    header("Location: ktx_danhsachsinhviendangkynoitru2017.php");
?>