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
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhvienoptienphong.php?idthutienphongsinhvien="+id;
                }
            }
            function inphieu(id){
                if(confirm(' Bạn có chắc in phiếu này?')){
                    window.location="thuchieninphieuthutienphongsinhvien.php?idthutienphongsinhvien="+id;
                }
            }

            function load(){
                
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var hocky=document.getElementById('hocky').value;
                var url="thp_thuhocphi.php?idday="+idday+"&idphong="+idphong+"&hocky="+hocky;
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
                echo "document.thutienphong.submit();";  
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
//        echo $idphong;
        $hocky=1;
        if(isset($_GET["hocky"])){
            $hocky=$_GET["hocky"];
        }
        if($hocky==1)
            {
                $kthk="1";
            }
            else
            {
                $kthk="2";
            }
        
        $sotien=1;
        if(isset($_POST["sotien"])){
             $sotien=$_POST["sotien"];
        }
        else echo " ";

        $ngaythu='';
        if(isset($_POST["ngaythu"])){
             $nnt=$_POST["ngaythu"];
             $x=explode("/", $nnt);
             $ngaythu=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
        $hocky='';
        if(isset($_POST["hocky"])){
             $hocky=$_POST["hocky"];
        }
        else echo " ";
        
        $namhoc='';
        if(isset($_POST["namhoc"])){
             $namhoc=$_POST["namhoc"];
        }
        else echo " ";
        
        $nguoithu='';
        if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        }
        
        
        $kt=0;
        for($i=0; $i<$sopt-1; $i++)
        {
            $query_dk="select * from thuhocphi ";//echo $query_dk;
            $result_dk = mysql_query($query_dk, $link);  
            $totalRows_dk=mysql_num_rows($result_dk); 
            while ($row = mysql_fetch_array ($result_dk))
            {
                if(($row["ID_SINHVIEN"]==$arr[$i])&&($row["HOCKY"]==$hocky)&&($row["NAMHOC"]==$namhoc))
                    $kt+=1;
                
            }
            if($kt>=1)
            {
                echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Đã nộp tiền học kỳ năm học này');";
                echo "</script>";
            }
            else {
                
                $query_dcs="select * from sinhvien where ID_SINHVIEN=$arr[$i]";//echo $query_dk;
                $result_dcs = mysql_query($query_dcs, $link);  
                $totalRows_dcs=mysql_num_rows($result_dcs); 
                $row_dcs = mysql_fetch_array ($result_dcs);
                $ngheo="Nha ngheo";
                $contb="Con thuong binh";
                $bodoi="Bo doi xuat ngu";
                $tuquan="Tu quan";
                $ngheo=addslashes($ngheo);
                $contb=addslashes($contb);
                $bodoi=addslashes($bodoi);
                $tuquan=addslashes($tuquan);
                $st=$sotien;
                if($row_dcs["DIENCHINHSACH"]==$ngheo || $row_dcs["DIENCHINHSACH"]==$tuquan || $row_dcs["DIENCHINHSACH"]==$contb)
                {
                    $st=0;
                
                }
                else if($row_dcs["DIENCHINHSACH"]==$bodoi)
                {
                    $st=$st*1/2;
                }
                else 
                {
                    $st=$sotien;
                }
                
                $query="insert into thuhocphi(ID_SINHVIEN,DONGIA,NGAYTHU,HOCKY,NAMHOC,NGUOITHU) "
                               . "values($arr[$i],$st,'$ngaythu','$hocky','$namhoc','$nguoithu')";
                       mysql_query($query, $link);
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
                        <h2> Thu tiền phòng HSSV nội trú </h2>
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
                        echo "<form name=\"thutienphong\" action=\"thp_thuhocphi.php\" method=\"post\">";
                       
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
                        
                        $ktt=1;
                        echo "<tr>";
                        echo "<th > Tên phòng: </th>";
                            echo "<select name=\"idphong\" id=\"idphong\" onchange=\"load()\">";
                                echo "<option value=\"1\"";
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
                        
                        echo "<tr>";
                        echo "<th > Học kỳ: </th>";
                            echo "<select name=\"hocky\" id=\"hocky\" onchange=\"load()\">";
                                
                                echo "<option value=\"1\"";
                                if($kthk=="1"){echo " selected=\"selected\"";}
                                echo ">1</option>";
                                
                                echo "<option value=\"2\"";
                                if($kthk=="2"){echo " selected=\"selected\"";}
                                echo ">2 </option>";
                                
                                echo ">";
                            echo "</select>";
                            
                       echo "</tr>";
                       
                        echo "<tr>";
                        $now = getdate(); 
                        $namsau=$now["year"]+1;
                        $namtruoc=$now["year"]-1;
                            if($hocky==1)
                            {
                                $nhoc=$now["year"]."-".$namsau;
                            }
                            else {
                                $nhoc=$namtruoc."-".$now["year"];
                            }
                            echo "<td> Năm học: </td>";
                            echo "<td> <input type=\"text\" name=\"namhoc\" id=\"namhoc\" size=\"10\" maxlength=\"10\" value=\"".$nhoc."\" </td>";
                        echo "</tr>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Số tiền: </td>";
                            echo "<td> <input type=\"text\" name=\"sotien\" id=\"sotien\" size=\"4\" maxlength=\"4\" value=\"450000\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                        
                        $ngthu=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                        echo "<td> Ngày thu: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaythu\" id=\"ngaythu\" size=\"10\" maxlength=\"10\" value=\"".$ngthu."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
                            echo "<input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"\" </td>";
                        echo "</tr>";
                        
                        
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";

                        
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
                        if($_SESSION["quyen"]=="QT")
                        {

                        echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thu tiền phòng</button>";
                        }
                        echo "</div>"; 

                        echo "</div>"; 
                    ?>
                    <div class="form-group">
                        <form role="form" action="ktx_danhsachsinhviennoptienphong.php" method="post">                                                   
                        <button type="submit" class="btn btn-info"> Danh sách HSSV nộp tiền phòng</button>
                    </form>     
                    </div>   
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
                            <th>MÃ HSSV</th>
                            <th> HỌ VÀ TÊN </th>
                            
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
                            <th>PHÒNG</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_SINHVIEN,b.MASV, b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,c.MALOPCHUYENNGANH,d.TENPHONG  "
                                    . "from danhsachnoitru a, sinhvien b,lopchuyennganh c,phong d  "
                                    . "where a.ID_SINHVIEN=b.ID_SINHVIEN and b.ID_LOPCHUYENNGANH=c.ID_LOPCHUYENNGANH "
                                    . " and a.ID_PHONG=d.ID_PHONG and a.ID_PHONG=$idphong ";
                                    //. " and b.ID_SINHVIEN not in (select ID_SINHVIEN from thutienphongsinhvien where ID_SINHVIEN is not null)";//$idlcn and ID_SINHVIEN not in (select ID_SINHVIEN from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            //echo $stSQL;
                            $result = mysql_query($stSQL, $link);  
                            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                
                                echo"<tr>";
                                echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
                                echo "<td>"; echo $i; echo "</td>";
                                echo "<td>"; echo $row["MASV"]; echo "</td>";
                                echo "<td>"; echo $row["HODEM"]; echo " "; echo $row["TEN"];echo "</td>";
                                
                                echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }

                                echo "<td>"; echo $row["MALOPCHUYENNGANH"]; echo "</td>";
                                echo "<td>"; echo $row["TENPHONG"]; echo "</td>";
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
