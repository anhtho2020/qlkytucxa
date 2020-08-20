<?php


include 'dbcon.php';
    
$link=  clsConnet::DBConnect();

    
   
	$iddsphieuthutiendiennuocsinhvien=$_GET["iddsphieuthutiendiennuocsinhvien"];

    
	$query="delete from dsphieuthutiendiennuoc where ID_DSPHIEUTHUTIENDIENNUOC='".$iddsphieuthutiendiennuocsinhvien."'";
    
	$result=mysql_query($query, $link);//echo $query;
    
	header("Location: ktx_xoaphieuthutiendiennuocsinhvien.php");  
    
?>
