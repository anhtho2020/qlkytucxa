<?php


include 'dbcon.php';
    
$link=  clsConnet::DBConnect();

    
   
	$idthutienphongsinhvien=$_GET["idthutienphongsinhvien"];

    
	$query="delete from thutienphongsinhvien2017 where ID_THUTIENPHONGSINHVIEN=$idthutienphongsinhvien";
    
	$result=mysqli_query($link,$query);//echo $query;
    
	header("Location: ktx_xoaphieuthutienphongsinhvien2017.php");  
    
?>
