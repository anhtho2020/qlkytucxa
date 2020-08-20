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
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }
            
            function load(){
//                var idlcn=document.getElementById('idlopchuyennganh').value;
//                var idbdt=document.getElementById('idbacdaotao').value;
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_khachthuephong.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.themkhachthuephong.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một khách');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";

    

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
        $idphong=1;
        if(isset($_GET["idphong"])){
             $idphong=$_GET["idphong"];
        }
        else echo " ";
        $iphong=1;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
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
 
    if($slsv==8)
        {
            echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Phòng đầy!');";
                echo "</script>";
        }
        elseif ($sopt-1+$slsv>8) 
        {
            echo "<script>";
            //echo "alert(str);"; 
            echo "alert('Số lượng đăng ký nhiều hơn số chỗ, không thể đăng ký phòng nầy!');";
            echo "</script>";
        } 
        else
        {
            for($i=0; $i<$sopt-1; $i++){

               $query="insert into dskhachnoitru(ID_KHACH,ID_PHONG,NGAYNOITRU) "
                        . "values($arr[$i],$iphong,'$ngaynoitru')";
                //echo $query;
            mysqli_query($link,$query); 
                
        }
    }
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
                        <h2> Khách đăng ký mướn phòng </h2>
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
                        echo "<form name=\"themkhachthuephong\" action=\"ktx_khachthuephong.php\" method=\"post\">";
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
                            
                                $query_phong="select ID_PHONG,ID_DAY, TENPHONG from phong "
                                        . "where ID_DAY=$idday";
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
//                        echo $idphong;
                            $query_slsv="select * from dskhachnoitru where ID_PHONG=$idphong";
                            $result_slsv = mysqli_query($link,$query_slsv);  
                            $totalRows_slsv=mysqli_num_rows($result_slsv);
//                            echo $totalRows_slsv;
//                            $query_slsvlt="select * from dssvltnoitru where ID_PHONG=$idphong";
//                            $result_slsvlt = mysql_query($query_slsvlt, $link);  
//                            $totalRows_slsvlt=mysql_num_rows($result_slsvlt);
//                          $sum=$totalRows_slsv+$totalRows_slsvlt;
                            echo "<th> Số lượng đã đăng ký: </th>";
                            echo "<td> <input type=\"text\" name=\"sldadangky\" id=\"sldadangky\" size=\"1\" maxlength=\"2\" value=\"".$totalRows_slsv."\"> </td>";
                        echo "</tr>";
                        echo "<tr>";
                        $slcothedangky=8-$totalRows_slsv;
                        echo "<td> Số lượng có thể đăng ký: </td>";
                            echo "<td> <input type=\"text\" name=\"slcothedangky\" id=\"slcothedangky\" size=\"1\" maxlength=\"2\" value=\"".$slcothedangky."\"></td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            $now = getdate(); 
                            $ngnoitru=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày mướn phòng: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaynoitru\" id=\"ngaynoitru\" size=\"10\" maxlength=\"12\" value=\"".$ngnoitru."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<input type=\"hidden\" name=\"iphong\" id=\"iphong\" value=\"".$idphong."\"";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";

                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                       echo "</div>";
                       
                      echo "</form>";    
                       echo "<div class=\"form-group\">";
                       if($_SESSION["quyen"]=="QT")
                        {
                         echo "<button onclick=\"tht()\" class=\"btn btn-info\"> Đăng ký </button>";
                        }
                         echo "</div>"; 
                         
                         echo "<div>";
                        echo "<form name=\"themkhach\" action=\"ktx_danhsachkhachmuonphong.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Danh sách khách mướn phòng </button>";
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
                            <th>MÃ KHÁCH</th>
                            <th>HỌ VÀ TÊN </th>
                            
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>CMND</th>
                            <th>ĐỊA CHỈ</th>
                            <th> ĐIỆN THOẠI </th>
                            
                            </tr>
                          </thead>
                        <?php
                            echo "<tbody>";
                            $totalRows = 0;       
                            $stSQL ="select ID_KHACH,MAKHACH, HODEM,TEN,NGAYSINH,PHAI,CMND,DIACHI, "
                                    . "DIENTHOAI from khach where ID_KHACH not in "
                                    . "(select ID_KHACH from dskhachnoitru where ID_KHACH is not null)";// where ID_LOPCHUYENNGANH=$idlcn";// and xoaten=0 and datotnghiep=0 and not in ()";  
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
