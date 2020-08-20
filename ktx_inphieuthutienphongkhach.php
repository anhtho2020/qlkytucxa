<?php
    include 'ClassData.php';
    clsData::welcometowork();
    include 'dbcon.php';  
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
            function xoakhachthuephong(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoakhachthuephong.php?idkhach="+id;
                }
            }
            
            function load(){
                
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_inphieuthutienphongkhach.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
         
    <?php  
        
        echo "<script>";
        echo "function tht(){ "; 
            echo "if(confirm('Thông tin chính xác?')){ "; 
                echo "var str=\"\";"; 
                //var num = $('#dshp input[type=checkbox]:checked').length;           
                echo "$(\"input[name='chk[]']\").each(function () {"; 
                    echo "if($(this).is(':checked')){ "; 
                        echo "str+=$(this).val()+\",\"; "; 
                    echo "}"; 
                echo "});           ";            
                echo "document.getElementById('chon').value=str; alert(str);"; 
                echo "if(str!=\"\"){ "; 
                    echo "document.inphieuthutienphongkhach.submit();";  
                    //echo "alert(str);"; 
                echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
            echo "}"; 
            echo "else{ "; 
               echo "return false; "; 
            echo "}"; 
            echo "return true;"; 
            echo "}";
        echo "</script>";
        
        
        $idday=1;
        if(isset($_GET["idday"])){
            $idday=$_GET["idday"];
            
        }
        
        
        $idphong=1;
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
               <!--<div class="row">-->
               <div class="col-lg-12 selecthk">
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Xuất phiếu thu tiền phòng khách ở ký túc xá </h2>
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
                echo "<div>"; 
                    echo "<div class=\"form-group\">";
                        echo "<tr>";
                        
                       
                       
                        echo "</div>";
                        echo "</div>";
                        
                      echo "<div class=\"form-group\">";  
                        echo "<div>"; 
                        echo "<form name=\"inphieuthutienphongkhach\" action=\"ktx_xuatexcelphieuthutienphongkhach.php\" method=\"post\">";
//                        echo "<tr>";
                        echo "<th > Tên dãy: </th>";
                            echo "<select name=\"day\" id=\"idday\" onchange=\"load()\">";
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
                        
                        echo "<tr>";
                        $kt=1;$id_phong=0;
                        echo "<td width=\"400\"> Tên phòng: </td>";
                        echo "<select name=\"phong\" id=\"idphong\" onchange=\"load()\">";
                            echo "<option value=\"0\"";
                            if($kt==1){echo " selected=\"selected\"";}
                            echo "> Ten phong </option>";
//                                $query_phong="select ID_PHONG, TENPHONG from phong where ID_DAY='".$kt."'";
                                $query_phong="select ID_PHONG,ID_DAY, TENPHONG from phong where ID_DAY=$idday";
                                echo $query_phong;
                                $f=false;
                                $result_phong=mysql_query($query_phong, $link);
                                $row_phong=  mysql_fetch_array($result_phong);
                                $tam=$row_phong[0];
//                                echo "<option value=\"".$row_phong["ID_PHONG"]."\"";
//                                if($row_phong["ID_PHONG"]==$idphong){
//                                    echo " selected=\"selected\"";
//                                    $f=true;
//                                }
//                                echo ">";
//                                echo $row_phong["TENPHONG"]."</option>";
                                mysql_data_seek($result_phong,0);
                                while($row_phong=  mysql_fetch_array($result_phong)){
                                    echo "<option value=\"".$row_phong["ID_PHONG"]."\"";
                                    if($row_phong["ID_PHONG"]==$idphong){
                                        echo " selected=\"selected\"";
                                        $f=true;
                                    }
                                    echo ">";
                                    echo $row_phong["TENPHONG"]."</option>";
                                }
                                //$id_phong=$idphong;
                                if(!$f){$idphong=$tam;}
                                
                            echo "</select>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Mã khách: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"makhach\" id=\"makhach\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Ngày thu: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaythu\" id=\"ngaythu\" value=\"\" </td></br></br>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
                            echo "<td> <input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<input type=\"hidden\" name=\"id_phong\" id=\"id_phong\" value=\"".$idphong."\"> "; 
                        echo "<button type=\"submit\" class=\"btn btn-info\">In phiếu thu</button>";
                    echo "</form>";    
                echo "</div>";
            echo "</div>";
            echo "<div class=\"form-group\">";
//                echo "<button onclick=\"tht()\" class=\"btn btn-info\">In phiếu thu</button>";
            echo "</div>"; 
        ?>
                    
                    <div class="form-group">
                        <form role="form" action="ktx_thutienphongkhach1.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">Thu tiền phòng khách</button>
                        </form>     
                    </div>   
                    
                </div>
                </div>
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
                                <th>MÃ KHÁCH</th>
                                <th>HỌ ĐỆM</th>
                                <th>TÊN</th>
                                <th>NGÀY SINH</th>
                                <th>TÊN PHÒNG</th>
                                <th>ĐƠN GIÁ</th>
                                <th>NGÀY THU</th>
                                <th>SỐ NGÀY</th>
                                <th>THÀNH TIỀN</th>
                                <th>NGƯỜI THU</th>
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
                            $query ="select a.ID_THUTIENPHONGKHACH,a.ID_KHACH,a.SONGAY,a.DONGIA,"
                                    . "a.THANHTIEN,a.NGAYTHU,a.NGUOITHU,b.MAKHACH,b.HODEM,b.TEN,"
                                    . "b.NGAYSINH,b.PHAI,b.DIACHI,b.DIENTHOAI,c.TENPHONG "
                                    . "from thutienphongkhach a, khach b, phong c, danhsachnoitru d "
                                    . "where a.ID_KHACH=b.ID_KHACH and b.ID_KHACH=d.ID_KHACH and "
                                    . "d.ID_PHONG=c.ID_PHONG and d.ID_PHONG=$idphong";  
                            //echo $query;
                            $result = mysql_query($query, $link);  
                            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                           
 
//                                    $stSQL_kh ="select * from khach where ID_KHACH='".$row["ID_KHACH"]."'";  
//                                    $result_kh = mysql_query($stSQL_kh, $link);
//                                    $row_kh = mysql_fetch_array ($result_kh);
//                                    
//                                    $stSQL_phong ="select * from danhsachnoitru where ID_KHACH='".$row["ID_KHACH"]."'";  
//                                    $result_phong = mysql_query($stSQL_phong, $link);
//                                    $row_phong = mysql_fetch_array ($result_phong);
//                                    
//                                    $stSQL_phong1 ="select * from phong where ID_PHONG='".$row_phong["ID_PHONG"]."'";  
//                                    $result_phong1 = mysql_query($stSQL_phong1, $link);
//                                    $row_phong1 = mysql_fetch_array ($result_phong1);
                                    
                                    
                                    echo "<div class=\"modal fade\" id=\"modalsuakhachnoptienphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật sinh viên vi phạm</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhatsinhvienvipham.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_phong["TENPHONG"]."\" "; 
                                                           echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"idday\">ID_DAY</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngayvipham\">Ngày vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngayvipham\" value=\"".$row["NGAYVIPHAM"]."\" "; 
                                                          echo "name=\"ngayvipham\" placeholder=\"Nhập ngày vi phạm\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"hinhthucvipham\">Hình thức vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hinhthucvipham\" value=\"".$row["HINHTHUCVIPHAM"]."\" "; 
                                                          echo "name=\"hinhthucvipham\" placeholder=\"Hình thức vi phạm\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row["ID_PHONG"]."\" />";
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
                                <!--<td><input type="checkbox" name="chk[]" value="<?=$row["ID_SINHVIEN"]?>"></td>-->
                                <td><?=$i?></td>
                                <td><?=$row["MAKHACH"]?></td>
                                <td><?=$row["HODEM"]?></td>
                                <td> <?=$row["TEN"]?> </td>
                                <td><?=$row["NGAYSINH"]?></td>
                                
                                <td><?=$row["TENPHONG"]?></td>
                                
                                <td><?=$row["DONGIA"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["SONGAY"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                    <?php
                                    if($_SESSION["quyen"]=="QT")
                                    {

                                    echo "<td>";
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalsuakhachnoptienphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
//                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviennoptienphong('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">Xóa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"thuchienxoakhachthuephong('".$row["ID_KHACH"]."')\">Xóa</a></button>";
                                        echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthu('".$row["ID_KHACH"]."')\">In phiếu thu</a></button>";
                                    
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
