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
            function xoasinhviennoitru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienviphamnoiquy.php?idsinhvien="+id;
                }
            }
        </script>
    <?php  
        
 
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $stSQL ="select a.ID_TIENPHONGSINHVIENLT,a.DONGIA,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU, b.MASV,b.HODEM,b.TEN,b.NGAYSINH,d.TENPHONG "
                . "from tienphongsinhvienlt a, lienthong b, dssvltnoitru c,phong d "
                . "where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_LIENTHONG=c.ID_LIENTHONG and c.ID_PHONG=d.ID_PHONG";  
        //echo $stSQL; 
        $result = mysqli_query($link,$stSQL);  
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
                        <h2>Thống kê SVLT nộp tiền phòng từ ngày - đến ngày </h2>
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
                        echo "<form name=\"thongkesinhvienlttienphongtungaydenngay\" action=\"ktx_xuatexcel_thongke_svlt_noptienphong_tungay_denngay.php\" method=\"post\">";
                        echo "<tr>";
                            echo "<td> Từ ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"tungay\" id=\"tungay\" value=\"\"> </td>";
                            echo "<td> Đến ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"denngay\" id=\"denngay\" value=\"\"> </td></br></br>";
                        echo "</tr>";
                        echo "<button type=\"submit\" class=\"btn btn-info\"> In bảng kê</button>";
                        echo "</form>";   
                        echo "</div>"; 
                       ?>
                    
                    <div class="form-group">
                        <form role="form" action="ktx_thutienphongsinhvienlt.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">Thu tiền phòng SVLT</button>
                        </form>     
                    </div>   
                    
                </div>
                </div>
                             
                
               <div class="row">                  
               <div class="col-lg-10">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                                <th width="3%">STT</th>
                                <th width="8%">MÃ SVLT</th>
                                <th width="18%">HỌ VÀ TÊN</th>
                                <!--<td>TÊN</td>-->
                                <th width="12%">NGÀY SINH</th>
                                <th width="5%">TÊN PHÒNG</th>
                                <th width="5%">ĐƠN GIÁ</th>
                                <th width="12%">NGÀY THU</th>
<!--                                <td>SỐ THÁNG</td>
                                <td>THÀNH TIỀN</td>-->
                                <th width="15%">NGƯỜI THU</th>
                                
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
                                    
                                    
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatthongtinsvltnoptienphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật sinh viên vi phạm</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhatsinhvienvipham.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_phong["TENPHONG"]."\" "; 
                                                           echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"idday\">ID_DAY</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngayvipham\">Ngày vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngayvipham\" value=\"".$row["NGAYVIPHAM"]."\" "; 
                                                          echo "name=\"ngayvipham\" placeholder=\"Nhập ngày vi phạm\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"hinhthucvipham\">Hình thức vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hinhthucvipham\" value=\"".$row["HINHTHUCVIPHAM"]."\" "; 
                                                          echo "name=\"hinhthucvipham\" placeholder=\"Hình thức vi phạm\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idthutienphongsinhvien\" value=\"".$row["ID_THUTIENPHONGSINHVIEN"]."\" />";
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
                                <td><?=$row["MASV"]?></td>
                                <td><?=$row["HODEM"]?><?=" "?><?=$row["TEN"]?></td>
                                <!--<td>  </td>-->
                                <td><?=$row["NGAYSINH"]?></td>
                                
                                <td><?=$row["TENPHONG"]?></td>
                                
                                <td><?=$row["DONGIA"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
<!--                              
                                <td><?=$row["THANHTIEN"]?></td>-->
                                <td><?=$row["NGUOITHU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                    <?php
                                    echo "<td>";
                                    if($_SESSION["quyen"]=="QT")
                                    {

                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhatthongtinsvltnoptienphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvienltdongtienphong('".$row["ID_TIENPHONGSINHVIENLT"]."')\">Xóa</a></button>";
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

