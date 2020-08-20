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
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }

            function load(){
//                var idlcn=document.getElementById('idlopchuyennganh').value;
//                var idngaymuonphong=document.getElementById('idngaymuonphong').value;
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var idngaymuonphong=document.getElementById('idngaymuonphong').value;
                var url="ktx_thutienphongkhach1.php?idday="+idday+"&idphong="+idphong+"&idngaymuonphong="+idngaymuonphong;
                
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
                echo "document.thutienphongkhach.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";
    
        $idngaymuonphong='2015-05-12';
        if(isset($_GET["idngaymuonphong"])){
            $idngaymuonphong=$_GET["idngaymuonphong"];
        }

        $sopt=1;
        if(isset($_POST["chon"])){
            $arr = explode(",",$_POST["chon"]);
            $sopt=count($arr);
        }
        else echo " ";
        $idday=4;
        if(isset($_GET["idday"])){
             $idday=$_GET["idday"];
        }
        else echo " ";
        $idphong=10;
        if(isset($_GET["idphong"])){
             $idphong=$_GET["idphong"];
        }
        else echo " ";
//        echo $idphong;
        
        $iphong=10;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
//        echo $iphong;

        $ngaymuon='2015-05-12';

        if(isset($_POST["ngaymuon"])){
             $ngaymuon=$_POST["ngaymuon"];
        }
        else echo " ";
        
        $songay=0;
        if(isset($_POST["songay"])){
             $songay=$_POST["songay"];
        }
        else echo " ";
        
        $dongia=0;
        if(isset($_POST["dongia"])){
             $dongia=$_POST["dongia"];
        }
        else echo " ";
        
        $ngaythu="";
        if(isset($_POST["ngaythu"])){
             $nth=$_POST["ngaythu"];
             $x=explode("/", $nth);
             $ngaythu=$x[2]."-".$x[1]."-".$x[0];//echo $ngaythu;
        }
        else echo " ";
        
        $nguoithu="";
        if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        }
        else echo " ";
        
        
        $thanhtien=0;
        $thanhtien=$dongia*$songay;

        
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
                        <h2> Thu tiền phòng khách </h2>
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
                        echo "<div class=\"form-group\">";
                        echo "<form name=\"thutienphongkhach\" action=\"thuchienthutienphongkhach.php\" method=\"post\">";
                       
                        
                      
                        echo "<tr>";
                        echo "<th > Tên dãy: </th>";
                            echo "<select name=\"idday\" id=\"idday\" onchange=\"load()\">";
                                $query_day="select ID_DAY, TENDAY from day";
                                echo $query_day;
                                $result_day=mysqli_query($link,$query_day);
                                while($row_day=  mysqli_fetch_array($result_day)){
                                    echo "<option value=\"".$row_day["ID_DAY"]."\"";
                                    if($row_day["ID_DAY"]==$idday){
                                        echo " selected=\"selected\"";
                                    }
                                    echo ">";
                                    echo $row_day["TENDAY"]."</option>";
                                }
                            echo "</select>";
                        echo "</tr>";
                        
                        $ktt=1;
                        echo "<tr>";
                        echo "<th > Tên phòng: </th>";
                            echo "<select name=\"idphong\" id=\"idphong\" onchange=\"load()\">";
                                echo "<option value=\"1\"";
                                if($ktt==1){echo " selected=\"selected\"";}
                                echo ">Ten phong</option>";
                            
                                $query_phong="select ID_PHONG,ID_DAY, TENPHONG from phong where ID_DAY=$idday";
                                //echo $query_phong;
                                $result_phong=mysqli_query($link,$query_phong);
                                while($row_phong=  mysqli_fetch_array($result_phong)){
                                    echo "<option value=\"".$row_phong["ID_PHONG"]."\"";
                                    if($row_phong["ID_PHONG"]==$idphong){
                                        echo " selected=\"selected\"";
                                    }
                                    echo ">";
                                    echo $row_phong["TENPHONG"]."</option>";
                                }
                            echo "</select>";
                            
                        echo "</tr>";
                        echo "</div>";
                        echo "<div class=\"form-group\">";
                        $ktt=1;
                        echo "<tr>";
                        echo "<th > Ngày mướn phòng: </th>";
                            echo "<select name=\"idngaymuonphong\" id=\"idngaymuonphong\" onchange=\"load()\">";
                                echo "<option value=\"1\"";
                                if($ktt==1){echo " selected=\"selected\"";}
                                echo ">Ngay muon phong</option>";
                            
                                $query_nnt="select ID_PHONG,NGAYNOITRU from dskhachnoitru where ID_PHONG=$idphong";
                                //echo $query_phong;
                                $result_nnt=mysqli_query($link,$query_nnt);
                                while($row_nnt=  mysqli_fetch_array($result_nnt)){
                                    echo "<option value=\"".$row_nnt["NGAYNOITRU"]."\"";
                                    if($row_nnt["NGAYNOITRU"]==$idngaymuonphong){
                                        echo " selected=\"selected\"";
                                    }
                                    echo ">";
                                    echo $row_nnt["NGAYNOITRU"]."</option>";
                                }
                            echo "</select>";
                            
                        echo "</tr>";
                        echo "</div>";
                        
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Số ngày: </td>";
                            echo "<td> <input type=\"number\" name=\"songay\" id=\"songay\" value=\"\" </td>";
                        echo "</tr>";
                        
                        
                        echo "<tr>";
                            echo "<td> Đơn giá: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"number\" name=\"dongia\" id=\"dongia\" value=\"120000\" </td>";
                        echo "</tr>";
                            $now = getdate(); 
                        echo "<tr>";
                            $ngthu=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
   // $workSheet->setCellValueByColumnAndRow(7, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
                            echo "<td> Ngày thu: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaythu\" id=\"ngaythu\" value=\"".$ngthu."\"</td>";
                        echo "</tr>";
                       
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
                            echo "<td> <input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"\" </td>";
                        echo "</tr>";
                            echo "<input type=\"hidden\" name=\"iphong\" id=\"iphong\" value=\"".$idphong."\"";
                        echo "</tr>";
                       
                        echo "<input type=\"hidden\" name=\"ngaymuon\" id=\"ngaymuon\" value=\"".$idngaymuonphong."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        
                      
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
                        if($_SESSION["quyen"]=="QT")
                        {
                        echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thu tiền phòng</button>";
                        }
                        echo "</div>"; 
                        
                        echo "<div>"; 
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachphongkhachdathutien.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách khách trả tiền phòng </button>";
                        echo "</form>";  
                        echo "</div>"; 
                        
                    ?>

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
                            <th> </th>
                            <th>STT</th>
                            <th>MÃ KHÁCH</th>
                            <th> HỌ VÀ TÊN </th>
                            
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>CMND</th>
                            <th>ĐỊA CHỈ</th>
                            <th>ĐIỆN THOẠI</th>
                            
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_KHACH,b.MAKHACH, b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,"
                                    . "b.DIACHI,b.CMND,b.DIENTHOAI from dskhachnoitru a,khach b "
                                    . "where a.ID_KHACH =b.ID_KHACH and a.ID_PHONG=$idphong and "
                                    . "a.NGAYNOITRU='$idngaymuonphong' ";
                                    //. "and  b.ID_KHACH not in (select ID_KHACH from thutienphongkhach where ID_KHACH is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            //echo $stSQL;
                            $result = mysqli_query($link,$stSQL);  
                            $totalRows=mysqli_num_rows($result); 
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
                                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin nội trú</h4>";
                                                        echo "</div>";
                                                        echo "<div class=\"modal-body\">";
                                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinsinhviennoitru.php\" method=\"post\">";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"masv\">Mã HSSV</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"makhach\" value=\"".$row_khach["MAKHACH"]."\""; 
                                                                          echo "name=\"makhach\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"hodem\">Họ đệm</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row_khach["HODEM"]."\" "; 
                                                                          echo "name=\"hodem\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ten\">Tên khách </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row_khach["TEN"]."\" "; 
                                                                           echo "name=\"ten\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"phai\">Phái</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row_khach["PHAI"]."\" "; 
                                                                           echo "name=\"phai\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ngaysinh\">Ngày sinh</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row_khach["NGAYSINH"]."\" "; 
                                                                           echo "name=\"ngaysinh\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"cmnd\">CMND</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"cmnd\" value=\"".$row_khach["CMND"]."\" "; 
                                                                           echo "name=\"cmnd\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"noisinh\">Nơi sinh</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"noisinh\" value=\"".$row_khach["NOISINH"]."\" "; 
//                                                                           echo "name=\"noisinh\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"diachi\">Địa chỉ</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"diachi\" value=\"".$row_khach["DIACHI"]."\" "; 
                                                                           echo "name=\"diachi\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"email\">EMAIL</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"email\" value=\"".$row_khach["EMAIL"]."\" "; 
//                                                                           echo "name=\"email\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"dienthoai\">Điện thoại</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"dienthoai\" value=\"".$row_khach["DIENTHOAI"]."\" "; 
                                                                           echo "name=\"dienthoai\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row_khach["ID_KHACH"]."\" />";
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
                                
                                echo"<tr>";
                                echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_KHACH"]."\"> </td>";
                                echo "<td>"; echo $i; echo "</td>";
                                echo "<td>"; echo $row["MAKHACH"]; echo "</td>";
                                echo "<td>"; echo $row["HODEM"]; echo " "; echo $row["TEN"];echo "</td>";
                                echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }
                                echo "<td>"; echo $row["CMND"]; echo "</td>";
                                echo "<td>"; echo $row["DIACHI"]; echo "</td>";
                                echo "<td>"; echo $row["DIENTHOAI"]; echo "</td>";


                                
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
            //clsData::footer_data();
      ?>
      <!--footer end-->
  </section>
        <?php
            clsData::footer_footer();
        ?>

  </body>
</html>
