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
            function xoasinhviennoitru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhviennoitru.php?idsinhvien="+id;
                }
            }
        </script>
    <?php  
       
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $stSQL ="select a.ID_DANHSACHNOITRU,a.NGAYNOITRU,a.ID_SINHVIEN,"
                . "b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,c.TENPHONG,d.MALOPCHUYENNGANH "
                . " from danhsachnoitru a,sinhvien b, phong c,lopchuyennganh d "
                . " where a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_PHONG=c.ID_PHONG and "
                . " b.ID_LOPCHUYENNGANH=d.ID_LOPCHUYENNGANH";  
        $result = mysql_query($stSQL, $link);  
        $totalRows=mysql_num_rows($result); 
    
        
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
                        echo "<form name=\"xuatexceldanhsachsinhviennoitru\" action=\"ktx_xuatexceldanhsachsinhviennoitru.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách sinh viên nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<div class=\"modal-body\">";
                    echo "<div>";
                    echo "<div>";
                        echo "<form name=\"themsinhviennoitru\" action=\"ktx_sinhviennoitru.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> HSSV đăng ký nội trú </button>";
                        echo "</form>";
                    echo "</div>";
                    
                    echo "<div class=\"form-group\">";    
                        //echo "<form name=\"xuatexcelbangkethutienphongtungaydenngay\" action=\"ktx_xuatexcel_bangkethutienphong_tungaydenngay.php\" method=\"post\">";
                        echo "<form name=\"danhsachsinhvienoktxdangkytamtru\" action=\"ktx_xuatexcel_danhsachsinhvienoktx_dangkytamtru_tndn.php\" method=\"post\">";
//                        echo "<tr>";
//                            echo "<td> Học kỳ: </td>";
//                            echo "<td> <input type=\"text\" name=\"hocky\" id=\"hocky\" value=\"\"> </td>";
//                            echo "<td> Năm học: </td>";
//                            echo "<td> <input type=\"text\" name=\"namhoc\" id=\"namhoc\" value=\"\"> </td></br></br>";
//                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Từ ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"tungay\" id=\"tungay\" value=\"\"> </td>";
                            echo "<td> Đến ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"denngay\" id=\"denngay\" value=\"\"> </td></br></br>";
                        echo "</tr>";
                        echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách tạm trú </button>";
                        //echo "<button type=\"submit\" class=\"btn btn-info\"> Đăng ký tạm trú </button>";
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
                            <th>MÃ SINH VIÊN</th>
                            <th>HỌ VÀ TÊN </th>
                          
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
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
                                while ($row = mysql_fetch_array ($result))     
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
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatsinhviennoitru.php\" method=\"post\">";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"masv\"> Mã sinh viên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MASV"]."\""; 
                                                                   echo "name=\"masv\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"hodem\"> Họ đệm</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row["HODEM"]."\" "; 
                                                                   echo "name=\"hodem\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ten\">Tên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row["TEN"]."\" "; 
                                                                   echo "name=\"ten\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaysinh\"> Ngày sinh </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row["NGAYSINH"]."\" "; 
                                                                    echo "name=\"ngaysinh\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"phai\"> Phái</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row["PHAI"]."\" "; 
                                                                    echo "name=\"phai\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"malop\"> Lớp </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=malop\" value=\"".$row["MALOPCHUYENNGANH"]."\" "; 
                                                                    echo "name=\"malop\" placeholder=\"\">";
                                                         echo "</div>";

                                                         //echo "<div class=\"form-group\">";
                                                             //echo "<label for=\"tenphong\"> Tên phòng </label>";
                                                             //echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                                    //echo "name=\"tenphong\" placeholder=\"\">";
                                                         //echo "</div>";
                                                         //echo "<div class=\"form-group\">";
                                                             //echo "<label for=\"ngaynoitru\"> Ngày nội trú </label>";
                                                             //echo "<input type=\"text\" class=\"form-control\" id=\"ngaynoitru\" value=\"".$row["NGAYNOITRU"]."\" "; 
                                                                    //echo "name=\"ngaynoitru\" placeholder=\"\">";
                                                         //echo "</div>";
                                                         echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row["ID_SINHVIEN"]."\" />";
                                                         echo "<input type=\"hidden\" name=\"iddanhsachnoitru\" value=\"".$row["ID_DANHSACHNOITRU"]."\" />";
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
                                <td><?=$row["MALOPCHUYENNGANH"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    
                                    echo "<a href=\"#modalcapnhatsinhviennoitru$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhviennoitru('".$row["ID_SINHVIEN"]."')\">Sửa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviennoitru('".$row["ID_SINHVIEN"]."')\">Xóa</a></button>";
                                    
                                  
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
