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
            function xoasinhviennoitru(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoasinhviennoitru_dcs.php?idsinhvien="+id;
                }
            }
            
            function xoa(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoaphong.php?idphong="+id;
                }
            }

            function load(){
                
                var idday=document.getElementById('idday').value;
                var idphong=document.getElementById('idphong').value;
                var url="ktx_capnhatthongtinsinhvien.php?idday="+idday+"&idphong="+idphong;
                window.location=url;
            }
        </script>
        
    <?php  
        

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
        $dienchinhsach=1;
        if(isset($_GET["dienchinhsach"])){
            $dienchinhsach=$_GET["dienchinhsach"];
        }
        if($dienchinhsach==1)
            {
                $dcs="Nha ngheo";
            }
            else if($dienchinhsach==2)
            {
                $dcs="Con thuong binh";
            }
            else if($dienchinhsach==3)
            {
                $dcs="Tu quan";
            }
            else if($dienchinhsach==4)
            {
                $dcs="Bo doi xuat ngu";
            }
            else 
            {
                $dcs=" ";
            }
        
        if(isset($_POST["ngaynoitru"])){
             $nnt=$_POST["ngaynoitru"];
             $x=explode("/", $nnt);
             $ngaynoitru=$x[2]."-".$x[1]."-".$x[0];//echo $ngaynoitru;
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
                        <h2> Cập nhật thông tin sinh viên </h2>
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
                        echo "<form name=\"capnhatthongtinsinhvien\" action=\"ktx_capnhatthongtinsinhvien.php\" method=\"post\">";
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
                        echo "<form role=\"form\" action=\"ktx_sinhviennoitru.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\"> Sinh viên đăng ký nội trú </button>";
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
                            <th>STT</th>
                            <th>MÃ SINH VIÊN</th>
                            <th>HỌ VÀ TÊN </th>
                          
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            <th>CMND</th>
                            <th> ĐỊA CHỈ</th>
                            <th>DIỆN CS</th>
                            <th>LỚP</th>
                            <th>TÊN PHÒNG</th>
                            <th>NGÀY NỘI TRÚ</th>
                            <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                            echo "<th>TÙY CHỌN</th>";
                            }
                            ?>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            $totalRows = 0;       
                            $stSQL ="select a.NGAYNOITRU,a.ID_SINHVIEN,b.MASV,b.HODEM,b.TEN,b.NGAYSINH,"
                                    . "b.PHAI,b.CMND,b.DIACHI,b.DIENCHINHSACH,c.TENPHONG,"
                                    . "d.MALOPCHUYENNGANH from danhsachnoitru a,sinhvien b, phong c,"
                                    . "lopchuyennganh "
                                    . "d where a.ID_SINHVIEN=b.ID_SINHVIEN and a.ID_PHONG=c.ID_PHONG and "
                                    . "b.ID_LOPCHUYENNGANH=d.ID_LOPCHUYENNGANH and a.ID_PHONG=$idphong";  
                            $result = mysqli_query($link,$stSQL);  
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
                                                   echo " <h4 class=\"modal-title\">Cập nhật thông tin sinh viên</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatthongtinsinhvien.php\" method=\"post\">";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"masv\"> Mã sinh viên</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"masv\" value=\"".$row["MASV"]."\""; 
                                                                   echo "name=\"masv\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"hodem\"> Họ đệm </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"hodem\" value=\"".$row["HODEM"]."\" "; 
                                                                   echo "name=\"hodem\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ten\"> Tên </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ten\" value=\"".$row["TEN"]."\" "; 
                                                                    echo "name=\"ten\" placeholder=\"\">";
                                                         echo "</div>";

							echo "<div class=\"form-group\">";
                                                             echo "<label for=\"phai\"> Phái </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"phai\" value=\"".$row["PHAI"]."\" "; 
                                                                    echo "name=\"phai\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"cmnd\"> Chứng minh nhân dân </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"cmnd\" value=\"".$row["CMND"]."\" "; 
                                                                    echo "name=\"cmnd\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"diachi\"> Địa chỉ </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"diachi\" value=\"".$row["DIACHI"]."\" "; 
                                                                    echo "name=\"diachi\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"dienchinhsach\"> Diện chính sách </label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"dienchinhsach\" value=\"".$row["DIENCHINHSACH"]."\" "; 
                                                                    echo "name=\"dienchinhsach\" placeholder=\"\">";
                                                         echo "</div>";
                                                         //echo "<input type=\"hidden\" name=\"idphong\" value=\"".$row["ID_PHONG"]."\" />";
                                                         echo "<input type=\"hidden\" name=\"idsinhvien\" value=\"".$row["ID_SINHVIEN"]."\" />";
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
                                <td><?=$row["MASV"]?></td>
                                <td><?=$row["HODEM"]?> <?=' '?><?=$row["TEN"]?></td>
                                
                                <td><?=$row["NGAYSINH"]?></td>
                                <?php
                                if($row["PHAI"]==0)
                                {
                                    echo "<td>"; echo 'Nam'; echo"</td>";
                                }
                                else {
                                    echo "<td>"; echo 'Nữ'; echo"</td>";
                                }
                                ?>
                                <td><?=$row["CMND"]?></td>
                                <td><?=$row["DIACHI"]?></td>
                                <td><?=$row["DIENCHINHSACH"]?></td>
                                <td><?=$row["MALOPCHUYENNGANH"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                    echo "<td>";
                                    
                                    echo "<a href=\"#modalcapnhatdienchinhsach$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    //echo "<button class=\"btn btn-warning btn-xs\" onClick=\"capnhatsinhviennoitru('".$row["ID_SINHVIEN"]."')\">Sửa</a></button>";
                                    echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhviennoitru('".$row["ID_SINHVIEN"]."')\">Xóa</a></button>";
                                    
                                  
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
              <!--</div>-->                         
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <?php
           // clsData::footer_data();
      ?>
      <!--footer end-->
  </section>
        <?php
            clsData::footer_footer();
        ?>
  </body>
</html>
