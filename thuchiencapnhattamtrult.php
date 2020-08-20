<?php

    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddangkytamtrult=$_POST["iddangkytamtrult"];
    $masv=$_POST["masv"];
    $ngaytamtru=$_POST["ngaytamtru"];
    
    $ghichu=$_POST["ghichu"];
    
    $totalRows_masv = 0;       
    $query_masv ="select * from lienthong  where MASV='$masv'";
    $result_masv = mysqli_query($link,$query_masv);  
    $totalRows_masv=mysqli_num_rows($result_masv);
//    if($totalRows_truong)
//    {
        $row_masv = mysqli_fetch_array ($result_masv);
        $idlienthong=$row_maloplt["ID_LIENTHONG"];
//    }
    

    $query="Update dangkytamtrult set ID_LIENTHONG=$idlienthong,NGAYTAMTRU='$ngaytamtru',GHICHU='$ghichu'"
            . " where ID_DANGKYTAMTRULT=$iddangkytamtrult"; //echo $query;
    mysqli_query($link,$query);
    header("Location: ktx_danhsachsinhvienltdangkytamtru.php");
?>