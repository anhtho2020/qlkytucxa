<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

        require("ktdangnhapphongtaivu.php");
//$username='';
//        if(isset($_POST["user_name"])){
//             $username=$_POST["user_name"];
//        }
//        else echo " ";
        
        $totalRows_dn = 0;       
        $stSQL_dn ="select * from giaovien where TENTAIKHOAN='".$username."'";  
        $result_dn = mysql_query($stSQL_dn, $link);  
//        $totalRows_dn=mysql_num_rows($result_dn); 
        while ($row = mysql_fetch_array ($result_dn))     
        {   
            $hodem=$row["HODEM"];
            $ten=$row["TEN"];
        }
        $user_name=$hodem." ".$ten;

