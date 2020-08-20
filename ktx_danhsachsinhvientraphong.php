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
            function xoasinhvientraphong(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoadanhsachsinhvientraphong.php?iddanhsachtraphong="+id;
                }
            }
        </script>
    <?php  
        
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $query ="select a.ID_DANHSACHTRAPHONG, a.NGAYNOITRU,a.NGAYTRAPHONG,a.ID_SINHVIEN,b.MASV,b.HODEM,"
                . "b.TEN,b.NGAYSINH,c.MALOPCHUYENNGANH, d.TENPHONG "
                . "from danhsachtraphong a,sinhvien b,lopchuyennganh c,"
                . " phong d where a.ID_SINHVIEN=b.ID_SINHVIEN and b.ID_LOPCHUYENNGANH=c.ID_LOPCHUYENNGANH and a.ID_PHONG=d.ID_PHONG";  
        //echo $query;
        $result = mysqli_query( $link,$query);  
        $totalRows=mysqli_num_rows($result); 
    
        
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
<!--               <div class="row">
               <div class="col-lg-12 selecthk">-->
               <div class="panel panel-default">
                    <header class="panel-heading">
                        <h2> Danh sách học sinh sinh viên trả phòng </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                    <div class="modal-body">
                        <form role="form" action="ktx_xuatexceldanhsachsinhvientraphong.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">In danh sách HSSV trả phòng</button>
                        </form>                                               
                        <br>
                        <form role="form" action="ktx_traphong.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">HSSV trả phòng</button>
                        </form>                                               
                    </div> <!--End of ModalBody-->

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
                            <th width="3%">STT</th>
                            <th width="8%">MÃ HSSV</th>
                            <th width="16%">HỌ VÀ TÊN</th>
                            
                            <th width="13%">NGÀY SINH</th>
                            <th width="6%">LỚP</th>
                            <th width="4%">PHÒNG</th>
                            <th width="12%">NGÀY NỘI TRÚ</th>
                            <th width="12%">NGÀY TRẢ PHÒNG</th>
                        <?php
                            if($_SESSION["quyen"]=="QT")
                            {
                                echo "<td> Tùy chọn </td>";
                            }
                        ?>
                            </tr>
                          </thead>
                          <tbody>
                        <?php
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatngaytraphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                        echo "<div class=\"modal-dialog\">";
                                             echo "<div class=\"modal-content\">";
                                               echo "<div class=\"modal-header\">";
                                                   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                   echo " <h4 class=\"modal-title\">Cập nhật HSSV trả phòng</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatdanhsachsinhvientraphong.php\" method=\"post\">";
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\"mahssv\"> Mã HSSV</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"mahssv\" value=\"".$row["MASV"]."\""; 
                                                                   echo "name=\"mahssv\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaytraphong\"> Ngày trả phòng</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaytraphong\" value=\"".$row["NGAYTRAPHONG"]."\""; 
                                                                   echo "name=\"ngaytraphong\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<input type=\"hidden\" name=\"iddstraphong\" value=\"".$row["ID_DANHSACHTRAPHONG"]."\" />";
//                                                         echo "<input type=\"hidden\" name=\"idkhach\" value=\"".$row["ID_KHACH"]."\" />";
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
                                <td><?=$row["HODEM"]?><?=" "?><?=$row["TEN"]?></td>
                                <!--<td> </td>-->
                                <td><?=$row["NGAYSINH"]?></td>
                                <td><?=$row["MALOPCHUYENNGANH"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <td><?=$row["NGAYTRAPHONG"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                        <?php
                        if($_SESSION["quyen"]=="QT")
                        {
                                  echo "<td>";
                                   //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                    //echo "<a href=\"#modalcapnhatngaytraphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                    
                                    //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvientraphong('".$row["ID_DANHSACHTRAPHONG"]."')\">Xóa</a></button>";
                                    
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
