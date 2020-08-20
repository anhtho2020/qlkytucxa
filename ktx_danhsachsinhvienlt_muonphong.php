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
            function xoasinhvienltnoitru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienltnoitru.php?iddssvltnoitru="+id;
                }
            }
        </script>
    <?php  
        
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $stSQL ="select a.ID_DSSVLTNOITRU,a.NGAYNOITRU,a.ID_LIENTHONG,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,c.TENPHONG,"
                . "c.ID_PHONG,d.ID_LOPLT,d.MALOPLT from dssvltnoitru a,lienthong b, phong c,loplt "
                . "d where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_PHONG=c.ID_PHONG and "
                . "b.ID_LOP=d.ID_LOPLT";  
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
                        <h2> Danh sách sinh viên nội trú </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
<!--                    <div class="modal-body">
                        <form role="form" action="ktx_xuatexceldanhsachsinhviennoitrult.php" method="post">                                                   
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
                        echo "<form name=\"xuatexceldanhsachsinhviennoitru\" action=\"ktx_xuatexceldanhsachsinhviennoitru.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách sinh viên nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<div class=\"modal-body\">";
                    echo "<div>";
                    echo "<div>";
                        echo "<form name=\"themsinhviennoitru\" action=\"ktx_sinhviennoitru.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Thêm sinh viên nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    ?>

  		</div>                   
		<!--</div>-->
                <!--</div>-->
               <!--<div class="row">-->                  
               <div class="col-lg-10">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <th width="3%">STT</th>
                            <th width="5%">MÃ SVLT</th>
                            <th width="18%">HỌ VÀ TÊN </th>
                          
                            <th width="13%">NGÀY SINH</th>
                            <th width="5%">PHÁI</th>
                            <th width="5%">LỚP</th>
                            <th width="5%">PHÒNG</th>
                            <th width="13%">NGÀY NỘI TRÚ</th>
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
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatsinhvienltnoitru$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                        echo "<div class=\"modal-dialog\">";
                                             echo "<div class=\"modal-content\">";
                                               echo "<div class=\"modal-header\">";
                                                   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                   echo " <h4 class=\"modal-title\">Cập nhật SVLT mướn phòng</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatsinhvienltmuonphong.php\" method=\"post\">";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"masvlt\">Mã SVLT</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"masvlt\" value=\"".$row["MASV"]."\""; 
                                                                   echo "name=\"masvlt\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"hodem\">Họ đệm</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row["HODEM"]."\" "; 
                                                                   echo "name=\"hodem\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ten\">Tên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row["TEN"]."\" "; 
                                                                    echo "name=\"ten\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaysinh\">Ngày sinh</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row["NGAYSINH"]."\" "; 
                                                                    echo "name=\"ngaysinh\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"phai\">Phái</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row["PHAI"]."\" "; 
                                                                    echo "name=\"phai\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"malop\">Lớp</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"malop\" value=\"".$row["MALOPLT"]."\" "; 
                                                                    echo "name=\"malop\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"tenphong\">Phòng</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                                    echo "name=\"tenphong\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaynoitru\">Ngày nội trú</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaynoitru\" value=\"".$row["NGAYNOITRU"]."\" "; 
                                                                    echo "name=\"ngaynoitru\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<input type=\"hidden\" name=\"iddssvltnt\" value=\"".$row["ID_DSSVLTNOITRU"]."\" />";
                                                         echo "<input type=\"hidden\" name=\"idlienthong\" value=\"".$row["ID_LIENTHONG"]."\" />";
//                                                         echo "<input type=\"hidden\" name=\"idloplt\" value=\"".$row["ID_LOPLT"]."\" />";
                                                         
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
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhatsinhvienltnoitru$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
//                                    echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhvienltnoitru('".$row["ID_LIENTHONG"]."')\">Sửa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvienltnoitru('".$row["ID_DSSVLTNOITRU"]."')\">Xóa</a></button>";
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
