<?php
    include 'ClassData.php';
    clsData::welcometowork();
    include 'dbcon.php';  
    $link= clsConnet::DBConnect();
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
            function xoataisan(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoataisan.php?idtaisan="+id;
                }
            }
    </script>
    <?php  

        $totalRows_taisan = 0;       
        $stSQL_taisan ="select * from taisan";  
        $result_taisan = mysql_query($stSQL_taisan, $link);  
        $totalRows_taisan=mysql_num_rows($result_taisan); 
       
        
       
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
               <!--<div class="row">-->
               <!--<div class="col-lg-12 selecthk">-->
               <!--<div class="panel panel-default">-->
                    <header class="panel-heading">
                        <h2> Thêm tài sản vào danh sách </h2>
                            <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                                <a class="icon-remove" href="javascript:;"></a>
                            </span>
                    </header>
                    <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
  		<!--</div>-->
<!--                    </div>                    
                </div>-->
<!--               <div class="row">                  
               <div class="col-lg-12">
               <div class="panel">
  		<div class="panel-body">-->
                <div class="adv-table editable-table ">
                        
                    
                       <div class="panel-body">   
                           <?php
                            if($_SESSION["quyen"]=="QT")
                        {
                                ?>
                            
                            <button class="btn btn-info" data-toggle="modal" href="##modalupexcel" ><i class="icon-cloud-upload"></i> Thêm tài sản</button>
                             <?php
                            }
                            ?>
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm tài sản</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="thuchienthemtaisan.php" method="post">
                                                <div class="form-group">
                                                    <label for="mataisan">Mã tài sản</label>
                                                    <input type="text" class="form-control" id="mataisan" 
                                                           name="mataisan" placeholder="Nhập mã tài sản">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tentaisan">Tên tài sản</label>
                                                    <input type="text" class="form-control" id="tentaisan" 
                                                           name="tentaisan" placeholder="Nhập tên tài sản">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kieumau">Kiểu mẫu</label>
                                                    <input type="text" class="form-control" id="kieumau" 
                                                           name="kieumau" placeholder="Nhập kiểu mẫu">
                                                </div>
                                                <div class="form-group">
                                                    <label for="namsanxuat">Năm sản xuất</label>
                                                    <input type="text" class="form-control" id="namsanxuat" 
                                                           name="namsanxuat" placeholder="Nhập năm sản xuất">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nuocsanxuat">Nước sản xuất</label>
                                                    <input type="text" class="form-control" id="nuocsanxuat" 
                                                           name="nuocsanxuat" placeholder="Nhập nước sản xuất">
                                                </div>
                                                <div class="form-group">
                                                    <label for="donvitinh">Đơn vị tính</label>
                                                    <input type="text" class="form-control" id="donvitinh" 
                                                           name="donvitinh" placeholder="Nhập Đơn vị tính">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ghichu">Ghi chú</label>
                                                    <input type="text" class="form-control" id="ghichu" 
                                                           name="ghichu" placeholder="Nhập Ghi chú">
                                                </div>
                                                
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
                    <?php
                    echo "<div>";
                        echo "<form name=\"danhmuctaisan\" action=\"ktx_danhmuctaisan.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Danh mục tài sản </button>";
                        echo "</form>";
                    echo "</div>";

                    ?>
                    
                    <div class="row">                  
               <div class="col-lg-9">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                        <table class="table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:20px">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã TS</th>
                                    <th>Tên tài sản</th>
                                    <th>Kiểu mẫu</th>
                                    <th>Năm SX</th>
                                    <th>Nước SX</th>
                                    <th>ĐV tính</th>
                                    <?php
                            if($_SESSION["quyen"]=="QT")
                        {
                               
                                    echo "<th>Tùy chọn</th>";
                        }
                        ?>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              
                                    if($totalRows_taisan>0)   
                                    {    
                                        $i=0;                    
                                        while ($row_taisan = mysql_fetch_array ($result_taisan))     
                                        {   
                                            $i+=1;
                                            
                                            //Cập nhật sinh viên
                            echo "<div class=\"modal fade\" id=\"modalcapnhattaisan$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật tài sản</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhattaisan.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"mataisan\">Mã tài sản</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"mataisan\" value=\"".$row_taisan["MATAISAN"]."\""; 
                                                          echo "name=\"mataisan\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tentaisan\">Tên tài sản</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tentaisan\" value=\"".$row_taisan["TENTAISAN"]."\" "; 
                                                          echo "name=\"tentaisan\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"kieumau\">Kiểu mẫu</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"kieumau\" value=\"".$row_taisan["KIEUMAU"]."\" "; 
                                                           echo "name=\"kieumau\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"namsanxuat\">Năm san xuất</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"namsanxuat\" value=\"".$row_taisan["NAMSANXUAT"]."\" "; 
                                                           echo "name=\"namsanxuat\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nuocsanxuat\">Nước san xuất</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nuocsanxuat\" value=\"".$row_taisan["NUOCSANXUAT"]."\" "; 
                                                           echo "name=\"nuocsanxuat\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"donvitinh\">Đơn vị tính</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"donvitinh\" value=\"".$row_taisan["DONVITINH"]."\" "; 
                                                           echo "name=\"donvitinh\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idtaisan\" value=\"".$row_taisan["ID_TAISAN"]."\" />";
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
                              
                              <tr class="">
                                  <td><?=$i?></td>
                                  <td><?=$row_taisan["MATAISAN"]?></td>
                                  <td><?=$row_taisan["TENTAISAN"]?></td>
                                  <td><?=$row_taisan["KIEUMAU"]?></td>
                                  <td><?=$row_taisan["NAMSANXUAT"]?></td>
                                  <td><?=$row_taisan["NUOCSANXUAT"]?></td>
                                  <td><?=$row_taisan["DONVITINH"]?></td>
                        <?php
                        if($_SESSION["quyen"]=="QT")
                        {
                                  echo "<td>";
                                   
                                        echo "<a href=\"#modalcapnhattaisan$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                        //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoataisan('".$row_taisan["ID_TAISAN"]."')\">Xóa</a></button>";
                                  echo "</td>";
                        }
                        
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
      <?php
            clsData::footer_data();
      ?>
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
