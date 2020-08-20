<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddssvltnt=$_POST["iddssvltnt"];
    $masvlt=$_POST["masvlt"];
//    $idlienthong=$_POST["idlienthong"];
    
    $phong=$_POST["phong"];
    
    $ngaynoitru=$_POST["ngaynoitru"];
    
//    $idloplt=$_POST["idloplt"];
//    
//    $maloplt=$_POST["maloplt"];
    
    $totalRows_lienthong = 0;       
    $query_lienthong ="select * from lienthong  where MASV='$masvlt'";
                                        
    $result_lienthong = mysql_query($query_lienthong, $link);  
    $totalRows_lienthong=mysql_num_rows($result_lienthong);
//    if($totalRows_truong)
//    {
        $row_lienthong = mysql_fetch_array ($result_lienthong);
        $lt=$row_lienthong["ID_LIENTHONG"];
//    }
    
    
    $totalRows_phong = 0;       
    $query_phong ="select * from phong  where TENPHONG='$phong'";
                                        
    $result_phong = mysql_query($query_phong, $link);  
    $totalRows_phong=mysql_num_rows($result_phong);
//    if($totalRows_truong)
//    {
        $row_phong = mysql_fetch_array ($result_phong);
        $ph=$row_phong["ID_PHONG"];
//    }
    
//    echo "ma sinh viên".$mt;
//    echo " ma nganh".$mng;
    $query="Update dssvltnoitru set ID_LIENTHONG=$lt,ID_PHONG=$ph,"
            . "NGAYNOITRU='$ngaynoitru' where ID_DSSVLTNOITRU='$iddssvltnt'";// echo $query;
    mysql_query($query, $link);
    header("Location: ktx_danhsachsinhvienlt_muonphong.php");
