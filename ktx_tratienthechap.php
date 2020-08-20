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
                    window.location="thuchienxoathechap.php?idthechap="+id;
                }
            }
            function inphieu(id){
//                if(confirm('Ban co chac in phieu khong?')){
                    window.location="thuchieninphieuchitrathechap.php?idthechap="+id;
//                }
            }
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_tratienthechap.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.tratienthechap.submit();";  
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
        $idphong=0;
        if(isset($_GET["idphong"])){
             $idphong=$_GET["idphong"];
        }
        else echo " ";
        
        
        $ngaytrathechap='';
        if(isset($_POST["ngaytrathechap"])){
             $nnt=$_POST["ngaytrathechap"];
             $x=explode("/", $nnt);
             $ngaytrathechap=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
        //if(isset($_POST["ngaytrathechap"])){
            ///$ngaytrathechap=$_POST["ngaytrathechap"];
        //}
        //else echo " ";
        
        $idthechap[0]=0;
        $ngaythechap[0]='';
        $sotien[0]=0;
        $hocky[0]='';
        $namhoc[0]='';
        $ghichu[0]='';
        
        
        //$sotien=0;
        //$i=0;
        $totalRows_ins = 0;  
        for($i=0; $i<$sopt-1; $i++){
            $strSQR_ins ="select a.ID_DSPHIEUTHUTHECHAP,a.ID_THECHAP,a.ID_SINHVIEN,a.NGAYTHECHAP,"
                . "a.NGAYINPHIEU,a.SOTIEN,a.HOCKY,a.NAMHOC,a.NGUOITHU,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,b.PHAI "
                . " from dsphieuthuthechap a,sinhvien b"
                . " where a.ID_SINHVIEN =b.ID_SINHVIEN "
                . " and a.ID_SINHVIEN=$arr[$i]";// and a.SOTIEN>0";// from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                           
                $result_ins = mysqli_query($link,$strSQR_ins);  
                $totalRows_ins=mysqli_num_rows($result_ins); 
            //while($row_ins = mysql_fetch_array ($result_ins))
            //{
                $row_ins = mysqli_fetch_array ($result_ins);
                $idthechap[$i]=$row_ins["ID_THECHAP"];
                $ngaythechap[$i]=$row_ins["NGAYTHECHAP"];
                $sotien[$i]=$row_ins["SOTIEN"];
                $hocky[$i]=$row_ins["HOCKY"];
                $namhoc[$i]=$row_ins["NAMHOC"];
                //$ghichu[$i]=$row_ins["GHICHU"];
            //}
        }
        
        for($i=0; $i<$sopt-1; $i++){
            $query="insert into dstrathechap (ID_THECHAP,ID_SINHVIEN,NGAYTHECHAP,NGAYTRATHECHAP,SOTIEN,HOCKY,NAMHOC) "
                    . "values($idthechap[$i],$arr[$i],'$ngaythechap[$i]','$ngaytrathechap',$sotien[$i],'$hocky[$i]','$namhoc[$i]')";//echo $query;
            
            //$idthechap=$_GET["idthechap"];
            $query_del="delete from thechap where ID_THECHAP=$idthechap[$i]";
            $result=mysqli_query($link,$query_del);//echo $query;
            
            mysqli_query($link,$query);
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
                        <h2> Chi tiền thế chấp</h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                         
                    
  		</div>                   
		</div>
                </div>
            <?php
                echo "<div class=\"form-group\">";
                        echo "<form name=\"tratienthechap\" action=\"ktx_tratienthechap.php\" method=\"post\">";
                        echo "<div>"; 
                        
                        echo "<div class=\"form-group\">";
                        
                       /*
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
                        
                        $ktt=1;
                        echo "<tr>";
                        echo "<th > Tên phòng: </th>";
                            echo "<select name=\"idphong\" id=\"idphong\" onchange=\"load()\">";
                                echo "<option value=\"0\"";
                                if($ktt==1){echo " selected=\"selected\"";}
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
                        echo "</div>";
                        */
                        echo "<div>";
                       echo "<div class=\"form-group\">";

                        echo "<tr>";
                            $now = getdate();
                            $ngtrathechap=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày Trả Thế Chấp: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaytrathechap\" id=\"ngaytrathechap\" size=\"10\" maxlength=\"10\" value=\"".$ngtrathechap."\" </td>";
                        echo "</tr>";

                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";    
                        if($_SESSION["quyen"]=="KTKTX")
                        {
                            echo "<div class=\"form-group\">";
                            echo "<button onclick=\"tht()\" class=\"btn btn-info\">Trả Thế Chấp</button>";
                            echo "</div>"; 
                        }
                        
                
            ?>
               <div class="row">                  
               <div class="col-lg-10">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            <th></th>
                            <th width="3%">STT</th>
                            <th width="8%">MÃ HSSV</th>
                            <th width="25%">HỌ VÀ TÊN </th>
                            
                            <th width="12%">NGÀY SINH</th>
                            <th width="13%">NGÀY THẾ CHẤP</th>
                            <th width="12%">SỐ TIỀN </th>
                            <th width="12%">NGÀY IN PHIẾU</th>
                            
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                            $totalRows = 0;       
                            $stSQL ="select b.ID_SINHVIEN,a.ID_THECHAP,a.NGAYTHECHAP,a.NGAYINPHIEU,a.SOTIEN,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,"
                                    . "b.PHAI from dsphieuthuthechap a,sinhvien b "
                                    . " where a.ID_SINHVIEN =b.ID_SINHVIEN "
                                    . " and a.ID_SINHVIEN not in(select ID_SINHVIEN from dstrathechap where ID_SINHVIEN is not null)";
                                   
                            //echo $stSQL;
                            /*
                             $stSQL ="select b.ID_SINHVIEN,a.ID_THECHAP,a.NGAYTHECHAP,a.SOTIEN,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,"
                                    . "b.PHAI,c.NGAYTRAPHONG,d.MALOPCHUYENNGANH from thechap a,sinhvien b,danhsachtraphong c, "
                                    . " lopchuyennganh d where a.ID_SINHVIEN =b.ID_SINHVIEN and "
                                    . "a.ID_SINHVIEN=c.ID_SINHVIEN and b.ID_LOPCHUYENNGANH=d.ID_LOPCHUYENNGANH"
                                    . " and c.ID_PHONG=$idphong";// and a.SOTIEN>0";// from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            //echo $stSQL;
                             */
                            $result = mysqli_query($link,$stSQL);  
                            $totalRows=mysqli_num_rows($result); 
                            
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                    
                                    echo "<div class=\"modal fade\" id=\"modalcapnhattienthechap$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                               echo "<div class=\"modal-dialog\">";
                                                    echo "<div class=\"modal-content\">";
                                                      echo "<div class=\"modal-header\">";
                                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                          echo " <h4 class=\"modal-title\">Cập nhật tiền thế chấp</h4>";
                                                        echo "</div>";
                                                        echo "<div class=\"modal-body\">";
                                                            echo "<form role=\"form\" action=\"thuchiencapnhattienthechap.php\" method=\"post\">";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"sotien\">Tiền thế chấp</label>";
                                                                    echo "<input type=\"number\" class=\"form-control\" id=\"sotien\" value=\"".$row["SOTIEN"]."\""; 
                                                                          echo "name=\"sotien\" placeholder=\"\">";
                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"hodem\">Họ đệm</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row_khach["HODEM"]."\" "; 
//                                                                          echo "name=\"hodem\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"ten\">Tên khách </label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row_khach["TEN"]."\" "; 
//                                                                           echo "name=\"ten\" placeholder=\"\">";
//                                                                echo "</div>";
////                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"phai\">Phái</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row_khach["PHAI"]."\" "; 
//                                                                           echo "name=\"phai\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"ngaysinh\">Ngày sinh</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaysinh\" value=\"".$row_khach["NGAYSINH"]."\" "; 
//                                                                           echo "name=\"ngaysinh\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"cmnd\">CMND</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"cmnd\" value=\"".$row_khach["CMND"]."\" "; 
//                                                                           echo "name=\"cmnd\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"noisinh\">Nơi sinh</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"noisinh\" value=\"".$row_khach["NOISINH"]."\" "; 
//                                                                           echo "name=\"noisinh\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"diachi\">Địa chỉ</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"diachi\" value=\"".$row_khach["DIACHI"]."\" "; 
//                                                                           echo "name=\"diachi\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"email\">EMAIL</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"email\" value=\"".$row_khach["EMAIL"]."\" "; 
//                                                                           echo "name=\"email\" placeholder=\"\">";
//                                                                echo "</div>";
//                                                                echo "<div class=\"form-group\">";
//                                                                    echo "<label for=\"dienthoai\">Điện thoại</label>";
//                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"dienthoai\" value=\"".$row_khach["DIENTHOAI"]."\" "; 
//                                                                           echo "name=\"dienthoai\" placeholder=\"\">";
//                                                                echo "</div>";
                                                                echo "<input type=\"hidden\" name=\"idthechap\" value=\"".$row["ID_THECHAP"]."\" />";
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
                                    echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
                                    echo "<td>"; echo $i; echo "</td>";
                                    echo "<td>"; echo $row["MASV"]; echo "</td>";
                                    echo "<td>"; echo $row["HODEM"]; echo " "; echo $row["TEN"];echo "</td>";
                                    
                                    echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYTHECHAP"]; echo "</td>";
                                    echo "<td>"; echo $row["SOTIEN"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYINPHIEU"]; echo "</td>";
                                    echo"</tr>";
                            
                                 } 
                            }
//                            else
//                            {  
//                                       
//                                echo "<tr valign=\"top\">    ";                
//                                echo "<td >&nbsp;</td>      ";             
//                                echo "<td > ";
//                                   echo " <b>";
//                                      echo "  <font face=\"Arial\" color=\"#FF0000\">      ";                
//                                            echo "Oop! Ship not found!";
//                                      echo "  </font>";
//                                    echo "</b>";
//                                echo "</td>                 ";
//                                echo "</tr>                 ";
//                           
//                            } 
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
      <!--footer start
      <footer class="site-footer">
          <div class="text-center">
              2015 &copy; Phát triển bởi Khoa Công Nghệ Thông Tin - Truyền Thông.
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
   

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <script type="text/javascript" language="javascript" src="assets/isotope/jquery.isotope.js"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/datatable.bootstrap.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/respond.min.js" ></script>

    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

  <script>
		function updateDiem(a){
			if ($(a).val()==""){
				$(a).parent('td').removeClass('has-success').addClass('has-error');
			}
			else{
				$(a).parent('td').removeClass('has-error').addClass('has-success');
			}
		}
      //owl carousel

      $(document).ready(function() {
        $('#example').dataTable({
				  "sPaginationType": "bootstrap",
        			"oLanguage": {
            "sLengthMenu": "Hiển thị _MENU_ mẫu tin trên mỗi trang",
            "sZeroRecords": "Không có dữ liệu",
            "sInfo": "Hiển thị từ _START_ đến _END_ of _TOTAL_ mẫu tin",
            "sInfoEmpty": "Có 0 đến 0 của 0 mẫu tin",
            "sInfoFiltered": "(lọc từ _MAX_ mẫu tin)",
			"sSearch": "Tìm kiếm:",
			"oPaginate": {
                        "sPrevious": "Trước đó",
                        "sNext": "Kế tiếp"
                    }
        }
    });
			  
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  function captaikhoan(){
		  $('#formcaptaikhoan').hide();
		  $('#ctkprogressbar').show();
	  }

  </script>

  </body>
</html>
