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
            function xoathechaplt(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoathechaplt.php?idthechaplt="+id;
                }
            }
            
            function inphieult(id){
//                if(confirm('Ban co chac xoa khong?')){
                    window.location="inphieuthuthechaplt.php?idthechaplt="+id;
//                }
            }
        
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_danhsachthechaplt.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.danhsachthechaplt.submit();";  
                //echo "alert(str);"; 
           echo "} else{alert('Phải chọn ít nhất một sinh viên');}";            
       echo "}"; 
       echo "else{ "; 
           echo "return false; "; 
       echo "}"; 
       echo "return true;"; 
  echo "}";
echo "</script>";

        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
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

        if(isset($_POST["sotien"])){
             $sotien=$_POST["sotien"];
        }
        else echo " ";
        
       
        
        if(isset($_POST["ngaythechap"])){
             $nnt=$_POST["ngaythechap"];
             $x=explode("/", $nnt);
             $ngaythechap=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
        }
        else echo " ";
        
         if(isset($_POST["ghichu"])){
             $ghichu=$_POST["ghichu"];
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
               <div class="row">
               <div class="col-lg-12 selecthk">
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Xuất phiếu thu tiền thế chấp- LT </h2>
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
                        echo "<form name=\"danhsachthechaplt\" action=\"ktx_danhsachthechaplt.php\" method=\"post\">";
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
                        echo "</form>"; 
                        echo "</div>";
                    echo "<div>";
                        echo "<form name=\"dsphiethuthechaplt\" action=\"ktx_danhsachphieuthechaplt.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Danh sách phiếu thu thế cháp </button>";
                        echo "</form>";
                    echo "</div>";
                    echo "<div class=\"form-group\">";
                    echo "</div>";
                    echo "<div>";
                        echo "<form name=\"thutienthechaplt\" action=\"ktx_thechap_svlt.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Thu tiền thế cháp </button>";
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
                            <th width="8%">MÃ SVLT</th>
                            <th width="20%">HỌ TÊN </th>
                            <th width="5%">PHÒNG</th>
                            <th width="10%"> SỐ TIỀN </th>
                            <th width="15%">NGÀY NỘP</th>
                            <th width="5%">HỌC KỲ</th>
                            <th width="12%">NĂM HỌC</th>
                            
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                                      echo "<th> TÙY CHỌN</th>";
                            }
                            ?>

                            </tr>
                          </thead>
                        <?php
                            echo "<tbody>";
                            $totalRows = 0;       

                            $query="select a.ID_THECHAPLT,a.ID_LIENTHONG,a.NGAYTHECHAP,a.SOTIEN,a.HOCKY,"
                                    . "a.NAMHOC,b.MASV,b.HODEM,b.TEN,b.PHAI,b.NGAYSINH,c.NGAYNOITRU,"
                                    . "d.TENPHONG from thechaplt a,lienthong b,dssvltnoitru c,phong d "
                                    . "where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_LIENTHONG=c.ID_LIENTHONG "
                                    . "and c.ID_PHONG=d.ID_PHONG and d.ID_PHONG=$idphong and "
                                    . " a.ID_THECHAPLT NOT IN "
                                    . "(select ID_THECHAPLT from dsphieuthuthechaplt where ID_THECHAPLT is not null)";//echo $query;
                            $result=mysqli_query($link,$query);
                            $totalRows=mysqli_num_rows($result); 
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                    
                                    echo "<div class=\"modal fade\" id=\"modalcapthechap$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                               echo "<div class=\"modal-dialog\">";
                                                    echo "<div class=\"modal-content\">";
                                                      echo "<div class=\"modal-header\">";
                                                          echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                          echo " <h4 class=\"modal-title\">Cập nhật thông tin thế chấp</h4>";
                                                        echo "</div>";
                                                        echo "<div class=\"modal-body\">";
                                                            echo "<form role=\"form\" action=\"thuchiencapnhatthongtinthechap.php\" method=\"post\">";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"ngaythechap\">Ngày thế chấp</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"ngaythechap\" value=\"".$row["NGAYTHECHAP"]."\""; 
                                                                          echo "name=\"ngaythechap\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"sotien\"> Số tiền</label>";
                                                                    echo "<input type=\"number\" class=\"form-control\" id=\"sotien\" value=\"".$row["SOTIEN"]."\" "; 
                                                                          echo "name=\"sotien\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"hocky\"> Học kỳ </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"hocky\" value=\"".$row["HOCKY"]."\" "; 
                                                                           echo "name=\"hocky\" placeholder=\"\">";
                                                                echo "</div>";
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"namhoc\">Năm học</label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"namhoc\" value=\"".$row["NAMHOC"]."\" "; 
                                                                           echo "name=\"namhoc\" placeholder=\"\">";
                                                                echo "</div>";
                                                                
                                                                
                                                                echo "<input type=\"hidden\" name=\"idthechap\" value=\"".$row["ID_THECHAPLT"]."\" />";
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
//                                    echo "<td><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["ID_SINHVIEN"]."\"> </td>";
//                                    echo "<td>"; echo $i; echo "</td>";
                                    echo "<td>"; echo $row["MASV"]; echo "</td>";
                                    echo "<td width=\"45\">"; echo $row["HODEM"]." ".$row["TEN"]; echo "</td>";
                                    
//                                    echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                    echo "<td>"; echo $row["TENPHONG"]; echo "</td>";
                                    echo "<td>"; echo $row["SOTIEN"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYTHECHAP"]; echo "</td>";
                                    echo "<td>"; echo $row["HOCKY"]; echo "</td>";
                                    echo "<td>"; echo $row["NAMHOC"]; echo "</td>";
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    echo "<a href=\"#modalcapthechap$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
//                                    echo "<a href=\"#modalsuaphong$i\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\">Xóa</a>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoathechaplt('".$row["ID_THECHAPLT"]."')\">Xóa</a></button>";
                                    echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieult('".$row["ID_THECHAPLT"]."')\">In phiếu</a></button>";
                                    //echo "<a href=\"thuchienxoaphong.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>";
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoadangkytamtru('".$row["ID_DANGKYTAMTRU"]."')\">Xóa</a></button>";
                                    echo "</td>";
                                }
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
