<?php


        include 'dbcon.php';
    $link=  clsConnet::DBConnect();

//
//
//        $sopt=1;
//        if(isset($_POST["chon"])){
//            $arr = explode(",",$_POST["chon"]);
//            $sopt=count($arr);
//        };
//
//
        $idsinhvien=0;
        if(isset($_POST["idsinhvien"])){
             $idsinhvien=$_POST["idsinhvien"];
        };
        //echo $masv;

//        $idsinhvien=0;
        $query_idsinhvien ="select * from sinhvien  where MASV='$masv'";//$idlcn and ID_SINHVIEN not in (select ID_SINHVIEN from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
        echo $query_idsinhvien;
        $result_idsinhvien = mysql_query($query_idsinhvien, $link);  
        $totalRows_idsinhvien=mysql_num_rows($result_idsinhvien); 
        if($totalRows_idsinhvien>0) 
        {
            $row = mysql_fetch_array ($result_idsinhvien);
            $idsinhvien=$row["ID_SINHVIEN"];
        }
              
                                                  
        
        $sotien=0;
        if(isset($_POST["sotien"])){
             $sotien=$_POST["sotien"];
        }
//
//        
        $hocky="";
        if(isset($_POST["hocky"])){
             $hocky=$_POST["hocky"];
        }
//
        $namhoc="";
        if(isset($_POST["namhoc"])){
             $namhoc=$_POST["namhoc"];
        };
//
//
        $ngaythu='';
        if(isset($_POST["ngaythu"])){
             $nth=$_POST["ngaythu"];
             $x=explode("/", $nth);
             $ngaythu=$x[2]."-".$x[1]."-".$x[0];
        };
        //echo $ngaythu;
//
//        
       $nguoithu='';
        if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        };
//        
//        
//
//        for($i=0; $i<$sopt-1; $i++){
            $query="insert into thutienphongsinhvien(ID_SINHVIEN,DONGIA,NGAYTHU,HOCKY,NAMHOC,NGUOITHU) values($idsinhvien,$sotien,'$ngaythu','$hocky','$namhoc','$nguoithu')";
                
            mysql_query($query, $link);
//        }
        ///header("Location: ktx_thutienphong.php");
        
//        include("classinexcel.php");
//        $varinexcel=new inexcel();
////        $masv='a';
////        $ngaythu='2015-1-1';
//        if($masv!=''){
//            $varinexcel->in($masv,$ngaythu,$link);
//        }

