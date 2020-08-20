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
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }
            
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_sinhvienviphamnoiquy.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.themsinhvienviphamnoiquy.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";
   
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

        $sopt=1;
        if(isset($_POST["chon"])){
            $arr = explode(",",$_POST["chon"]);
            $sopt=count($arr);
        }
        else echo " ";
        $idday=1;
        if(isset($_GET["idday"])){
             $idday=$_GET["idday"];
        }
        else echo " ";
        $idphong=1;
        if(isset($_GET["idphong"])){
             $idphong=$_GET["idphong"];
        }
        else echo " ";
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
        if(isset($_POST["hinhthucvipham"])){
             $hinhthucvipham=$_POST["hinhthucvipham"];
        }
        else echo " ";
        
        if(isset($_POST["ngayviphamnoiquy"])){
             $nnt=$_POST["ngayviphamnoiquy"];
             $x=explode("/", $nnt);
             $ngayviphamnoiquy=$x[2]."-".$x[1]."-".$x[0];//echo $ngayviphamnoiquy;
        }
        else echo " ";
        //else echo "ngaynoitru khong ton tai !";
        //$ngaynoitru=$_POST["ngaynoitru"];
        for($i=0; $i<$sopt-1; $i++){
            $query="insert into viphamnoiquy(ID_SINHVIEN,ID_PHONG, NGAYVIPHAM,HINHTHUCVIPHAM) "
                    . "values($arr[$i],$iphong,'$ngayviphamnoiquy','$hinhthucvipham')";//echo $query;
            mysql_query($query, $link);
            $query_xoanoitru="delete from danhsachnoitru where ID_SINHVIEN='".$arr[$i]."'";
            $result_xoanoitru=mysql_query($query_xoanoitru, $link);
            $query_xoatamtru="delete from dangkytamtru where ID_SINHVIEN='".$arr[$i]."'";
            $result_xoatamtru=mysql_query($query_xoanoitru, $link);
        }

//$query1="select date_format(ngaynoitru, '%d/%m/%Y')";
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
                        <h2> Quản lý sinh viên vi phạm nội quy </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                   
                   <!--
  			<div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Thêm sinh viên </button>
                             
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm sinh viên</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="thuchienthempinhvien.php" method="post">
                                                <div class="form-group">
                                                    <label for="idday">ID_DAY</label>
                                                    <input type="text" class="form-control" id="idday" 
                                                           name="idday" placeholder="Nhập id_day">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tenphong">Tên phòng</label>
                                                    <input type="text" class="form-control" id="tenphong" 
                                                           name="tenphong" placeholder="Nhập tên phòng">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1"> Số lượng SV tối đa </label>
                                                    <input type="number" class="form-control" id="soluongsv" 
                                                           name="succhua" placeholder="Nhập số lượng SV tối đa">
                                                </div>
                                                <button type="submit" class="btn btn-info">Thêm</button>
                                            </form>                                               
                                            <!--End of Success-->             
                                       <!-- </div> <!--End of ModalBody-->
                                    <!--    <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            
                                
                            
                        </div>
                        -->
                   
                       <?php

                    echo "<div>"; 
                    echo "<div class=\"form-group\">";
                        echo "<form name=\"themsinhvienviphamnoiquy\" action=\"ktx_sinhvienviphamnoiquy.php\" method=\"post\">";
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
//                        echo "<tr>";
//                            echo "<td> Tên phòng: </td>";
//                            echo "<td> <input type=\"text\" name=\"tenphong\" id=\"tenphong\" value=\"\" </td>";
//                        echo "</tr>";
                        echo "<tr>";
                            $now = getdate(); 
                            $ngvipham=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày vi phạm: </td>";
                            echo "<td> <input type=\"text\" name=\"ngayviphamnoiquy\" id=\"ngayviphamnoiquy\" size=\"10\" maxlength=\"10\" value=\"".$ngvipham."\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                       
                            echo "<td> Hình thức vi phạm: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"hinhthucvipham\" id=\"hinhthucvipham\" value=\"Tổ chức đánh bạc\" </td>";
                        echo "</tr>";
                        echo "<input type=\"hidden\" name=\"iphong\" value=\"".$idphong."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                       
                        echo "</form>";   
                        if($_SESSION["quyen"]=="QT")
                        {
                           echo "<div class=\"form-group\">";
                            echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thêm sinh viên vi phạm nội quy vào danh sách</button>";
                            echo "</div>"; 
                        }
                    ?>
                    <div>
                       <form role="form" action="ktx_danhsachsinhvienviphamnoiquy.php" method="post">                                                   
                         <button type="submit" class="btn btn-info">Danh sách sinh viên vi phạm nội quy</button>
                                            </form>         
                   </div>
             
                    
  		</div>                   
		</div>
                </div>
               <div class="row">                  
               <div class="col-lg-9">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <th width="3%"> </th>
                            <th width="3%">STT</th>
                            <th width="10%">MÃ HSSV</th>
                            <th width="20%">HỌ VÀ TÊN</th>
                            
                            <th width="13%">NGÀY SINH</th>
                            <th width="3%"> PHÁI </th>
                            <th width="10%"> LỚP </th>
                            <!--<th> PHÒNG </th>-->
                            <th width="13%"> NGÀY NỘI TRÚ </th>
                            
                            </tr>
                          </thead>
                        <?php
                        echo "<tbody>";
                            $totalRows = 0;       
                            $stSQL ="select a.ID_SINHVIEN,a.MASV,a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                    . "b.NGAYNOITRU,c.TENPHONG,d.MALOPCHUYENNGANH from sinhvien a,danhsachnoitru b,phong c,"
                                    . "lopchuyennganh d where a.ID_SINHVIEN=b.ID_SINHVIEN and "
                                    . " a.ID_LOPCHUYENNGANH=d.ID_LOPCHUYENNGANH "
                                    . " and b.ID_PHONG=c.ID_PHONG and b.ID_PHONG=$idphong";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            //echo $stSQL;
                            $result = mysql_query($stSQL, $link);  
                            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                             $i+=1;
                             
                           /*  
                           echo "<div class=\"modal fade\" id=\"modalsuaphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật phòng</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"suaphong.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"idday\">ID_DAY</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                          echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng SV tối đa</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsv\" value=\"".$row["SUCCHUA"]."\" "; 
                                                           echo "name=\"succhua\" placeholder=\"Nhập số lượng SV tối đa\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"exampleInputPassword1\">Số lượng sinh viên của phòng</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluongsvcuaphong\" value=\"".$row1["total"]."\" "; 
                                                           echo "name=\"total\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row["ID_PHONG"]."\" />";
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
                             */   
                                    
                                    
                                    
                                    
                                    
                         
                            
                            echo"<tr>";
                                echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
                                echo "<td>"; echo $i; echo "</td>";
                                echo "<td>"; echo $row["MASV"]; echo "</td>";
                                echo "<td>"; echo $row["HODEM"]; echo " "; echo $row["TEN"];echo "</td>";
                                
                                echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }

                                echo "<td>"; echo $row["MALOPCHUYENNGANH"]; echo "</td>";
//                                echo "<td>"; echo $row["TENPHONG"]; echo "</td>";
                                echo "<td>"; echo $row["NGAYNOITRU"]; echo "</td>";
                                
                                
//                               echo "<td>";
                                    
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                   // echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoa('".$row["ID_PHONG"]."')\">Xóa</a></button>";
                                    /*
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs" type="button">In biểu mẫu <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="#">Danh sách SV</a></li>
                                            <li><a href="#">Danh sách CSVC</a></li>
                                        </ul>
                                    </div><!-- /btn-group -->*/
                                  
//                                echo "</td>";
                                
                        echo "</tr>  ";
                          
                                } 
                        
                            }
                                                
                        
                       echo " </tbody> ";
                       
                       
                            
                            ?>
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
