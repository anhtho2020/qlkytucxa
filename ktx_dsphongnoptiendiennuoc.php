<?php
    session_start();
    if(!isset($_SESSION["quyen"]) || ($_SESSION["quyen"]!="QT" && $_SESSION["quyen"]!="KTKTX" && $_SESSION["quyen"]!="CTCTHT")){
        echo "<script>";
        echo "alert('Ban khong co quyen quan tri');";
        echo "window.location=\"index.php\";";
        echo "</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="nthieu">
    <meta name="keyword" content="CTEC">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>HỆ THỐNG QUẢN LÝ KÝ TÚC XÁ | KHOA CNTT - TT</title>

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
                    height:30px;
                    font-weight:bold;
                    text-indent:3px;
            }
        </style>
  </head>

    <body>
        <script>
            function xoaphongnoptiendiennuoc(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienoptiendiennuoc.php?idthutiendiennuoc="+id;
                }
            }
            
            function inphieuthutiendiennuoc(id){
//                if(confirm('Bạn có chắc in phiếu này không?')){
                    window.location="ktx_inphieuthudiennuoc_dg_cs_tt.php?idthutiendiennuoc="+id;
//                }
            }
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_danhsachphongdanoptiendiennuoc.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
    <?php  
        include 'ClassData.php';
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $idday=1;
        if(isset($_GET["idday"])){
             $idday=$_GET["idday"];
        }
        else echo " ";
        $idphong=0;
        if(isset($_GET["idphong"])){
             $idphong=$_GET["idphong"];
        }
        else echo " ";
    
        
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
                        <h2> Danh sách phòng nộp tiền điện nước </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div class="form-group"> 
                    <form role="form" action="ktx_xuatexceldanhsachphongdanoptiendiennuoc.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">In danh sách</button>
                    </form> 
                    </div> 
                   <div class="form-group">
                       <form role="form" action="ktx_thudiennuoc.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">Thu tiền điện nước</button>
                    </form>     
                    </div>   
                   
                </div>
                </div>
                   
                   <?php
//                    echo "<div>"; 
//                        echo "<form name=\"danhsachphongdanoptiendiennuoc\" action=\"ktx_danhsachphongdanoptiendiennuoc.php\" method=\"post\">";
//                        echo "<div class=\"form-group\">";
//                        
//                        echo "<tr>";
//                          echo "<th > Tên dãy: </th>";
//                              echo "<select name=\"idday\" id=\"idday\" onchange=\"load()\">";
//                                  $query_day="select ID_DAY, TENDAY from day";
//                                  echo $query_day;
//                                  $result_day=mysql_query($query_day, $link);
//                                  while($row_day=  mysql_fetch_array($result_day)){
//                                      echo "<option value=\"".$row_day["ID_DAY"]."\"";
//                                        if($row_day["ID_DAY"]==$idday){
//                                            echo " selected=\"selected\"";
//                                        }
//                                      echo ">";
//                                      echo $row_day["TENDAY"]."</option>";
//                                  }
//                                echo "</select>";
//                            echo "</tr>";
//                      
//                            $kt=1;
//                            echo "<tr>";
//                            echo "<th > Tên phòng: </th>";
//                                echo "<select name=\"idphong\" id=\"idphong\" onchange=\"load()\">";
//                                    
//                                    echo "<option value=\"0\"";
//                                    if($kt==1){echo " selected=\"selected\"";}
//                                    echo ">Ten phong</option>";
//                                    
//                                    
//                                    $query_phong="select ID_PHONG,ID_DAY, TENPHONG from phong where ID_DAY=$idday";
//                                    //echo $query_phong;
//                                    $result_phong=mysql_query($query_phong, $link);
//                                    while($row_phong=  mysql_fetch_array($result_phong)){
//                                        echo "<option value=\"".$row_phong["ID_PHONG"]."\"";
//                                        if($row_phong["ID_PHONG"]==$idphong){
//                                            echo " selected=\"selected\"";
//                                        }
//                                        echo ">";
//                                        echo $row_phong["TENPHONG"]."</option>";
//                                    }
//                                echo "</select>";
//                                
//                                
//                           echo "</tr>";
//                           echo "<tr>";
//                            $now = getdate(); 
//                            $ngtrathechap=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
//                            echo "<td> Ngày trả thế chấp: </td>";
////                            echo "<td>&nbsp</td> ";
//                            echo "<td width=\"60\"> <input type=\"text\" name=\"ngaytrathechap\" id=\"ngaytrathechap\" size=\"8\" maxlength=\"10\" value=\"".$ngtrathechap."\" </td>";
//                        echo "</tr>";
//                        echo "</form>"; 
//                        echo "</div>";
              
                ?>
             
               <div class="row">                  
               <div class="col-lg-12">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <!--<td>STT</td>-->
                            <td> TÊN PHÒNG</td>
                            <td> GIÁ ĐIỆN</td>
                            <td> CSĐ CŨ</td>
                            <td> CSĐ MỚI </td>
                            <td> GIÁ NƯỚC</td>
                            <td> CSN CŨ</td>
                            <td> CSN MỚI </td>
                            <td> THÀNH TIỀN</td>
                            <td> THÁNG NỘP</td>
                            <td> NGÀY THU </td>
                            <td>NGƯỜI THU</td>
                            <td>NGƯỜI NỘP</td>
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                            echo "<td>TÙY CHỌN</td>";   
                            }
                            ?>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            $totalRows = 0;       
            $query ="select a.ID_THUTIENDIENNUOC,a.ID_SINHVIEN,a.GIADIEN,a.CSDIENCU,a.CSDIENMOI,a.GIANUOC,a.CSNUOCCU,"
                    . "a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.THANGNOP,a.NGUOITHU,"
                    . "b.MASV,b.HODEM,b.TEN,b.NGAYSINH,c.TENPHONG "
                    . "from dsphieuthutiendiennuoc a,sinhvien b, phong c where a.ID_SINHVIEN=b.ID_SINHVIEN and "
                    . "a.ID_PHONG=c.ID_PHONG";// and a.ID_PHONG=$idphong and "
                    //. "a.ID_THUTIENDIENNUOC not in (select ID_THUTIENDIENNUOC from dsphieuthutiendiennuoc  where ID_THUTIENDIENNUOC is not null)";
            //echo $query;
            $result = mysql_query($query, $link);  
            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                                    $i+=1;

                                    echo "<div class=\"modal fade\" id=\"modalsuathutiendiennuoc$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thu điện nước</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinthudiennuoc.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"giadien\">Giá điện</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"giadien\" value=\"".$row["GIADIEN"]."\" "; 
                                                           echo "name=\"giadien\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csdiencu\"> Chỉ số điện cũ</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csdiencu\" value=\"".$row["CSDIENCU"]."\""; 
                                                          echo "name=\"csdiencu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csdienmoi\"> Chỉ số điện mới</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csdienmoi\" value=\"".$row["CSDIENMOI"]."\" "; 
                                                          echo "name=\"csdienmoi\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"gianuoc\">Giá nước</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"gianuoc\" value=\"".$row["GIANUOC"]."\" "; 
                                                           echo "name=\"gianuoc\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csnuoccu\"> Chỉ số nước cũ</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csnuoccu\" value=\"".$row["CSNUOCCU"]."\""; 
                                                          echo "name=\"csnuoccu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csnuocmoi\"> Chỉ số nước mới</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csnuocmoi\" value=\"".$row["CSNUOCMOI"]."\" "; 
                                                          echo "name=\"csnuocmoi\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thanhtien\"> Thành tiền</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"thanhtien\" value=\"".$row["THANHTIEN"]."\" "; 
                                                          echo "name=\"thanhtien\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythu\"> Ngày thu </label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaythu\" value=\"".$row["NGAYTHU"]."\" "; 
                                                          echo "name=\"ngaythu\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                 echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thangnop\">Tháng nộp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"thangnop\" value=\"".$row["THANGNOP"]."\" "; 
                                                          echo "name=\"thangnop\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nguoithu\"> Người thu </label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
                                                          echo "name=\"nguoithu\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                
                                                echo "<input type=\"hidden\" name=\"idthutiendiennuoc\" value=\"".$row["ID_THUTIENDIENNUOC"]."\" />";
                                                //echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row["ID_KHACH"]."\" />";
                                                
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
                                    
                        ?>  
                            
                            <tr>
                                <!--<td><?=$i?></td>-->
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["GIADIEN"]?></td>
                                <td><?=$row["CSDIENCU"]?> </td>
                                <td><?=$row["CSDIENMOI"]?></td>
                                
                                <td><?=$row["GIANUOC"]?></td>
                                
                                <td><?=$row["CSNUOCCU"]?></td>
                                <td><?=$row["CSNUOCMOI"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["THANGNOP"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <td><?=$row["HODEM"]?> <?=$row["TEN"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <td>
                                    <?php
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalsuasinhvienvipham$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    if($_SESSION["quyen"]=="QT"){
                                        echo "<a href=\"#modalsuathutiendiennuoc$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoaphongnoptiendiennuoc('".$row["ID_THUTIENDIENNUOC"]."')\">Xóa</a></button>";
                                        
                                    }
//                                    echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthutiendiennuoc('".$row["ID_THUTIENDIENNUOC"]."')\">In phiếu thu</a></button>";
                                    /* <!--<div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs" type="button">In biểu mẫu <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                           <li><a href="#">Danh sách SV</a></li>
                                           <li><a href="#">Danh sách CSVC</a></li>
                                        </ul>
                                    </div><!-- /btn-group -->*/
                                  ?>
                                </td>
                                
                        </tr>  
                        <?php  
                                } 
                            }
                            
                        ?>
                                               
                        </tbody>        
                        </table>
                        </div>
                        </div>
                        
  		</div>
		</div>
               </div>
              </div>                         
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 &copy; Phát triển bởi Nguyễn Minh Đợi- Khoa Công Nghệ Thông Tin - Truyền Thông.
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

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

  <script>
		function updateDiem(a){
			if ($(a).val()==""){
				$(a).parent('td').removeClass('has-success').addClass('has-error');
			}
			else{
				$(a).parent('td').removeClass('has-error').addClass('has-success');
			}
		}
      //owl carousel

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

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  function captaikhoan(){
		  $('#formcaptaikhoan').hide();
		  $('#ctkprogressbar').show();
	  }

  </script>

  </body>
</html>
