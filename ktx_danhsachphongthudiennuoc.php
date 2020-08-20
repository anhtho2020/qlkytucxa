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
  </head>

    <body>
        <script>
            function xoaphongthudiennuoc(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphongthudiennuoc.php?idthudiennuoc="+id;
                }
            }
        </script>
    <?php  
        include 'ClassData.php';
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();   
        
        $totalRows = 0;       
        $query="select a.ID_THUDIENNUOC,a.ID_PHONG, b.TENPHONG, a.GIADIEN,a.CSDIENCU,a.CSDIENMOI,a.GIANUOC,a.CSNUOCCU,a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.THANGNOP,a.NGUOITHU,a.NGUOINOP from thudiennuoc a, phong b where a.ID_PHONG=b.ID_PHONG";  
        $result = mysql_query($query, $link);  
        $totalRows=mysql_num_rows($result); 
    
        
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
                        Danh sách sinh viên nộp tiền phòng - Ký túc xá
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div class="form-group">
                       <form role="form" action="ktx_thutienphongsinhvien.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">Thu tiền phòng sinh viên nội trú</button>
                    </form>     
                    </div>   
                   <div class="form-group"> 
                    <form role="form" action="ktx_xuatexceldanhsachsinhviennoptienphong.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">In danh sách sinh viên nộp tiền phòng</button>
                    </form> 
                    </div> 
                        <!--
  			<div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Thêm sinh viên </button>
                             
                                <div class="modal-body">
                                                                  
                                </div> <!--End of ModalBody

                            
                            
                            
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm sinh viên nội trú</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="thuchienthemkhach.php" method="post">
                                                <div class="form-group">
                                                    <label for="makhach">Mã khách</label>
                                                    <input type="text" class="form-control" id="makhach" 
                                                           name="makhach" placeholder="Nhập mã khách">
                                                </div>
                                                <div class="form-group">
                                                    <label for="hodem">Họ đệm</label>
                                                    <input type="text" class="form-control" id="hodem" 
                                                           name="hodem" placeholder="Nhập họ đệm">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ten">Tên</label>
                                                    <input type="text" class="form-control" id="ten" 
                                                           name="ten" placeholder="Nhập tên">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phai">Phái</label>
                                                    <input type="text" class="form-control" id="phai" 
                                                           name="phai" placeholder="Nhập phái">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ngaysinh">Ngày sinh</label>
                                                    <input type="text" class="form-control" id="ngaysinh" 
                                                           name="ngaysinh" placeholder="Nhập ngaysinh">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cmnd">CMND</label>
                                                    <input type="text" class="form-control" id="cmnd" 
                                                           name="cmnd" placeholder="Nhập cmnd">
                                                </div>
                                                <div class="form-group">
                                                    <label for="noisinh">Nơi sinh</label>
                                                    <input type="text" class="form-control" id="noisinh" 
                                                           name="noisinh" placeholder="Nhập nơi sinh">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="diachi">Địa chỉ</label>
                                                    <input type="text" class="form-control" id="diachi" 
                                                           name="diachi" placeholder="Nhập địa chỉ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">EMAIL</label>
                                                    <input type="text" class="form-control" id="email" 
                                                           name="email" placeholder="Nhập email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sodienthoai">Số điện thoại</label>
                                                    <input type="text" class="form-control" id="sodienthoai" 
                                                           name="sodienthoai" placeholder="Nhập số điện thoại">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ngaynoitru">Ngày nội trú</label>
                                                    <input type="date" class="form-control" id="ngaynoitru" 
                                                           name="ngaynoitru" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="ghichu">Ghi chú</label>
                                                    <input type="text" class="form-control" id="ghichu" 
                                                           name="ghichu" placeholder="Nhập ghi chú">
                                                </div>
                                                
                                                
                                                
                                                
                                                <button type="submit" class="btn btn-info">Thêm</button>
                                            </form>                                               
                                            End of Success
                                        </div> End of ModalBody
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                        -->
                                    </div>
                                </div>
              <!--
                            </div>    
                            
                            
                            
                        </div>
                            
                                
                   
                   
  		</div>                   
		</div>
                </div>
                -->
               <div class="row">                  
               <div class="col-lg-12">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <td>STT</td>
                            <td>TÊN PHÒNG</td>
                            <td>GIÁ ĐIỆN</td>
                            <td>CHỈ SỐ ĐIỆN CŨ</td>
                            <td>NCHỈ SỐ ĐIỆN MỚI</td>
                            <td>GIÁ NƯỚC</td>
                            <td>CHỈ SỐ NƯỚC CŨ</td>
                            <td>CHỈ SỐ NƯỚC MỚI</td>
                            <td>THÀNH TIỀN</td>
                            <td>NGÀY THU</td>
                            <td>THÁNG NỘP</td>
                            <td>NGƯỜI THU</td>
                            <td>NGƯỜI NỘP</td>
                            <td>TÙY CHỌN</td>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                             $i+=1;
                           
 
//                                    $stSQL_sv ="select * from sinhvien where ID_SINHVIEN='".$row["ID_SINHVIEN"]."'";  
//                                    $result_sv = mysql_query($stSQL_sv, $link);
//                                    $row_sv = mysql_fetch_array ($result_sv);
//                                    
//                                    
//                                    
//                                    
//                                    $stSQL_phong ="select * from danhsachnoitru where ID_SINHVIEN='".$row["ID_SINHVIEN"]."'";  
//                                    $result_phong = mysql_query($stSQL_phong, $link);
//                                    $row_phong = mysql_fetch_array ($result_phong);
//                                    
//                                    $stSQL_phong1 ="select * from phong where ID_PHONG='".$row_phong["ID_PHONG"]."'";  
//                                    $result_phong1 = mysql_query($stSQL_phong1, $link);
//                                    $row_phong1 = mysql_fetch_array ($result_phong1);
                                    
                                    
                                echo "<div class=\"modal fade\" id=\"modalthongtinphongdiennuoc$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thu điện nước của phòng</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinthudiennuoc.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                           echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"giadien\">Giá điện</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"giadien\" value=\"".$row["GIADIEN"]."\""; 
                                                          echo "name=\"giadien\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csdiencu\">Chỉ số điện cũ</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"csdiencu\" value=\"".$row["CSDIENCU"]."\" "; 
                                                          echo "name=\"csdiencu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csdienmoi\">Chỉ số điện mới</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"csdienmoi\" value=\"".$row["CSDIENMOI"]."\" "; 
                                                          echo "name=\"csdienmoi\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"gianuoc\">Giá nước</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"gianuoc\" value=\"".$row["GIANUOC"]."\""; 
                                                          echo "name=\"gianuoc\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csnuoccu\">Chỉ số nước cũ</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"csnuoccu\" value=\"".$row["CSNUOCCU"]."\" "; 
                                                          echo "name=\"csnuoccu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csnuocmoi\">Chỉ số nước mới</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"csnuocmoi\" value=\"".$row["CSNUOCMOI"]."\" "; 
                                                          echo "name=\"csnuocmoi\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thanhtien\">Thành tiền</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"thanhtien\" value=\"".$row["THANHTIEN"]."\" "; 
                                                          echo "name=\"thanhtien\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythu\">Ngày thu</label>";
                                                    echo "<input type=\"date\" class=\"form-control\" id=\"ngaythu\" value=\"".$row["NGAYTHU"]."\" "; 
                                                          echo "name=\"ngaythu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thangnop\">Tháng nộp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"thangnop\" value=\"".$row["THANGNOP"]."\" "; 
                                                          echo "name=\"thangnop\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nguoithu\">Người thu</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
                                                          echo "name=\"nguoithu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nguoinop\">Người nộp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguonop\" value=\"".$row["NGUOINOP"]."\" "; 
                                                          echo "name=\"nguoinop\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idthudiennuoc\" value=\"".$row["ID_THUDIENNUOC"]."\" />";
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
                                <td><?=$i?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["GIADIEN"]?></td>
                                <td><?=$row["CSDIENCU"]?> </td>
                                <td><?=$row["CSDIENMOI"]?></td>
                                <td><?=$row["GIANUOC"]?></td>
                                <td><?=$row["CSNUOCCU"]?></td>
                                <td><?=$row["CSNUOCMOI"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["THANGNOP"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <td><?=$row["NGUOINOP"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <td>
                                    <?php
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalthongtinphongdiennuoc$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoaphongthudiennuoc('".$row["ID_THUDIENNUOC"]."')\">Xóa</a></button>";
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
                            else
                            {  
                        ?>                 
                                <tr valign="top">                    
                                <td >&nbsp;</td>                   
                                <td > 
                                    <b>
                                        <font face="Arial" color="#FF0000">                      
                                            Không có dữ liệu !
                                        </font>
                                    </b>
                                </td>                 
                                </tr>                 
                        <?php   
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
