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
                var url="ktx_thutienphongsinhvienlt.php?idday="+idday+"&idphong="+idphong+"&hocky="+hocky;
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
                echo "document.thutienphongsinhvienlt.submit();";  
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
        $idphong=0;
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
                $kthk=1;
            }
            else
            {
                $kthk=2;
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
        
        $hocky=0;
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
            $query_dk="select * from tienphongsinhvienlt ";//echo $query_dk;
            $result_dk = mysqli_query($link,$query_dk);  
            $totalRows_dk=mysqli_num_rows($result_dk); 
            while ($row = mysqli_fetch_array ($result_dk))
            {
                if(($row["ID_LIENTHONG"]==$arr[$i])&&($row["HOCKY"]==$hocky)&&($row["NAMHOC"]==$namhoc))
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
                $query_dcs="select * from lienthong where ID_LIENTHONG=$arr[$i]";//echo $query_dk;
                $result_dcs = mysqli_query($link,$query_dcs);  
                $totalRows_dcs=mysqli_num_rows($result_dcs); 
                $row_dcs = mysqli_fetch_array ($result_dcs);
                $ngheo="Nha ngheo";
                $contb="Con thuong binh";
                $bodoi="Bo doi xuat ngu";
                $ngheo=addslashes($ngheo);
                $contb=addslashes($contb);
                $bodoi=addslashes($bodoi);
                $st=$sotien;
                if($row_dcs["DIENCHINHSACH"]==$ngheo)
                {
                    $st=0;
                }
                else if($row_dcs["DIENCHINHSACH"]==$contb)
                {
                    $st=$st*1/2;
                }
                else if($row_dcs["DIENCHINHSACH"]==$bodoi)
                {
                    $st=$st*1/4;
                }
                else 
                {
                    $st=$sotien;
                }
                //echo $row_dcs["DIENCHINHSACH"];
                $query="insert into tienphongsinhvienlt(ID_LIENTHONG,DONGIA,NGAYTHU,HOCKY,NAMHOC,NGUOITHU) "
                               . "values($arr[$i],$st,'$ngaythu',$hocky,'$namhoc','$nguoithu')";
                       mysqli_query($link,$query);
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
                        <h2> Thu tiền phòng SVLT nội trú </h2>
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
                        echo "<form name=\"thutienphongsinhvienlt\" action=\"ktx_thutienphongsinhvienlt.php\" method=\"post\">";
                       
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
                        
                        echo "<tr>";
                        echo "<th > Học kỳ: </th>";
                            echo "<select name=\"hocky\" id=\"hocky\" onchange=\"load()\">";
                                
                                echo "<option value=\"1\"";
                                if($kthk==1){echo " selected=\"selected\"";}
                                echo ">1</option>";
                                
                                echo "<option value=\"2\"";
                                if($kthk==2){echo " selected=\"selected\"";}
                                echo ">2 </option>";
                                
                                echo ">";
                            echo "</select>";
                            
                       echo "</tr>";
                       
                        echo "<tr>";
                        $now = getdate(); 
//                        $namsau=$now["year"]+1;
//                        $namtruoc=$now["year"]-1;
//                            if(hocky==1)
//                            {
//                                $nhoc=$now["year"]."-".$namsau;
//                            }
//                            else {
//                                $nhoc=$namtruoc."-".$now["year"];
//                            }
                            echo "<td> Năm học: </td>";
                            echo "<td> <input type=\"text\" name=\"namhoc\" id=\"namhoc\" size=\"10\" maxlength=\"10\" value=\"\" </td>";
                        echo "</tr>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Số tiền: </td>";
                            echo "<td> <input type=\"text\" name=\"sotien\" id=\"sotien\" size=\"6\" maxlength=\"6\" value=\"450000\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                        
                        $ngthu=$now["mday"] . '/'. $now["mon"] . '/' . $now["year"];
                        echo "<td> Ngày thu: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaythu\" id=\"ngaythu\" size=\"8\" maxlength=\"8\" value=\"".$ngthu."\" </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td> Người thu: </td>";
                            echo "<input type=\"text\" name=\"nguoithu\" id=\"nguoithu\" value=\"\" </td>";
                        echo "</tr>";
                        
                        
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";
//                        echo "<tr>";
//                       
//                            echo "<td> Học kỳ: </td>";
//                            echo "<td>&nbsp</td> ";
//                            
//                            echo "<td width=\"60\"> <input type=\"text\" name=\"hocky\" id=\"hocky\" value=\"I\" </td>";
//                        echo "</tr>";
                        
                        
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
                        if($_SESSION["quyen"]=="QT")
                        {
							echo "<button onclick=\"tht()\" class=\"btn btn-info\">Thu tiền phòng</button>";
							echo "</div>"; 
                        }
                        echo "</div>"; 
                    ?>
                    <div class="form-group"> 
                        <form role="form" action="ktx_ds_svlt_tienphong.php" method="post">                                                   
                        <button type="submit" class="btn btn-info">Danh sách SVLT nộp tiền phòng</button>
                    </form> 
                    </div>      
  		</div>                   
		</div>
                </div>
               <div class="row">                  
               <div class="col-lg-8">
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
                            <!--<th>TÊN</th>-->
                            <th>NGÀY SINH</th>
                            <th>PHÁI</th>
                            </tr>
                          </thead>
                        <?php
                        
                            echo "<tbody>";
                        
                            $totalRows = 0;       
                            $stSQL ="select a.ID_LIENTHONG,b.MASV, b.HODEM,b.TEN,b.NGAYSINH,b.PHAI,b.DIENCHINHSACH "
                                    . "from dssvltnoitru a, lienthong b "
                                    . "where a.ID_LIENTHONG=b.ID_LIENTHONG and a.ID_PHONG=$idphong";
                                    //. " and a.ID_LIENTHONG not in (select ID_LIENTHONG from tienphongsinhvienlt where ID_LIENTHONG is not null)";
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
									echo "<td>"; echo $row["HODEM"]." ".$row["TEN"];echo "</td>";
//                                echo "<td>"; echo $row["TEN"]; echo "</td>";
									echo "<td>"; echo $row["NGAYSINH"]; echo "</td>";
									if($row["PHAI"]==0)
									{
										echo "<td>"; echo "Nam" ; echo "</td>";
									}
									else {
										echo "<td>"; echo "Nữ"; echo "</td>";
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
