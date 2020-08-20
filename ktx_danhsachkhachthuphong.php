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
                    height:20px;
                    font-weight:bold;
                    text-indent:3px;
            }
        </style>
  </head>
    <body>
        <script>
            function xoakhachthuephong(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoakhachnoitru.php?idkhach="+id;
                }
            }
        </script>
    <?php  
        include 'ClassData.php';
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        $totalRows_khach = 0;       
        $stSQL_khach ="select * from danhsachnoitru where ID_LOAINOITRU=2";  
        $result_khach = mysqli_query($link,$stSQL_khach);  
        $totalRows_khach=mysqli_num_rows($result_khach); 
    
        
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
                        <h2> Danh sách khách mướn phòng</h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div>
                       <form name="indanhsachkhach" action="thuchienthemkhach.php" method="post">
                           <button type="submit" class="btn btn-info">In danh sách khách mướn phòng ra định dạng excel</button>
                       </form>
                   </div>
  			<div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Khách đăng ký mướn phòng </button>
                             
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm khách vào danh sách</h4>
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
<!--                                                <div class="form-group">
                                                    <label for="ngaynoitru">Ngày nội trú</label>
                                                    <input type="date" class="form-control" id="ngaynoitru" 
                                                           name="ngaynoitru" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="ghichu">Ghi chú</label>
                                                    <input type="text" class="form-control" id="ghichu" 
                                                           name="ghichu" placeholder="Nhập ghi chú">
                                                </div>-->
                                                <button type="submit" class="btn btn-info">Thêm</button>
                                            </form>                                               
                                            <!--End of Success-->             
                                        </div> <!--End of ModalBody-->
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                                   
                        </div>
  		</div>                   
		</div>
                </div>
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
                            <td>Mã khách</td>
                            <td>Họ đệm</td>
                            <td>Tên</td>
                            <td>Ngày sinh</td>
                            <td>Tên phòng</td>
                            <td>Ngày thuê phòng</td>
                            <td>Tùy chọn</td>
                            </tr>
                          </thead>
                         <tbody>
                        <?php
                            if($totalRows_khach>0)   
                            {    
                                $i=0;                    
                                while ($row_khach = mysqli_fetch_array ($result_khach))     
                                {
                                    $i+=1;
                                                                
                                    $stSQL1 ="select * from KHACH where ID_KHACH='".$row_khach["ID_KHACH"]."'";  
                                    $result1 = mysqli_query($link,$stSQL1);
                                    $row1 = mysqli_fetch_array ($result1);
                                    
                                    $stSQL_phong ="select * from PHONG where ID_PHONG='".$row_khach["ID_PHONG"]."'";  
                                    $result_phong = mysqli_query($link,$stSQL_phong);
                                    $row_phong = mysqli_fetch_array ($result_phong);
                                    
                                    
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatkhachthuephong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật khách thuê phòng</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhatkhachthuephong.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"makhach\">Mã khách</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idmakhach\" value=\"".$row1["MAKHACH"]."\""; 
                                                          echo "name=\"makhach\" placeholder=\"Nhập mã khách\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"hodem\">Họ đệm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row1["HODEM"]."\" "; 
                                                          echo "name=\"hodem\" placeholder=\"Nhập họ đệm\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ten\">Tên</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row1["TEN"]."\" "; 
                                                           echo "name=\"ten\" placeholder=\"Nhập tên\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"phai\">Phái</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row1["PHAI"]."\" "; 
                                                           echo "name=\"phai\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaysinh\">Ngày sinh</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row1["NGAYSINH"]."\" "; 
                                                           echo "name=\"ngaysinh\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row1["ID_KHACH"]."\" />";
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
                                <td><?=$row1["MAKHACH"]?></td>
                                <td><?=$row1["HODEM"]?></td>
                                <td> <?=$row1["TEN"]?> </td>
                                
                                <td><?=$row1["NGAYSINH"]?></td>
                                <td><?=$row_phong["TENPHONG"]?></td>
                                <td><?=$row_khach["NGAYNOITRU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                <td>
                                    <?php
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalthemkhachthuephong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Thêm</a>";
                                    //echo "<a href=\"#modalcapnhatkhachthuephong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoakhachthuephong('".$row_khach["ID_KHACH"]."')\">Xóa</a></button>";
                                    /*
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs" type="button">In biểu mẫu <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="#">Danh sách SV</a></li>
                                            <li><a href="#">Danh sách CSVC</a></li>
                                        </ul>
                                    </div><!-- /btn-group -->*/
                                  ?>
                                </td>
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
      <!--footer start
      <footer class="site-footer">
          <div class="text-center">
              2015 &copy; Phát triển bởi - Khoa Công Nghệ Thông Tin - Truyền Thông.
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
