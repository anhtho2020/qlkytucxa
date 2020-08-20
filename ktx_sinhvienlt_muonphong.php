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
                var idlcn=document.getElementById('idloplienthong').value;
                var idbdt=document.getElementById('idbacdaotao').value;
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_sinhvienlt_muonphong.php?idlcn="+idlcn+"&idbdt="+idbdt+"&idday="+idday+"&idphong="+idphong;
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
                echo "document.themsinhvienltnoitru.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";
    
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
//        require("phong.php");
        
        $idlcn=1;
        if(isset($_GET["idlcn"])){
            $idlcn=$_GET["idlcn"];
        }
        
        $idbdt=1;
        if(isset($_GET["idbdt"])){
            $idbdt=$_GET["idbdt"];
        }
        if($idbdt==1)
            {
                $kt="CD";
            }
            else
            {
                $kt="DH";
            }

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
//        echo $idphong;
        
        $iphong=0;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
//        echo $iphong;
        $idloainoitru=0;
        if(isset($_POST["idloainoitru"])){
             $idloainoitru=$_POST["idloainoitru"];
        }
        else echo " ";
        
        if(isset($_POST["ngaynoitru"])){
             $nnt=$_POST["ngaynoitru"];
             $x=explode("/", $nnt);
             $ngaynoitru=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
        $slsv=0;
//        $sldadangky=1;
        if(isset($_POST["sldadangky"])){
             $slsv=$_POST["sldadangky"];
        }
        else echo " ";
//        echo "Số lượng sinh viên của phòng: ".$slsv;
        
        $query_svvpnq="select ID_SINHVIEN from viphamnoiquy";
        $kt_svvpnq=mysqli_query($link,$query_svvpnq);
        $arr_svvpnq=array();
        while($row_svvpnq=mysqli_fetch_array($kt_svvpnq)){
                $arr_svvpnq[]=$row_svvpnq["ID_SINHVIEN"];
        }
    if($slsv==8)
        {
            echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Phòng đầy!');";
                echo "</script>";
        }
        elseif ($sopt-1+$slsv>8) {
            echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Số lượng đăng ký nhiều hơn số chỗ, không thể đăng ký phòng nầy!');";
                echo "</script>";
        } 
        else
        {
            for($i=0; $i<$sopt-1; $i++){
            $f=false;
            foreach($arr_svvpnq as $v){
                    if($arr[$i]==$v){$f=true;}		
            }
            
            if($f){
                echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Sinh viên đã vi phạm nội quy');";
                echo "</script>";
            }
            else
            {
                    $query="insert into dssvltnoitru(ID_LIENTHONG,ID_PHONG,NGAYNOITRU) "
                            . "values($arr[$i],$iphong,'$ngaynoitru')";
                    mysqli_query($link,$query);
                    $slsv=$slsv+1;
                    //echo $query;
            }
        }
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
                        <h2> SV liên thông đăng ký nội trú </h2>
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
                        echo "<form name=\"themsinhvienltnoitru\" action=\"ktx_sinhvienlt_muonphong.php\" method=\"post\">";
                        echo "<div>"; 
                        
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<th > Bậc đào tạo: </th>";
                            echo "<select name=\"bacdaotao\" id=\"idbacdaotao\" onchange=\"load()\">";
                                
                                echo "<option value=\"1\"";
                                if($kt=="CD"){echo " selected=\"selected\"";}
                                echo ">Cao đẳng</option>";
                                
                                echo "<option value=\"2\"";
                                if($kt=="DH"){echo " selected=\"selected\"";}
                                echo ">Đại học </option>";
                                
                                echo ">";
                            echo "</select>";
                            
                       echo "</tr>";
                       
                        
                        echo "<td width=\"400\"> Mã lớp: </td>";
                        echo "<select name=\"loplienthong\" id=\"idloplienthong\" onchange=\"load()\">";
                            $query_lcn="select ID_LOPLT, MALOPLT from loplt";// where LEFT(MALOPCHUYENNGANH,1)='".$kt."'";
                            //echo $query_lcn;
                            $result_lcn=mysqli_query($link,$query_lcn);
                            while($row_lcn=  mysqli_fetch_array($result_lcn)){
                                echo "<option value=\"".$row_lcn["ID_LOPLT"]."\"";
                                if($row_lcn["ID_LOPLT"]==$idlcn){
                                    echo " selected=\"selected\"";
                                }
                                echo ">";
                                echo $row_lcn["MALOPLT"]."</option>";
                            }
                        echo "</select>";
                        echo "</tr>";
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
                                echo "<option value=\"0\"";
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
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            $query_slsv="select * from danhsachnoitru where ID_PHONG=$idphong";
                            $result_slsv = mysqli_query($link,$query_slsv);  
                            $totalRows_slsv=mysqli_num_rows($result_slsv);
                            
                            $query_slsvlt="select * from dssvltnoitru where ID_PHONG=$idphong";
                            $result_slsvlt = mysqli_query($link,$query_slsvlt);  
                            $totalRows_slsvlt=mysqli_num_rows($result_slsvlt);
							
							$query_sl2017="select * from danhsachnoitrum where ID_PHONG=$idphong";
                            $result_sl2017 = mysqli_query($link,$query_sl2017);  
                            $totalRows_s20l17=mysqli_num_rows($result_sl2017);
							
                            $sum=$totalRows_slsv+$totalRows_slsvlt+$totalRows_s20l17;
							
                            echo "<th> Số lượng đã đăng ký: </th>";
                            echo "<td> <input type=\"text\" name=\"sldadangky\" id=\"sldadangky\" size=\"1\" maxlength=\"2\" value=\"".$sum."\"> </td>";
                        echo "</tr>";
                        echo "<tr>";
                        $slcothedangky=8-$sum;
                        echo "<td> Số lượng có thể đăng ký: </td>";
                            echo "<td> <input type=\"text\" name=\"slcothedangky\" id=\"slcothedangky\" size=\"1\" maxlength=\"2\" value=\"".$slcothedangky."\"></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<tr>";
                            $now = getdate(); 
                            $ngnoitru=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày nội trú: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaynoitru\" id=\"ngaynoitru\" size=\"10\" maxlength=\"12\" value=\"".$ngnoitru."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<input type=\"hidden\" name=\"iphong\" id=\"iphong\" value=\"".$idphong."\"";
                        echo "</tr>";
                        
                        
                        
                        //echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row_lcn["ID_LOPCHUYENNGANH"]."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
                        if($_SESSION["quyen"]=="QT")
                        {
                        echo "<button onclick=\"tht()\" class=\"btn btn-info\">Đăng ký</button>";
                        }
                        echo "</div>"; 
                        
//                        echo "<div>"; 
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachsinhvienlt_muonphong.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách SVLT </button>";
                        echo "</form>";  
                        echo "</div>"; 

                    ?>

  		</div>                   
		</div>
                </div>
              
              
              
               <div class="row">                  
               <div class="col-lg-8">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example" >
                          <thead>
                            <tr>
                            <th> </th>
                            <th>STT</th>
                            <th>MÃ SINH VIÊN</th>
                            <th> HỌ VÀ TÊN </th>
                            <!--<th>TÊN</th>-->
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th> LỚP</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            if($idday==1 || $idday==2)
                            {
                                $stSQL ="select a.ID_LIENTHONG,a.MASV, a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                        . "b.ID_LOPLT,b.MALOPLT from lienthong a,"
                                        . "loplt b where a.ID_LOP=b.ID_LOPLT "
                                        . "and a.ID_LOP=$idlcn and a.PHAI=1 and "
                                        . "a.ID_LIENTHONG not in (select ID_LIENTHONG from dssvltnoitru "
                                        . "where ID_LIENTHONG is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            
                                //echo $stSQL;
                            }
                            else if($idday==3){
                                $stSQL ="select a.ID_LIENTHONG,a.MASV, a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                        . "b.ID_LOPLT,b.MALOPLT from lienthong a,"
                                        . "loplt b where a.ID_LOP=b.ID_LOPLT "
                                        . "and a.ID_LOP=$idlcn and a.PHAI=0 and "
                                        . "a.ID_LIENTHONG not in (select ID_LIENTHONG from dssvltnoitru "
                                        . "where ID_LIENTHONG is not null)";
                            }
                            else {
                                $stSQL ="select a.ID_LIENTHONG,a.MASV, a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                        . "b.ID_LOPLT,b.MALOPLT from lienthong a,"
                                        . "loplt b where a.ID_LOP=b.ID_LOPLT "
                                        . "and a.ID_LOP=$idlcn and  "
                                        . "a.ID_LIENTHONG not in (select ID_LIENTHONG from dssvltnoitru "
                                        . "where ID_LIENTHONG is not null)";
                            }
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
                                echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_LIENTHONG"]."\"> </td>";
                                echo "<td>"; echo $i; echo "</td>";
                                echo "<td>"; echo $row["MASV"]; echo "</td>";
                                echo "<td>"; echo $row["HODEM"]; echo ' '; echo $row["TEN"];echo "</td>";
                                echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }
                                echo "<td>";  echo $row["MALOPLT"] ; echo "</td>";
//                                echo "<td>";
                                    
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
//                                    echo "<a href=\"#modalcapnhatsinhviennoitru$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
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
      <!--footer start-->
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
