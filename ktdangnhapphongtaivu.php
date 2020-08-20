<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php
    session_start();
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();  
    $user=$_POST["username"];
    $pass=$_POST["password"];
    $username= addslashes($user);	
	$password=md5(md5(md5(md5(md5($pass)))));
        $query="select id_giaovien, matkhau,HODEM,TEN,TENTAIKHOAN ";        
        $query.="from giaovien ";
        $query.="where tentaikhoan='$username'"; 
//        echo $query;
        $result=mysqli_query($link,$query);
        $num=  mysqli_num_rows($result);
        if($num>0)
        {
            $row=mysqli_fetch_array($result);
            if($password==addslashes($row['matkhau']))
            {
                $queryQuyen = "select a.id_quyen ";
                $queryQuyen.="from gvquyen a, quyen b ";
                $queryQuyen.="where maquyen='KTKTX' ";
                $queryQuyen.="and a.id_quyen = b.id_quyen ";
                $queryQuyen.="and id_giaovien=".$row[0];                
                
                $result1=  mysqli_query($link,$queryQuyen);
                $num1=  mysqli_num_rows($result1);
                if($num1>0){                    
                    $_SESSION['idptv']=$row[0];      
                    $_SESSION['quyen']="KTKTX";
                    echo "<script>";                    
                    echo "window.location=\"ktx_phong.php\";";
                    echo "</script>";
                }
                else{
                    echo "<script>";
                    echo "alert('Ban khong co quyen nay');";
                    echo "window.location=\"dangnhap_phongtaivu.php\";";
                    echo "</script>";
                }
                $_SESSION['hodem']=$row["HODEM"];
                $_SESSION['ten']=$row["TEN"];
                $_SESSION["tentaikhoan"]=$row["TENTAIKHOAN"];
            }
             else{
                    echo "<script>";
                    echo "alert('Sai mat khau');";
                    echo "window.location=\"dangnhap_phongtaivu.php\";";
                    echo "</script>";
                }
        }
         else{
                    echo "<script>";
                    echo "alert('Tai khoan khong ton tai');";
                    echo "window.location=\"dangnhap_phongtaivu.php\";";
                    echo "</script>";
                }
                
?>
