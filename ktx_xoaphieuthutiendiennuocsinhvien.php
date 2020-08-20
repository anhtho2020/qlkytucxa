 <?php
    include 'ClassData.php';
    clsData::welcometowork();
    require("dbcon.php");  
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
            function xoaphieuthutiendiennuocsinhvien(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphieuthutienphongsinhvien.php?iddsphieuthutiendiennuocsinhvien="+id;
                }
            }
            function inphieuthu(id){
//                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchieninphieusinhvienoptienphong.php?idthutienphongsinhvien="+id;
//                }
            }
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_xoaphieuthutiendiennuocsinhvien.php?idday="+idday+"&idphong="+idphong;
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
        ?>        <!--header end-->
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
                        <h2> Xóa phiếu thu tiền điện nước sinh viên </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   <div class="form-group"> 
                    <form role="form" action="ktx_xuatexceldanhsachsinhviennoptienphong.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">In danh sách</button>
                    </form> 
                    </div> 
                   
                   
                </div>
                </div>
             
                   <?php
                   
                   echo "<div>"; 
                        echo "<form name=\"xoaphieuthutienphongsinhvien\" action=\"ktx_xoaphieuthutienphongsinhvien.php\" method=\"post\">";
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
                            <th width="3%">STT</th>
                            <th width="10%">MÃ HSSV</th>
                            <th width="18%">HỌ VÀ TÊN</th>
                            <th width="5%">PHÒNG</th>
                            <th width="5%">THÀNH TIỀN</th>
                            <th width="13%">NGÀY THU</th>
                            <th width="5%">NGÀY IN PHIẾU</th>
                            <th width="13%">THÁNG NÔP</th>
               
                            <th width="18%">NGƯỜI THU</th>
                            <th width="5%">SỐ PHIẾU</th>
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                                echo "<th>TÙY CHỌN</th>";   
                            }
                            elseif($_SESSION["quyen"]=="KTKTX")
                            {
                                echo "<th>TÙY CHỌN</th>";
                            }
                            ?>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                        $totalRows = 0;       
        $query ="select a.ID_DSPHIEUTHUTIENDIENNUOC, a.ID_THUTIENDIENNUOC,a.GIADIEN,a.CSDIENCU,CSDIENMOI,a.GIANUOC,A.CSNUOCCU,"
                . "a.CSNUOCMOI,a.THANHTIEN,a.NGAYTHU,a.NGAYINPHIEU,a.THANGNOP,a.NGUOITHU,b.MASV,b.HODEM,b.TEN,d.TENPHONG "
                . "from dsphieuthutiendiennuoc a,sinhvien b, phong d "
                . "where a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_PHONG=d.ID_PHONG and d.ID_PHONG=$idphong ";
                //. " and a.ID_THUTIENPHONGSINHVIEN not in (select ID_THUTIENPHONGSINHVIEN from dsphieuthutienphongsinhvien where ID_THUTIENPHONGSINHVIEN is not null)";
        //echo $query;
        $result = mysql_query($query, $link);  
        $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                                    $i+=1;

                                    echo "<div class=\"modal fade\" id=\"modalsuasinhviennoptienphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin sinh viên nộp tiền phòng </h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\" thuchiencapnhatthongtinsinhviennoptienphong.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"dongia\"> Đơ giá</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"dongia\" value=\"".$row["DONGIA"]."\" "; 
                                                           echo "name=\"dongia\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaythu\"> Ngày thu</label>";
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
                                                    echo "<label for=\"nguoithu\"> Người thu</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
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
                                <td><?=$row["MASV"]?></td>
                                <td><?=$row["HODEM"]?><?=" "?> <?=$row["TEN"]?> </td>
                                
                                <!--<td><?=$row["ID_THUTIENPHONGSINHVIEN"]?></td>-->
                                
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["NGAYINPHIEU"]?></td>
                                <td><?=$row["THANGNOP"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <td><?=$row["ID_THUTIENDIENNUOC"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                    <?php
                                    
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                        echo"<td>";
                                        //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                        //echo "<a href=\"#modalsuasinhviennoptienphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
				//echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthu('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">In phiếu thu</a></button>";
			echo"</td>";
		}
		else if($_SESSION["quyen"]=="KTKTX")
		{
			echo"<td>";
                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoaphieuthutiendiennuocsinhvien('".$row["ID_DSPHIEUTHUTIENDIENNUOC"]."')\">Xóa</a></button>";
                                        //echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthu('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">In phiếu thu</a></button>";
                                        echo"</td>";
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
          //clsData::footer_footer();
      ?>
  </body>
</html>
