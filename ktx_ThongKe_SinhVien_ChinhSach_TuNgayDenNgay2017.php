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
            function xoasinhviendongtienphong(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienoptienphong.php?idthutienphongsinhvien="+id;
                }
            }
            function thuchiencapnhatthongtinsinhviennoptienphong(id){
                if(confirm('Ban co chac cập nhật khong?')){
                    window.location="thuchiencapnhatthongtinthutienphongsinhvien.php?idthutienphongsinhvien="+id;
                }
            }
        </script>
    <?php  
        

        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $stSQL ="select a.ID_SINHVIEN, b.MAHSSV,b.HODEM,b.TEN,b.DIENCHINHSACH,a.NGAYNOITRU,c.TENPHONG from danhsachnoitrum a,dshssv b,phong c where a.ID_SINHVIEN=b.ID_DSHSSV and c.ID_PHONG=a.ID_PHONG and b.DIENCHINHSACH in ('Con thuong binh' , 'Con nha ngheo','Nguoi tan tat','Tu quan','Bo doi xuat ngu')";  
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
                        <h2>THỐNG KÊ SINH VIÊN DIỆN CHÍNH SÁCH 2017 </h2>
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
                        echo "<form name=\"thongkesinhviendienchinhsachtungaydenngay\" action=\"ktx_XuatExcel_SinhVien_ChinhSach_TuNgayDenNgay2017.php\" method=\"post\">";
                        echo "<tr>";
                            echo "<td> Nội trú- Từ ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"tungay\" id=\"tungay\" value=\"\"> </td>";
                            echo "<td> Đến ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"denngay\" id=\"denngay\" value=\"\"> </td></br></br>";
                        echo "</tr>";
                        echo "<button type=\"submit\" class=\"btn btn-info\"> In bảng kê </button>";
                        echo "</form>";   
                        echo "</div>"; 
                       ?>
                    <!---
                    <div class="form-group">
                        <form role="form" action="ktx_thutienphongsinhvien.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">Thu tiền phòng sinh viên nội trú</button>
                        </form>     
                    </div>   
                    --->
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
                                <th width="8%">MÃ HSSV</th>
                                <th width="18%">HỌ VÀ TÊN</th>
                                
                                <td width="12%">DIỆN CHÍNH SÁCH</td>
                                <td width="12%">NGÀY NỘI TRÚ</td>
                                <td width="5%">TÊN PHÒNG</td>
                                
                                
                                <?php
                               // if($_SESSION["quyen"]=="QT")
                                //{
                                       //   echo "<td>TÙY CHỌN</td>";
                                //}
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
                            echo "<div class=\"modal fade\" id=\"modalcapnhatthongtinhssvnoptienphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thu tiền phòng sinh viên</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhatthongtinthutienphongsinhvien.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"dongia\"> Đơn giá</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"dongia\" value=\"".$row["DONGIA"]."\" "; 
                                                           echo "name=\"dongia\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythu\">Ngày thu</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaythu\" value=\"".$row["NGAYTHU"]."\""; 
                                                          echo "name=\"ngaythu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"hocky\"> Học kỳ</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hocky\" value=\"".$row["HOCKY"]."\" "; 
                                                          echo "name=\"hocky\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"namhoc\"> Năm học</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"namhoc\" value=\"".$row["NAMHOC"]."\" "; 
                                                          echo "name=\"namhoc\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nguoithu\">Người thu</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\""; 
                                                          echo "name=\"nguoithu\" placeholder=\"\">";
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
                                
                                <td><?=$i?></td>
                                <td><?=$row["MAHSSV"]?></td>
                                <td><?=$row["HODEM"]?><?=" "?><?=$row["TEN"]?></td>
                                
                                
                                <td><?=$row["DIENCHINHSACH"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                
                                
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                    <?php
                                    //if($_SESSION["quyen"]=="QT")
                                    //{
                                        //echo "<td>";
                                        //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                        //echo "<a href=\"#modalcapnhatthongtinhssvnoptienphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                        //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviendongtienphong('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">Xóa</a></button>";
                                        //echo "</td>";
                                    //}
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
