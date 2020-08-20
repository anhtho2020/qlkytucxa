<?php
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

    $iddanhsachnoitru=$_POST["iddanhsachnoitru"];
    $idsinhvien=$_POST["idsinhvien"];
    $masv=$_POST["masv"];
    $hodem=$_POST["hodem"];
    $ten=$_POST["ten"];
    $ngaysinh=$_POST["ngaysinh"];
    $phai=$_POST["phai"];
    $malop=$_POST["malop"];
    $tenphong=$_POST["tenphong"];
    $ngaynoitru=$_POST["ngaynoitru"];
  
    $totalRows_lop = 0;       
    $query_lop ="select * from lopchuyennganh  where MALOPCHUYENNGANH='$malop'";
    $result_lop = mysql_query($query_lop, $link);  
    $totalRows_lop=mysql_num_rows($result_lop);
    $row_lop = mysql_fetch_array ($result_lop);
    $idlopchuyennganh=$row_lop["ID_LOPCHUYENNGANH"];
        

    $query_up_sv="Update sinhvien set MASV='$masv', HODEM='$hodem',TEN='$ten',NGAYSINH='$ngaysinh',PHAI=$phai,"
            . " ID_LOPCHUYENNGANH=$idlopchuyennganh "
            . " where ID_SINHVIEN=$idsinhvien"; //echo $query_up_sv;
    mysql_query($query_up_sv, $link);
    
   //$totalRows_phong = 0;       
    //$query_phong ="select * from phong  where TENPHONG='$tenphong'"; //echo $query_phong;
    //$result_phong = mysql_query($query_phong, $link);  
    //$totalRows_phong=mysql_num_rows($result_phong);

        //$row_phong = mysql_fetch_array ($result_phong);
        //$idphong=$row_phong["ID_PHONG"];

    //$query="Update danhsachnoitru set ID_SINHVIEN=$idsinhvien,ID_PHONG=$idphong,NGAYNOITRU='$ngaynoitru'"
            //. " where ID_DANHSACHNOITRU=$iddanhsachnoitru"; //echo $query;
    mysql_query($query, $link);
    header("Location: ktx_danhsachsinhviennoitru.php");
?>