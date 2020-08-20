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
                var dcs=document.getElementById('dcs').value;
                var url="ktx_thutienphong.php?idday="+idday+"&idphong="+idphong+"&hocky="+hocky+"&dcs="+dcs;
                window.location=url;
            }
 
        </script>
        
        
        
    <?php  
    echo "<script>";
    echo "function tht(){ "; 
      echo "if(confirm('Thông tin chính xác?')){ "; 
          echo "var str=\"\";"; 
          //echo "var str1=\"\";"; 
          //var num = $('#dshp input[type=checkbox]:checked').length;           
           echo "$(\"input[name='chk[]']\").each(function () {"; 
               echo "if($(this).is(':checked')){ "; 
                    echo "str+=$(this).val()+\",\"; "; 
               echo "}"; 
           echo "});           ";     
           echo "document.getElementById('chon').value=str; alert(str);"; 
           //echo "document.getElementById('nguoithu').value=str1; alert(str1);";
           echo "if(str!=\"\"){ "; 
                echo "document.thutienphong.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên. Hoặc chưa nhập tên người thu');}";            
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
        if(isset($_POST["idphong"])){
             $idphong=$_POST["idphong"];
        }
        
        $hocky=1;
        if(isset($_GET["hocky"])){
            $hocky=$_GET["hocky"];
        }
        if($hocky==1)
            {
                $kthk="1";
            }
            else if($hocky==2)
            {
                $kthk="2";
            }
	else
	{ $kthk="3";}
        
        $ktdcs=0;
        $dcs=0;
        if(isset($_GET["dcs"])){
            $dcs=$_GET["dcs"];
        }
        if($dcs==0)
            {
                $ktdcs="0";
            }
        else if($dcs==1)
            {
                $ktdcs="1";
            }
            else if($dcs==2)
            {
                $ktdcs="2";
            }
            else if($dcs==3)
            {
                $ktdcs="3";
            }
            else if($dcs==4){
                    $ktdcs="4";
                 }
                 else {
                    $ktdcs="5";
                 }

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
        
        $dcs='';
        if(isset($_POST["dcs"])){
             $dcs=$_POST["dcs"];
        }
        
        $mgiam='';
        if(isset($_POST["mgiam"])){
             $mgiam=$_POST["mgiam"];
             
        }
        
        $nguoithu='';
        if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        }
        
        $sothang=0;
        if(isset($_POST["sothangnop"])){
             $sothang=$_POST["sothangnop"];
        }
        else echo " ";
        $dongiathang=0;
        if(isset($_POST["dongiathang"])){
             $dongiathang=$_POST["dongiathang"];
        }
        else echo " ";
        $sotien=0;
        $sotien=$sothang*$dongiathang;
        
        
        $mg='';
        if($mgiam=='0')
        {
            $mg="100%";
        }
        else if ($mgiam=='0.5') {
            $mg="50%";
        }
        else
        {
            $mg=" ";
        }
        $ngheo="Nha ngheo";
                $contb="Con thuong binh";
                $bodoi="Bo doi xuat ngu";
                $tuquan="Tu quan";
        $ghichu='';
        $gh='';
        //if(isset($_POST["dcs"])){
             //$ghichu=$_POST["dcs"];
             
        //}
        if($dcs==1){
                $gh='Con thương binh';
            }
            else if($dcs==2) {
                $gh='Nhà nghèo';
            }
            else if($dcs==3) {
                $gh='Sinh viên tự quản';
            }
            else if($dcs==4) {
                $gh='Bộ đội xuất ngũ';
            }
            else if($dcs==5) {
                $gh='Mất sức lao động';
            }
        $kt=0;
        for($i=0; $i<$sopt-1; $i++)
        {
            $query_dk="select * from thutienphongsinhvien ";//echo $query_dk;
            $result_dk = mysqli_query($link,$query_dk);  
            $totalRows_dk=mysqli_num_rows($result_dk); 
            while ($row = mysqli_fetch_array ($result_dk))
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
                $result_dcs = mysqli_query($link,$query_dcs);  
                $totalRows_dcs=mysqli_num_rows($result_dcs); 
                $row_dcs = mysqli_fetch_array ($result_dcs);
                
                $ngheo=addslashes($ngheo);
                $contb=addslashes($contb);
                $bodoi=addslashes($bodoi);
                $tuquan=addslashes($tuquan);
                $st=$sotien;
                if($dcs==1 || $dcs==2 || $dcs==3)
                {
                    $st=((100-$mgiam)*$st)/100;
                
                }
                else if($dcs==4)
                {
                    $st=((100-$mgiam)*$st)/100;
                }
                else if($dcs==5)
                {
                    $st=((100-$mgiam)*$st)/100;
                }
                else 
                {
                    $st=$sotien;
                }
                if($_SESSION['idqt']==2051)
				{
					$idgiaovien=$_SESSION['idqt'];
					$query="insert into thutienphongsinhvienkhtc(ID_SINHVIEN,DONGIA,NGAYTHU,HOCKY,NAMHOC,NGUOITHU,GHICHU,SOTHANGNOP,DONGIATHANG,MUCGIAM,ID_PHONG,ID_GIAOVIEN) "
                               . "values($arr[$i],$st,'$ngaythu','$hocky','$namhoc','$nguoithu','$gh',$sothang,$dongiathang,'$mg',$idphong,$idgiaovien)";
                       mysqli_query($link,$query);
				}
                else
				{
					$idgiaovien=$_SESSION['idqt'];
					$query="insert into thutienphongsinhvien(ID_SINHVIEN,DONGIA,NGAYTHU,HOCKY,NAMHOC,NGUOITHU,GHICHU,SOTHANGNOP,DONGIATHANG,MUCGIAM,ID_PHONG,ID_GIAOVIEN) "
                               . "values($arr[$i],$st,'$ngaythu','$hocky','$namhoc','$nguoithu','$gh',$sothang,$dongiathang,'$mg',$idphong,$idgiaovien)";
                       mysqli_query($link,$query);
				}
                //echo $query;       
            
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
                        echo "<form name=\"thutienphong\" action=\"ktx_thutienphong.php\" method=\"post\">";
                       
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
                        
                        echo "<tr>";
                        echo "<th > Học kỳ: </th>";
                            echo "<select name=\"hocky\" id=\"hocky\" onchange=\"load()\">";
                                
                                echo "<option value=\"1\"";
                                if($kthk=="1"){echo " selected=\"selected\"";}
                                echo ">1</option>";
                                
                                echo "<option value=\"2\"";
                                if($kthk=="2"){echo " selected=\"selected\"";}
                                echo ">2 </option>";

		echo "<option value=\"3\"";
                                if($kthk=="3"){echo " selected=\"selected\"";}
                                echo ">3 </option>";
                                
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
                            
                            //echo "<td> <input type=\"text\" name=\"dcs\" id=\"dcs\" size=\"15\" maxlength=\"15\" value=\"\" </td>";
                            
                            echo "<th> Diện chính sách: </th>";
                            echo "<select name=\"dcs\" id=\"dcs\" onchange=\"load()\">";
                                
                                echo "<option value=\"0\"";
                                if($ktdcs=="0"){echo " selected=\"selected\"";}
                                echo ">Không thuộc diện chính sách</option>";
                                
                                echo "<option value=\"1\"";
                                if($ktdcs=="1"){echo " selected=\"selected\"";}
                                echo ">Nhà nghèo</option>";
                                
                                echo "<option value=\"2\"";
                                if($ktdcs=="2"){echo " selected=\"selected\"";}
                                echo ">Con thương binh</option>";
                                
                                echo "<option value=\"3\"";
                                if($ktdcs=="3"){echo " selected=\"selected\"";}
                                echo ">Sinh viên tự quản</option>";
                                
                                echo "<option value=\"4\"";
                                if($ktdcs=="4"){echo " selected=\"selected\"";}
                                echo ">Bộ đội xuất ngũ</option>";
                                
                                echo "<option value=\"5\"";
                                if($ktdcs=="5"){echo " selected=\"selected\"";}
                                echo ">Mất sức lao động</option>";
                               
                                
                                echo ">";
                            echo "</select>";
                            
                            
                            
                            
                        echo "</tr>";
                        echo "<tr>";
                        //echo $ktdcs;
                        //$ngthu=0;
                        echo "<td> Mức giảm: </td>";
                            echo "<td> <input type=\"text\" name=\"mgiam\" id=\"mgiam\" size=\"10\" maxlength=\"10\" value=\"\" </td>";
                        echo "</tr>";
                        
                        
                        
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Số tháng nộp: </td>";
                            echo "<input type=\"text\" name=\"sothangnop\" id=\"sothangnop\" size=\"2\" maxlength=\"2\" value=\"5\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Đơn giá: </td>";
                            echo "<input type=\"text\" name=\"dongiathang\" id=\"dongiathang\" size=\"10\" maxlength=\"10\" value=\"100000\" </td>";
                        echo "</tr>";
                        
                        //echo "<input type=\"hidden\" name=\"sotien\" id=\"sotien\"> ";    
                        
                        //echo "<tr>";
                            //echo "<td> Số tiền: </td>";
                            //echo "<td> <input type=\"text\" name=\"sotien\" id=\"sotien\" size=\"10\" maxlength=\"10\" value=\"450000\" </td>";
                        //echo "</tr>";
                        echo "<tr>";
                        
                        $ngthu=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                        echo "<td> Ngày thu: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaythu\" id=\"ngaythu\" size=\"10\" maxlength=\"10\" value=\"".$ngthu."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
							$nguoi_thu=$_SESSION["hodem"]." ".$_SESSION["ten"];
                            echo "<input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"".$nguoi_thu."\" </td>";
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
                        <form role="form" action="ktx_inphieuthutienphongsinhvien.php" method="post">                                                   
                        <button type="submit" class="btn btn-info"> IN PHIẾU THU </button>
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
                            $result = mysqli_query($link,$stSQL);  
                            $totalRows=mysqli_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
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
