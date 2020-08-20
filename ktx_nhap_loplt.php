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
                    height:20px;
                    font-weight:bold;
                    text-indent:3px;
            }
        </style>
  </head>

  <body>
    <script>
            function xoaloplt(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaloplt.php?idloplt="+id;
                }
            }

            function load(){
                var idbdt=document.getElementById('idbacdaotao').value;
                var idng=document.getElementById('idnganh').value;
                var idtr=document.getElementById('idtruong').value;
                var url="ktx_nhap_loplt.php?idbdt="+idbdt+"&idng="+idng+"&idtr="+idtr;
                window.location=url;
            }
        </script>
    <?php  
        
        include 'dbcon.php';
        $link=  clsConnet::DBConnect();

        $idbdt=0;
        if(isset($_GET["idbdt"])){
            $idbdt=$_GET["idbdt"];
        }
        
        
        if($idbdt==1)
            {
                $kt=1;
            }
            else if($idbdt==2)
            {
                $kt=2;
            }
            else {
                $kt=0;
            }
        $idng=0;
        if(isset($_GET["idng"])){
            $idng=$_GET["idng"];
        }
        $idtr=0;
        if(isset($_GET["idtr"])){
            $idtr=$_GET["idtr"];
        }
        
            $bachoc=0;
        if(isset($_POST["bachoc"])){
             $bachoc=$_POST["bachoc"];
        }
        else echo " ";
        $nganh=0;
        if(isset($_POST["nganh"])){
             $nganh=$_POST["nganh"];
        }
        else echo " ";
        
        $truong=0;
        if(isset($_POST["truong"])){
             $truong=$_POST["truong"];
        }
        else echo " ";
        $malop='';
        if(isset($_POST["malop"])){
             $malop=$_POST["malop"];
        }
        else echo " ";
        $tenlop='';
        if(isset($_POST["tenlop"])){
             $tenlop=$_POST["tenlop"];
        }
        else echo " ";
 
        if($malop != '' && $tenlop != '')
        {
            $query="insert into loplt(ID_BACHOC,ID_NGANH,ID_TRUONG,MALOPLT,TENLOPLT) "
                    . "values($bachoc,$nganh,$truong,'$malop','$tenlop')";
                    mysqli_query($link,$query);
            //echo $query;
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
               <!--<div class="row">-->
               <!--<div class="col-lg-12 selecthk">-->
               <!--<div class="panel panel-default">-->
                    <header class="panel-heading">
                        <h2> Thêm lớp vào danh sách </h2>
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
                        echo "<th > Bậc đào tạo: </th>";
                            echo "<select name=\"bacdaotao\" id=\"idbacdaotao\" onchange=\"load()\">";
                                echo "<option value=\"0\"";
                                if($kt==0){echo " selected=\"selected\"";}
                                echo ">Bac hoc</option>";
                                echo "<option value=\"1\"";
                                if($kt==1){echo " selected=\"selected\"";}
                                echo ">Cao đẳng</option>";
                                echo "<option value=\"2\"";
                                if($kt==2){echo " selected=\"selected\"";}
                                echo ">Đại học </option>";
                                echo ">";
                            echo "</select>";
                        echo "<th width=\"400\"> Mã ngành: </th>";
                        echo "<select name=\"nganh\" id=\"idnganh\" onchange=\"load()\">";
                            $query_nganh="select ID_NGANH,MANGANH, TENNGANH from nganhlt";
                            $result_nganh=mysqli_query($link,$query_nganh);
                            while($row_nganh=  mysqli_fetch_array($result_nganh)){
                                echo "<option value=\"".$row_nganh["ID_NGANH"]."\"";
                                if($row_nganh["ID_NGANH"]==$idng){
                                    echo " selected=\"selected\"";
                                }
                                echo ">";
                                echo $row_nganh["MANGANH"]."</option>";
                            }
                        echo "</select>";
                        
                        
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th width=\"400\"> Mã trường: </th>";
                        echo "<select name=\"truong\" id=\"idtruong\" onchange=\"load()\">";
                            $query_truong="select ID_TRUONG,MATRUONG,TENTRUONG from truong";
                            $result_truong=mysqli_query($link,$query_truong);
                            while($row_truong=  mysqli_fetch_array($result_truong)){
                                echo "<option value=\"".$row_truong["ID_TRUONG"]."\"";
                                if($row_truong["ID_TRUONG"]==$idtr){
                                    echo " selected=\"selected\"";
                                }
                                echo ">";
                                echo $row_truong["MATRUONG"]."</option>";
                            }
                        echo "</select>";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";
                    
                        echo "<div class=\"form-group\">";
                        echo "<form name=\"themloplt\" action=\"ktx_nhap_loplt.php\" method=\"post\">";
                        
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<th> Mã lớp: </th>";
                        echo "<td> <input type=\"text\" name=\"malop\" id=\"malop\" size=\"10\" maxlength=\"12\" value=\"\"> </td>";
                        
                        echo "<td> Tên lớp: </td>";
                            echo "<td> <input type=\"text\" name=\"tenlop\" id=\"tenlop\" size=\"34\" maxlength=\"34\" value=\"\"></td>";
                        echo "</tr>";
                       echo "</div>";
                       
                       echo "<input type=\"hidden\" name=\"bachoc\" value=\"".$idbdt."\" />";
                       echo "<input type=\"hidden\" name=\"nganh\" value=\"".$idng."\" />";
                       echo "<input type=\"hidden\" name=\"truong\" value=\"".$idtr."\" />";

                       if($_SESSION["quyen"]=="QT")
                        {
                        echo "<button type=\"submit\" class=\"btn btn-info\">Thực hiện </button>";
                        }
                        echo "</form>";  
                        echo "</div>"; 
                        
                        echo "<div class=\"form-group\">";
                        echo "</div>"; 
                       
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_xuatexceldanhsachloplt.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách lớp liên thông </button>";
                        echo "</form>";  
                        echo "</div>"; 

                    ?>
                    
            <div class="row">                  
               <div class="col-lg-8">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                        <table class="table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:20px">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>NGÀNH</th>
                                    <th>TRƯỜNG</th>
                                    <th>MÃ LỚP</th>
                                    <th>TÊN LỚP</th>
                                    
                                    <?php
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                              echo "<th>Tùy chọn</th>";
                                    }

                                    ?>

                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $totalRows_lop = 0;       
                                $query_lop ="select a.ID_LOPLT,a.MALOPLT,a.TENLOPLT,b.MANGANH,c.MATRUONG,b.ID_NGANH,c.ID_TRUONG "
                                        . " from loplt a,nganhlt b, truong c where a.ID_NGANH=b.ID_NGANH "
                                        . " and a.ID_TRUONG=c.ID_TRUONG";  
                                $result_lop = mysqli_query($link,$query_lop);  
                                $totalRows_lop=mysqli_num_rows($result_lop);
                                    if($totalRows_lop>0)   
                                    {    
                                        $i=0;                    
                                        while ($row = mysqli_fetch_array ($result_lop))     
                                        {   
                                            $i+=1;
                                            
                                            //Cập nhật sinh viên
                            echo "<div class=\"modal fade\" id=\"modalcapnhatloplt$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                               echo "<div class=\"modal-dialog\">";
                                    echo "<div class=\"modal-content\">";
                                      echo "<div class=\"modal-header\">";
                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                          echo " <h4 class=\"modal-title\">Cập nhật lớp liên thông</h4>";
                                        echo "</div>";
                                        echo "<div class=\"modal-body\">";
                                            echo "<form role=\"form\" action=\"thuchiencapnhaloplt.php\" method=\"post\">";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"matruong\">Mã trường</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"matruong\" value=\"".$row["MATRUONG"]."\""; 
                                                          echo "name=\"matruong\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"manganh\">Mã ngành </label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"manganh\" value=\"".$row["MANGANH"]."\""; 
                                                          echo "name=\"manganh\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"malop\">Mã lớp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"malop\" value=\"".$row["MALOPLT"]."\""; 
                                                          echo "name=\"malop\" placeholder=\"\">";
                                                echo "</div>";
                                                echo "<div class=\"form-group\">";
                                                    echo "<label for=\"tenlop\">Tên lớp</label>";
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenlop\" value=\"".$row["TENLOPLT"]."\" "; 
                                                          echo "name=\"tenlop\" placeholder=\"\">";
                                                echo "</div>";
                                                
                                                echo "<input type=\"hidden\" name=\"idloplt\" value=\"".$row["ID_LOPLT"]."\" />";
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
                                  <td><?=$row["MANGANH"]?></td>
                                  <td><?=$row["MATRUONG"]?></td>
                                  
                                  <td><?=$row["MALOPLT"]?></td>
                                  <td><?=$row["TENLOPLT"]?></td>
                                  <?php
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                              echo "<td>";
                                                //echo "<a href=\"ktx_edit.php?idphong=".$row_phong["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                        echo "<a href=\"#modalcapnhatloplt$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                        //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoaloplt('".$row["ID_LOPLT"]."')\">Xóa</a></button>";
                                              echo "</td>";
                                    }

                                    ?>
              
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
