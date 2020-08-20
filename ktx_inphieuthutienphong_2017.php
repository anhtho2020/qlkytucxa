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
            function xoasinhviennoptienphong(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienoptienphong.php?idthutienphongsinhvien="+id;
                }
            }
            function inphieuthu(id){
//                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchieninphieusinhvienoptienphong2017.php?idthutienphongsinhvien="+id;
//                }
            }
            
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_inphieuthutienphong_2017.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
        
    <?php  
     
        //mysql_query("SET CHARACTER SET utf8",$link);
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
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> IN PHIẾU THU TIỀN PHÒNG TỪ 2017 </h2>
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
                        echo "<form name=\"danhsachsinhviennoptienphong\" action=\"ktx_danhsachsinhviennoptienphong_2017.php\" method=\"post\">";
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
                        echo "</form>";  

                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_xuatexceldanhsachsinhviennoptienphong2017.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách </button>";
                        echo "</form>";  
                        echo "</div>"; 
                    
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_thutienphong2017.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Thu tiền phòng sinh viên nội trú </button>";
                        echo "</form>";  
                        echo "</div>"; 

                    ?>
                    

  		</div>                   
		<!--</div>-->
                <!--</div>-->
               <!--<div class="row">-->                  
               <div class="col-lg-12">
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
             
                            <th width="5%">PHÒNG</th>
                            <th width="5%">HỌC KỲ</th>
                            <th width="13%"> NĂM HỌC</th>
                            <th width="5%">ĐƠN GIÁ</th>
                            <th width="13%">NGÀY THU</th>
               
                            <th width="18%">NGƯỜI THU</th>
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                                echo "<th>TÙY CHỌN</th>";   
                            }
                            elseif($_SESSION["quyen"]=="KTKTX")
                            {
                                echo "<th>TÙY CHỌN</th>";
                            }
                            ?>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            $totalRows = 0;       
        $query ="select a.ID_THUTIENPHONGSINHVIEN,a.ID_SINHVIEN,a.SOTHANGNOP,a.DONGIATHANG,a.MUCGIAM,a.THANHTIEN,a.NGAYTHU,a.HOCKY,a.NAMHOC,a.NGUOITHU,b.MAHSSV,"
                . "b.HODEM,b.TEN,b.NGAYSINH,d.TENPHONG from ";
        $query.= "thutienphongsinhvien2017 a,dshssv b,danhsachnoitrum c, phong d where ";
        $query.="a.ID_SINHVIEN=b.ID_DSHSSV and a.ID_SINHVIEN=c.ID_SINHVIEN and c.ID_PHONG=d.ID_PHONG and "
                . "c.ID_PHONG=$idphong";
                //. " and a.ID_THUTIENPHONGSINHVIEN not in (select ID_THUTIENPHONGSINHVIEN from dsphieuthutienphongsinhvien where ID_THUTIENPHONGSINHVIEN is not null)";
        //echo $query;
        $result = mysqli_query($link,$query);  
        $totalRows=mysqli_num_rows($result); 
                            
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatdienchinhsach$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                        echo "<div class=\"modal-dialog\">";
                                             echo "<div class=\"modal-content\">";
                                               echo "<div class=\"modal-header\">";
                                                   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                   echo " <h4 class=\"modal-title\">Cập nhật thông tin sinh viên nộp tiền phòng</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatthongtinsinhviennoptienphong2017.php\" method=\"post\">";
                                                         
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\"masv\"> Mã sinh viên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MAHSSV"]."\""; 
                                                                   echo "name=\"masv\" placeholder=\"\">";
                                                         echo "</div>";
                                                        
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\"sothangnop\"> Số tháng nộp</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"sothangnop\" value=\"".$row["SOTHANGNOP"]."\""; 
                                                                   echo "name=\"sothangnop\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"dongiathang\"> Đơn giá tháng </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"dongiathang\" value=\"".$row["DONGIATHANG"]."\" "; 
                                                                   echo "name=\"dongiathang\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"mucgiam\"> Mức giảm </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"mucgiam\" value=\"".$row["MUCGIAM"]."\" "; 
                                                                    echo "name=\"mucgiam\" placeholder=\"\">";
                                                         echo "</div>";

							echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaythu\"> Ngày thu </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaythu\" value=\"".$row["NGAYTHU"]."\" "; 
                                                                    echo "name=\"ngaythu\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                            echo "<label for=\"hocky\"> Học kỳ</label>";
                                                            echo "<input type=\"text\" class=\"form-control\" id=\"hocky\" value=\"".$row["HOCKY"]."\" "; 
                                                            echo "name=\"hocky\" placeholder=\"\">";
                                                        echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"namhoc\"> Năm học </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"namhoc\" value=\"".$row["NAMHOC"]."\" "; 
                                                                    echo "name=\"namhoc\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"nguoithu\"> Người thu </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
                                                                    echo "name=\"nguoithu\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         //echo "<div class=\"form-group\">";
                                                             //echo "<label for=\"dienchinhsach\"> Diện chính sách </label>";
                                                             //echo "<input type=\"text\" class=\"form-control\" id=\"dienchinhsach\" value=\"".$row["DIENCHINHSACH"]."\" "; 
                                                                    //echo "name=\"dienchinhsach\" placeholder=\"\">";
                                                         //echo "</div>";
                                                         //echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row["ID_PHONG"]."\" />";
                                                         //echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row["ID_SINHVIEN"]."\" />";
                                                         echo "<input type=\"hidden\" name=\"idthutienphongsinhvien\" value=\"".$row["ID_THUTIENPHONGSINHVIEN"]."\" />";
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
                                <td><?=$row["HODEM"]?> <?=' '?><?=$row["TEN"]?></td>
                                
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["HOCKY"]?></td>
                                <td><?=$row["NAMHOC"]?></td>
                                <td><?=$row["THANHTIEN"]?></td>
                                <td><?=$row["NGAYTHU"]?></td>
                                <td><?=$row["NGUOITHU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    
                                    echo "<a href=\"#modalcapnhatdienchinhsach$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhviennoitru('".$row["ID_SINHVIEN"]."')\">Sửa</a></button>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviennoitru('".$row["ID_SINHVIEN"]."')\">Xóa</a></button>";
                                    echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthu('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">In phiếu thu</a></button>";
                                  
                                echo "</td>";
                                }
                                else if($_SESSION["quyen"]=="KTKTX")
                                    {
                                        echo"<td>";
                                        echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviennoptienphong('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">Xóa</a></button>";
                                        //echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieuthu('".$row["ID_THUTIENPHONGSINHVIEN"]."')\">In phiếu thu</a></button>";
                                        echo"</td>";
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
              <!--</div>-->                         
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
    
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
