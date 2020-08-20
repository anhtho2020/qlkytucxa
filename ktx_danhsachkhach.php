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
            function xoakhach(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoakhach.php?idkhach="+id;
                }
            }
        </script>
    <?php  
       $totalRows = 0;       
        $query ="select * from khach";  
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
               <!--<div class="row">-->
               <!--<div class="col-lg-12 selecthk">-->
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Danh sách khách đặt phòng </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
<!--                    <div class="modal-body">
                        <form role="form" action="ktx_xuatexceldanhsachsinhviennoitru.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">In danh sách sinh viên nội trú</button>
                        </form>                                               
                    </div> End of ModalBody
                    <div class="modal-body">
                        <form role="form" action="ktx_sinhviennoitru.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">Thêm sinh viên nội trú</button>
                        </form>                                               
                    </div> End of ModalBody-->
                    <?php
                    echo "<div>";
                        echo "<form name=\"xuatexceldanhsachkhachdatphong\" action=\"ktx_xuatexceldanhsachkhachdatphong.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách ra định dạng excel </button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<div class=\"modal-body\">";
                    echo "<div>";
                    echo "<div>";
                        echo "<form name=\"themkhach\" action=\"ktx_khach.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Thêm khách đặt phòng </button>";
                        echo "</form>";
                    echo "</div>";
                    ?>
                    
<!--  			<div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Thêm sinh viên </button>
 
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm sinh viên nội trú</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="ktx_sinhviennoitru.php" >
                                                <button type="submit" class="btn btn-info">Mở trang thêm sinh viên nội trú</button>
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
		<!--</div>-->
                <!--</div>-->
               <!--<div class="row">-->                  
               <div class="col-lg-12">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                                  <th>STT</th>
                                  <th>MÃ KHÁCH</th>
                                  <th> HỌ VÀ TÊN </th>
                                  <!--<th>Tên</th>-->
                                  <th>PHÁI</th>
                                  <th> NGÀY SINH</th>
                                  <th>CMND</th>
                                  <th>ĐỊA CHỈ</th>
                                  
                                  <th>ĐIỆN THOẠI</th>
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
                                            
                                            echo "<div class=\"modal fade\" id=\"modalcapnhatkhach$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                               echo "<div class=\"modal-dialog\">";
                                                    echo "<div class=\"modal-content\">";
                                                      echo "<div class=\"modal-header\">";
                                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin khách</h4>";
                                                        echo "</div>";
                                                        echo "<div class=\"modal-body\">";
                                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinkhach.php\" method=\"post\">";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"makhach\">Mã khách</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"makhach\" value=\"".$row["MAKHACH"]."\""; 
                                                                          echo "name=\"makhach\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"hodem\">Họ đệm</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row["HODEM"]."\" "; 
                                                                          echo "name=\"hodem\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ten\">Tên khách </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row["TEN"]."\" "; 
                                                                           echo "name=\"ten\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"phai\">Phái</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row["PHAI"]."\" "; 
                                                                           echo "name=\"phai\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ngaysinh\">Ngày sinh</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row["NGAYSINH"]."\" "; 
                                                                           echo "name=\"ngaysinh\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"cmnd\">CMND</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"cmnd\" value=\"".$row["CMND"]."\" "; 
                                                                           echo "name=\"cmnd\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"noisinh\">Nơi sinh</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"noisinh\" value=\"".$row_khach["NOISINH"]."\" "; 
//                                                                           echo "name=\"noisinh\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"diachi\">Địa chỉ</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"diachi\" value=\"".$row["DIACHI"]."\" "; 
                                                                           echo "name=\"diachi\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"email\">EMAIL</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"email\" value=\"".$row_khach["EMAIL"]."\" "; 
//                                                                           echo "name=\"email\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"dienthoai\">Điện thoại</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"dienthoai\" value=\"".$row["DIENTHOAI"]."\" "; 
                                                                           echo "name=\"dienthoai\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row["ID_KHACH"]."\" />";
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
                                <td><?=$row["MAKHACH"]?></td>
                                <td><?=$row["HODEM"]?> <?=' '?><?=$row["TEN"]?></td>
                                <?php
                                if($row["PHAI"]==0)
                                {
                                    echo "<td>"; echo 'Nam'; echo"</td>";
                                }
                                else {
                                    echo "<td>"; echo 'Nữ'; echo"</td>";
                                }
                                ?>
                                <td><?=$row["NGAYSINH"]?></td>
                                
                                <td><?=$row["CMND"]?></td>
                                <td><?=$row["DIACHI"]?></td>
                                <td><?=$row["DIENTHOAI"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    echo "<a href=\"#modalcapnhatkhach$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                
//                                    echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhviennoitru('".$row["ID_KHACH"]."')\">Sửa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoakhach('".$row["ID_KHACH"]."')\">Xóa</a></button>";
                                    
                                  
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
              <!--</div>-->                         
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
