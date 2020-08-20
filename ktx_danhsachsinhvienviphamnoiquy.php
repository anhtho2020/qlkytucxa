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
            function xoasinhvienvipham(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienviphamnoiquy.php?idviphamnoiquy="+id;
                }
            }
        </script>
    <?php  
        
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $query ="select a.ID_VIPHAMNOIQUY,a.ID_SINHVIEN,a.NGAYVIPHAM,a.HINHTHUCVIPHAM,"
                . "b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,c.MALOPCHUYENNGANH "
                . " from viphamnoiquy a,sinhvien b,lopchuyennganh c "
                . " where a.ID_SINHVIEN=b.ID_SINHVIEN "
                . " and b.ID_LOPCHUYENNGANH=c.ID_LOPCHUYENNGANH   ";  
        //echo $query;
        $result = mysql_query($query, $link);  
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
               <div class="row">
               <div class="col-lg-12 selecthk">
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Danh sách sinh viên vi phạm nội quy </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div>
                       <form role="form" action="ktx_xuatexceldanhsachsinhvienviphamnoiquy.php" method="post">                                                   
                         <button type="submit" class="btn btn-info">In danh sách sinh viên vi phạm nội quy</button>
                       </form>         
                   </div>
                   <div class="form-group">
                   </div>
                   <div>
                       <form role="form" action="ktx_sinhvienviphamnoiquy.php" method="post">                                                   
                         <button type="submit" class="btn btn-info"> Thêm HSSV vi phạm nội quy vào danh sách</button>
                       </form>         
                   </div>

  		</div>                   
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
                            
                            <th>MÃ HSSV</th>
                            <th>HỌ VÀ TÊN </th>
                            
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
                            <th>NGÀY VI PHẠM</th>
                            <th>HÌNH THỨC VI PHẠM</th>
                            
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
                                echo "<div class=\"modal fade\" id=\"modalcapnhatthongtinvipham$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin HSSV vi phạm</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinhssvvipham.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngayvipham\"> Ngày vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngayvipham\" value=\"".$row["NGAYVIPHAM"]."\" "; 
                                                           echo "name=\"ngayvipham\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"hinhthucvipham\"> Hình thức vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hinhthucvipham\" value=\"".$row["HINHTHUCVIPHAM"]."\""; 
                                                          echo "name=\"hinhthucvipham\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<input type=\"hidden\" name=\"idviphamnoiquy\" value=\"".$row["ID_VIPHAMNOIQUY"]."\" />";
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
                                
                                <td><?=$row["MASV"]?></td>
                                <td><?=$row["HODEM"]?><?=" "?><?=$row["TEN"]?></td>
                                
                                <td><?=$row["NGAYSINH"]?></td>
                                <?php
                                if($row["PHAI"]==0)
                                {
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }
                                ?>
                                <td><?=$row["MALOPCHUYENNGANH"]?></td>
                                <td><?=$row["NGAYVIPHAM"]?></td>
                                <td><?=$row["HINHTHUCVIPHAM"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhatthongtinvipham$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvienvipham('".$row["ID_VIPHAMNOIQUY"]."')\">Xóa</a></button>";
                                   
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
