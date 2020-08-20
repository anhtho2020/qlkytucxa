<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $idthutienphongsinhvien=$_POST["idthutienphongsinhvien"];
    $sothangnop=$_POST["sothangnop"];
    $dongiathang=$_POST["dongiathang"];
    
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
    $query_masv ="select * from sinhvien  where MASV='$masv'";
    $result_masv = mysqli_query($link,$query_masv);  
    $totalRows_masv=mysqli_num_rows($result_masv);
    $row_masv = mysqli_fetch_array ($result_masv);
    $idsv=$row_masv["ID_SINHVIEN"];
    
    $query="Update thutienphongsinhvien set ID_SINHVIEN=$idsv,DONGIA=$thanhtien,NGAYTHU='$ngaythu',HOCKY='$hocky',NAMHOC='$namhoc',NGUOITHU='$nguoithu', SOTHANGNOP=$sothangnop, DONGIATHANG=$dongiathang,MUCGIAM='$mg'  where ID_THUTIENPHONGSINHVIEN=$idthutienphongsinhvien"; //echo $query;
    
    mysqli_query($link,$query);
    //echo $query;
    header("Location: ktx_inphieuthutienphongsinhvien.php");
