<?php

include 'dbcon.php';
    $link =  clsConnet::DBConnect();

    $idthutienphongsinhvien=$_POST["idthutienphongsinhvien"];
    $dongiathang=$_POST["dongiathang"];
    $sothangnop=$_POST["sothangnop"];
    $mucgiam=$_POST["mucgiam"];
    
    $mg='';
        if($mucgiam=="")
        {
            $mg="";
            $thanhtien=$sothangnop*$dongiathang;
        }
        else {
            $mg="$mucgiam".'%';
            $thanhtien=$sothangnop*$dongiathang;
            $thanhtien=((100-$mucgiam)*$thanhtien)/100;
        }
    $ngaythu=$_POST["ngaythu"];
    $hocky=$_POST["hocky"];
    $namhoc=$_POST["namhoc"];
   
    $nguoithu=$_POST["nguoithu"];
    
    $masv=$_POST["masv"];
    $totalRows_masv = 0;       
    $query_masv ="select * from dshssv  where MAHSSV='$masv'";
    $result_masv = mysql_query($query_masv, $link);  
    $totalRows_masv=mysql_num_rows($result_masv);
    $row_masv = mysql_fetch_array ($result_masv);
    $idsv=$row_masv["ID_DSHSSV"];

    $query="Update thutienphongsinhvien2017 set ID_SINHVIEN=$idsv, DONGIATHANG=$dongiathang,SOTHANGNOP=$sothangnop,MUCGIAM='$mg',THANHTIEN=$thanhtien,NGAYTHU='$ngaythu',HOCKY='$hocky',NAMHOC='$namhoc',NGUOITHU='$nguoithu'  where ID_THUTIENPHONGSINHVIEN=$idthutienphongsinhvien"; //echo $query;
    echo $query;
    mysql_query($query, $link);
    
    //header("Location: ktx_thongkesinhviendongtienphong_tungaydenngay2017.php");