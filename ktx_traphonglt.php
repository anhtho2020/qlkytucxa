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
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_traphonglt.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.traphonglt.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";

        include 'dbcon.php';
    $link=  clsConnet::DBConnect();
  

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
        
        $idphong=1;
        if(isset($_GET["idphong"])){
            $idphong=$_GET["idphong"];
        }
        $iphong=1;
        if(isset($_POST["iphong"])){
             $iphong=$_POST["iphong"];
        }
        else echo " ";
        $ngaytraphong=" ";
        if(isset($_POST["ngaytraphong"])){
             $nnt=$_POST["ngaytraphong"];
             $x=explode("/", $nnt);
             $ngaytraphong=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
        $ghichu=" ";
        $i=0;
         if(isset($_POST["ghichu"])){
             $ghichu=$_POST["ghichu"];
        }
        else echo " ";
        
//        echo " id lien thông ".$arr[$i];
        $totalRows_lienthong = 0;       
    $query_lienthong ="select * from dssvltnoitru  where ID_LIENTHONG='$arr[$i]'";
    $result_lienthong = mysqli_query($link,$query_lienthong);  
    $totalRows_lienthong=mysqli_num_rows($result_lienthong);

        $row_lienthong = mysqli_fetch_array ($result_lienthong);
        $ngaynt=$row_lienthong["NGAYNOITRU"];

        for($i=0; $i<$sopt-1; $i++){
            $query="insert into dstraphonglt (ID_LIENTHONG,ID_PHONG,NGAYNOITRU,NGAYTRAPHONG,GHICHU ) "
                    . "values($arr[$i],$iphong,'$ngaynt','$ngaytraphong','$ghichu')";//echo $query;
            mysqli_query($link,$query);
            $query_xoanoitru="delete from dssvltnoitru where ID_LIENTHONG='".$arr[$i]."'";
            $result_xoanoitru=mysqli_query($link,$query_xoanoitru);
            $query_xoatamtru="delete from dangkytamtrult where ID_LIENTHONG='".$arr[$i]."'";
            $result_xoatamtru=mysqli_query($link,$query_xoanoitru);
            
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
                        <h2> Sinh viên liên thông trả phòng </h2>
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
                        echo "<form name=\"traphonglt\" action=\"ktx_traphonglt.php\" method=\"post\">";
                        
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
                      
                            $kt=1;
                            echo "<tr>";
                            echo "<th > Tên phòng: </th>";
                                echo "<select name=\"idphong\" id=\"idphong\" onchange=\"load()\">";
                                    
                                    echo "<option value=\"0\"";
                                    if($kt==1){echo " selected=\"selected\"";}
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
                        
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            $now = getdate(); 
                            $ngtraphong=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày trả phòng: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"ngaytraphong\" id=\"ngaytraphong\" value=\"".$ngtraphong."\" </td>";
                        echo "</tr>";
//                        echo "<tr>";
//                            echo "<td> Số tiền: </td>";
//                            echo "<td> <input type=\"number\" name=\"sotien\" id=\"sotien\" value=\"\" </td>";
//                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Ghi chú: </td>";
                            echo "<td> <input type=\"text\" name=\"ghichu\" id=\"ghichu\" value=\"\" </td>";
                        echo "</tr>";
                         echo "<input type=\"hidden\" name=\"iphong\" value=\"".$idphong."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                       
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
                        if($_SESSION["quyen"]=="QT")
                        {
                            echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thực hiện trả phòng</button>";
                        }
                            echo "</div>"; 
                        
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachsinhvientraphonglt.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách SVLT trả phòng</button>";
                        echo "</form>";  
                        echo "</div>"; 
                    ?>
  		</div>                   
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
                            <th> </th>
                            <th>STT</th>
                            <th>MÃ SVLT</th>
                            <th>HỌ VÀ TÊN </th>
                            
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
                            <th>NGÀY NỘI TRÚ</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_LIENTHONG,a.MASV,a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                    . "b.NGAYNOITRU,c.ID_PHONG,d.MALOPLT from lienthong a,dssvltnoitru b, "
                                    . "phong c,loplt d  where a.ID_LIENTHONG =b.ID_LIENTHONG and "
                                    . "b.ID_PHONG=c.ID_PHONG and a.ID_LOP=d.ID_LOPLT and "
                                    . "  c.ID_PHONG=$idphong";// from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
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
                                    echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_LIENTHONG"]."\"> </td>";
                                    echo "<td>"; echo $i; echo "</td>";
                                    echo "<td>"; echo $row["MASV"]; echo "</td>";
                                    echo "<td>"; echo $row["HODEM"]; echo " "; echo $row["TEN"];echo "</td>";
                                     
                                    echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                    if($row["PHAI"]==0)
                                    {
                                        echo "<td>"; echo "Nam" ; echo "</td>";
                                    }
                                    else {
                                        echo "<td>"; echo "Nữ" ; echo "</td>";
                                    }
                                    echo "<td>"; echo $row["MALOPLT"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYNOITRU"]; echo "</td>";
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
