<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
    $idkhach=$_GET["idkhach"];
    $query_khach="delete from khach where ID_KHACH='".$idkhach."'";
    $result_khach=mysql_query($query_khach, $link);
    header("Location: ktx_khach.php");
?>

