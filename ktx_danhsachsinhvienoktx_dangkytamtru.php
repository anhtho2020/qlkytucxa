<?php
    session_start();
    if(!isset($_SESSION["quyen"]) || ($_SESSION["quyen"]!="QT" && $_SESSION["quyen"]!="KTKTX" && $_SESSION["quyen"]!="CTCTHT")){
        echo "<script>";
        echo "alert('Ban khong co quyen quan tri');";
        echo "window.location=\"index.php\";";
        echo "</script>";
    }
    include 'ClassData.php';
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
            function xoasinhvientamtru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvientamtru.php?idsinhvien="+id;
                }
            }
        </script>
    <?php  
        
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $query ="select a.ID_DANHSACHNOITRU,a.ID_SINHVIEN,a.NGAYNOITRU,c.ID_PHONG,b.MASV, b.HODEM,b.TEN, b.NGAYSINH,b.CMND,b.DIACHI,c.TENPHONG,"
                . " b.GHICHU "
                . "from danhsachnoitru a, sinhvien b, phong c  "
                . "where  (a.ID_SINHVIEN=b.ID_SINHVIEN) and (a.ID_PHONG=c.ID_PHONG)";
                //. "(c.ID_LOPCHUYENNGANH=e.ID_LOPCHUYENNGANH)";  
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
                        <h2> Danh sách sinh viên đăng ký tạm trú </h2>
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
                        //echo "<form name=\"danhsachsinhvienoktxdangkytamtru\" action=\"ktx_xuatexcel_danhsachsinhvienoktx_dangkytamtru.php\" method=\"post\">";
//                      echo "<div class=\"form-group\">";    
                        echo "<form name=\"thongketienphongsinhvientungaydenngay\" action=\"ktx_xuatexcel_danhsachsinhvienoktx_dangkytamtru.php\" method=\"post\">";
                        
                        echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách </button>";
                        echo "</form>";   
                        echo "</div>"; 
                        
//                        echo "<div>";
//                        echo "<form name=\"danhsachtamtrult\" action=\"ktx_danhsachsinhvienltdangkytamtru.php\" method=\"post\">";
//                            echo "<button type=\"submit\" class=\"btn btn-info\"> Danh sách SVLT tam tru </button>";
//                        echo "</form>";
//                        echo "</div>";
                        
                        echo "<div class=\"form-group\">";    
                        echo "<form name=\"danhsachsinhvienoktxdangkytamtru\" action=\"ktx_dangkytamtru.php\" method=\"post\">";
//                        echo "<input type=\"submit\" class=\"btn btn-info\" value=\"Đăng ký tạm trú\">";
                        echo "<button type=\"submit\" class=\"btn btn-info\"> Đăng ký tạm trú </button>";
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
                                <th>MÃ HSSV</th>
                                <th width="18%">HỌ VÀ TÊN</th>
                                <!--<th>TÊN</th>-->
                                <th>NGÀY SINH</th>
                                <!--<th>CMND</th>-->
                                
                                <th> PHÒNG </th>
                                <th>NGÀY NT</th>
                                
                                <!--<td>GHI CHÚ</td>-->
                                
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
                           echo "<div class=\"modal fade\" id=\"modalcapnhatthongtintamtru$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin sv đăng ký tam trú</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhattamtru.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"masv\">MASV</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MASV"]."\""; 
                                                          echo "name=\"masv\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaytamtru\">Ngày đăng tạm trú</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaytamtru\" value=\"".$row["NGAYTAMTRU"]."\" "; 
                                                          echo "name=\"ngaytamtru\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ghichu\">Ghi chú</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ghichu\" value=\"".$row["GHICHU"]."\" "; 
                                                          echo "name=\"ghichu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"masv\" value=\"".$row["MASV"]."\" />";
                                                echo "<input type=\"hidden\" name=\"iddangkytamtru\" value=\"".$row["ID_DANGKYTAMTRU"]."\" />";
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
                                
                                
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                

                                
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                          //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhatthongtintamtru$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvientamtru('".$row["ID_SINHVIEN"]."')\">Xóa</a></button>";
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
<?php
      clsData::footer_footer();
?>
  </body>
</html>
