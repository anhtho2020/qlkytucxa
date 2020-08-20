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
            function xoathechap(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoathechap.php?idthechap="+id;
                }
            }
        </script>
    <?php  
        include 'ClassData.php';
        include 'dbcon.php';
//    ob_end_clean();
//    ob_start();
    $link=  clsConnet::DBConnect();
        
        $totalRows = 0;       
        $query ="select a.ID_THECHAP,a.ID_SINHVIEN,a.SOTIEN,a.NGAYTHECHAP,a.SOTIEN,a.NGUOITHU,"
                . " b.MAHSSV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI from thechap2017 a, dshssv b "
                . "where a.ID_SINHVIEN=b.ID_DSHSSV ";  
        $result = mysqli_query($link,$query);  
        $totalRows=mysqli_num_rows($result); 
    
        
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
                        <h2> XUẤT PHIẾU THU THẾ THẤP TỪ 2017 </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   
                     <?php
                            
                        echo "<div>";                 
                        echo "<div class=\"form-group\">";    
                        echo "<form name=\"thuthechap\" action=\"ktx_xuatexcelphieuthuthechap2017.php\" method=\"post\">";
                        echo "<tr>";
                            echo "<td> Nhập MASV cần in: </td>";
                            echo "<td> <input type=\"text\" name=\"masv\" id=\"masv\" value=\"\"> </td>";
                            //echo "<td> Nhập ngày thế chấp: </td>";
                            //echo "<td> <input type=\"date\" name=\"ngaythechap\" id=\"ngaythechap\" value=\"\"> </td></br></br>";
                        echo "<input type=\"submit\" class=\"btn btn-info\" value=\"Xuất ra excel_ Phiếu thu tiền thế chấp\">";
                        echo "</form>";   
                        echo "</div>"; 
                        echo "</div>"
                       ?>
                    
                    <div class="form-group">
                        <form role="form" action="ktx_thechap2017.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">Thu tiền thê chấp</button>
                        </form>     
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
                                <td>MÃ SINH VIÊN</td>
                                <td>HỌ ĐỆM</td>
                                <td>TÊN</td>
                                <td>NGÀY SINH</td>
                                <td>PHÁI</td>
                                <td>TIỀN THẾ CHẤP</td>
                                <td>NGÀY THẾ CHẤP</td>
                                
                                
                                <?php
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                        echo "<th>TÙY CHỌN</th>";
                                    }
                                ?>
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
                           
 
//                                    
                                    echo "<div class=\"modal fade\" id=\"modalsuathuthechap$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thu thế chấp</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinthechap2017.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"mahssv\">Mã HSSV</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"mahssv\" value=\"".$row["MAHSSV"]."\" "; 
                                                           echo "name=\"mahssv\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"sotien\"> Số tiền</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"sotien\" value=\"".$row["SOTIEN"]."\" "; 
                                                          echo "name=\"sotien\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythechap\"> Ngày thế chấp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaythechap\" value=\"".$row["NGAYTHECHAP"]."\" "; 
                                                          echo "name=\"ngaythechap\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nguoithu\"> Ngày thế chấp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
                                                          echo "name=\"nguoithu\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<input type=\"hidden\" name=\"idthechap\" value=\"".$row["ID_THECHAP"]."\" />";
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
                                <!--<td><input type="checkbox" name="chk[]" value="<?=$row["ID_SINHVIEN"]?>"></td>-->
                                <td><?=$i?></td>
                                <td><?=$row["MAHSSV"]?></td>
                                <td><?=$row["HODEM"]?></td>
                                <td><?=$row["TEN"]?> </td>
                                <td><?=$row["NGAYSINH"]?></td>
                                <?php
                                if($row["PHAI"]==0)
                                    {
                                        echo "<td>"; echo "Nam" ; echo "</td>";
                                    }
                                    else {
                                        echo "<td>"; echo "Nữ" ; echo "</td>";
                                    }
                                ?>
                                
                                <td><?=$row["SOTIEN"]?></td>
                                <td><?=$row["NGAYTHECHAP"]?></td>
                                
                                
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                            
                                    echo "<td>";
                                    
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalsuathuthechap$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoathechap('".$row["ID_THECHAP"]."')\">Xóa</a></button>";
                                    /* <!--<div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs" type="button">In biểu mẫu <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                           <li><a href="#">Danh sách SV</a></li>
                                           <li><a href="#">Danh sách CSVC</a></li>
                                        </ul>
                                    </div><!-- /btn-group -->*/
                                    echo "</td>";
                                }
                                ?>
                                
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
      <!--footer start
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
