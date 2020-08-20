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
                var url="ktx_thechap_svlt.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.dangkythechaplt.submit();";  
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
        if(isset($_POST["sotien"])){
             $sotien=$_POST["sotien"];
        }
        else echo " ";
        
        if(isset($_POST["hocky"])){
             $hocky=$_POST["hocky"];
        }
        else echo " ";
        
        if(isset($_POST["namhoc"])){
             $namhoc=$_POST["namhoc"];
        }
        else echo " ";
       
        
        if(isset($_POST["ngaythechap"])){
             $nnt=$_POST["ngaythechap"];
             $x=explode("/", $nnt);
             $ngaythechap=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
         if(isset($_POST["nguoithu"])){
             $nguoithu=$_POST["nguoithu"];
        }
        else echo " ";

        
        for($i=0; $i<$sopt-1; $i++){
            $query="insert into thechaplt (ID_LIENTHONG,ID_PHONG,NGAYTHECHAP,SOTIEN,HOCKY,NAMHOC,NGUOITHU ) "
                    . "values($arr[$i],$iphong,'$ngaythechap',$sotien,'$hocky','$namhoc','$nguoithu')";//echo $query;
            mysql_query($link,$query);
            
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
                        <h2>
                            Sinh viên liên thông nộp tiền thế chấp
                        </h2>
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
                        echo "<form name=\"dangkythechaplt\" action=\"ktx_thechap_svlt.php\" method=\"post\">";
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
                            $ngthechap=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                            echo "<td> Ngày thế chấp: </td>";
                            echo "<td>&nbsp</td> ";
                            echo "<td width=\"60\"> <input type=\"text\" name=\"ngaythechap\" id=\"ngaythechap\" size=\"8\" maxlength=\"10\" value=\"".$ngthechap."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Số tiền: </td>";
                            echo "<td> <input type=\"text\" name=\"sotien\" id=\"sotien\" size=\"6\" maxlength=\"6\"  value=\"200000\" </td></br></br>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Học kỳ: </td>";
                            echo "<td> <input type=\"text\" name=\"hocky\" id=\"hocky\" size=\"1\" maxlength=\"1\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Năm học: </td>";
                            echo "<td> <input type=\"text\" name=\"namhoc\" id=\"namhoc\" size=\"9\" maxlength=\"9\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
                            echo "<td> <input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<input type=\"hidden\" name=\"iphong\" value=\"".$idphong."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                       
                        echo "</form>";   
                        echo "</div>";
                        if($_SESSION["quyen"]=="QT")
                        {
                        echo "<div class=\"form-group\">";
                            echo "<button onclick=\"tht()\" class=\"btn btn-info\"> Thực hiện thu thế chấp </button>";
                        echo "</div>"; 
                        }
                        echo "<div>"; 
                        echo "<form name=\"xuatphiethuthechap\" action=\"ktx_danhsachthechaplt.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> In phiếu thu tiền thế chấp </button>";
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
                            <th>HỌ TÊN </th>
                            <!--<th>TÊN</th>-->
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>LỚP</th>
                            <th>PHÒNG</th>
                            <th>NGÀY NỘI TRÚ</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_LIENTHONG,a.MASV,a.HODEM,a.TEN,a.NGAYSINH,a.PHAI,"
                                    . "b.NGAYNOITRU,c.ID_PHONG,c.TENPHONG,d.MALOPLT from lienthong a,"
                                    . "dssvltnoitru b,phong c,loplt d  where a.ID_LIENTHONG =b.ID_LIENTHONG and "
                                    . "b.ID_PHONG=c.ID_PHONG and a.ID_LOP=d.ID_LOPLT and c.ID_PHONG=$idphong and "
                                    . "a.ID_LIENTHONG not in (select ID_LIENTHONG from thechaplt "
                                    . "where ID_LIENTHONG is not null)";// from danhsachnoitru where ID_SINHVIEN is not null)";// and xoaten=0 and datotnghiep=0 and not in ()";  
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
                                    echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_LIENTHONG"]."\"></td>";
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
                                    echo "<td>"; echo $row["TENPHONG"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYNOITRU"]; echo "</td>";
                                    //echo "<td>";
                                    
                                    //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoadangkytamtru('".$row["ID_DANGKYTAMTRU"]."')\">Xóa</a></button>";
                                   
                                //echo "</td>";
                                
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
