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
    <!--<meta name="keyword" content="CTEC">-->
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
    <style rel='stylesheet' type='text/css'>
            body {
                margin: 0;
            }
            th, tfoot td {
                /*border: thin solid black;*/
                text-align: left;
                font-weight: bold;
                font-size: 130%;
            }
            tbody td {
                font-size: 120%;
                font-weight: bold;
            }
            body, td, div{
                    font-family:Arial, Helvetica, sans-serif;
                    font-size:12px; line-height:14px;
                    color:#838486;
                    font-weight:bold;
            }
            input{
                    height:30px;
                    font-weight:bold;
                    text-indent:3px;
            }
        </style>
  </head>

    <body>
        <script>
            function xoasinhviennoitru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienviphamnoiquy.php?idsinhvien="+id;
                }
            }
        </script>
    <?php  
        include 'ClassData.php';
    include 'dbcon.php';
    $link=  clsConnet::DBConnect();

        $totalRows = 0;       
        $query ="select a.ID_SINHVIEN,a.THANHTIEN,a.NGAYTHU,a.HOCKY,a.NAMHOC,b.MAHSSV,b.HODEM,b.TEN,b.NGAYSINH,"
                . "c.TENPHONG,LEFT(c.TENPHONG,1) as DAY "
                . "from thutienphongsinhvien2017 a,dshssv b, phong c, danhsachnoitrum d "
                . "where a.ID_SINHVIEN=b.ID_DSHSSV and d.ID_SINHVIEN=a.ID_SINHVIEN and c.ID_PHONG=d.ID_PHONG ";//echo $query;
        $result = mysqli_query($link,$query);  
        $totalRows=mysqli_num_rows($result); 
        
        
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
                        <h2> Danh sách HSSV nộp tiền phòng theo học kỳ- năm học 2017</h2>
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
                        echo "<form name=\"xuatexcelbangkethutienphongtungaydenngay\" action=\"ktx_xuatexcel_tk_sv_da_noptienphong_hk_nh2017.php\" method=\"post\">";
                        echo "<tr>";
                            echo "<td> Học kỳ: </td>";
                            echo "<td> <input type=\"text\" name=\"hocky\" id=\"hocky\" size=\"1\" maxlength=\"2\" value=\"\"> </td>";
                            echo "<td> Năm học: </td>";
                            echo "<td> <input type=\"text\" name=\"namhoc\" id=\"namhoc\" size=\"10\" maxlength=\"10\" value=\"\"> </td></br></br>";
                        echo "</tr>";
//                        echo "<tr>";
//                            echo "<td> Từ ngày: </td>";
//                            echo "<td> <input type=\"date\" name=\"tungay\" id=\"tungay\" value=\"\"> </td>";
//                            echo "<td> Đến ngày: </td>";
//                            echo "<td> <input type=\"date\" name=\"denngay\" id=\"denngay\" value=\"\"> </td></br></br>";
//                        echo "</tr>";
                        echo "<input type=\"submit\" class=\"btn btn-info\" value=\"In danh sách\">";
                        echo "</form>";   
                        echo "</div>"; 
                       ?>
                </div>
                </div>
               <div class="row">                  
               <div class="col-lg-10">
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

                                <!--<th width="13%">NGÀY SINH</th>-->
                                
                                <td width="5%">PHÒNG</td>
                                <td width="5%">DÃY</td>
                                <td width="8%">SỐ TIỀN</td>
                                <td width="13%">NGÀY NỘP TIỀN</td>
                                <td width="5%">HỌC KỲ</td>
                                <td width="13%">NĂM HỌC</td>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                             $i+=1;

                                echo "<div class=\"modal fade\" id=\"modalsuasinhvienvipham$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật sinh viên vi phạm</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"capnhatsinhvienvipham.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenphong\">Tên phòng</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row_phong["TENPHONG"]."\" "; 
                                                           echo "name=\"tenphong\" placeholder=\"Nhập tên phòng\">";
                                                echo "</div>";
                                                
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"idday\">ID_DAY</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"idday\" value=\"".$row["ID_DAY"]."\""; 
                                                          echo "name=\"idday\" placeholder=\"Nhập id_day\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"ngayvipham\">Ngày vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngayvipham\" value=\"".$row["NGAYVIPHAM"]."\" "; 
                                                          echo "name=\"ngayvipham\" placeholder=\"Nhập ngày vi phạm\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"hinhthucvipham\">Hình thức vi phạm</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hinhthucvipham\" value=\"".$row["HINHTHUCVIPHAM"]."\" "; 
                                                          echo "name=\"hinhthucvipham\" placeholder=\"Hình thức vi phạm\">";
                                                echo "</div>";
                                                echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row["ID_PHONG"]."\" />";
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
                                <td><?=$row["MAHSSV"]?></td>
                                <td><?=$row["HODEM"]?><?=" "?><?=$row["TEN"]?></td>
                                
                                
                                
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["DAY"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["HOCKY"]?></td>
                                <td><?=$row["NAMHOC"]?></td>
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
      <footer class="site-footer">
          <div class="text-center">
              2015 &copy; Phát triển bởi Nguyễn Minh Đợi- Khoa Công Nghệ Thông Tin - Truyền Thông.
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