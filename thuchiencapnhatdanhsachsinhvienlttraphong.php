<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddstraphonglt=$_POST["iddstraphonglt"];
    $totalRows_svtraphong = 0;       
    $query_svtraphong ="select * from dstraphonglt  where ID_DSTRAPHONGLT='$iddstraphonglt'";
                                        
    $result_svtraphong = mysql_query($query_svtraphong, $link);  
    $totalRows_svtraphong=mysql_num_rows($result_svtraphong);
//    if($totalRows_truong)
//    {
        $row_svtraphong = mysql_fetch_array ($result_svtraphong);
        $idltcu=$row_svtraphong["ID_LIENTHONG"];
        $phongltcu=$row_svtraphong["ID_PHONG"];
        $ngntltcu=$row_svtraphong["NGAYNOITRU"];
        
        
//    }
    $totalRows_svtraphong_dsnt = 0;       
    $query_svtraphong_dsnt ="select * from dstraphonglt  where ID_DSTRAPHONGLT='$iddstraphonglt'";
                                        
    $result_svtraphong_dsnt = mysql_query($query_svtraphong_dsnt, $link);  
    $totalRows_svtraphong_dsnt=mysql_num_rows($result_svtraphong_dsnt);
//    if($totalRows_truong)
//    {
        $row_svtraphong_dsnt = mysql_fetch_array ($result_svtraphong_dsnt);
        $idltcu=$row_svtraphong["ID_LIENTHONG"];
//    }
      $query_dsltnt="insert into dssvltnoitru (ID_LIENTHONG,ID_PHONG,NGAYNOITRU ) "
                    . "values($idltcu,$phongltcu,'$ngntltcu')";echo $query_dsltnt;
            mysql_query($query_dsltnt, $link);  
        
        
    
    $masvlt=$_POST["masvlt"];
//    $idlienthong=$_POST["idlienthong"];
    
//    $phong=$_POST["phong"];
    
    $ngaytraphong=$_POST["ngaytraphong"];
    
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
        $idlt=$row_lienthong["ID_LIENTHONG"];
//    }
    
    
    $totalRows_dssvltnoitru = 0;       
    $query_dssvltnoitru ="select * from dssvltnoitru  where ID_LIENTHONG='$idlt'";
                                        
    $result_dssvltnoitru = mysql_query($query_dssvltnoitru, $link);  
    $totalRows_dssvltnoitru=mysql_num_rows($result_dssvltnoitru);
//    if($totalRows_truong)
//    {
        $row_dssvltnoitru = mysql_fetch_array ($result_dssvltnoitru);
        $ph=$row_dssvltnoitru["ID_PHONG"];
        $ngnt=$row_dssvltnoitru["NGAYNOITRU"];
//    }
    
//    echo "ma sinh viên".$mt;
//    echo " ma nganh".$mng;
    $query="Update dstraphonglt set ID_LIENTHONG=$idlt,ID_PHONG=$ph,"
            . "NGAYNOITRU='$ngnt',NGAYTRAPHONG='$ngaytraphong' where ID_DSTRAPHONGLT='$iddstraphonglt'"; echo $query;
    mysql_query($query, $link);
    header("Location: ktx_danhsachsinhvientraphonglt.php");
