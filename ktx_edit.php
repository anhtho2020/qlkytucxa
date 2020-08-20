<?php
    session_start();
    if(!isset($_SESSION["quyen"]) || ($_SESSION["quyen"]!="QT" && $_SESSION["quyen"]!="KTKTX" && $_SESSION["quyen"]!="CTCTHT")){
        echo "<script>";
        echo "alert('Ban khong co quyen quan tri');";
        echo "window.location=\"index.php\";";
        echo "</script>";
    }
    include 'ClassData.php';
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="nthieu">
    <!--<meta name="keyword" content="CTEC">-->
    <link rel="shortcut icon" href="img/favicon.png">

    <title>CHƯƠNG TRÌNH QUẢN LÝ KÝ TÚC XÁ | KHOA CNTT - TT</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/isotope/jquery.isotope.css" rel="stylesheet" />
     <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <style rel='stylesheet' type='text/css'>
            body {
                margin: 0;
            }
            th, tfoot td {
                /*border: thin solid black;*/
                text-align: left;
                font-weight: bold;
                font-size: 130%;
            }
            tbody td {
                font-size: 120%;
                font-weight: bold;
            }
            body, td, div{
                    font-family:Arial, Helvetica, sans-serif;
                    font-size:12px; line-height:14px;
                    color:#838486;
                    font-weight:bold;
            }
            input{
                    height:20px;
                    font-weight:bold;
                    text-indent:3px;
            }
        </style>
  </head>

  <body>
       <?php  
        
        $idphong=$_GET["idphong"];
        //echo $idphong;
        $totalRows_khach = 0;       
        $query_khach ="select a.ID_KHACH,a.ID_PHONG,b.MAKHACH,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,b.CMND"
                . " from dskhachnoitru a,khach b where a.ID_KHACH=b.ID_KHACH and a.ID_PHONG=$idphong";  
        $result_khach = mysqli_query($link,$query_khach);  
        $totalRows_khach=mysqli_num_rows($result_khach); 
        
        $totalRows_sinhvien = 0;       
        $query_sinhvien ="select a.ID_SINHVIEN,a.ID_PHONG,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.CMND,b.PHAI"
                . " from danhsachnoitru a,sinhvien b "
                . "where a.ID_SINHVIEN=b.ID_SINHVIEN and  a.ID_PHONG=$idphong";  
        $result_sinhvien = mysqli_query($link,$query_sinhvien);  
        $totalRows_sinhvien=mysqli_num_rows($result_sinhvien); 
        //echo $totalRows_sinhvien;
        $totalRows_lt = 0;       
        $stSQL_lt ="select a.ID_LIENTHONG,a.ID_PHONG,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.CMND,b.PHAI "
                . "from dssvltnoitru a,lienthong b "
                . "where a.ID_LIENTHONG=b.ID_LIENTHONG and ID_PHONG=$idphong";  
        $result_lt = mysqli_query($link,$stSQL_lt);  
        $totalRows_lt=mysqli_num_rows($result_lt); 
        
        $totalRows_2017 = 0;       
        $stSQL_2017 ="select a.ID_SINHVIEN,a.ID_PHONG,b.MAHSSV,b.HODEM,b.TEN,b.NGAYSINH,b.CMND,b.PHAI"
                . " from danhsachnoitrum a,dshssv b "
                . "where a.ID_SINHVIEN=b.ID_DSHSSV and  a.ID_PHONG=$idphong";   
        $result_2017 = mysqli_query($link,$stSQL_2017);  
        $totalRows_2017=mysqli_num_rows($result_2017); 
       
        $stSQL_phong ="select * from phong where ID_PHONG=$idphong";  
        $result_phong = mysqli_query($link,$stSQL_phong);
        $row_phong = mysqli_fetch_array($result_phong);
        
        $idday=$row_phong["ID_DAY"];
        $tenphong=$row_phong["TENPHONG"];
        
//        echo $tenphong;
        if($idday==1)
        {
            $tenday="A";
        }
        elseif ($idday==2)
        {
            $tenday="B";
        }
        elseif ($idday==3)
        {
            $tenday="C";
        }
        elseif ($idday==4)
        {
            $tenday="D";
        }
        else
        {
            $tenday="END";
        }
        
        $stSQL_trangbi ="select * from trangbi where TENPHONG='$tenphong'";  
//        echo $stSQL_trangbi;
        $result_trangbi = mysqli_query($link,$stSQL_trangbi);
        $totalrows_trangbi = mysqli_num_rows ($result_trangbi);
        
        //echo $idphong;
       
    ?>

  <section id="container" >
      <!--header start-->
      <?php
            clsData::data_header();
        ?>
      <!--header end-->
      <!--sidebar start-->
      <aside>
           <?php
                clsData::data_menu();
            ?>

        </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">         
               <div class="row">
               <div class="col-lg-12 selecthk">
               <div class="panel panel-default">
  		<header class="panel-heading">
                    <h2>
                        Thông tin chi tiết phòng <?=$row_phong["TENPHONG"]?> dãy <?=$tenday?>- Ký Túc Xá
                    </h2> 
                    <span class="tools pull-right">
                        <a class="icon-chevron-down" href="javascript:;"></a>
                        <a class="icon-remove" href="javascript:;"></a>
                    </span>
                </header>
  		<div class="panel-body">                   		                       
                    <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                </div>
  		</div>
                </div>                    
                </div>
               <div class="row">                  
               <div class="col-lg-12">
               <div class="panel">
  		<div class="panel-body">
                <div class="adv-table editable-table ">

                <?php
                if($idday==4)
                {
                        echo "<table class=\"table table-striped table-hover table-bordered\" id=\"editable-sample\" style=\"margin-top:20px\">";
                             echo " <thead>";
                             echo " <tr>";
                                echo "  <th>MÃ KHÁCH</th>";
                                echo "  <th>HỌ TÊN</th>";
//                                echo "  <th>TÊN</th>";
                                echo "  <th>PHÁI</th>";
                                echo "  <th>NGÀY SINH</th>";
                                echo "  <th>CMND</th>";
                                
                            echo "  </tr>";
                            echo "  </thead>";
                            echo "<tbody>";
                                if($totalRows_khach>0)   
                                {    
                                    $i=0;                    
                                    while ($row_khach = mysqli_fetch_array ($result_khach))     
                                    {   
                                        $i+=1;
//                                        $stSQL_khach ="select * from khach where ID_KHACH='".$row_khach_khach["ID_KHACH"]."'";  
//                                        $result_khach = mysql_query($stSQL_khach, $link);
//                                        $row_khach = mysql_fetch_array ($result_khach);
                              
                                        
                                        echo "<tr class=\"\">";
                                            echo "<td>"; echo $row_khach["MAKHACH"]; echo "</td>";
                                            echo "<td>"; echo $row_khach["HODEM"]." ".$row_khach["TEN"]; echo "</td>";
//                                            echo "<td>"; echo $row_khach["TEN"]; echo "</td>";
                                            if($row_khach["PHAI"]==0)
                                            {
                                                echo "<td>"; echo 'Nam'; echo "</td>";
                                            }
                                            else {
                                                echo "<td>"; echo 'Nữ'; echo "</td>";

                                            }
                                            echo "<td>"; echo $row_khach["NGAYSINH"]; echo "</td>";
                                            echo "<td>"; echo $row_khach["CMND"]; echo "</td>";
                                            
                                        echo "</tr>";
                              
                                    } 
                                }
                            echo "</tbody>";
                        echo "</table>";
                    }
                    else 
                    {

                        echo "<table class=\"table table-striped table-hover table-bordered\" id=\"editable-sample\" style=\"margin-top:20px\">";
                             echo " <thead>";
                             echo " <tr>";
                                echo "  <th>MÃ HSSV</th>";
                                echo "  <th>HỌ TÊN</th>";
//                                echo "  <th>TÊN</th>";
                                echo "  <th>PHÁI</th>";
                                echo "  <th>NGÀY SINH</th>";
                                echo "  <th>CMND</th>";
                        
                            echo "  </tr>";
                            echo "  </thead>";
                            echo "<tbody>";
                            $i=0;
                                if($totalRows_sinhvien>0)   
                                {    
                                                        
                                    while ($row_sinhvien = mysqli_fetch_array ($result_sinhvien))     
                                    {   
                                        $i+=1;
//                                        $stSQL_sinhvien ="select * from sinhvien "
//                                                . "where ID_SINHVIEN='".$row_sinhvien_noitru["ID_SINHVIEN"]."'";  
//                                        $result_sinhvien = mysql_query($stSQL_sinhvien, $link);
//                                        $row_sinhvien = mysql_fetch_array ($result_sinhvien);
                              
                                        
                                        echo "<tr class=\"\">";
                                            echo "<td>"; echo $row_sinhvien["MASV"]; echo "</td>";
//                                            echo "<td>"; echo $row_sinhvien["HODEM"]; echo "</td>";
//                                            echo "<td>"; echo $row_sinhvien["TEN"]; echo "</td>";
                                            echo "<td>"; echo $row_sinhvien["HODEM"].' '.$row_sinhvien["TEN"]; echo "</td>";
                                            if($row_sinhvien["PHAI"]==0)
                                            {
                                                echo "<td>"; echo 'Nam'; echo "</td>";
                                            }
                                            else {
                                                echo "<td>"; echo 'Nữ'; echo "</td>";

                                            }
                                            
                                            echo "<td>"; echo $row_sinhvien["NGAYSINH"]; echo "</td>";
                                            echo "<td>"; echo $row_sinhvien["CMND"]; echo "</td>";
                                            
                                        echo "</tr>";
                                    }
                                        
                                    while ($row_2017 = mysqli_fetch_array ($result_2017))     
                                    {   
                                        $i+=1;
//                                        
                              
                                        
                                        echo "<tr class=\"\">";
                                            echo "<td>"; echo $row_2017["MAHSSV"]; echo "</td>";
//                                            echo "<td>"; echo $row_sinhvien["HODEM"]; echo "</td>";
//                                            echo "<td>"; echo $row_sinhvien["TEN"]; echo "</td>";
                                            echo "<td>"; echo $row_2017["HODEM"].' '.$row_2017["TEN"]; echo "</td>";
                                            if($row_2017["PHAI"]==0)
                                            {
                                                echo "<td>"; echo 'Nam'; echo "</td>";
                                            }
                                            else {
                                                echo "<td>"; echo 'Nữ'; echo "</td>";

                                            }
                                            
                                            echo "<td>"; echo $row_2017["NGAYSINH"]; echo "</td>";
                                            echo "<td>"; echo $row_2017["CMND"]; echo "</td>";
                                            
                                        echo "</tr>";
                              
                                    } 
                                }
                                if($totalRows_lt>0)   
                                {    
                                    //$i=0;    
                                    while ($row_lt = mysqli_fetch_array ($result_lt))     
                                    {   
                                        $i+=1;
//                                        $stSQL_sinhvien ="select * from lienthong where ID_LIENTHONG='".$row_lt_noitru["ID_LIENTHONG"]."'";  
//                                        $result_sinhvien = mysql_query($stSQL_sinhvien, $link);
//                                        $row_sinhvien = mysql_fetch_array ($result_sinhvien);
                              
                                        
                                        echo "<tr class=\"\">";
                                            echo "<td>"; echo $row_lt["MASV"]; echo "</td>";
//                                            echo "<td>"; echo $row_sinhvien["HODEM"]; echo "</td>";
//                                            echo "<td>"; echo $row_sinhvien["TEN"]; echo "</td>";
                                            echo "<td>"; echo $row_lt["HODEM"].' '.$row_lt["TEN"]; echo "</td>";
                                            if($row_lt["PHAI"]==0)
                                            {
                                                echo "<td>"; echo 'Nam'; echo "</td>";
                                            }
                                            else {
                                                echo "<td>"; echo 'Nữ'; echo "</td>";

                                            }
                                            echo "<td>"; echo $row_lt["NGAYSINH"]; echo "</td>";
                                            echo "<td>"; echo $row_lt["CMND"]; echo "</td>";
                                            
                                        echo "</tr>";
                              
                                    } 
                                }

                               
                            echo "</tbody>";
                        echo "</table>";
                        
                        
                    }
                    ?>
                        
                </div>

                              <?php
                    echo "<form class=\"form-horizontal\" role=\"form\" > ";
                        echo "<div class=\"form-group\">";
                            echo "<label  class=\"col-lg-2 control-label\">Tên phòng</label>";
                            echo "<div class=\"col-lg-6\">";
                                echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" placeholder=\"Nhập tên phòng\" value=".$row_phong["TENPHONG"].">";
                            echo "</div>";
                        echo "</div>";
                        
                        echo "<div class=\"form-group\">";
                            echo "<label  class=\"col-lg-2 control-label\">Sức chứa </label>";
                            echo "<div class=\"col-lg-6\">";
                                echo "<input type=\"number\" class=\"form-control\" id=\"soluongsv\" placeholder=\"Nhập số lượng sinh viên tối đa\" value=".$row_phong["SUCCHUA"].">";
                            echo "</div>";
                        echo "</div>    ";                                                                
                        
                        echo "<div class=\"form-group\">";
                            echo "<label class=\"control-label col-md-3\"><h2>Cơ sở vật chất của phòng</h2></label>";
                            echo "<div class=\"col-md-9\">";
                        echo "<table class=\"table table-striped table-hover table-bordered\" id=\"editable-sample\" style=\"margin-top:20px\">";
                            echo "  <thead>";
                              echo "<tr>";
                                  echo "<th>MÃ TÀI SẢN</th>";
                                  echo "<th>TÊN TÀI SẢN</th>";
                                  echo "<th>KIỂU MẪU</th>";
                                  echo "<th>SỐ LƯỢNG</th>";
                                  echo "<th>NGÀY TRANG BỊ</th>";
                                                                   
                              echo "</tr>";
                              echo "</thead>";
                                echo "<tbody>";
                                    if($totalrows_trangbi>0)   
                                    {    
                                        $i=0;                    
                                        while ($row_trangbi = mysqli_fetch_array ($result_trangbi))     
                                        {   
                                            $i+=1;
                                            
                                            echo "<div class=\"modal fade\" id=\"modalsuaphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật phòng</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"suaphong.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"idday\">ID_DAY</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                          echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng SV tối đa</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsv\" value=\"".$row["SUCCHUA"]."\" "; 
                                                           echo "name=\"succhua\" placeholder=\"Nhập số lượng SV tối đa\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng sinh viên của phòng</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsvcuaphong\" value=\"".$row1["total"]."\" "; 
                                                           echo "name=\"total\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row["ID_PHONG"]."\" />";
                                                echo "<button type=\"submit\" class=\"btn btn-info\">Cập nhật</button>";
                                            echo "</form>";                                               
                                           // <!--End of Success-->             
                                        //</div> <!--End of ModalBody-->
                                        echo "<div class=\"modal-footer\">";
                                             echo " <button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\">Đóng</button>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div> "; 
                                            
                                            
                                            
                                            $stSQL_taisan ="select * from taisan where MATAISAN='".$row_trangbi["MATAISAN"]."'";  
                                            echo $stSQL_taisan;
                                            $result_taisan = mysqli_query($link,$stSQL_taisan);
                                            $row_taisan = mysqli_fetch_array ($result_taisan);
                              
                              //echo "<tbody>";
                              echo "<tr class=\"\">";
                                  echo "<td>".$row_taisan["MATAISAN"]."</td>";
                                  echo "<td>".$row_taisan["TENTAISAN"]."</td>";
                                  echo "<td>".$row_taisan["KIEUMAU"]."</td>";
                                  echo "<td>".$row_trangbi["SOLUONG"]."</td>";
                                  echo "<td>".$row_trangbi["NGAYTRANGBI"]."</td>";
                                  
                                  
                                  
                              echo "</tr>";
                               
                                    } 
                                }
//                                else
//                                {  
//                                                 
//                                    echo "<tr valign=\"top\">";
//                                       echo " <td >&nbsp;</td> ";                  
//                                       echo " <td > ";
//                                            echo "<b>";
//                                                echo "<font face=\"Arial\" color=\"#FF0000\">";                      
//                                                   echo " Oop! Ship not found!";
//                                               echo " </font>";
//                                            echo "</b>";
//                                        echo "</td>    ";             
//                                    echo "</tr>";                 
//                                   
//                                } 
                                
                            echo "</tbody>";
                        echo "</table>";
                        
                                
                           echo " </div>";
                        echo "</div>";
                    echo "</form>";
                     ?>
                        
  		</div>
		</div>
               </div>
              </div>                         
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
     <!--  <footer class="site-footer">
          <div class="text-center">
              2015 &copy; Phát triển bởi Khoa Công Nghệ Thông Tin - Truyền Thông.
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <script type="text/javascript" language="javascript" src="assets/isotope/jquery.isotope.js"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/datatable.bootstrap.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/respond.min.js" ></script>

    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script src="js/Entity_Edit.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

  <script>
      $(document).ready(function() {
        $('#example').dataTable({
				  "sPaginationType": "bootstrap",
        			"oLanguage": {
            "sLengthMenu": "Hiển thị _MENU_ mẫu tin trên mỗi trang",
            "sZeroRecords": "Không có dữ liệu",
            "sInfo": "Hiển thị từ _START_ đến _END_ of _TOTAL_ mẫu tin",
            "sInfoEmpty": "Có 0 đến 0 của 0 mẫu tin",
            "sInfoFiltered": "(lọc từ _MAX_ mẫu tin)",
			"sSearch": "Tìm kiếm:",
			"oPaginate": {
                        "sPrevious": "Trước đó",
                        "sNext": "Kế tiếp"
                    }
        }
    });
			  
      });
	$('#my_multi_select1').multiSelect();
          jQuery(document).ready(function() {
              EditableTable.init();
          });
  </script>

  </body>
</html>
