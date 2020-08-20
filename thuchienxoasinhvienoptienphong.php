<?php
	include 'dbcon.php';
	$link=  clsConnet::DBConnect();
	$ididthutienphongsinhvien=$_GET["idthutienphongsinhvien"];
	$query="delete from thutienphongsinhvien where ID_THUTIENPHONGSINHVIEN='".$ididthutienphongsinhvien."'";
    	$result=mysql_query($query, $link);
   	header("Location: ktx_danhsachsinhviennoptienphong.php");  
?>