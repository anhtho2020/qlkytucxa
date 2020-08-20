<?php
    session_start();
    if(!isset($_SESSION["quyen"]) || ($_SESSION["quyen"]!="QT" && $_SESSION["quyen"]!="KTKTX" && $_SESSION["quyen"]!="CTCTHT")){
        echo "<script>";
        echo "alert('Ban khong co quyen quan tri');";
        echo "window.location=\"index.php\";";
        echo "</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="nthieu">
    <meta name="keyword" content="CTEC">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>HỆ THỐNG QUẢN LÝ KÝ TÚC XÁ | KHOA CNTT - TT</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/isotope/jquery.isotope.css" rel="stylesheet" />
     <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
        <script>
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }
            
            
            //function load_bacdaotao(){
               // var idbdt=document.getElementById('idbacdaotao').value;
                //var url="ktx_sinhvien.php?idbdt="+idbdt;
               // window.location=url;
            //}
            
            function load(){
                var idlcn=document.getElementById('idlopchuyennganh').value;
                var idbdt=document.getElementById('idbacdaotao').value;
                var url="ktx_sinhvien.php?idlcn="+idlcn+"&idbdt="+idbdt;
                window.location=url;
            }
            //function load_phong(){
             //   var idlcn=document.getElementById('idphong').value;
             //   var url="ktx_sinhvien.php?idphong="+idphong;
             //   window.location=url;
           // }
           

           
            
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
    
    
    
    include 'ClassData.php';
        //session_start();
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
       
        $sopt=1;
        if(isset($_POST["chon"])){
            $arr = explode(",",$_POST["chon"]);
            $sopt=count($arr);
        }
        else echo " ";
        
        if(isset($_POST["idday"])){
             $idday=$_POST["idday"];
        }
        else echo " ";
        
        if(isset($_POST["idphong"])){
             $idphong=$_POST["idphong"];
        }
        else echo " ";
        
        if(isset($_POST["idloainoitru"])){
             $idloainoitru=$_POST["idloainoitru"];
        }
        else echo " ";
        
        if(isset($_POST["ngaynoitru"])){
             $nnt=$_POST["ngaynoitru"];
             $x=explode("/", $nnt);
             $ngaynoitru=$x[2]."-".$x[1]."-".$x[0];echo $ngaynoitru;
        }
        else echo " ";
        
        $query_svvpnq="select ID_SINHVIEN from viphamnoiquy";
        $kt_svvpnq=mysql_query($query_svvpnq, $link);
        $arr_svvpnq=array();
        while($row_svvpnq=mysql_fetch_array($kt_svvpnq)){
                $arr_svvpnq[]=$row_svvpnq["ID_SINHVIEN"];
        }
        
        
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
            else{
                $query="insert into danhsachnoitru(ID_SINHVIEN,ID_DAY,ID_PHONG,ID_LOAINOITRU,NGAYNOITRU) values($arr[$i],$idday,$idphong,$idloainoitru,'$ngaynoitru')";
                mysql_query($query, $link);
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
                        Quản lý sinh viên nội trú - Ký túc xá
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
                            
                       echo "<div class=\"form-group\">";
                       echo "</div>";
                       
                       
                        echo "<div>"; 
                        //echo "<caption>Mã lớp</caption>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<th > Bậc đào tạo: </th>";
                            echo "<select name=\"bacdaotao\" id=\"idbacdaotao\" onchange=\"load()\">";
                                
                                echo "<option value=\"1\"";
                                if($kt=="C"){echo " selected=\"selected\"";}
                                echo ">Cao đẳng</option>";
                                
                                echo "<option value=\"2\"";
                                if($kt=="T"){echo " selected=\"selected\"";}
                                echo ">Trung cấp </option>";
                                
                                echo ">";
                            echo "</select>";
                            
                       echo "</tr>";
                       
                        
                        echo "<td width=\"400\"> Mã lớp: </td>";
                        echo "<select name=\"lopchuyennhanh\" id=\"idlopchuyennganh\" onchange=\"load()\">";
                            $query_lcn="select ID_LOPCHUYENNGANH, MALOPCHUYENNGANH from lopchuyennganh where LEFT(MALOPCHUYENNGANH,1)='".$kt."'";
                            echo $query_lcn;
                            $result_lcn=mysql_query($query_lcn, $link);
                            while($row_lcn=  mysql_fetch_array($result_lcn)){
                                echo "<option value=\"".$row_lcn["ID_LOPCHUYENNGANH"]."\"";
                                if($row_lcn["ID_LOPCHUYENNGANH"]==$idlcn){
                                    echo " selected=\"selected\"";
                                }
                                echo ">";
                                echo $row_lcn["MALOPCHUYENNGANH"]."</option>";
                            }
                        echo "</select>";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";
                       
                       
                       
                    echo "<div>"; 
                      echo "<form name=\"themsinhviennoitru\" action=\"ktx_sinhvien.php\" method=\"post\">";
                       
                      //echo "<div class=\"form-group\">";
                            //echo "<label for=\"idday\">ID_DAY</label>";
                            //echo "<input type=\"text\" class=\"form-control\" id=\"idday\" ";
                            //echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                      //echo "</div>";
                       //echo "<select name=\"phong\" id=\"idphong\" onchange=\"load_phong()\">";
                      echo "<div class=\"form-group\">";
                      
                      echo "<tr>";
                        echo "<th > Tên dãy: </th>";
                            echo "<select name=\"idday\" id=\"idday\" >";
                                $query_day="select ID_DAY, TENDAY from day";
                                echo $query_day;
                                $result_day=mysql_query($query_day, $link);
                                while($row_day=  mysql_fetch_array($result_day)){
                                    echo "<option value=\"".$row_day["ID_DAY"]."\"";
                                //if($row_phong["ID_PHONG"]==$idphong){
                                   // echo " selected=\"selected\"";
                                //}
                                    echo ">";
                                    echo $row_day["TENDAY"]."</option>";
                                }
                            echo "</select>";
                       echo "</tr>";
                      
                      
                       echo "<tr>";
                        echo "<th > Tên phòng: </th>";
                            echo "<select name=\"idphong\" id=\"idphong\" >";
                                $query_phong="select ID_PHONG, TENPHONG from phong";
                                echo $query_phong;
                                $result_phong=mysql_query($query_phong, $link);
                                while($row_phong=  mysql_fetch_array($result_phong)){
                                    echo "<option value=\"".$row_phong["ID_PHONG"]."\"";
                                //if($row_phong["ID_PHONG"]==$idphong){
                                   // echo " selected=\"selected\"";
                                //}
                                    echo ">";
                                    echo $row_phong["TENPHONG"]."</option>";
                                }
                            echo "</select>";
                       echo "</tr>";
                       //echo "</div>";
                       //echo "<td>&nbsp</td> ";
                       //echo "<td>&nbsp</td> ";
                       
                       //echo "<div class=\"form-group\">";
                       
                       
                       
                       
                       echo "<tr>";
                       
                            echo "<td> Loại nội trú: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"idloainoitru\" id=\"idloainoitru\" value=\"1\" </td>";
                       echo "</tr>";
                       //echo "</div>";
                       echo "<tr>";
                            echo "<td> Ngày nội trú: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaynoitru\" id=\"ngaynoitru\" value=\"\" </td>";
                       echo "</tr>";
                       //echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row_lcn["ID_LOPCHUYENNGANH"]."\" />";
                      echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                       echo "</div>";
                       
                      echo "</form>";    
                       echo "<div class=\"form-group\">";
                         echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thêm sinh viên nội trú</button>";
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
                            <th>MÃ SINH VIÊN</th>
                            <th>HỌ ĐỆM</th>
                            <th>TÊN</th>
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            </tr>
                          </thead>
                        <?php
                            $totalRows = 0;       
                            $stSQL ="select * from sinhvien where ID_LOPCHUYENNGANH=$idlcn";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            $result = mysql_query($stSQL, $link);  
                            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {   
                                    $i+=1;
                                /*    $fsv=false;
                                    foreach($arr_svvpnq as $vsv){
                                            if($row["ID_SINHVIEN"]==$vsv){$fsv=true;}		
                                    }
                                    
                                    if($fsv)
                                    {
                                        echo"<tr>";
                                        //echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
                                        echo "<td>"; echo $i; echo "</td>";
                                        echo "<td>"; echo $row["MASV"]; echo "</td>";
                                        echo "<td>"; echo $row["HODEM"]; echo "</td>";
                                        echo "<td>"; echo $row["TEN"]; echo "</td>";
                                        echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                        echo "<td><span class=\"badge bg-important\">"; echo $row["PHAI"]; echo "</span></td>";
                                       echo "</tr>";
                                    }
                                    else 
                                    {
                                        */
                                    
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
                                    
                                    
                                    
                                        echo "<tbody>";
                                        echo"<tr>";
                                            echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
                                            echo "<td>"; echo $i; echo "</td>";
                                            echo "<td>"; echo $row["MASV"]; echo "</td>";
                                            echo "<td>"; echo $row["HODEM"]; echo "</td>";
                                            echo "<td>"; echo $row["TEN"]; echo "</td>";
                                            echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                            echo "<td><span class=\"badge bg-important\">"; echo $row["PHAI"]; echo "</span></td>";
                                           echo "<td>";
                                    
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
                                  
                                echo "</td>";
                                
                        echo "</tr>  ";
                                    
                          
                                } 
                            }
                            else
                            {  
                                echo "<tr valign=\"top\">    ";                
                                echo "<td >&nbsp;</td>      ";             
                                echo "<td > ";
                                   echo " <b>";
                                      echo "  <font face=\"Arial\" color=\"#FF0000\">      ";                
                                            echo "Oop! Ship not found!";
                                      echo "  </font>";
                                    echo "</b>";
                                echo "</td>                 ";
                                echo "</tr>                 ";
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
              2015 &copy; Phát triển bởi Nguyễn Minh Đợi - Khoa Công Nghệ Thông Tin - Truyền Thông.
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
