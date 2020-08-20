<?php
    include 'ClassData.php';
    clsData::welcometowork();
    require("dbcon.php");  
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
            function xoatrangbi(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoatrangbi.php?idtrangbi="+id;
                }
            }
        </script>
      
    <?php  
        
        $totalRows_trangbi = 0;       
        $stSQL_trangbi ="select * from trangbi";  
        $result_trangbi = mysql_query($stSQL_trangbi, $link);  
        $totalRows_trangbi=mysql_num_rows($result_trangbi); 
//        $tenphong='';
//        if(isset($_POST["tenphong"])){
//            $tenphong = $_POST["tenphong"];
//        }
//        else {
//            echo " ";
//        }
//        $mataisan='';
//        if(isset($_POST["mataisan"])){
//            $mataisan = $_POST["mataisan"];
//        }
//        else {
//            echo " ";
//        }
//        $soluong=0;
//        if(isset($_POST["soluong"])){
//            $soluong = $_POST["soluong"];
//        }
//        else {
//            echo " ";
//        }
//    $ntb=$_POST["ngaytrangbi"];
//if($ntb != "")
//{
//    if(isset($_POST["ngaytrangbi"]))
//    {
//                $dtb=$_POST["ngaytrangbi"];
//                $d=explode("/", $dtb);
//                $ngaytrangbi=$d[2]."-".$d[1]."-".$d[0];//echo $ngayviphamnoiquy;
//
//                $query="insert into trangbi(TENPHONG,MATAISAN,SOLUONG,NGAYTRANGBI) "
//                        . "Values('$tenphong','$mataisan',$soluong,'$ngaytrangbi')";
//                //echo $query;
//                mysql_query($query, $link);
//    }
//}
//    else {
//     
//        echo "<script>";
//                    //echo "alert(str);"; 
//                    echo "alert('Chưa nhập ngày trang bị.');";
//                    echo "</script>";
//    }
//            
//            
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
                        <h2> Trang bị tài sản cho phòng  </h2>
                            <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                                <a class="icon-remove" href="javascript:;"></a>
                            </span>
                    </header>
                    <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i>Trở về</a>                              
                    </div>
  		</div>
                </div>                    
                </div>
                
                <?php
                     
                    echo "<div>"; 
                        echo "<form name=\"thuchientrangbi\" action=\"thuchientrangbi.php\" method=\"post\">";
                            echo "<div class=\"form-group\">";
                            echo "<tr>";
                            echo "<th > Tên phòng: </th>";
                                echo "<select name=\"tenphong\" id=\"tenphong\" >";
                                    $query_phong="select TENPHONG from phong";// where LEFT(MALOPCHUYENNGANH,1)='".$kt."'";
                                    $result_phong=mysql_query($query_phong, $link);
                                    while($row_phong=  mysql_fetch_array($result_phong)){
                                        echo "<option value=\"".$row_phong["TENPHONG"]."\"";
                                            echo " selected=\"selected\"";
                                echo ">";
                                  echo $row_phong["TENPHONG"]."</option>";
                                }
                                echo "</select>";
                            echo "</tr>";
                            
                            echo "<td width=\"400\"> Mã tài sản: </td>";
                                echo "<select name=\"mataisan\" id=\"mataisan\" >";
                                $query_ts="select MATAISAN from taisan";// where LEFT(MALOPCHUYENNGANH,1)='".$kt."'";
                                $result_ts=mysql_query($query_ts, $link);
                                while($row_ts=  mysql_fetch_array($result_ts)){
                                    echo "<option value=\"".$row_ts["MATAISAN"]."\"";
                                    echo " selected=\"selected\"";
                                    echo ">";
                                    echo $row_ts["MATAISAN"]."</option>";
                                }
                            echo "</select>";
                            
                            echo "</tr>";
    
                            echo "<tr>";
                                echo "<td> Số lượng: </td>";
                                echo "<td>&nbsp</td> ";
                                echo "<td width=\"60\"> <input type=\"text\" name=\"soluong\" id=\"soluong\" size=\"1\" maxlength=\"2\" value=\"1\" </td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td> Ngày trang bị: </td>";
                                echo "<td> <input type=\"text\" name=\"ngaytrangbi\" id=\"ngaytrangbi\" size=\"10\" maxlength=\"10\" value=\"\" </td>";
                            echo "</tr>";

                            echo "</div>";
                            if($_SESSION["quyen"]=="QT")
                        {

                            echo "<button type=\"submit\" class=\"btn btn-info\">Thực hiện trang bị tài sản</button>";
                        }
                        echo "</form>"; 
                    echo "</div>"; 
                ?>
                <div class="row">                  
                <div class="col-lg-8">
                <div class="panel">
  		<div class="panel-body">
                <div class="adv-table editable-table ">
                        <!--  
                        <div class="clearfix">
                              <div class="btn-group">
                                  <button id="editable-sample_new" class="btn btn-success">
                                      <i class="icon-plus"></i> Thêm sinh viên
                                  </button>
                              </div>                              
                          </div>
                         -->   
                    
<!--                        <div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="##modalupexcel" ><i class="icon-cloud-upload"></i> Thực hiện trang bị tài sản </button>
                             
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Trang bị tài sản</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="thuchientrangbi.php" method="post">
                                                <div class="form-group">
                                                    <label for="tenphong">Tên phòng</label>
                                                    <input type="text" class="form-control" id="tenphong" 
                                                           name="tenphong" placeholder="Nhập tên phòng">
                                                </div>
                                                <div class="form-group">
                                                    <label for="mataisan">Mã tài sản</label>
                                                    <input type="text" class="form-control" id="mataisan" 
                                                           name="mataisan" placeholder="Nhập mã tài sản">
                                                </div>
                                                <div class="form-group">
                                                    <label for="soluong">Số lượng</label>
                                                    <input type="number" class="form-control" id="soluong" 
                                                           name="soluong" placeholder="Nhập số lượng tài sản">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ngaytrangbi">Ngày trang bị</label>
                                                    <input type="text" class="form-control" id="ngaytrangbi" 
                                                           name="ngaytrangbi" placeholder="">
                                                </div>

                                                <button type="submit" class="btn btn-info">Thêm</button>
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
                    
                    
                    
                        <table class="table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:20px">
                              <thead>
                              <tr>
                                    <th>STT</th>
                                    <th>Tên phòng</th>
                                    <th>Mã tài sản</th>
                                    <th>Số lượng</th>
                                    <th>Ngày trang bị</th>
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
                                    if($totalRows_trangbi>0)   
                                    {    
                                        $i=0;                    
                                        while ($row_trangbi = mysql_fetch_array ($result_trangbi))     
                                        {   
                                            $i+=1;
                                            //Cập nhật khách
                            echo "<div class=\"modal fade\" id=\"modalcapnhattrangbi$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật trang bi</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhattrangbi.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_trangbi["TENPHONG"]."\""; 
                                                          echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"mataisan\">Mã tài sản</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"mataisan\" value=\"".$row_trangbi["MATAISAN"]."\" "; 
                                                          echo "name=\"mataisan\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"soluong\">Số lượng tài sản</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluong\" value=\"".$row_trangbi["SOLUONG"]."\" "; 
                                                           echo "name=\"soluong\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaytrangbi\">Ngày trang bị</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaytrangbi\" value=\"".$row_trangbi["NGAYTRANGBI"]."\" "; 
                                                           echo "name=\"ngaytrangbi\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idtrangbi\" value=\"".$row_trangbi["ID_TRANGBI"]."\" />";
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
                                  <td><?=$row_trangbi["TENPHONG"]?></td>
                                  <td><?=$row_trangbi["MATAISAN"]?></td>
                                  <td><?=$row_trangbi["SOLUONG"]?></td>
                                  <td><?=$row_trangbi["NGAYTRANGBI"]?></td>
                                  <?php
                        if($_SESSION["quyen"]=="QT")
                        {
                                  echo "<td>";
                                   //echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhattrangbi$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoatrangbi('".$row_trangbi["ID_TRANGBI"]."')\">Xóa</a></button>";
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
