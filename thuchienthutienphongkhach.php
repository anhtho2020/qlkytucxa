<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();
        
        $sopt=1;
        if(isset($_POST["chon"])){
            $arr = explode(",",$_POST["chon"]);
            $sopt=count($arr);
        }
        
        $iphong=10;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
//        echo $iphong;

        $ngaymuon='2015-05-12';

        if(isset($_POST["ngaymuon"])){
             $ngaymuon=$_POST["ngaymuon"];
        }
        else echo " ";
        
        $songay=0;
        if(isset($_POST["songay"])){
             $songay=$_POST["songay"];
        }
        else echo " ";
        
        $dongia=0;
        if(isset($_POST["dongia"])){
             $dongia=$_POST["dongia"];
        }
        else echo " ";
        
        $ngaythu="";
        if(isset($_POST["ngaythu"])){
             $nth=$_POST["ngaythu"];
             $x=explode("/", $nth);
             $ngaythu=$x[2]."-".$x[1]."-".$x[0];//echo $ngaythu;
        }
        else echo " ";
        
        $nguoithu="";
        if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        }
        else echo " ";
        
        
        $thanhtien=0;
        $thanhtien=$dongia*$songay;
        
        if($songay<1){
            echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Số ngày ở không thể nhỏ hơn 1.');";
                echo "</script>";
        }
        else {
            for($i=0; $i<$sopt-1; $i++){
                $kt=0;
                $totalRows_kt = 0;       
                $query_kt ="select a.ID_KHACH,a.ID_PHONG,a.NGAYMUON,b.MAKHACH from thutienphongkhach a,khach b where a.ID_KHACH=b.ID_KHACH";  
                $result_kt = mysqli_query($link,$query_kt);  
                $totalRows_kt=mysqli_num_rows($result_kt); 
                while ($row_kt = mysqli_fetch_array ($result_kt))     
                {  
                    $idkhachkt=$row_kt["ID_KHACH"];
                    $idphongkt=$row_kt["ID_PHONG"];
                    $ngaymuonkt=$row_kt["NGAYMUON"];

                    if(($idkhachkt==$arr[$i]) && ($idphongkt==$iphong) && ($ngaymuonkt=$ngaymuon))
                    {
                        $kt=$kt+1;
                    }
                }
                $totalRows_kh=0;
                $query_kh ="select * from khach where ID_KHACH=$arr[$i]";  
                $result_kh = mysqli_query($link,$query_kh);  
                $totalRows_kh=mysqli_num_rows($result_kh); 
                $row_kh = mysqli_fetch_array ($result_kh);
                $hd=$row_kh["HODEM"];
                $ten=$row_kh["TEN"];
                $dg="";
                if($kt==0){
                    
                    $query="insert into thutienphongkhach(ID_KHACH,ID_PHONG,NGAYMUON,SONGAY,DONGIA,THANHTIEN,NGAYTHU,NGUOITHU,DIENGIAI,HODEM,TEN) values($arr[$i],$iphong,'$ngaymuon',$songay,$dongia,$thanhtien,'$ngaythu','$nguoithu','$dg','$hd','$ten')";
                    //echo $query;
                    mysql_query($link,$query);
                    header("Location: ktx_thutienphongkhach1.php");
                }
                else {
                    echo "<script>";
                        //echo "alert(str);"; 
                        echo "alert(' Đã thu rồi');";
                        echo "</script>";
                    echo "<li><a href=\"ktx_thutienphongkhach1.php\"><i class=\"icon-key\"></i> Tiếp tục thu tiền phòng khách </a></li>"        ;
                }
			}
        }
        
header("Location: ktx_thutienphongkhach1.php");
?>
