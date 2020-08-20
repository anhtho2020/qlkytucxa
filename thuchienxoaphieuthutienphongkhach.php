<?php
	include 'dbcon.php';
	$link=  clsConnet::DBConnect();
	$iddsphieuthutienphongkhach=$_GET["iddsphieuthutienphongkhach"];
	$query="delete from dsphieuthutienphongkhach where ID_DSPHIEUTHUTIENPHONGKHACH='".$iddsphieuthutienphongkhach."'";
    	$result=mysqli_query($link,$query);
   	header("Location: ktx_xoaphieuthutienphongkhach.php");  
?>

