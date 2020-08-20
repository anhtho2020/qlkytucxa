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
            function xoatrangbi(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoatrangbi.php?idtrangbi="+id;
                }
            }
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_trangbi.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
      
    <?php  
        require("dbcon.php");  
        
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
        
        
        
//        if(isset($_POST["ngayviphamnoiquy"])){
//             $nnt=$_POST["ngayviphamnoiquy"];
//             $x=explode("/", $nnt);
//             $ngayviphamnoiquy=$x[2]."-".$x[1]."-".$x[0];//echo $ngayviphamnoiquy;
//        }
//        else echo " ";
        
        $totalRows_trangbi = 0;       
        $stSQL_trangbi ="select * from trangbi";  
        $result_trangbi = mysql_query($stSQL_trangbi, $link);  
        $totalRows_trangbi=mysql_num_rows($result_trangbi); 
        
        $tenphong='';
//        if(isset($_POST["tenphong"])){
//            $tenphong = $_POST["tenphong"];
//        }
//        else {
//            echo " ";
//        }
        $mataisan='';
        if(isset($_POST["mataisan"])){
            $mataisan = $_POST["mataisan"];
        }
        else {
            echo " ";
        }
        $soluong=0;
        if(isset($_POST["soluong"])){
            $soluong = $_POST["soluong"];
        }
        else {
            echo " ";
        }
  
        $totalRows = 0;       
                    $query ="select * from phong where ID_PHONG=$idphong";  
                    $result = mysql_query($query, $link);  
                    $totalRows=mysql_num_rows($result); 
                    $row = mysql_fetch_array ($result);
                    $tenphong=$row["TENPHONG"];
                    echo $tenphong;
                    echo $mataisan;
                    echo $soluong;
                    echo $ngaytrangbi;
                    
        //$ngaytrangbi='';
            if(isset($_POST["ngaytrangbi"]))
            {
                $dtb=$_POST["ngaytrangbi"];
                $d=explode("/", $dtb);
                $ngaytrangbi=$d[2]."-".$d[1]."-".$d[0];//echo $ngayviphamnoiquy;
                $query="insert into trangbi(TENPHONG,MATAISAN,SOLUONG,NGAYTRANGBI) Values('$tenphong','$mataisan',$soluong,'$ngaytrangbi')";
                mysql_query($query, $link);
            }
            
            
                    
                   

                        
    ?>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Ẩn Menu" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="index.html" class="logo">KTX<span>System</span></a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username">Nguyễn Minh Đợi</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class="icon-credit-card"></i>Thông tin</a></li>
                            <li><a href="#"><i class="icon-table"></i> QL Phòng</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> QL Sinh Viên</a></li>
                            <li><a href="index.php"><i class="icon-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="#">
                          <i class="icon-dashboard"></i>
                          <span>Trang chủ</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" class="active">
                          <i class="icon-edit"></i>
                          <span>Quản lý</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="ktx_phong.php">Phòng</a></li>
                          <li><a  href="#">Cơ sở vật chất</a></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" class="active">
                      <a href="javascript:;">
                          <i class="icon-money"></i>
                          <span>Thu phí KTX</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="ktx_phong.php">Thu tiền phòng</a></li>
                          <li><a  href="#">Thu tiền điện</a></li>
                          <li><a  href="#">Thu tiền nước</a></li>
                      </ul>
                  </li>

                  
                  

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">         
               <div class="row">
               <div class="col-lg-12 selecthk">
               <div class="panel panel-default">
                    <header class="panel-heading">
                            Trang bị tài sản cho phòng- Ký Túc Xá
                            <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                                <a class="icon-remove" href="javascript:;"></a>
                            </span>
                    </header>
                    <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i>Trở về</a>                              
                    </div>
  		</div>
                </div>                    
                </div>
                
                <?php
                     
                    echo "<div>"; 
                        echo "<form name=\"thuchientrangbi\" action=\"ktx_trangbi.php\" method=\"post\">";
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
                                    echo "<option value=\"1\"";
                                    if($kt==1){echo " selected=\"selected\"";}
                                    echo ">Ten phong</option>";
                                
                                    $query_phong="select ID_PHONG,ID_DAY,TENPHONG from phong where ID_DAY=$idday";
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
                            
                            echo "<td width=\"400\"> Mã tài sản: </td>";
                                echo "<select name=\"mataisan\" id=\"mataisan\" >";
                                $query_ts="select MATAISAN from taisan";// where LEFT(MALOPCHUYENNGANH,1)='".$kt."'";
                                $result_ts=mysql_query($query_ts, $link);
                                while($row_ts=  mysql_fetch_array($result_ts)){
                                    echo "<option value=\"".$row_ts["MATAISAN"]."\"";
                                    echo " selected=\"selected\"";
                                    echo ">";
                                    echo $row_ts["MATAISAN"]."</option>";
                                }
                            echo "</select>";
                            
                            echo "</tr>";
    
                            echo "<tr>";
                                echo "<td> Số lượng: </td>";
                                echo "<td>&nbsp</td> ";
                                echo "<td width=\"60\"> <input type=\"number\" name=\"soluong\" id=\"soluong\" value=\"1\" </td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td> Ngày trang bị: </td>";
                                echo "<td> <input type=\"text\" name=\"ngaytrangbi\" id=\"ngaytrangbi\" value=\"\" </td>";
                            echo "</tr>";

                            echo "</div>";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Thực hiện trang bị tài sản</button>";
                        echo "</form>"; 
                    echo "</div>"; 
                    
                    

                   
                    
                ?>
                <div class="row">                  
                <div class="col-lg-12">
                <div class="panel">
  		<div class="panel-body">
                <div class="adv-table editable-table ">
                        <!--  
                        <div class="clearfix">
                              <div class="btn-group">
                                  <button id="editable-sample_new" class="btn btn-success">
                                      <i class="icon-plus"></i> Thêm sinh viên
                                  </button>
                              </div>                              
                          </div>
                         -->   
                    
<!--                        <div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="##modalupexcel" ><i class="icon-cloud-upload"></i> Thực hiện trang bị tài sản </button>
                             
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Trang bị tài sản</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="thuchientrangbi.php" method="post">
                                                <div class="form-group">
                                                    <label for="tenphong">Tên phòng</label>
                                                    <input type="text" class="form-control" id="tenphong" 
                                                           name="tenphong" placeholder="Nhập tên phòng">
                                                </div>
                                                <div class="form-group">
                                                    <label for="mataisan">Mã tài sản</label>
                                                    <input type="text" class="form-control" id="mataisan" 
                                                           name="mataisan" placeholder="Nhập mã tài sản">
                                                </div>
                                                <div class="form-group">
                                                    <label for="soluong">Số lượng</label>
                                                    <input type="number" class="form-control" id="soluong" 
                                                           name="soluong" placeholder="Nhập số lượng tài sản">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ngaytrangbi">Ngày trang bị</label>
                                                    <input type="text" class="form-control" id="ngaytrangbi" 
                                                           name="ngaytrangbi" placeholder="">
                                                </div>

                                                <button type="submit" class="btn btn-info">Thêm</button>
                                            </form>                                               
                                            End of Success             
                                        </div> End of ModalBody
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                                   
                        </div>-->
                    
                    
                    
                        <table class="table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:20px">
                              <thead>
                              <tr>
                                    <th>STT</th>
                                    <th>Tên phòng</th>
                                    <th>Mã tài sản</th>
                                    <th>Số lượng</th>
                                    <th>Ngày trang bị</th>
                                    <th>Tùy chọn</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                                    if($totalRows_trangbi>0)   
                                    {    
                                        $i=0;                    
                                        while ($row_trangbi = mysql_fetch_array ($result_trangbi))     
                                        {   
                                            $i+=1;
                                            //Cập nhật khách
                            echo "<div class=\"modal fade\" id=\"modalcapnhattrangbi$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật trang bi</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhattrangbi.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_trangbi["TENPHONG"]."\""; 
                                                          echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"mataisan\">Mã tài sản</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"mataisan\" value=\"".$row_trangbi["MATAISAN"]."\" "; 
                                                          echo "name=\"mataisan\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"soluong\">Số lượng tài sản</label>";
                                                    echo "<input type=\"number\" class=\"form-control\" id=\"soluong\" value=\"".$row_trangbi["SOLUONG"]."\" "; 
                                                           echo "name=\"soluong\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngaytrangbi\">Ngày trang bị</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaytrangbi\" value=\"".$row_trangbi["NGAYTRANGBI"]."\" "; 
                                                           echo "name=\"ngaytrangbi\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idtrangbi\" value=\"".$row_trangbi["ID_TRANGBI"]."\" />";
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
                              
                              <tr class="">
                                  <td><?=$i?></td>
                                  <td><?=$row_trangbi["TENPHONG"]?></td>
                                  <td><?=$row_trangbi["MATAISAN"]?></td>
                                  <td><?=$row_trangbi["SOLUONG"]?></td>
                                  <td><?=$row_trangbi["NGAYTRANGBI"]?></td>
                                  <td>
                                     <?php
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapnhattrangbi$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoatrangbi('".$row_trangbi["ID_TRANGBI"]."')\">Xóa</a></button>";
                                    
                                  ?>
                                </td>
                              </tr>
                              <?php  
                                    } 
                                }
                                else
                                {  
                                ?>                 
                                    <tr valign="top">                    
                                        <td >&nbsp;</td>                   
                                        <td > 
                                            <b>
                                                <font face="Arial" color="#FF0000">                      
                                                    Oop! Ship not found!
                                                </font>
                                            </b>
                                        </td>                 
                                    </tr>                 
                                <?php   
                                } 
                                ?>
                            </tbody>
                        </table>
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
    <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script src="js/Entity_Edit.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

  <script>
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
	$('#my_multi_select1').multiSelect();
          jQuery(document).ready(function() {
              EditableTable.init();
          });
  </script>

  </body>
</html>
