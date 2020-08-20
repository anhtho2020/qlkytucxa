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
                var idbdt=document.getElementById('idbacdaotao').value;
                var idlt=document.getElementById('idloplt').value;
                var url="ktx_nhap_lienthong.php?idbdt="+idbdt+"&idlt="+idlt;
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
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        
        $idlt=0;
        if(isset($_GET["idlt"])){
            $idlt=$_GET["idlt"];
        }
        
        $idbdt=0;
        if(isset($_GET["idbdt"])){
            $idbdt=$_GET["idbdt"];
        }
        if($idbdt==1)
            {
                $kt=1;
            }
            else if($idbdt==2)
            {
                $kt=2;
            }
            else {
                $kt=0;
            }
 
        $sohoso=1;
        if(isset($_POST["sohoso"])){
            $sohoso=$_POST["sohoso"];
        }
        else echo " ";
                
        $cmnd='';
        if(isset($_POST["cmnd"])){
             $cmnd=$_POST["cmnd"];
        }
        else echo " ";
        

        $namnhaphoc='';
        if(isset($_POST["namnhaphoc"])){
             $namnhaphoc=$_POST["namnhaphoc"];
        }
        else echo " ";
        $masv='';
        if(isset($_POST["masv"])){
             $masv=$_POST["masv"];
        }
        else echo " ";
        $hodem='';
        if(isset($_POST["hodem"])){
             $hodem=$_POST["hodem"];
        }
        else echo " ";
        $ten='';
        if(isset($_POST["ten"])){
             $ten=$_POST["ten"];
        }
        else echo " ";
        $phai=0;
        if(isset($_POST["phai"])){
             $phai=$_POST["phai"];
        }
        else echo " ";
        $ngaysinh='';

        if(isset($_POST["ngaysinh"])){
             $nnt=$_POST["ngaysinh"];
             $x=explode("/", $nnt);
             $ngaysinh=$x[2]."-".$x[1]."-".$x[0];
        }
        else echo " ";
        
        
        $diachi='';
        if(isset($_POST["diachi"])){
             $diachi=$_POST["diachi"];
        }
        else echo " ";
        $email='';
        if(isset($_POST["email"])){
             $email=$_POST["email"];
        }
        else echo " ";
        $dienthoai='';
        if(isset($_POST["dienthoai"])){
             $dienthoai=$_POST["dienthoai"];
        }
        else echo " ";
        $dantoc='';
        if(isset($_POST["dantoc"])){
             $dantoc=$_POST["dantoc"];
        }
        else echo " ";
        $dienchinhsach='';
        if(isset($_POST["dienchinhsach"])){
             $dienchinhsach=$_POST["dienchinhsach"];
        }
        else echo " ";
        $tpgiadinh='';
        if(isset($_POST["tpgiadinh"])){
             $tpgiadinh=$_POST["tpgiadinh"];
        }
        else echo " ";
        $ghichu='';
        if(isset($_POST["ghichu"])){
             $ghichu=$_POST["ghichu"];
        }
        else echo " ";
        
        $idlop=0;
        if(isset($_POST["idlop"])){
             $idlop=$_POST["idlop"];
        }
        else echo " ";

        if($hodem != '' && $ten != '')
        {
            $query="insert into lienthong(ID_LOP,SOHOSO,NAMNHAPHOC,CMND,"
                            . "MASV,HODEM,TEN,PHAI,NGAYSINH,DIACHI,DIENTHOAI,DANTOC,DIENCHINHSACH,"
                            . "TPGIADINH,GHICHU) values($idlop,$sohoso,'$namnhaphoc','$cmnd','$masv',"
                            . "'$hodem','$ten',$phai,'$ngaysinh','$diachi','$dienthoai',"
                            . "'$dantoc','$dienchinhsach','$tpgiadinh','$ghichu')";
                    mysqli_query($link,$query);
                    //echo $query;
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
                        <h2> Nhập sinh viên liên thông </h2>
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
                        echo "<form name=\"themhssvnoitru\" action=\"ktx_nhap_lienthong.php\" method=\"post\">";
                        echo "<div>"; 
                        
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                        echo "<th > Bậc đào tạo: </th>";
                            echo "<select name=\"bacdaotao\" id=\"idbacdaotao\" onchange=\"load()\">";
                            
                                echo "<option value=\"0\"";
                                if($kt==0){echo " selected=\"selected\"";}
                                echo ">Bac hoc</option>";
                                
                                echo "<option value=\"1\"";
                                if($kt==1){echo " selected=\"selected\"";}
                                echo ">Cao đẳng</option>";
                                
                                echo "<option value=\"2\"";
                                if($kt==2){echo " selected=\"selected\"";}
                                echo ">Đại học </option>";
                                
                                echo ">";
                            echo "</select>";
                            
                      
                       
                        
                        echo "<td width=\"400\"> Mã lớp: </td>";
                        echo "<select name=\"loplt\" id=\"idloplt\" onchange=\"load()\">";
                        
                            echo "<option value=\"0\"";
                                    if($kt==0){echo " selected=\"selected\"";}
                                    echo ">Lop</option>";
                            $query_lcn="select ID_LOPLT,MALOPLT,TENLOPLT from loplt where ID_BACHOC=$kt";
                            //echo $query_lcn;
                            $result_lcn=mysqli_query($link,$query_lcn);
                            while($row_lcn=  mysqli_fetch_array($result_lcn)){
                                echo "<option value=\"".$row_lcn["ID_LOPLT"]."\"";
                                if($row_lcn["ID_LOPLT"]==$idlt){
                                    echo " selected=\"selected\"";
                                }
                                echo ">";
                                echo $row_lcn["MALOPLT"]."</option>";
                            }

                        echo "</select>";
                        echo "</tr>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        
                        echo "<tr>";
                        echo "<th> Số hồ sơ: </th>";
                        echo "<td> <input type=\"text\" name=\"sohoso\" id=\"sohoso\" size=\"4\" maxlength=\"4\" value=\"\"> </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td> Năm nhập học: </td>";
                            echo "<td> <input type=\"text\" name=\"namnhaphoc\" id=\"namnhaphoc\" size=\"4\" maxlength=\"4\" value=\"\"></td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<th> Số CMND: </th>";
                        echo "<td>&nbsp</td> ";
                        echo "<td width=\"60\"> <input type=\"text\" name=\"cmnd\" id=\"cmnd\" size=\"12\" maxlength=\"12\" value=\"1\" </td>";
                        echo "</tr>";
                        
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<div>";
                        echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Mã HSSV: </td>";
                            echo "<td> <input type=\"text\" name=\"masv\" id=\"masv\" size=\"10\" maxlength=\"10\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Họ đệm: </td>";
                            echo "<td> <input type=\"text\" name=\"hodem\" id=\"hodem\" size=\"30\" maxlength=\"30\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Tên: </td>";
                            echo "<td> <input type=\"text\" name=\"ten\" id=\"ten\" size=\"10\" maxlength=\"10\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Phái: </td>";
                            echo "<td> <input type=\"text\" name=\"phai\" id=\"phai\" size=\"1\" maxlength=\"1\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Ngày sinh: </td>";
                            echo "<td> <input type=\"text\" name=\"ngaysinh\" id=\"ngaysinh\" size=\"10\" maxlength=\"10\" value=\"\" </td>";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<div>";
                       echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Địa chỉ: </td>";
                            echo "<td> <input type=\"text\" name=\"diachi\" id=\"diachi\" size=\"30\" maxlength=\"30\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Điện thoại: </td>";
                            echo "<td> <input type=\"text\" name=\"dienthoai\" id=\"dienthoai\" size=\"11\" maxlength=\"11\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Dân tộc: </td>";
                            echo "<td> <input type=\"text\" name=\"dantoc\" id=\"dantoc\" size=\"30\" maxlength=\"30\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Diện chính sách: </td>";
                            echo "<td> <input type=\"text\" name=\"dienchinhsach\" id=\"dienchinhsach\" size=\"20\" maxlength=\"20\" value=\"\" </td>";
                        echo "</tr>";
                        echo "</div>";
                        echo "</div>";
                        
                        echo "<div>";
                       echo "<div class=\"form-group\">";
                        echo "<tr>";
                            echo "<td> Thành phần gia đình: </td>";
                            echo "<td> <input type=\"text\" name=\"tpgiadinh\" id=\"tpgiadinh\" size=\"30\" maxlength=\"30\" value=\"\" </td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                            echo "<td> Ghi chu: </td>";
                            echo "<td> <input type=\"text\" name=\"ghichu\" id=\"ghichu\" size=\"20\" maxlength=\"20\" value=\"\" </td>";
                        echo "</tr>";
                        echo "<input type=\"hidden\" name=\"idlop\" value=\"".$idlt."\" />";
                        echo "<input type=\"hidden\" name=\"chon\" id=\"chon\"> ";                       
                        echo "</div>";
                        echo "</div>";
                        if($_SESSION["quyen"]=="QT")
                        {
                            echo "<button type=\"submit\" class=\"btn btn-info\">Thực hiện </button>";
                        }
                        echo "</form>";    
                        echo "<div class=\"form-group\">";
//                        echo "<button onclick=\"tht()\" class=\"btn btn-info\">Đăng ký</button>";
                        
                        echo "</div>"; 
                        
//                        echo "<div>"; 
                        echo "<div class=\"form-group\">";
                        echo "<form role=\"form\" action=\"ktx_danhsachsinhvienlt.php\" method=\"post\">";
                            echo "<button type=\"submit\" class=\"btn btn-info\">Danh sách sinh viên liên thông </button>";
                        echo "</form>";  
                        echo "</div>"; 

                    ?>
                   
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
