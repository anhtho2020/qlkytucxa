<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idloplt=$_POST["idloplt"];
    $malop=$_POST["malop"];
    $tenlop=$_POST["tenlop"];
    $matruong=$_POST["matruong"];
    $manganh=$_POST["manganh"];
    
    $totalRows_truong = 0;       
    $query_truong ="select * from truong  where MATRUONG='$matruong'";
                                        
    $result_truong = mysqli_query($link,$query_truong);  
    $totalRows_truong=mysqli_num_rows($result_truong);
//    if($totalRows_truong)
//    {
        $row_truong = mysqli_fetch_array ($result_truong);
        $mt=$row_truong["ID_TRUONG"];
//    }
    
    
    $totalRows_nganh = 0;       
    $query_nganh ="select * from nganhlt  where MANGANH='$manganh'";
                                        
    $result_nganh = mysqli_query($link,$query_nganh);  
    $totalRows_nganh=mysqli_num_rows($result_nganh);
//    if($totalRows_truong)
//    {
        $row_nganh = mysqli_fetch_array ($result_nganh);
        $mng=$row_nganh["ID_NGANH"];
//    }
    
//    echo "ma truong".$mt;
//    echo " ma nganh".$mng;
    $query="Update loplt set ID_TRUONG='$mt',ID_NGANH='$mng',"
            . "MALOPLT='$malop',TENLOPLT='$tenlop' where ID_LOPLT=$idloplt";// echo $query;
    mysqli_query($link,$query);
    header("Location: ktx_nhap_loplt.php");
