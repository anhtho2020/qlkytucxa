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
            function xoasinhvienlttraphong(id){
                if(confirm('Ban co chac xoa khong?')){
                    window.location="thuchienxoadanhsachsinhvienlttraphong.php?iddanhsachtraphonglt="+id;
                }
            }
        </script>
    <?php  
        
        require("dbcon.php");  
        $link=  clsConnet::DBConnect();
        //mysql_query("SET CHARACTER SET utf8",$link);
        $totalRows = 0;       
        $query ="select a.ID_DSTRAPHONGLT, a.NGAYNOITRU,a.NGAYTRAPHONG,a.ID_LIENTHONG,b.MASV,b.HODEM,"
                . "b.TEN,b.NGAYSINH,c.MALOPLT, d.TENPHONG "
                . "from dstraphonglt a,lienthong b,loplt c,"
                . " phong d where a.ID_LIENTHONG=b.ID_LIENTHONG and b.ID_LOP=c.ID_LOPLT "
                . "and a.ID_PHONG=d.ID_PHONG";  
        //echo $query;
        $result = mysqli_query($link,$query);  
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
                        <h2> Danh sách sinh viên liên thông trả phòng </h2>
                        <span class="tools pull-right">
                            <a class="icon-chevron-down" href="javascript:;"></a>
                            <a class="icon-remove" href="javascript:;"></a>
                        </span>
                    </header>
                   <div class="panel-body">                   		                       
                        <a class="btn btn-danger" href="ktx_phong.php"><i class="icon-reply"></i> Trở về</a>                              
                    </div>
                    <div class="modal-body">
                        <form role="form" action="ktx_xuatexceldanhsachsinhvientraphonglt.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">In danh sách SVLT trả phòng</button>
                        </form>                                               
                    </br>
                    
                        <form role="form" action="ktx_traphonglt.php" method="post">                                                   
                            <button type="submit" class="btn btn-info">SVLT trả phòng</button>
                        </form>                                               
                    </div> <!--End of ModalBody-->
<!--  			<div class="panel-body">                   		  
                            <button class="btn btn-info" data-toggle="modal" href="#modalupexcel"> <i class="icon-cloud-upload"> </i> Thêm sinh viên </button>
 
                            <div class="modal fade" id="modalupexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Thêm sinh viên nội trú</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="ktx_sinhviennoitru.php" >
                                                <button type="submit" class="btn btn-info">Mở trang thêm sinh viên nội trú</button>
                                            </form>
                                            
                                            End of Success             
                                        </div> End of ModalBody
                                        <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            
                            
                            
                        </div>-->
                            
                                
                   
                   
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
                            <th width="8%">MÃ SVLT</th>
                            <th width="16%">HỌ VÀ TÊN</th>
                            
                            <th width="13%">NGÀY SINH</th>
                            <th width="6%">LỚP</th>
                            <th width="4%">PHÒNG</th>
                            <th width="13%">NGÀY NỘI TRÚ</th>
                            <th width="13%">NGÀY TRẢ PHÒNG</th>
                            
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
                            if($totalRows>0)   
                            {    
                                $i=0;                    
                                while ($row = mysqli_fetch_array ($result))     
                                {                                   
                                    $i+=1;
                                    echo "<div class=\"modal fade\" id=\"modalcapnhatsvlttraphong$i\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
                                        echo "<div class=\"modal-dialog\">";
                                             echo "<div class=\"modal-content\">";
                                               echo "<div class=\"modal-header\">";
                                                   echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
                                                   echo " <h4 class=\"modal-title\">Cập nhật ngày trả phòng</h4>";
                                                 echo "</div>";
                                                 echo "<div class=\"modal-body\">";
                                                     echo "<form role=\"form\" action=\"thuchiencapnhatdanhsachsinhvienlttraphong.php\" method=\"post\">";
                                                        echo "<div class=\"form-group\">";
                                                             echo "<label for=\"masvlt\"> Mã SVLT</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"masvlt\" value=\"".$row["MASV"]."\""; 
                                                                   echo "name=\"masvlt\" placeholder=\"\">";
                                                         echo "</div>";
                                                         echo "<div class=\"form-group\">";
                                                             echo "<label for=\"ngaytraphong\"> Ngày trả phòng</label>";
                                                             echo "<input type=\"text\" class=\"form-control\" id=\"ngaytraphong\" value=\"".$row["NGAYTRAPHONG"]."\""; 
                                                                   echo "name=\"ngaytraphong\" placeholder=\"\">";
                                                         echo "</div>";
                                                         
                                                         echo "<input type=\"hidden\" name=\"iddstraphonglt\" value=\"".$row["ID_DSTRAPHONGLT"]."\" />";
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
                                <td><?=$row["MALOPLT"]?></td>
                                <td><?=$row["TENPHONG"]?></td>
                                <td><?=$row["NGAYNOITRU"]?></td>
                                <td><?=$row["NGAYTRAPHONG"]?></td>
                                <!--<td><span class="badge bg-important"> </span></td>-->
                                
                                <?php
                                if($_SESSION["quyen"]=="QT")
                                {
                                          echo "<td>";
                                           //echo "<a href=\"ktx_edit.php?idphong=".$row["ID_PHONG"]."\" class=\"btn btn-primary btn-xs\">Xem chi tiết</a>";
                                            echo "<a href=\"#modalcapnhatsvlttraphong$i\" class=\"btn btn-warning btn-xs\" data-toggle=\"modal\">Sửa</a>";
                                            //echo "<button class=\"btn btn-danger btn-xs\" onClick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</button>";
                                            echo "<button class=\"btn btn-danger btn-xs\" onClick=\"xoasinhvienlttraphong('".$row["ID_DSTRAPHONGLT"]."')\">Xóa</a></button>";

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
