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
            function xoasinhviennoitru2017(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoadsnoitrumoi2017.php?iddshssv="+id;
                }
            }
        </script>
    <?php  
       
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $stSQL ="select a.ID_DANHSACHNOITRU,a.NGAYNOITRU,a.ID_SINHVIEN,"
                . "b.ID_DSHSSV,b.MAHSSV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,b.CMND,b.DIACHI,b.EMAIL,b.DIENTHOAI,b.DIENCHINHSACH,b.GHICHU,c.TENPHONG "
                . " from danhsachnoitrum a,dshssv b, phong c "
                . " where a.ID_SINHVIEN=b.ID_DSHSSV and a.ID_PHONG=c.ID_PHONG ";
                //. " b.ID_LOPCHUYENNGANH=d.ID_LOPCHUYENNGANH";  
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
                        <h2> DANH SÁCH HỌC SINH- SINH VIÊN NỘI TRÚ TỪ 2017</h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>

                    <?php
                    echo "<div>";
                        echo "<form name=\"xuatexceldanhsachsinhviennoitru\" action=\"ktx_xuatexceldanhsachsinhviennoitru2017.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách sinh viên nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    //echo "<div class=\"modal-body\">";
                    //echo "<div>";
                    echo "<div>";
                        echo "<form name=\"themsinhviennoitru\" action=\"ktx_sinhviendangkynoitru2017.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> HSSV đăng ký nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    ?>
                    

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
                            <th>MÃ SINH VIÊN</th>
                            <th>HỌ VÀ TÊN </th>
                          
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>CMND</th>
                            <th>TÊN PHÒNG</th>
                            <th>NGÀY NỘI TRÚ</th>
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
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatsinhviennoitru$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                        echo "<div class=\"modal-dialog\">";
                                             echo "<div class=\"modal-content\">";
                                               echo "<div class=\"modal-header\">";
                                                   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                   echo " <h4 class=\"modal-title\">Cập nhật sinh viên nội trú</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatthongtinHSSVnoitru2017.php\" method=\"post\">";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"mahssv\"> Mã sinh viên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"mahssv\" value=\"".$row["MAHSSV"]."\""; 
                                                                   echo "name=\"mahssv\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"tenphong\"> Tên phòng </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                                   echo "name=\"tenphong\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaynoitru\">Tên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaynoitru\" value=\"".$row["NGAYNOITRU"]."\" "; 
                                                                   echo "name=\"ngaynoitru\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                           
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ghichu\"> Ghi chú </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ghichu\" value=\"".$row["GHICHU"]."\" "; 
                                                                           echo "name=\"ghichu\" placeholder=\"\">";
                                                                echo "</div>";
                                                                
                                                                echo "<input type=\"hidden\" name=\"iddsnoitru\" value=\"".$row["ID_DANHSACHNOITRU"]."\" />";
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
                                <td><?=$row["HODEM"]?> <?=' '?><?=$row["TEN"]?></td>
                                
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
                                <td><?=$row["CMND"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    
                                    echo "<a href=\"#modalcapnhatsinhviennoitru$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhviennoitru('".$row["ID_SINHVIEN"]."')\">Sửa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviennoitru2017('".$row["ID_DSHSSV"]."')\">Xóa</a></button>";
                                    
                                  
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
