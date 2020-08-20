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
     <?php
    clsData::header_header();
    ?>
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
       
        
        $totalRows = 0;       
        $query="select a.ID_THUTIENDIENNUOC,a.ID_PHONG, a.ID_SINHVIEN,b.TENPHONG, a.GIADIEN,a.CSDIENCU,a.CSDIENMOI,a.GIANUOC,a.CSNUOCCU,a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.THANGNOP,a.NGUOITHU,c.HODEM,c.TEN from "
                . " thutiendiennuoc a, phong b,sinhvien c where a.ID_PHONG=b.ID_PHONG and a.ID_SINHVIEN=c.ID_SINHVIEN";  
        //echo $query;
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
                        <h2> Danh sách sinh viên nộp tiền điện nước theo tháng năm và dãy phòng</h2>    
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
                    echo "<div>"; 
                    echo "<form name=\"xuatexcelthutiendiennuocthangnamday\" action=\"ktx_xuatexcel_bangkethutiendien_thangnamday.php\" method=\"post\">";
                                               
                        
                        echo "<tr>";
                            echo "<td> Nhập tháng: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"thang\" id=\"thang\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Nhập năm: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"nam\" id=\"nam\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Nhập dãy: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"day\" id=\"day\" value=\"\" </td>";
                        echo "</tr>";
                       echo "<div class=\"form-group\">";
                  echo "</div>";
                        echo "<button type=\"submit\" class=\"btn btn-info\">In bảng kê thu tiền điện nước theo tháng- năm- dãy phòng</button>";
                   echo "</form>";    
                   echo "</div>";
                  echo "</div>";
                  
                   
                    
                           echo "<div class=\"form-group\">";
                        echo "<form name=\"form\" action=\"ktx_thudiennuoc.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Thu tiền điện nước </button>";
                        echo "</form>";  
                           ?>

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
                            <!--<td>STT</td>-->
                            <th> TÊN PHÒNG</th>
                            <th> GIÁ ĐIỆN</th>
                            <th> CSĐ CŨ</th>
                            <th> CSĐ MỚI </th>
                            <th> GIÁ NƯỚC</th>
                            <th> CSN CŨ</th>
                            <th> CSN MỚI </th>
                            <th> THÀNH TIỀN</th>
                            <th> THÁNG NỘP</th>
                            <th> NGÀY THU </th>
                            <th>NGƯỜI THU</th>
                            <th>NGƯỜI NỘP</th>
                            
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
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                             $i+=1;
           
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
//                                                echo "<div class=\"form-group\">";
//                                                    echo "<label for=\"nguoinop\">Người nộp</label>";
//                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguonop\" value=\"".$row["NGUOINOP"]."\" "; 
//                                                          echo "name=\"nguoinop\" placeholder=\"\">";
//                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idthudiennuoc\" value=\"".$row["ID_THUTIENDIENNUOC"]."\" />";
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
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["THANGNOP"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <td><?=$row["HODEM"]?> <?=$row["TEN"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                    <?php
                                    echo "<td>";
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalthongtinphongdiennuoc$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoaphongthudiennuoc('".$row["ID_THUTIENDIENNUOC"]."')\">Xóa</a></button>";
                                   
                                    }

                                    echo "</td>";
                                    ?>
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
