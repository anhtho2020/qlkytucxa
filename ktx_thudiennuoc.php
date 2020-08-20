<?php
    include 'ClassData.php';
    clsData::welcometowork();
    include 'dbcon.php';  
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
                var url="ktx_thudiennuoc.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.thutiendiennuoc.submit();";  
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
        $arr[0]=0;
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

        
        $iphong=1;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
      
              
                $dongiadien=0;
        if(isset($_POST["dongiadien"])){
             $dongiadien=$_POST["dongiadien"];
        }
        else echo " ";
        
        $chisodiencu=0;
        
        
        if(isset($_POST["chisodiencu"])){
             $chisodiencu=$_POST["chisodiencu"];
        }
        else echo " ";
        $chisodienmoi=0;
        if(isset($_POST["chisodienmoi"])){
             $chisodienmoi=$_POST["chisodienmoi"];
        }
        else echo " ";
         
        $dongianuoc=0;
        if(isset($_POST["dongianuoc"])){
             $dongianuoc=$_POST["dongianuoc"];
        }
        else echo " ";
        $chisonuoccu=0;
        if(isset($_POST["chisonuoccu"])){
             $chisonuoccu=$_POST["chisonuoccu"];
        }
        else echo " ";
        $chisonuocmoi=0;
        if(isset($_POST["chisonuocmoi"])){
             $chisonuocmoi=$_POST["chisonuocmoi"];
        }
        else echo " ";
        
        $thangnop="";
        if(isset($_POST["thangnop"])){
             $thangnop=$_POST["thangnop"];
        }
        else echo " ";
        $ngaythu="";
        if(isset($_POST["ngaythu"])){
             $nth=$_POST["ngaythu"];
             $x=explode("/", $nth);
             $ngaythu=$x[2]."-".$x[1]."-".$x[0];//echo $ngaythu;
        }
        else echo " ";
        
        $nguoithu="";
        if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        }
        else echo " ";
        $kt=0;
        $query_kt="select * from thutiendiennuoc ";
        $result_kt = mysql_query($query_kt, $link);  
                            $totalRows_kt=mysql_num_rows($result_kt); 
                            while ($row_kt = mysql_fetch_array ($result_kt))
                            {
                                if(($row_kt["ID_PHONG"]==$iphong)&&($row_kt["THANGNOP"])==$thangnop)
                                {
                                    $kt=$kt+1;
                                }
                            }
        

        
        $thanhtien=0;
        $thanhtien=$dongiadien*($chisodienmoi-$chisodiencu)+$dongianuoc*($chisonuocmoi-$chisonuoccu);
        
if($arr[0]>0)
{
        if($kt==0){
            if(($chisodienmoi<$chisodiencu)||($chisonuocmoi<$chisonuoccu)){
                echo "<script>";
                    //echo "alert(str);"; 
                    echo "alert('Chỉ số (điện/nước) mới không thể nhỏ hơn chỉ số (điện/nước) cũ');";
                    echo "</script>";
            }
            else {
//                for($i=0; $i<$sopt-1; $i++){
                $query="insert into thutiendiennuoc(ID_SINHVIEN,ID_PHONG,GIADIEN,CSDIENCU,CSDIENMOI,"
                        . "GIANUOC,CSNUOCCU,CSNUOCMOI,THANHTIEN,NGAYTHU,THANGNOP,NGUOITHU) "
                        . "values($arr[0],$iphong,$dongiadien,$chisodiencu,$chisodienmoi,$dongianuoc,"
                        . "$chisonuoccu,$chisonuocmoi,$thanhtien,'$ngaythu','$thangnop','$nguoithu')";
                echo $query;
                mysql_query($query, $link);
//            }
            }
        }
        else {
                echo "<script>";
                //echo "alert(str);"; 
                echo "alert(' Phong nay thang nay thu roi');";
                echo "</script>";
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
                        <h2> Thu tiền điện nước </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                         
                       <?php
                            
                                       
                       
//                        echo "<div>"; 
//                        
//                        echo "<div class=\"form-group\">";
//                        echo "<tr>";
//                        echo "<th > Bậc đào tạo: </th>";
//                            echo "<select name=\"bacdaotao\" id=\"idbacdaotao\" onchange=\"load()\">";
//                                
//                                echo "<option value=\"1\"";
//                                if($kt=="C"){echo " selected=\"selected\"";}
//                                echo ">Cao đẳng</option>";
//                                
//                                echo "<option value=\"2\"";
//                                if($kt=="T"){echo " selected=\"selected\"";}
//                                echo ">Trung cấp </option>";
//                                
//                                echo ">";
//                            echo "</select>";
//                            
//                       echo "</tr>";
//                       
//                        
//                        echo "<td width=\"400\"> Mã lớp: </td>";
//                        echo "<select name=\"lopchuyennhanh\" id=\"idlopchuyennganh\" onchange=\"load()\">";
//                            $query_lcn="select ID_LOPCHUYENNGANH, MALOPCHUYENNGANH from lopchuyennganh where LEFT(MALOPCHUYENNGANH,1)='".$kt."'";
//                            //echo $query_lcn;
//                            $result_lcn=mysql_query($query_lcn, $link);
//                            while($row_lcn=  mysql_fetch_array($result_lcn)){
//                                echo "<option value=\"".$row_lcn["ID_LOPCHUYENNGANH"]."\"";
//                                if($row_lcn["ID_LOPCHUYENNGANH"]==$idlcn){
//                                    echo " selected=\"selected\"";
//                                }
//                                echo ">";
//                                echo $row_lcn["MALOPCHUYENNGANH"]."</option>";
//                            }
//                        echo "</select>";
//                        echo "</tr>";
//                        echo "</div>";
//                        echo "</div>";
 
                        echo "<div>"; 
                        echo "<div class=\"form-group\">";
                        echo "<form name=\"thutiendiennuoc\" action=\"ktx_thudiennuoc.php\" method=\"post\">";
                       
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
                        echo "</div>";
                        
//                        echo "<tr>";
//                            $query_slsv="select * from danhsachnoitru where ID_PHONG=$idphong";
//                            $result_slsv = mysql_query($query_slsv, $link);  
//                            $totalRows_slsv=mysql_num_rows($result_slsv);
//                            echo "<td> Số lượng đã đăng ký: </td>";
//                            echo "<td> <input type=\"text\" name=\"sldadangky\" id=\"sldadangky\" value=\"".$totalRows_slsv."\" </td>";
//                        echo "</tr>";
//                        echo "<tr>";
//                        $slcothedangky=8-$totalRows_slsv;
//                        echo "<td> Số lượng có thể đăng ký: </td>";
//                            echo "<td> <input type=\"text\" name=\"slcothedangky\" id=\"slcothedangky\" value=\"".$slcothedangky."\" </td>";
//                        echo "</tr>";
//                        echo "</div>";
                        
                        echo "<tr>";
                            echo "<td> Đơn giá điện: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"dongiadien\" id=\"dongiadien\" size=\"8\" maxlength=\"8\"value=\"3000\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            $totalRows_csdcu=0;
                            $query_csdcu="select CSDIENMOI from thutiendiennuoc where ID_PHONG=$idphong"; //echo $query_csdcu;
                            $result_csdcu = mysql_query($query_csdcu, $link);
                            $totalRows_csdcu=mysql_num_rows($result_csdcu); 
                            
                                while ($row_csdcu = mysql_fetch_array ($result_csdcu))     
                                {      
//                                    $row_csdcu = mysql_fetch_array ($result_csdcu);

                                    $chisodiencu=$row_csdcu["CSDIENMOI"];
                                }
//                            }
                            if($totalRows_csdcu==0)   
                            { 
                                $chisodiencu=0;
                            }  
                            //echo $chisodiencu;
                            echo "<td> Chỉ số điện cũ: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"chisodiencu\" id=\"chisodiencu\" size=\"5\" maxlength=\"5\" value=\"".$chisodiencu."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Chỉ số điện mới: </td>";
                            echo "<td>&nbsp</td> ";
                            
                            echo "<td width=\"60\"> <input type=\"text\" name=\"chisodienmoi\" id=\"chisodienmoi\" size=\"5\" maxlength=\"5\" value=\" \" </td>";
                        echo "</tr>";
                        echo "</div>"; 
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Đơn giá nước: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"dongianuoc\" id=\"dongianuoc\" size=\"5\" maxlength=\"5\" value=\"6000\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            $totalRows_csncu=0;
                            $chisonuoccu=0;
                            $query_csncu="select CSNUOCMOI from thutiendiennuoc where ID_PHONG=$idphong"; //echo $query_csdcu;
                            $result_csncu = mysql_query($query_csncu, $link);
                            $totalRows_csncu=mysql_num_rows($result_csncu); 
                            
                                while ($row_csncu = mysql_fetch_array ($result_csncu))     
                                {      
//                                    $row_csncu = mysql_fetch_array ($result_csncu);

                                    $chisonuoccu=$row_csncu["CSNUOCMOI"];
                                }
//                            }
                            if($totalRows_csncu==0)   
                            { 
                                $chisonuoccu=0;
                            }  
                            echo "<td> Chỉ số nước cũ: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"chisonuoccu\" id=\"chisonuoccu\" size=\"5\" maxlength=\"5\" value=\"".$chisonuoccu."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Chỉ số nước mới: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"chisonuocmoi\" id=\"chisonuocmoi\" size=\"5\" maxlength=\"5\" value=\" \" </td>";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class=\"form-group\">";  
                        echo "<tr>";
                            $now = getdate(); 
                            $thang=$now["mon"]-1;
                            $nam=$now["year"] ;
                            $tnop=$thang."-".$nam;
                            echo "<td> Tháng nộp: </td>";
                            echo "<td> <input type=\"text\" name=\"thangnop\" id=\"thangnop\" size=\"8\" maxlength=\"8\" value=\"".$tnop."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            $ngthu=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
   // $workSheet->setCellValueByColumnAndRow(7, $tuDong+2, 'Cần thơ, ngày '. $now["mday"] . ' tháng '. $now["mon"] . ' năm ' . $now["year"] );
                            echo "<td> Ngày thu: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaythu\" id=\"ngaythu\" size=\"10\" maxlength=\"10\"value=\"".$ngthu."\"</td>";
                        echo "</tr>";
                       
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
                            echo "<td> <input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"\" </td>";
                        echo "</tr>";
                        
//                        echo "<tr>";
//                            echo "<td> Người nộp: </td>";
//                            echo "<td> <input type=\"text\" name=\"nguoinop\" id=\"nguoinop\" value=\"\" </td>";
//                        echo "</tr>";
//                        
//                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";

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
                        echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thu tiền điện nước</button>";
                        }
                        echo "</div>"; 
                        
                        echo "<div>"; 
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachphongdanoptiendiennuoc.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">In phiếu thu điện nước </button>";
                        echo "</form>";  
                        echo "</div>"; 
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
                            <th width="3%"> </th>
                            <th width="3%">STT</th>
                                <th width="8%">MÃ HSSV</th>
                                <th width="18%">HỌ VÀ TÊN</th>
                            
                            <th width="13%">NGÀY SINH</th>
                            <th width="2%">PHÁI</th>
                            <th width="10%">LỚP</th>
                            <th width="5%">PHÒNG</th>
                            <!--<th>TÙY CHỌN</th>-->
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_SINHVIEN,b.MASV, b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,c.MALOPCHUYENNGANH,d.TENPHONG "
                                    . " from danhsachnoitru a,sinhvien b,lopchuyennganh c, phong d "
                                    . " where a.ID_SINHVIEN =b.ID_SINHVIEN and a.ID_PHONG=d.ID_PHONG and "
                                    . " b.ID_LOPCHUYENNGANH=c.ID_LOPCHUYENNGANH and a.ID_PHONG=$idphong";//not in (select ID_SINHVIEN from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            //echo $stSQL;
                            $result = mysql_query($stSQL, $link);  
                            $totalRows=mysql_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysql_fetch_array ($result))     
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
                                echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
                                echo "<td>"; echo $i; echo "</td>";
                                echo "<td>"; echo $row["MASV"]; echo "</td>";
                                echo "<td>"; echo $row["HODEM"]; echo " "; echo $row["TEN"]; echo "</td>";
                                
                                echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }

                                echo "<td>"; echo $row["MALOPCHUYENNGANH"]; echo "</td>";
                                echo "<td>"; echo $row["TENPHONG"]; echo "</td>";
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
      <?php
    clsData::footer_data();
    ?>

      <!--footer end-->
  </section>
 <?php
    clsData::footer_footer();
    ?>

  </body>
</html>
