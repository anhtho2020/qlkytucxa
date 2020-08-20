<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php
session_start();
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $pass=$_POST["password"];
    $pass1=$_POST["password1"];
    $pass2=$_POST["password2"];
    
    $password=md5(md5(md5(md5(md5($pass)))));
    $password1=md5(md5(md5(md5(md5($pass1)))));
    $password2=md5(md5(md5(md5(md5($pass2)))));
    $tentk=$_SESSION["tentaikhoan"];
    //echo $tentk;
    $totalRows = 0;       
    $query ="select * from giaovien  where MATKHAU='$password'";
//    echo $query;                                    
    $result = mysql_query($query, $link);  
    $totalRows=mysql_num_rows($result);
    if($totalRows)
    {
        
        
        if($password1==$password2)
        {
            $query_update="Update giaovien set MATKHAU='$password1' where MATKHAU='$password'"
                    . " and TENTAIKHOAN='$tentk'"; 
            mysql_query($query_update, $link);
        }
        else {
            echo "<script>";
            echo "alert('Xác nhận mật khẩu sai');";
            echo "window.location=\"ktx_capnhatmatkhau.php\";";
            echo "</script>";
        }
    }
    else {
        echo "<script>";
            echo "alert('Mật khẩu không tồn tại');";
            echo "window.location=\"ktx_capnhatmatkhau.php\";";
            echo "</script>";
   }
    
    
    
    
    header("Location: ktx_capnhatmatkhau.php");
