<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
   
    $sohoso=$_POST["sohoso"];
    $namnhaphoc=$_POST["namnhaphoc"];
    $cmnd=$_POST["cmnd"];
    $masv=$_POST["masv"];
    
    $hodem = $_POST["hodem"];
    $ten=$_POST["ten"];
    $phai=$_POST["phai"];
    $ngaysinh='';
    if(isset($_POST["ngaysinh"])){
    $nnt=$_POST["ngaysinh"];
     $x=explode("/", $nnt);
          $ngaysinh=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
      }
   else echo " ";
    //$ngaysinh=$_POST["ngaysinh"];
    $noisinh=$_POST["noisinh"];
    $diachi=$_POST["diachi"];
    $email=$_POST["email"];
    $dienthoai=$_POST["dienthoai"];
    $dienchinhsach=$_POST["dienchinhsach"];
    $ghichu=$_POST["ghichu"];
    $query="insert into dshssv(SOHOSO,NAMNHAPHOC,CMND,MAHSSV,HODEM,TEN,PHAI,NGAYSINH,NOISINH,DIACHI,EMAIL,DIENTHOAI,DIENCHINHSACH,GHICHU) "
            . "Values('$sohoso','$namnhaphoc','$cmnd','$masv','$hodem','$ten','$phai','$ngaysinh','$noisinh','$diachi','$email',"
            . "'$dienthoai','$dienchinhsach','$ghichu')";
    //echo $query;
    mysqli_query($link,$query);
    
    header("Location: ktx_nhapdanhsachhssv2017.php");


