<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php
    include 'ClassData.php';
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    
    $iday=$_POST["idday"];
    $tenphong = $_POST["tenphong"];
    $succhua=$_POST["succhua"];
    $kttenphong=  clsData::left($tenphong, 1);
    if($iday>0 && $iday<5 )
    {
        if(($kttenphong=='A')||($kttenphong=='B')||($kttenphong=='C')||($kttenphong=='D')||($kttenphong=='a')||($kttenphong=='b')||($kttenphong=='c')||($kttenphong=='d'))
        {
        $totalRows_phong = 0;       
        $stSQL_phong ="select * from PHONG";  
        $result_phong = mysql_query($stSQL_phong, $link);  
        $totalRows_phong=mysql_num_rows($result_phong); 
        $kt=0;
        while ($row_kt = mysql_fetch_array ($result_phong))     
                {  
                    $day=$row_kt["ID_DAY"];
                    $phong=$row_kt["TENPHONG"];
                    
                    if(($day==$iday) && ($phong==$tenphong))
                    {
                        $kt=$kt+1;
                    }
                }
        if($kt == 0)
        {
            $query="insert into phong(ID_DAY,TENPHONG,SUCCHUA) Values($iday,'$tenphong',$succhua)";
            mysql_query($query, $link);
            echo "<script>";
                //echo "alert(str);"; 
            echo "alert('Đã nhập');";
            echo "</script>";
            header("Location: ktx_phong.php");    
        }
        else {
            echo "<script>";
                //echo "alert(str);"; 
            echo "alert('Phòng này nhập rồi');";
            echo "</script>";
            echo "<li><a href=\"ktx_phong.php\"><i class=\"icon-key\"></i> Tiếp tục nhập phòng </a></li>"        ;
        }
    }
    else {
            echo "<script>";
                //echo "alert(str);"; 
            echo "alert('Nhập phòng không hợp lệ.');";
            echo "</script>";
            echo "<li><a href=\"ktx_phong.php\"><i class=\"icon-key\"></i> Tiếp tục nhập phòng </a></li>"        ;
       }
}
else {
    echo "<script>";
                //echo "alert(str);"; 
            echo "alert('Nhập dãy không hợp lệ.');";
            echo "</script>";
            echo "<li><a href=\"ktx_phong.php\"><i class=\"icon-key\"></i> Tiếp tục nhập phòng </a></li>"        ;
}
    
        
