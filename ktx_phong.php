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
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }
        </script>
    <?php  
        $totalRows_phong = 0;       
        $stSQL_phong ="select * from phong";  
        $result_phong = mysqli_query($link,$stSQL_phong);  
        $totalRows_phong=mysqli_num_rows($result_phong); 
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
                        <h2> Quản lý phòng ký túc xá </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
					<div class="panel-body">       
                        <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                        ?>
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Thêm phòng </button>
                             
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                     
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm phòng vào danh sách</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="thuchienthemphong.php" method="post">
                                                <div class="form-group">
                                                    <label for="idday">ID_DAY</label>
                                                    <input type="text" class="form-control" id="idday" 
                                                           name="idday" size="1" maxlength="1" placeholder="Nhập id_day">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tenphong">Tên phòng</label>
                                                    <input type="text" class="form-control" id="tenphong" 
                                                           name="tenphong" size="4" maxlength="4" placeholder="Nhập tên phòng">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1"> Sức chứa của phòng </label>
                                                    <input type="number" class="form-control" id="soluongsv" 
                                                           name="succhua" value="8" >
                                                </div>
                                                <button type="submit" class="btn btn-info">Thêm</button>
                                            </form>                                               
                                            <!--End of Success-->             
                                        </div> <!--End of ModalBody-->
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                    </div>
                                    <?php
                            }
                            ?>
                            </div>
                        </div>                                   
                    </div>
				</div>                   
				</div>
                </div>
				<div class="row">                  
				<div class="col-lg-8">
				<div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <td width="5%">STT</td>
                            <td width="5%">MÃ PHÒNG </td>
                            <td width="5%">DÃY </td>
                            <td width="10%">TÊN PHÒNG</td>
                            <td width="10%">SỨC CHỨA</td>
                            <td width="10%">SL SV CỦA PHÒNG</td>
                            <td>Tùy chọn</td>
                            
                            </tr>
                          </thead>
                         <tbody>
                        <?php
                            if($totalRows_phong>0)   
                            {    
                                $i=0;                    
                                while ($row_phong = mysqli_fetch_array ($result_phong))     
                                {
                                    $i+=1;
                                    if($row_phong["ID_DAY"]==4)        
                                    {        
                                        $stSQL_slkhach ="select count(ID_KHACH) as total from dskhachnoitru where ID_PHONG='".$row_phong["ID_PHONG"]."'";  
                                        $result_slkhach = mysqli_query($link,$stSQL_slkhach);
                                        $row_slkhach = mysqli_fetch_array ($result_slkhach);
                             
                           
                                        $stSQL_day="select * from day where ID_DAY='".$row_phong["ID_DAY"]."'";
                                        $result_day = mysqli_query($link,$stSQL_day);
                                        $row_day = mysqli_fetch_array ($result_day);
                            
                            //Cập nhật khách
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
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row_phong["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_phong["TENPHONG"]."\" "; 
                                                          echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng khách lớn nhất</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsv\" value=\"".$row_phong["SUCCHUA"]."\" "; 
                                                           echo "name=\"succhua\" placeholder=\"Nhập số lượng khách lớn nhất\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng khách hiện tại của phòng</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsvcuaphong\" value=\"".$row_slkhach["total"]."\" "; 
                                                           echo "name=\"total\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row_phong["ID_PHONG"]."\" />";
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
                                <td><?=$row_phong["ID_PHONG"]?></td>
                                <td><?=$row_day["TENDAY"]?></td>
                                <td> <?=$row_phong["TENPHONG"]?> </td>
                                <td><?=$row_phong["SUCCHUA"]?></td>
                                <td><span class="badge bg-important"><?=$row_slkhach["total"]?></span></td>
                                    <?php
                                    echo "<td>";
                                    echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    if($_SESSION["quyen"]=="QT"){
                                    echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoa('".$row_phong["ID_PHONG"]."')\">Xóa</a></button>";
                                    }
                                  ?>
                                </td>
                        </tr>  
                        <?php  
                            }
                            else 
                            {
                                $stSQL_slsinhvien ="select count(a.ID_SINHVIEN) as total from danhsachnoitru a,sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN and ID_PHONG='".$row_phong["ID_PHONG"]."'";  
                                $result_slsinhvien = mysqli_query($link,$stSQL_slsinhvien);
                                $row_slsinhvien = mysqli_fetch_array ($result_slsinhvien);
                                
                                $stSQL_slsinhvien2017 ="select count(a.ID_SINHVIEN) as total from danhsachnoitrum a,dshssv b where a.ID_SINHVIEN=b.ID_DSHSSV and ID_PHONG='".$row_phong["ID_PHONG"]."'";  
                                $result_slsinhvien2017 = mysqli_query($link,$stSQL_slsinhvien2017);
                                $row_slsinhvien2017 = mysqli_fetch_array ($result_slsinhvien2017);
                                
                                $stSQL_slsinhvienlt ="select count(a.ID_LIENTHONG) as total from dssvltnoitru a,lienthong b where a.ID_LIENTHONG=b.ID_LIENTHONG and ID_PHONG='".$row_phong["ID_PHONG"]."'";  
                                $result_slsinhvienlt = mysqli_query($link,$stSQL_slsinhvienlt);
                                $row_slsinhvienlt = mysqli_fetch_array ($result_slsinhvienlt);
                             
                           
                            $stSQL_day="select * from day where ID_DAY='".$row_phong["ID_DAY"]."'";
                            $result_day = mysqli_query($link,$stSQL_day);
                            $row_day = mysqli_fetch_array ($result_day);
                            
                            //Cập nhật sinh viên
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
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row_phong["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_phong["TENPHONG"]."\" "; 
                                                          echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng SV lớn nhất</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsv\" value=\"".$row_phong["SUCCHUA"]."\" "; 
                                                           echo "name=\"succhua\" placeholder=\"Nhập số lượng SV lớn nhất\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng sinh viên hiện tại của phòng</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsvcuaphong\" value=\"".$row_slsinhvien["total"]."\" "; 
                                                           echo "name=\"total\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row_phong["ID_PHONG"]."\" />";
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
                                <td><?=$row_phong["ID_PHONG"]?></td>
                                <td><?=$row_day["TENDAY"]?></td>
                                <td> <?=$row_phong["TENPHONG"]?> </td>
                                <td><?=$row_phong["SUCCHUA"]?></td>
                                
								<td><span class="badge bg-important"><?=$row_slsinhvien["total"]+$row_slsinhvienlt["total"]+$row_slsinhvien2017["total"]?></span></td>
                                
                                    <?php
                                    echo "<td>";
                                    echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                    
                                    echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoa('".$row_phong["ID_PHONG"]."')\">Xóa</a></button>";
                                    echo "</td>";
                                    }
                                    ?>
                            </tr>  
                        <?php 
                                }
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
            //clsData::footer_data();
      ?>
      <!--footer end-->
  </section>
    <?php
            clsData::footer_footer();
      ?>

  </body>
  </body>
</html>
