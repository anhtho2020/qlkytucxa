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
            function xoathechap(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoathechap.php?idthechap="+id;
                }
            }
            
            function inphieu(id){
                    window.location="inphieuthuthechap.php?idthechap="+id;
            }
 
            function load(){
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_danhsachphieuthechap.php?idday="+idday+"&idphong="+idphong;
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
                echo "document.dangkythechap.submit();";  
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
                        <h2> DANH SÁCH THU TIỀN THẾ CHẤP 2017</h2>
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
                        echo "<form name=\"xuatdanhsachphiethuthechap\" action=\"ktx_xuatexceldanhsachthutienthechap2017KHTC.php\" method=\"post\">";
                        echo "<tr>";
                            echo "<td> Từ ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"tungay\" id=\"tungay\" value=\"\"> </td>";
                            echo "<td> Đến ngày: </td>";
                            echo "<td> <input type=\"date\" name=\"denngay\" id=\"denngay\" value=\"\"> </td></br></br>";
                        echo "</tr>";
                        echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách thu thế cháp Từ ngày- Đến ngày</button>";
                        echo "</form>";   
                        echo "</div>"; 
                    
                        
                    //echo "<div>";
                    //    echo "<form name=\"xuatdanhsachphiethuthechap\" action=\"ktx_xuatexceldanhsachphieuthuthechap_all.php\" method=\"post\">";
                    //        echo "<button type=\"submit\" class=\"btn btn-info\"> In danh sách phiếu thu thế cháp </button>";
                    //    echo "</form>";
                    //echo "</div>";
                    
                    echo "<div class=\"form-group\">";
                    echo "</div>";
                    echo "<div>";
                        echo "<form name=\"thutienthechap\" action=\"ktx_thechap2017KHTC.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Thu tiền thế chấp </button>";
                        echo "</form>";
                    echo "</div>";

                    ?>
  		</div>                   
		</div>
                </div>
               <div class="row">                  
               <div class="col-lg-12">
               <div class="panel">
                    <div class="panel-body">
                    <div class="table-responsive">
                          <div class="adv-table">
                          <table class="table table-hover bangdiemlhp" id="example">
                          <thead>
                            <tr>
                            
                            <th width="8%">MÃ HSSV</th>
                            <th width="18%">HỌ TÊN </th>
                            
                            <th width="5%">PHÒNG</th>
                            <th width="8%"> SỐ TIỀN </th>
                            <th width="13%">NGÀY THẾ CHẤP</th>
                            
                            <th width="4%">NGƯỜI THU</th>
                            
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                                echo "<th> Tùy chọn </th>";
                            }
                            ?>
                            </tr>
                          </thead>
                        <?php
                            echo "<tbody>";
                            $totalRows = 0;       
                            $query="select a.ID_THECHAP,a.ID_SINHVIEN,a.NGAYTHECHAP,a.SOTIEN,"
                                    . " a.NGUOITHU,b.MAHSSV,b.HODEM,b.TEN,b.PHAI,b.NGAYSINH, "
                                    . "c.TENPHONG from thechap2017khtc a,dshssv b,phong c "
                                    . "where a.ID_SINHVIEN=b.ID_DSHSSV and a.ID_PHONG=c.ID_PHONG ";
                                    //. "and c.ID_PHONG=d.ID_PHONG and c.ID_PHONG=$idphong";
//echo $query;
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
                                                                    echo "<label for=\"masv\"> Mã SV </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MAHSSV"]."\" "; 
                                                                           echo "name=\"masv\" placeholder=\"\">";
                                                                echo "</div>";
                                                                
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"tenphong\"> Phòng </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"tenphong\" value=\"".$row["TENPHONG"]."\" "; 
                                                                           echo "name=\"tenphong\" placeholder=\"\">";
                                                                echo "</div>";
                                                                
                                                                echo "<div class=\"form-group\">";
                                                                    echo "<label for=\"nguoithu\"> Người thu </label>";
                                                                    echo "<input type=\"text\" class=\"form-control\" id=\"nguoithu\" value=\"".$row["NGUOITHU"]."\" "; 
                                                                           echo "name=\"nguoithu\" placeholder=\"\">";
                                                                echo "</div>";
                                                                
                                                                
                                                                echo "<input type=\"hidden\" name=\"idthechap\" value=\"".$row["ID_THECHAP"]."\" />";
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
                                    echo "<td>"; echo $row["MAHSSV"]; echo "</td>";
                                    echo "<td width=\"45\">"; echo $row["HODEM"]." ".$row["TEN"]; echo "</td>";
                                    
//                                    echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
                                    echo "<td>"; echo $row["TENPHONG"]; echo "</td>";
                                    echo "<td>"; echo $row["SOTIEN"]; echo "</td>";
                                    echo "<td>"; echo $row["NGAYTHECHAP"]; echo "</td>";
                                    //echo "<td>"; echo $row["NGAYINPHIEU"]; echo "</td>";
                                    echo "<td>"; echo $row["NGUOITHU"]; echo "</td>";
                                    //echo "<td>"; echo $row["NAMHOC"]; echo "</td>";
                                    if($_SESSION["quyen"]=="QT")
                                    {
                                        echo "<td>";
                                        echo "<a href=\"#modalcapthechap$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                        //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoathechap('".$row["ID_THECHAP"]."')\">Xóa</a></button>";
                                        echo "<button class=\"btn btn-primary btn-xs\" onClick=\"inphieu('".$row["ID_THECHAP"]."')\">In phiếu</a></button>";
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
