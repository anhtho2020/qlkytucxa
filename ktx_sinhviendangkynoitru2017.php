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
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }

            function load(){
                var nnh=document.getElementById('namnhaphoc').value;
                //var idbdt=document.getElementById('idbacdaotao').value;
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_sinhviendangkynoitru2017.php?nnh="+nnh+"&idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>

    <?php  
    echo "<script>";
    echo "function tht(){ "; 
      echo "if(confirm('Thông tin chính xác?')){ "; 
          echo "var str=\"\";"; 
          //var num = $('#dshp input[type=checkbox]:checked').length;           
           echo "$(\"input[name='chk[]']\").each(function(){"; 
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
    
//include 'ClassData.php';
//        include 'dbcon.php';
//    $link=  clsConnet::DBConnect();
	        
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
        $nnh=1;
        if(isset($_GET["nnh"])){
            $nnh=$_GET["nnh"];
        }
        if($nnh==1)
            {
                $ktnnh=2017;
            }
            else if($nnh==2)
            {
                $ktnnh=2018;
            }
            else if($nnh==3)
            {
                $ktnnh=2019;
            }
            else if($nnh==4)
            {
                $ktnnh=2020;
            }
            else 
            {
                $ktnnh=2021;
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
//        echo $idphong;
        
        $iphong=1;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
//        echo $iphong;
        $idloainoitru=0;
        if(isset($_POST["idloainoitru"])){
             $idloainoitru=$_POST["idloainoitru"];
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
        
        $query_svvpnq="select ID_SINHVIEN from viphamnoiquy";
        $kt_svvpnq=mysqli_query($link,$query_svvpnq);
        $arr_svvpnq=array();
        while($row_svvpnq=mysqli_fetch_array($kt_svvpnq)){
                $arr_svvpnq[]=$row_svvpnq["ID_SINHVIEN"];
        }
    if($slsv==8)
        {
            echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Phòng đầy!');";
                echo "</script>";
        }
        elseif ($sopt-1+$slsv>8) {
            echo "<script>";
                //echo "alert(str);"; 
                echo "alert('Số lượng đăng ký nhiều hơn số chỗ, không thể đăng ký phòng nầy!');";
                echo "</script>";
        } 
        else
        {
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
            else
            {
                    $query="insert into danhsachnoitrum(ID_SINHVIEN,ID_PHONG,NGAYNOITRU) "
                            . "values($arr[$i],$iphong,'$ngaynoitru')";
                    mysqli_query($link,$query);
                    $slsv=$slsv+1;
            }
        }
    }


//    $username=$_SESSION["usernam"];
//
//        $totalRows_dn = 0;       
//        $stSQL_dn ="select * from giaovien where TENTAIKHOAN='".$username."'";  
//        $result_dn = mysql_query($stSQL_dn, $link);  
////        $totalRows_dn=mysql_num_rows($result_dn); 
//        while ($row = mysql_fetch_array ($result_dn))     
//        {   
//            $hodem=$row["HODEM"];
//            $ten=$row["TEN"];
//        }
//        $user_name=$hodem." ".$ten;
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
                        <h2> HỌC SINH SINH VIÊN ĐĂNG KÝ NỘI TRÚ TỪ 2017 </h2>
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
                        echo "<form name=\"themsinhviennoitrum\" action=\"ktx_sinhviendangkynoitru2017.php\" method=\"post\">";
                        echo "<div>"; 
                        
                        
                         /*                     
                        echo "<tr>";
                        echo "<td width=\"400\"> Năm nhập học: </td>"; //echo $idlcn;
                        echo "<select name=\"namnhaphoc\" id=\"namnhaphoc\" onchange=\"load()\">";
                            $query_lcn="select NAMNHAPHOC from dshssv ";
                                    //. "where NAMNHAPHOC='".$kt."'";
                            //echo $query_lcn;
                            $result_lcn=mysql_query($query_lcn, $link);
                            while($row_lcn=  mysql_fetch_array($result_lcn)){
                                echo "<option value=\"".$row_lcn["NAMNHAPHOC"]."\"";
                                if($row_lcn["NAMNHAPHOC"]==$idlcn){
                                    echo " selected=\"selected\"";
                                }
                                echo ">";
                                echo $row_lcn["NAMNHAPHOC"]."</option>";
                            }
                        echo "</select>";
                        echo "</tr>";
                        */
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<th width=\"400\"> Năm nhập học: </th>"; //echo $idlcn;
                        echo "<select name=\"namnhaphoc\" id=\"namnhaphoc\" onchange=\"load()\">";
                            echo "<option value=\"1\"";
                                if($ktnnh==2017){echo " selected=\"selected\"";}
                                echo ">2017</option>";
                                
                                echo "<option value=\"2\"";
                                if($ktnnh==2018){echo " selected=\"selected\"";}
                                echo ">2018 </option>";
                                
                                echo "<option value=\"3\"";
                                if($ktnnh==2019){echo " selected=\"selected\"";}
                                echo ">2019 </option>";
                                
                                echo "<option value=\"4\"";
                                if($ktnnh==2020){echo " selected=\"selected\"";}
                                echo ">2020</option>";
                                
                                echo "<option value=\"5\"";
                                if($ktnnh==2021){echo " selected=\"selected\"";}
                                echo ">2021 </option>";
                                
                                
                            //echo ">";
                        echo "</select>";
                        echo "</tr>";

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
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            $query_slsv="select * from danhsachnoitru a,sinhvien b where a.ID_SINHVIEN=b.ID_SINHVIEN and ID_PHONG=$idphong";
                            $result_slsv = mysqli_query($link,$query_slsv);  
                            $totalRows_slsv=mysqli_num_rows($result_slsv);
                            
                            $query_slsvm="select * from danhsachnoitrum a,dshssv b where a.ID_SINHVIEN=b.ID_DSHSSV and ID_PHONG=$idphong";
                            $result_slsvm = mysqli_query($link,$query_slsvm);  
                            $totalRows_slsvm=mysqli_num_rows($result_slsvm);
                            
                            $query_slsvlt="select * from dssvltnoitru a,lienthong b where a.ID_LIENTHONG=b.ID_LIENTHONG and ID_PHONG=$idphong";
                            $result_slsvlt = mysqli_query($link,$query_slsvlt);  
                            $totalRows_slsvlt=mysqli_num_rows($result_slsvlt);
                          $sum=$totalRows_slsv+$totalRows_slsvlt+$totalRows_slsvm;
                            echo "<th> Số lượng đã đăng ký: </th>";

                            //echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" placeholder=\"Nhập tên phòng\" value=\"A1\">";
//                            echo "<td style=\"padding-bottom: 0px; padding-left: 20px; padding-right: 20px; font-family: Arial; color: #ffffff; font-size: 12px; padding-top: 0px;\"> <input type=\"text\" name=\"sldadangky\" id=\"sldadangky\" size=\"4\" maxlength=\"2\" value=\"".$totalRows_slsv."\"> </td>";
                            echo "<td> <input type=\"text\" name=\"sldadangky\" id=\"sldadangky\" size=\"1\" maxlength=\"2\" value=\"".$sum."\"> </td>";
//                            echo "</div>";
                            
                                    

                            
                        echo "</tr>";
                        echo "<tr>";
                        $slcothedangky=8-$sum;
                        echo "<td> Số lượng có thể đăng ký: </td>";
                            echo "<td> <input type=\"text\" name=\"slcothedangky\" id=\"slcothedangky\" size=\"1\" maxlength=\"2\" value=\"".$slcothedangky."\"></td>";
                        echo "</tr>";
                        
//                        
//                        
                        echo "<tr>";
                        echo "</div>";
                       echo "</div>";
                        echo "<div>";
                       echo "<div class=\"form-group\">";
//                            echo "<td> Loại nội trú: </td>";
//                            echo "<td>&nbsp</td> ";
//                            
//                            echo "<td width=\"60\"> <input type=\"text\" name=\"idloainoitru\" id=\"idloainoitru\" size=\"1\" maxlength=\"2\" value=\"1\" </td>";
//                        echo "</tr>";
                        //echo "</div>";
                        echo "<tr>";
                            $now = getdate(); 
                            $ngnoitru=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày nội trú: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaynoitru\" id=\"ngaynoitru\" size=\"10\" maxlength=\"10\" value=\"".$ngnoitru."\" </td>";
                        echo "</tr>";
//                        echo "</div>";
                        echo "<tr>";
//                            echo "<td> Ngày nội trú: </td>";
                            echo "<input type=\"hidden\" name=\"iphong\" id=\"iphong\" value=\"".$idphong."\"";
                        echo "</tr>";
                        
                        
                        
                        //echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row_lcn["ID_LOPCHUYENNGANH"]."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";    
                        if($_SESSION["quyen"]=="QT")
                        {
                            echo "<div class=\"form-group\">";
                            echo "<button onclick=\"tht()\" class=\"btn btn-info\">Đăng ký</button>";
                            echo "</div>"; 
                        }
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachsinhviennoitru2017.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách HSSV_HSNH </button>";
                        echo "</form>";  
                        echo "</div>"; 
                    ?>
  		</div>                   
		</div>
                </div>
              
              
              
               <div class="row">                  
               <div class="col-lg-8">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example" >
                          <thead>
                            <tr>
                            <th> </th>
                            <th>STT</th>
                            <th>MÃ SINH VIÊN</th>
                            <th> HỌ VÀ TÊN </th>
                            <!--<th>TÊN</th>-->
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th> CMND</th>
                            <th> NĂM NHẬP HỌC</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            if($idday==1 || $idday==2)
                            {
                                $stSQL ="select ID_DSHSSV,MAHSSV, HODEM,TEN,NGAYSINH,PHAI,CMND,NAMNHAPHOC"
                                        . " from dshssv "
                                        . "where NAMNHAPHOC=$ktnnh and PHAI=1 and ID_DSHSSV not in "
                                        . "(select ID_SINHVIEN from danhsachnoitrum where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            
                                //echo $idlcn ;
                            }
                            else if($idday==3){
                                $stSQL ="select ID_DSHSSV,MAHSSV, HODEM,TEN,NGAYSINH,PHAI,CMND,NAMNHAPHOC"
                                        . " from dshssv "
                                        . "where NAMNHAPHOC=$ktnnh and PHAI=0 and ID_DSHSSV not in "
                                        . "(select ID_SINHVIEN from danhsachnoitrum where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            }
                            else {
                                $stSQL ="select ID_DSHSSV,MAHSSV, HODEM,TEN,NGAYSINH,PHAI,CMND,NAMNHAPHOC"
                                        . " from dshssv "
                                        . "where NAMNHAPHOC=$ktnnh and ID_DSHSSV not in "
                                        . "(select ID_SINHVIEN from danhsachnoitrum where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
                            }
                            
                            //echo $stSQL;
                            $result = mysqli_query($link,$stSQL);  
                            $totalRows=mysqli_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                    
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatsinhviennoitru$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                               echo "<div class=\"modal-dialog\">";
                                                    echo "<div class=\"modal-content\">";
                                                      echo "<div class=\"modal-header\">";
                                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin sinh viên nội trú từ 2017</h4>";
                                                        echo "</div>";
                                                        echo "<div class=\"modal-body\">";
                                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinsinhviennoitru.php\" method=\"post\">";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"mahssv\">Mã HSSV</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"mahssv\" value=\"".$row_khach["MAHSSV"]."\""; 
                                                                          echo "name=\"mahssv\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"hodem\">Họ đệm</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row_khach["HODEM"]."\" "; 
                                                                          echo "name=\"hodem\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ten\">Tên </label>";
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
                                echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_DSHSSV"]."\"> </td>";
                                echo "<td>"; echo $i; echo "</td>";
                                echo "<td>"; echo $row["MAHSSV"]; echo "</td>";
                                echo "<td>"; echo $row["HODEM"]; echo ' '; echo $row["TEN"];echo "</td>";
                                 
                                echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                if($row["PHAI"]==0){
                                    echo "<td>";  echo "Nam" ; echo "</td>";
                                }
                                else {
                                    echo "<td>";  echo "Nữ" ; echo "</td>";    
                                }
                                echo "<td>";  echo $row["CMND"] ; echo "</td>";
                                echo "<td>";  echo $row["NAMNHAPHOC"] ; echo "</td>";
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
            //clsData::footer_data();
      ?>
      <!--footer end-->
  </section>
    <?php
            clsData::footer_footer();
      ?>

  </body>
</html>
