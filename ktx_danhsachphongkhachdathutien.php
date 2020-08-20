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
            function xoathutienphongkhach(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoathutienphongkhach.php?idthutienphongkhach="+id;
                }
            }
            function inphieu(id){
//                if(confirm('Ban co chac in khong?')){
                    window.location="thuchieninphieuthutienphongkhach.php?idthutienphongkhach="+id;
//                    window.location="thuchienxoathutienphongkhach.php?idthutienphongkhach="+id;
//                }
            }
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_danhsachphongkhachdathutien.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
    <?php  
        
        $idday=4;
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
                        <h2>In phiếu thu tiền phòng khách</h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div>
                       <form name="thutienhongkhach" action="ktx_thutienphongkhach1.php" method="post">
                           <button type="submit" class="btn btn-info"> Thu tiền phòng khách</button>
                       </form>
                   </div>
                   
                   
<!--  			<div class="panel-body">                   		  
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
                                    </div>
                                </div>
                            </div>                                   
                        </div>-->
  		</div>                   
		</div>
                </div>
              <?php
                   
                   echo "<div>"; 
                        echo "<form name=\"danhsachphongkhachdathutien\" action=\"ktx_danhsachphongkhachdathutien.php\" method=\"post\">";
                        echo "<div class=\"form-group\">";
                        
                        echo "<tr>";
                          echo "<th > Tên dãy: </th>";
                              echo "<select name=\"idday\" id=\"idday\" onchange=\"load()\">";
                                  $query_day="select ID_DAY, TENDAY from day";
                                  echo $query_day;
                                  $result_day=mysqli_query($link,$query_day);
                                  while($row_day=  mysqli_fetch_array($result_day)){
                                      echo "<option value=\"".$row_day["ID_DAY"]."\"";
                                        if($row_day["ID_DAY"]==$idday){
                                            echo " selected=\"selected\"";
                                        }
                                      echo ">";
                                      echo $row_day["TENDAY"]."</option>";
                                  }
                                echo "</select>";
                            echo "</tr>";
                      
                            $kt=1;
                            echo "<tr>";
                            echo "<th > Tên phòng: </th>";
                                echo "<select name=\"idphong\" id=\"idphong\" onchange=\"load()\">";
                                    
                                    echo "<option value=\"0\"";
                                    if($kt==1){echo " selected=\"selected\"";}
                                    echo ">Ten phong</option>";
                                    
                                    
                                    $query_phong="select ID_PHONG,ID_DAY, TENPHONG from phong where ID_DAY=$idday";
                                    //echo $query_phong;
                                    $result_phong=mysqli_query($link,$query_phong);
                                    while($row_phong=  mysqli_fetch_array($result_phong)){
                                        echo "<option value=\"".$row_phong["ID_PHONG"]."\"";
                                        if($row_phong["ID_PHONG"]==$idphong){
                                            echo " selected=\"selected\"";
                                        }
                                        echo ">";
                                        echo $row_phong["TENPHONG"]."</option>";
                                    }
                                echo "</select>";
                                
                                
                           echo "</tr>";
//                           echo "<tr>";
//                            $now = getdate(); 
//                            $ngtrathechap=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
//                            echo "<td> Ngày trả thế chấp: </td>";
////                            echo "<td>&nbsp</td> ";
//                            echo "<td width=\"60\"> <input type=\"text\" name=\"ngaytrathechap\" id=\"ngaytrathechap\" size=\"8\" maxlength=\"10\" value=\"".$ngtrathechap."\" </td>";
//                        echo "</tr>";
                        echo "</form>"; 
                        echo "</div>";
                   
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
                            <th>STT</th>
                            <th>TÊN PHÒNG</td>
                            <td>NGÀY MƯỚN</th>
                            <th>SỐ NGÀY</th>
                            <th> ĐƠN GIÁ</th>
                            <th> THÀNH TIỀN</th>
                            <th> NGÀY THU</th>
                            <th> HỌ TÊN KHÁCH</th>
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                                echo "<th>Tùy chọn</th>";
                            }
                            else if($_SESSION["quyen"]=="KTKTX")
                            {
                                echo "<th>Tùy chọn</th>";
                            }
                        ?>
                            </tr>
                          </thead>
                         <tbody>
                        <?php
                        $totalRows = 0;       
        $query ="select a.ID_THUTIENPHONGKHACH,a.ID_KHACH,a.ID_PHONG,a.NGAYMUON,a.SONGAY,a.DONGIA,a.THANHTIEN,"
                . "a.NGAYTHU,a.NGUOITHU,a.HODEM,a.TEN,c.TENPHONG from thutienphongkhach a, phong c "
                . "where a.ID_PHONG=c.ID_PHONG and a.ID_PHONG=$idphong and "
                . "a.ID_THUTIENPHONGKHACH not in (select ID_THUTIENPHONGKHACH from dsphieuthutienphongkhach where ID_THUTIENPHONGKHACH is not null)";  
        //echo $query;
        $result = mysqli_query($link,$query);  
        $totalRows=mysqli_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {
                                    $i+=1;
                                                                
                                    
                                    
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatthongtinphongkhachtra$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thu tiền phòng khách </h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhatthutienphongkhach.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"songay\">Số ngay</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"songay\" value=\"".$row["SONGAY"]."\" "; 
                                                          echo "name=\"songay\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"dongia\">Đơn giá</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"dongia\" value=\"".$row["DONGIA"]."\""; 
                                                          echo "name=\"dongia\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thanhtien\">Thành tiền</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"thanhtien\" value=\"".$row["THANHTIEN"]."\" "; 
                                                           echo "name=\"thanhtien\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythu\">Ngày thu:</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaythu\" value=\"".$row["NGAYTHU"]."\" "; 
                                                           echo "name=\"ngaythu\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<input type=\"hidden\" name=\"idthutienphongkhach\" value=\"".$row["ID_THUTIENPHONGKHACH"]."\" />";
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
                                <td><?=$row["NGAYMUON"]?></td>
                                <td> <?=$row["SONGAY"]?> </td>
                                
                                <td><?=$row["DONGIA"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["HODEM"]?> <?=$row["TEN"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                
                                    <?php
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                    echo "<td>";
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalthemkhachthuephong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Thêm</a>";
                                    //echo "<a href=\"#modalcapnhatthongtinphongkhachtra$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieu('".$row["ID_THUTIENPHONGKHACH"]."')\">In phiếu thu</a></button>";
                                    echo "<td>";
                                    }
                                    if($_SESSION["quyen"]=="KTKTX")
                                    {
                                    echo "<td>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoathutienphongkhach('".$row["ID_THUTIENPHONGKHACH"]."')\">Xóa</a></button>";
                                    echo "<td>";
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
            //clsData::footer_data();
      ?>
      <!--footer end-->
  </section>
        <?php
            clsData::footer_footer();
        ?>
  </body>
</html>
