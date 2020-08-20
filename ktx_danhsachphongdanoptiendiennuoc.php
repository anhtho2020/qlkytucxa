<?php
    session_start();
    if(!isset($_SESSION["quyen"]) || ($_SESSION["quyen"]!="QT" && $_SESSION["quyen"]!="KTKTX" && $_SESSION["quyen"]!="CTCTHT")){
        echo "<script>";
        echo "alert('Ban khong co quyen quan tri');";
        echo "window.location=\"index.php\";";
        echo "</script>";
    }
    include 'ClassData.php';
        require("dbcon.php");  
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
            function xoaphongnoptiendiennuoc(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienoptiendiennuoc.php?idthutiendiennuoc="+id;
                }
            }
            
            function inphieuthutiendiennuoc(id){
//                if(confirm('Bạn có chắc in phiếu này không?')){
                    window.location="ktx_inphieuthudiennuoc_dg_cs_tt.php?idthutiendiennuoc="+id;
//                }
            }
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_danhsachphongdanoptiendiennuoc.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
    <?php  
        
        //mysql_query("SET CHARACTER SET utf8",$link);
        $idday=1;
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
                        <h2> Danh sách phòng nộp tiền điện nước </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div class="form-group"> 
                    <!--<form role="form" action="ktx_xuatexceldanhsachphongdanoptiendiennuoc.php" method="post">-->
                    <form role="form" action="ktx_dsphongnoptiendiennuoc.php" method="post">
                        
                        <button type="submit" class="btn btn-info">Danh sách phòng nộp tiền điện nước</button>
                    </form> 
                    </div> 
                   <div class="form-group">
                       <form role="form" action="ktx_thudiennuoc.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">Thu tiền điện nước</button>
                    </form>     
                    </div>   
                   
                </div>
                </div>
                   
                   <?php
                    echo "<div>"; 
                        echo "<form name=\"danhsachphongdanoptiendiennuoc\" action=\"ktx_danhsachphongdanoptiendiennuoc.php\" method=\"post\">";
                        echo "<div class=\"form-group\">";
                        
                        echo "<tr>";
                          echo "<th > Tên dãy: </th>";
                              echo "<select name=\"idday\" id=\"idday\" onchange=\"load()\">";
                                  $query_day="select ID_DAY, TENDAY from day";
                                  echo $query_day;
                                  $result_day=mysql_query($query_day, $link);
                                  while($row_day=  mysql_fetch_array($result_day)){
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
                                    $result_phong=mysql_query($query_phong, $link);
                                    while($row_phong=  mysql_fetch_array($result_phong)){
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
                            <!--<td>STT</td>-->
                            <th> TÊN PHÒNG</th>
                            <th> GIÁ ĐIỆN</th>
                            <th> CSĐ CŨ</th>
                            <th> CSĐ MỚI </th>
                            <th> GIÁ NƯỚC</th>
                            <th> CSN CŨ</th>
                            <th> CSN MỚI </th>
                            <th> THÀNH TIỀN</th>
                            <th> THÁNG NỘP</th>
                            <th> NGÀY THU </th>
                            <th>NGƯỜI THU</th>
                            <th>NGƯỜI NỘP</th>
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
                            $totalRows = 0;       
            $query ="select a.ID_THUTIENDIENNUOC,a.ID_SINHVIEN,a.GIADIEN,a.CSDIENCU,a.CSDIENMOI,a.GIANUOC,a.CSNUOCCU,"
                    . "a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.THANGNOP,a.NGUOITHU,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,c.TENPHONG "
                    . "from thutiendiennuoc a,sinhvien b, phong c where a.ID_SINHVIEN=b.ID_SINHVIEN and "
                    . "a.ID_PHONG=c.ID_PHONG and a.ID_PHONG=$idphong and "
                    . "a.ID_THUTIENDIENNUOC not in (select ID_THUTIENDIENNUOC from dsphieuthutiendiennuoc  where ID_THUTIENDIENNUOC is not null)";
            //echo $query;
            $result = mysql_query($query, $link);  
            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                                    $i+=1;

                                    echo "<div class=\"modal fade\" id=\"modalsuathutiendiennuoc$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thu điện nước</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinthudiennuoc.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"giadien\">Giá điện</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"giadien\" value=\"".$row["GIADIEN"]."\" "; 
                                                           echo "name=\"giadien\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csdiencu\"> Chỉ số điện cũ</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csdiencu\" value=\"".$row["CSDIENCU"]."\""; 
                                                          echo "name=\"csdiencu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csdienmoi\"> Chỉ số điện mới</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csdienmoi\" value=\"".$row["CSDIENMOI"]."\" "; 
                                                          echo "name=\"csdienmoi\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"gianuoc\">Giá nước</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"gianuoc\" value=\"".$row["GIANUOC"]."\" "; 
                                                           echo "name=\"gianuoc\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csnuoccu\"> Chỉ số nước cũ</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csnuoccu\" value=\"".$row["CSNUOCCU"]."\""; 
                                                          echo "name=\"csnuoccu\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"csnuocmoi\"> Chỉ số nước mới</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"csnuocmoi\" value=\"".$row["CSNUOCMOI"]."\" "; 
                                                          echo "name=\"csnuocmoi\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thanhtien\"> Thành tiền</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"thanhtien\" value=\"".$row["THANHTIEN"]."\" "; 
                                                          echo "name=\"thanhtien\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythu\"> Ngày thu </label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaythu\" value=\"".$row["NGAYTHU"]."\" "; 
                                                          echo "name=\"ngaythu\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                 echo "<div class=\"form-group\">";
                                                    echo "<label for=\"thangnop\">Tháng nộp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"thangnop\" value=\"".$row["THANGNOP"]."\" "; 
                                                          echo "name=\"thangnop\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"nguoithu\"> Người thu </label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
                                                          echo "name=\"nguoithu\" placeholder=\" \">";
                                                echo "</div>";
                                                
                                                
                                                echo "<input type=\"hidden\" name=\"idthutiendiennuoc\" value=\"".$row["ID_THUTIENDIENNUOC"]."\" />";
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
                                <!--<td><?=$i?></td>-->
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["GIADIEN"]?></td>
                                <td><?=$row["CSDIENCU"]?> </td>
                                <td><?=$row["CSDIENMOI"]?></td>
                                
                                <td><?=$row["GIANUOC"]?></td>
                                
                                <td><?=$row["CSNUOCCU"]?></td>
                                <td><?=$row["CSNUOCMOI"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["THANGNOP"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <td><?=$row["HODEM"]?> <?=$row["TEN"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                    <?php
                                    echo "<td>";
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalsuasinhvienvipham$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    if($_SESSION["quyen"]=="QT"){
                                        echo "<a href=\"#modalsuathutiendiennuoc$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoaphongnoptiendiennuoc('".$row["ID_THUTIENDIENNUOC"]."')\">Xóa</a></button>";
                                        echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthutiendiennuoc('".$row["ID_THUTIENDIENNUOC"]."')\">In phiếu thu</a></button>";
                                    }
                                    
                                    echo "</td>";
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
