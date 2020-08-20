<?php
include 'ClassData.php';
        include 'dbcon.php';
$link=  clsConnet::DBConnect();
$query_svvpnq="select a.ID_PHONG,a.ID_SINHVIEN from danhsachnoitrum a,thechap2017 b "
        . "where a.ID_SINHVIEN=b.ID_SINHVIEN";
        $kt_svvpnq=mysql_query($query_svvpnq, $link);
        //$result = mysql_query($stSQL, $link);  
                            $totalRows=mysql_num_rows($kt_svvpnq); 
        $arr_svvpnq=array();
        $arr_idsv=array();
        while($row_svvpnq=mysql_fetch_array($kt_svvpnq)){
                $arr_svvpnq[]=$row_svvpnq["ID_PHONG"];
                $arr_idsv[]=$row_svvpnq["ID_SINHVIEN"];
                //echo $row_svvpnq["ID_PHONG"];
        }
        echo $totalRows;
    
            for($i=0; $i<$totalRows; $i++){
                //echo $arr_svvpnq[$i].'';
                    $query="update thechap2017 set ID_PHONG = $arr_svvpnq[$i] where ID_SINHVIEN=$arr_idsv[$i]";
                    mysql_query($query, $link);
                    //$slsv=$slsv+1;
            }
        
        