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
                var url="ktx_dangkytamtrult.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.dangkytamtrult.submit();";  
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
        
        $idlcn=141;
        if(isset($_GET["idlcn"])){
            $idlcn=$_GET["idlcn"];
        }
        
        $idbdt=1;
        if(isset($_GET["idbdt"])){
            $idbdt=$_GET["idbdt"];
        }
        if($idbdt==1)
            {
                $kt="C";
            }
            else
            {
                $kt="T";
            }
        
        
        //$idlcn_temp=1;
        if(isset($_GET["idlcn"])){
            $idlcn_temp=$_GET["idlcn"];
        }

        
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
        
        $sopt=1;
        if(isset($_POST["chon"])){
            $arr = explode(",",$_POST["chon"]);
            $sopt=count($arr);
        }
        else echo " ";
        
        
        
       
        
        if(isset($_POST["ngaydangkytamtru"])){
             $nnt=$_POST["ngaydangkytamtru"];
             $x=explode("/", $nnt);
             $ngaydangkytamtru=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
         if(isset($_POST["ghichu"])){
             $ghichu=$_POST["ghichu"];
        }
        else echo " ";

        for($i=0; $i<$sopt-1; $i++){
            $query="insert into dangkytamtrult (ID_LIENTHONG,NGAYTAMTRU,GHICHU ) "
                    . "values($arr[$i],'$ngaydangkytamtru','$ghichu')";//echo $query;
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
               <div class="col-lg-9 selecthk">
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Sinh viên liên thông đăng ký tạm trú</h2>
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
                        echo "</div>";
                    
                        echo "<div>"; 
                        echo "<form name=\"dangkytamtrult\" action=\"ktx_dangkytamtrult.php\" method=\"post\">";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        $now = getdate(); 
                        $ngdangkytamtru=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày đăng ký tạm trú: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"ngaydangkytamtru\" id=\"ngaydangkytamtru\" value=\"".$ngdangkytamtru."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Ghi chú: </td>";
                            echo "<td> <input type=\"text\" name=\"ghichu\" id=\"ghichu\" value=\"\" </td>";
                        echo "</tr>";
                         //echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row_lcn["ID_LOPCHUYENNGANH"]."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                       
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
                        if($_SESSION["quyen"]=="QT")
                        {
                            echo "<button onclick=\"tht()\" class=\"btn btn-info\">Đăng ký </button>";
                        }    
                        echo "</div>"; 
                        echo "<div>";
                        echo "<form name=\"danhsachtamtrult\" action=\"ktx_danhsachsinhvienltdangkytamtru.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Danh sách SVLT tam tru </button>";
                        echo "</form>";
                        echo "</div>";
                    ?>
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
                            <th> </th>
                            <th>STT</th>
                            <th>MÃ SVLT</th>
                            <th>HỌ VÀ TÊN </th>
                            
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
                            <th>NGÀY NỘI TRÚ</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_LIENTHONG,a.MASV,a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                    . "b.NGAYNOITRU,c.MALOPLT from lienthong a,"
                                    . "dssvltnoitru b,loplt c where a.ID_LIENTHONG =b.ID_LIENTHONG and "
                                    . "b.ID_PHONG=$idphong and a.ID_LOP =c.ID_LOPLT and "
                                    . "a.ID_LIENTHONG not in (select ID_LIENTHONG from dangkytamtrult "
                                    . "where ID_LIENTHONG is not null)";// from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            //echo $stSQL;
                            $result = mysqli_query($link,$stSQL);  
                            $totalRows=mysqli_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                
                                    echo"<tr>";
                                    echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_LIENTHONG"]."\"> </td>";
                                    echo "<td>"; echo $i; echo "</td>";
                                    echo "<td>"; echo $row["MASV"]; echo "</td>";
                                    echo "<td>"; echo $row["HODEM"]; echo ' ';echo $row["TEN"]; echo "</td>";
                                    
                                    echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                    if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }
                                    echo "<td>"; echo $row["MALOPLT"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYNOITRU"]; echo "</td>";
//                                    echo "<td>";
                                    
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoadangkytamtru('".$row["ID_DANGKYTAMTRU"]."')\">Xóa</a></button>";
                                   
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
