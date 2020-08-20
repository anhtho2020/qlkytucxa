<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

   
        
    $makhach=$_POST["makhach"];
    $hodem = $_POST["hodem"];
    $ten=$_POST["ten"];
    $phai=$_POST["phai"];
    $ngaysinh=$_POST["ngaysinh"];
    $cmnd=$_POST["cmnd"];
    $diachi=$_POST["diachi"];
    $sodienthoai=$_POST["dienthoai"];
    
    $kt=0;
    $totalRows_kt = 0;       
        $query_kt ="select * from khach";  
        $result_kt = mysqli_query($link,$query_kt);  
        $totalRows_kt=mysqli_num_rows($result_kt); 
        while ($row_kt = mysqli_fetch_array ($result_kt))     
        {  
            $makhachkt=$row_kt["MAKHACH"];
            $cmndkt=$row_kt["CMND"];
            if(($makhachkt==$makhach)||($cmndkt==$cmnd))
            {
                $kt=$kt+1;
            }
        }
    if($kt==0)
    {
        $query="insert into khach(MAKHACH,HODEM,TEN,PHAI,NGAYSINH,CMND,DIACHI,DIENTHOAI) "
                . "Values('$makhach','$hodem','$ten','$phai','$ngaysinh','$cmnd','$diachi','$sodienthoai')";
        mysqli_query($link,$query);
        header("Location: ktx_khach.php");
    }
    else {
        echo "<script>";
                //echo "alert(str);"; 
                echo "alert(' Mã số hoặc CMND bị trùng');";
                echo "</script>";
        echo "<li><a href=\"ktx_khach.php\"><i class=\"icon-key\"></i> Tiếp tục thêm khách vào danh sách</a></li>"        ;
   }
    
    


