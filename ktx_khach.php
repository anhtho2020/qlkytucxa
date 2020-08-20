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
            function xoakhach(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoakhach.php?idkhach="+id;
                }
            }

            function load(){
                var idlcn=document.getElementById('idlopchuyennganh').value;
                var idbdt=document.getElementById('idbacdaotao').value;
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_sinhviennoitru.php?idlcn="+idlcn+"&idbdt="+idbdt+"&idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>

    <?php  
    echo "<script>";
    echo "function tht(){ "; 
      echo "if(confirm('Thông tin chính xác?')){ "; 
          echo "var str=\"\";"; 
          //var num = $('#dshp input[type=checkbox]:checked').length;           
           echo "$(\"input[name='chk[]']\").each(function(){"; 
               echo "if($(this).is(':checked')){ "; 
                    echo "str+=$(this).val()+\",\"; "; 
               echo "}"; 
           echo "});           ";            
           echo "document.getElementById('chon').value=str; alert(str);"; 
           echo "if(str!=\"\"){ "; 
                echo "document.themsinhviennoitru.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";
    
         
//        $makhach="";
//        if(isset($_POST["makhach"])){
//             $makhach=$_POST["makhach"];
//        }
//        else echo " ";
//
//        $hodem="";
//        if(isset($_POST["hodem"])){
//             $hodem=$_POST["hodem"];
//        }
//        else echo " ";
//        $ten="";
//        if(isset($_POST["ten"])){
//             $ten=$_POST["ten"];
//        }
//        else echo " ";
//        $phai="";
//        if(isset($_POST["phai"])){
//             $phai=$_POST["phai"];
//        }
//        else echo " ";
//if($makhach!="")
//{       
//        $ngaysinh='1/1/1900';
//        if(isset($_POST["ngaysinh"])){
//             $nnt=$_POST["ngaysinh"];
//             $x=explode("/", $nnt);
//             $ngaysinh=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
//        }
//        else echo " ";
//        $cmnd="";
//        if(isset($_POST["cmnd"])){
//             $cmnd=$_POST["cmnd"];
//        }
//        else echo " ";
//        $diachi="";
//        if(isset($_POST["diachi"])){
//            $diachi=$_POST["diachi"];
//        }
//        else echo " ";
//     
//        $dienthoai="";
//        if(isset($_POST["dienthoai"])){
//             $dienthoai=$_POST["dienthoai"];
//        }
//        else echo " ";
//
// 
//        $query_kt="select MAKHACH from khach";
//        $result_kt=mysql_query($query_kt, $link);
//        $totalRows_kt=mysql_num_rows($result_kt); 
//        $arr_kt=array();
//        while($row_kt=mysql_fetch_array($result_kt)){
//                $arr_kt[]=$row_kt["MAKHACH"];
//        }
//        $f=false;
//        for($i=0; $i<$totalRows_kt-1; $i++){
//            if($arr_kt[$i]==$makhach){$f=true;}		
//        }
//        
//        if($f){
//            echo "<script>";
//                //echo "alert(str);"; 
//            echo "alert('Mã khách này đã có');";
//            echo "</script>";
//        }
//        else
//        {
//            $query="insert into khach(MAKHACH,HODEM,TEN,PHAI,NGAYSINH,CMND,DIACHI,DIENTHOAI) "
//                . "values('$makhach','$hodem','$ten','$phai','$ngaysinh','$cmnd','$diachi','$dienthoai')";
//            mysql_query($query, $link);
////            $slsv=$slsv+1;
//        }
//}
// else {
//    echo "<script>";
//                //echo "alert(str);"; 
//    echo "alert('Mã khách chưa nhập');";
//    echo "</script>";
//    
//}
        

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
                        <h2> Khách đặt phòng </h2>
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
                        echo "<form name=\"khach\" action=\"thuchienthemkhach.php\" method=\"post\">";
                        echo "<div>"; 
                        
                        echo "<div class=\"form-group\">";
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<th> Mã khách: </th>";
                        echo "<td> <input type=\"text\" name=\"makhach\" id=\"makhach\" size=\"10\" maxlength=\"10\" value=\"\"> </td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Họ đệm: </td>";
                            echo "<td> <input type=\"text\" name=\"hodem\" id=\"hodem\" size=\"20\" maxlength=\"20\" value=\"\"></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Tên: </td>";
                        echo "<td> <input type=\"text\" name=\"ten\" id=\"ten\" size=\"10\" maxlength=\"10\" value=\"\"></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Phái: </td>";
                        echo "<td> <input type=\"text\" name=\"phai\" id=\"phai\" size=\"1\" maxlength=\"1\" value=\"\"></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Ngày sinh: </td>";
                        echo "<td> <input type=\"text\" name=\"ngaysinh\" id=\"ngaysinh\" size=\"10\" maxlength=\"10\" value=\"\"></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> CMND: </td>";
                        echo "<td> <input type=\"text\" name=\"cmnd\" id=\"cmnd\" size=\"12\" maxlength=\"12\" value=\"\"></td>";
                        echo "</tr>";
                        echo "</div>";
                       echo "</div>";
                       
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<td> Địa chỉ: </td>";
                        echo "<td> <input type=\"text\" name=\"diachi\" id=\"diachi\" size=\"30\" maxlength=\"30\" value=\"\"></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Điện thoại: </td>";
                        echo "<td> <input type=\"text\" name=\"dienthoai\" id=\"dienthoai\" size=\"12\" maxlength=\"12\" value=\"\"></td>";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";    
                        if($_SESSION["quyen"]=="QT")
                        {
                            echo "<div class=\"form-group\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Nhập </button>";
                            echo "</div>"; 
                        }
                        
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachkhach.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách khách đặt phòng </button>";
                        echo "</form>";  
                        echo "</div>"; 
                    ?>
  		</div>                   
		</div>
                </div>
               <div class="row">                  
               <div class="col-lg-10">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example" >
                          <thead>
                            <tr>  
                                  <th>STT</th>
                                  <th>Mã khách</th>
                                  <th>Họ VÀ TÊN</th>
<!--                                  <th>Tên</th>-->
                                  <th>Phái</th>
                                  <th>Ngày sinh</th>
                                  <th>CMND</th>
                                  <th>Địa chỉ</th>
                                  <th>Điện thoại</th>
                                  
                                  <?php
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                        echo "<th>Tùy chọn</th>";
                                    }
                                    ?>

                              </tr>
                          </thead>
                        <?php
                            echo "<tbody>";
                        
                            $totalRows_khach = 0;       
                            $stSQL_khach ="select * from khach";  
                            $result_khach = mysqli_query($link,$stSQL_khach);  
                            $totalRows_khach=mysqli_num_rows($result_khach); 
                            if($totalRows_khach>0)   
                                    {    
                                        $i=0;                    
                                        while ($row = mysqli_fetch_array ($result_khach))     
                                        {   
                                            $i+=1;
                                            
                                            echo "<div class=\"modal fade\" id=\"modalcapnhatkhach$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                               echo "<div class=\"modal-dialog\">";
                                                    echo "<div class=\"modal-content\">";
                                                      echo "<div class=\"modal-header\">";
                                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin khách</h4>";
                                                        echo "</div>";
                                                        echo "<div class=\"modal-body\">";
                                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinkhach.php\" method=\"post\">";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"makhach\">Mã khách</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"makhach\" value=\"".$row["MAKHACH"]."\""; 
                                                                          echo "name=\"makhach\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"hodem\">Họ đệm</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row["HODEM"]."\" "; 
                                                                          echo "name=\"hodem\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ten\">Tên khách </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row["TEN"]."\" "; 
                                                                           echo "name=\"ten\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"phai\">Phái</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row["PHAI"]."\" "; 
                                                                           echo "name=\"phai\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ngaysinh\">Ngày sinh</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row["NGAYSINH"]."\" "; 
                                                                           echo "name=\"ngaysinh\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"cmnd\">CMND</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"cmnd\" value=\"".$row["CMND"]."\" "; 
                                                                           echo "name=\"cmnd\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"noisinh\">Nơi sinh</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"noisinh\" value=\"".$row_khach["NOISINH"]."\" "; 
//                                                                           echo "name=\"noisinh\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"diachi\">Địa chỉ</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"diachi\" value=\"".$row["DIACHI"]."\" "; 
                                                                           echo "name=\"diachi\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"email\">EMAIL</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"email\" value=\"".$row_khach["EMAIL"]."\" "; 
//                                                                           echo "name=\"email\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"dienthoai\">Điện thoại</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"dienthoai\" value=\"".$row["DIENTHOAI"]."\" "; 
                                                                           echo "name=\"dienthoai\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row["ID_KHACH"]."\" />";
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
                                    <td><?=$row["MAKHACH"]?></td>
                                    <td><?=$row["HODEM"]?><?=" "?><?=$row["TEN"]?></td>
                                    <?php
                                    if($row["PHAI"]==0){
                                        echo "<td>";  echo "Nam" ; echo "</td>";
                                    }
                                    else {
                                        echo "<td>";  echo "Nữ" ; echo "</td>";    
                                    }
                                    ?>
                                    
                                    <td><?=$row["NGAYSINH"]?></td>
                                    <td><?=$row["CMND"]?></td>
                                    
                                    <td><?=$row["DIACHI"]?></td>
                                    
                                    <td><?=$row["DIENTHOAI"]?></td>
                        <?php
                        if($_SESSION["quyen"]=="QT")
                        {
                                  echo "<td>";
                                   //echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhatkhach$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoakhach('".$row["ID_KHACH"]."')\">Xóa</a></button>";
                                    
                                  echo "</td>";
                        }
                        ?>
                                </tr>
                            <?php  
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
