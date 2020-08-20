<?php
include 'ClassData.php';
        include 'dbcon.php';
$link=  clsConnet::DBConnect();
$query="select a.ID_PHONG,a.ID_SINHVIEN from danhsachnoitrum a,thutienphongsinhvien2017 b "
        . "where a.ID_SINHVIEN=b.ID_SINHVIEN";
        $kt=mysqli_query($link,$query);
        //$result = mysql_query($stSQL, $link);  
                            $totalRows=mysqli_num_rows($kt); 
        $arr_idphong=array();
        $arr_idsv=array();
        while($row=mysqli_fetch_array($kt)){
                $arr_idphong[]=$row["ID_PHONG"];
                $arr_idsv[]=$row["ID_SINHVIEN"];
                //echo $row_svvpnq["ID_PHONG"];
        }
        echo $totalRows;
    
            for($i=0; $i<$totalRows; $i++){
                //echo $arr_svvpnq[$i].'';
                    $query="update thutienphongsinhvien2017 set ID_PHONG = $arr_idphong[$i] where ID_SINHVIEN=$arr_idsv[$i]";
                    mysqli_query($link,$query);
                    //$slsv=$slsv+1;
            }
       
        
