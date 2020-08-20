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
            function xoasinhvienlt(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienlt.php?idlienthong="+id;
                }
            }
        </script>
    <?php  
        
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $stSQL ="select a.ID_LIENTHONG,a.SOHOSO,a.NAMNHAPHOC,a.CMND,a.MASV,a.HODEM,a.TEN,a.PHAI,"
                . "a.NGAYSINH,a.DIACHI,a.DIENTHOAI,a.DIENCHINHSACH,a.TPGIADINH,a.GHICHU, "
                . "b.MALOPLT from lienthong a,loplt b where a.ID_LOP=b.ID_LOPLT";  
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
               <!--<div class="row">-->
               <!--<div class="col-lg-12 selecthk">-->
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Danh sách sinh viên liên thông </h2>
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
                        echo "<form name=\"xuatexceldanhsachsinhviennoitrult\" action=\"ktx_xuatexceldanhsachsinhviennoitrult.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách sinh viên nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<div class=\"modal-body\">";
                    echo "<div>";
                    echo "<div>";
                        echo "<form name=\"themsinhviennoitru\" action=\"ktx_nhap_lienthong.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Thêm sinh viên liên thông </button>";
                        echo "</form>";
                    echo "</div>";
                    ?>
                    

  		</div>                   
<!--		</div>
                </div>
               <div class="row">                  -->
               <div class="col-lg-12">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <th>STT</th>
                            <th>MÃ SV</th>
                            <th>HỌ VÀ TÊN </th>
                            <th>CMND </th>
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
                            <th>SỐ HỒ SƠ</th>
                            <th>NĂM NHẬP HỌC</th>
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
                                    echo "<div class=\"modal fade\" id=\"modalsuasvlt$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                        echo "<div class=\"modal-dialog\">";
                                             echo "<div class=\"modal-content\">";
                                               echo "<div class=\"modal-header\">";
                                                   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                   echo " <h4 class=\"modal-title\">Cập nhật thông tin SVLT</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatthongtinsvlt.php\" method=\"post\">";
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\" maloplt\"> Mã lớp liên thông</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"maloplt\" value=\"".$row["MALOPLT"]."\""; 
                                                                   echo "name=\"maloplt\" placeholder=\"\">";
                                                         echo "</div>";
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\" sohoso\"> Số hồ sơ</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"sohoso\" value=\"".$row["SOHOSO"]."\""; 
                                                                   echo "name=\"sohoso\" placeholder=\"\">";
                                                         echo "</div>";
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\" namnhaphoc\"> Năm nhập học</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"namnhaphoc\" value=\"".$row["NAMNHAPHOC"]."\""; 
                                                                   echo "name=\"namnhaphoc\" placeholder=\"\">";
                                                         echo "</div>";
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\" cmnd\">CMND</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"cmnd\" value=\"".$row["CMND"]."\""; 
                                                                   echo "name=\"cmnd\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\" masv\">MASV</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MASV"]."\""; 
                                                                   echo "name=\"masv\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"hodem\"> Họ đệm</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row["HODEM"]."\" "; 
                                                                   echo "name=\"hodem\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ten\"> Tên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row["TEN"]."\" "; 
                                                                    echo "name=\"ten\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"phai\"> Phái </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row["PHAI"]."\" "; 
                                                                    echo "name=\"phai\" placeholder=\"\">";
                                                         echo "</div>";
                                                          echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaysinh\"> Ngày sinh </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row["NGAYSINH"]."\" "; 
                                                                    echo "name=\"ngaysinh\" placeholder=\"\">";
                                                         echo "</div>";
                                                          echo "<div class=\"form-group\">";
                                                             echo "<label for=\"diachi\"> Địa chỉ </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"diachi\" value=\"".$row["DIACHI"]."\" "; 
                                                                    echo "name=\"diachi\" placeholder=\"\">";
                                                         echo "</div>";
                                                          echo "<div class=\"form-group\">";
                                                             echo "<label for=\"dienthoai\"> Điện thoại </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"dienthoai\" value=\"".$row["DIENTHOAI"]."\" "; 
                                                                    echo "name=\"dienthoai\" placeholder=\"\">";
                                                         echo "</div>";
                                                          echo "<div class=\"form-group\">";
                                                             echo "<label for=\"dienchinhsach\"> Diện chính sách </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"dienchinhsach\" value=\"".$row["DIENCHINHSACH"]."\" "; 
                                                                    echo "name=\"dienchinhsach\" placeholder=\"\">";
                                                         echo "</div>";
                                                          echo "<div class=\"form-group\">";
                                                             echo "<label for=\"tpgiadinh\"> Thành phần gia đình </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"tpgiadinh\" value=\"".$row["TPGIADINH"]."\" "; 
                                                                    echo "name=\"tpgiadinh\" placeholder=\"\">";
                                                         echo "</div>";
                                                          echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ghichu\"> Ghi chú</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ghichu\" value=\"".$row["GHICHU"]."\" "; 
                                                                    echo "name=\"ghichu\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<input type=\"hidden\" name=\"idlienthong\" value=\"".$row["ID_LIENTHONG"]."\" />";
//                                                         echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row["ID_KHACH"]."\" />";
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
                                <td><?=$row["HODEM"]?> <?=' '?><?=$row["TEN"]?></td>
                                <td><?=$row["CMND"]?></td>
                                <td><?=$row["NGAYSINH"]?></td>
                                <?php
                                if($row["PHAI"]==0)
                                {
                                    echo "<td>"; echo 'Nam'; echo"</td>";
                                }
                                else {
                                    echo "<td>"; echo 'Nữ'; echo"</td>";
                                }
                                ?>
                                <td><?=$row["MALOPLT"]?></td>
                                <td><?=$row["SOHOSO"]?></td>
                                <td><?=$row["NAMNHAPHOC"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalsuasvlt$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
//                                    echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhviennoitru('".$row["ID_LIENTHONG"]."')\">Sửa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvienlt('".$row["ID_LIENTHONG"]."')\">Xóa</a></button>";
                                    
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
            clsData::footer_data();
      ?>
      <!--footer end-->
  </section>
   <?php
      clsData::footer_footer();
   ?>
  </body>
</html>
