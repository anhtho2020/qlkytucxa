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
    <!--<meta name="keyword" content="CTEC">-->
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
                font-size: 120%;
            }
            tbody td {
                font-size: 100%;
                font-weight: bold;
            }
        </style>
  </head>

    <body>
        <script>
            function xoasinhvienlttamtru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvientamtrult.php?iddangkytamtrult="+id;
                }
            }
        </script>
    <?php  
        include 'ClassData.php';
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $query ="select a.ID_DANGKYTAMTRULT,a.ID_LIENTHONG,a.NGAYTAMTRU,b.ID_PHONG,b.NGAYNOITRU, c.MASV, c.HODEM,c.TEN, "
                . "c.NGAYSINH,c.CMND,c.DIACHI,d.TENPHONG,e.MALOPLT,b.GHICHU from dangkytamtrult a,"
                . "dssvltnoitru b, lienthong c, phong d, loplt e  where  (a.ID_LIENTHONG=b.ID_LIENTHONG) "
                . "and (a.ID_LIENTHONG=c.ID_LIENTHONG) and (b.ID_PHONG=d.ID_PHONG) and "
                . "(c.ID_LOP=e.ID_LOPLT)";  
        $result = mysqli_query($link,$query);  
        $totalRows=mysqli_num_rows($result); 
        //echo $query;
        
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
                        <h2> Danh sách sinh viên liên thông đăng ký tạm trú </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                    <?php
                        echo "<div class=\"form-group\">";    
                        echo "<form name=\"danhsachsinhvienltdangkytamtru\" action=\"ktx_xuatexcel_danhsachsinhvienltdangkytamtru.php\" method=\"post\">";
                        echo "<input type=\"submit\" class=\"btn btn-info\" value=\"In danh sách \">";
                        echo "</form>";   
                        echo "</div>"; 
                        
                        echo "<div class=\"form-group\">";    
                        echo "<form name=\"danhsachsinhvienoktxdangkytamtru\" action=\"ktx_dangkytamtru.php\" method=\"post\">";
//                        echo "<tr>";
//                            echo "<td> Nhập năm học: </td>";
//                            echo "<td> <input type=\"text\" name=\"namhoc\" id=\"namhoc\" value=\"\"> </td>";
////                            echo "<td> Đến ngày: </td>";
////                            echo "<td> <input type=\"date\" name=\"denngay\" id=\"denngay\" value=\"\"> </td></br></br>";
//                        echo "</tr>";
                        echo "<input type=\"submit\" class=\"btn btn-info\" value=\"Đăng ký tạm trú\">";
                        echo "</form>";   
                        echo "</div>"; 
                       ?>
<!--  			<div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Thêm sinh viên đã đăng ký tạm trú </button>
                             
                                <div class="modal-body">
                                            <form name="form" action="ktx_xuatexcel_danhsachsinhvienoktx.php" method="post">                                                   
                                                
                                                
                                            <button type="submit" class="btn btn-info">In danh sách sinh viên ở ký túc xá</button>
                                            </form>                                               
                                </div> End of ModalBody

                            
                            
                            
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm sinh viên đã đăng ký tạm trú</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="ktx_dangkytamtru.php" >
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
                                                
                                                
                                                
                                                
                                                <button type="submit" class="btn btn-info">Mở trang thêm sinh viên đăng ký tạm trú</button>
                                            </form>                                               
                                            End of Success             
                                        </div> End of ModalBody
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                         </div>-->
   		</div>                   
		</div>
                </div>
               <div class="row">                  
               <div class="col-lg-11">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                                <th>STT</th>
                                <th>MÃ SVLT</th>
                                <th width="18%">HỌ VÀ TÊN</th>
                                <!--<th>TÊN</th>-->
                                <th>NGÀY SINH</th>
                                <!--<th>CMND</th>-->
                                <th> LỚP </th>
                                <th> PHÒNG </th>
                                <th>NGÀY NT</th>
                                <th>NGÀY TT</th>
                                <!--<td>GHI CHÚ</td>-->
                                <th>TÙY CHỌN</th>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                             $i+=1;
                           echo "<div class=\"modal fade\" id=\"modalcapnhattamtrult$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin SVLT tạm trú</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhattamtrult.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"masv\"> Mã sinh viên</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MASV"]."\""; 
                                                          echo "name=\"masv\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaytamtru\"> Ngày tạm trú</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaytamtru\" value=\"".$row["NGAYTAMTRU"]."\" "; 
                                                          echo "name=\"ngaytamtru\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ghichu\"> Ghi chú</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ghichu\" value=\"".$row["GHICHU"]."\" "; 
                                                           echo "name=\"ghichu\" placeholder=\"\">";
                                                echo "</div>";
//                                                echo "<div class=\"form-group\">";
//                                                    echo "<label for=\"exampleInputPassword1\">Số lượng sinh viên của phòng</label>";
//                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsvcuaphong\" value=\"".$row1["total"]."\" "; 
//                                                           echo "name=\"total\" placeholder=\"\">";
//                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"iddangkytamtrult\" value=\"".$row["ID_DANGKYTAMTRULT"]."\" />";
//                                                echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row["ID_KHACH"]."\" />";
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
                                <td><?=$row["MASV"]?></td>
                                <td><?=$row["HODEM"]?> <?=' '?> <?=$row["TEN"]?></td>
                                <!--<td> </td>-->
                                <td><?=$row["NGAYSINH"]?></td>
                                
                                <td><?=$row["MALOPLT"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <td><?=$row["NGAYTAMTRU"]?></td>

                                
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <td>
                                    <?php
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhattamtrult$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvienlttamtru('".$row["ID_DANGKYTAMTRULT"]."')\">Xóa</a></button>";
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
            "sInfo": "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
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
