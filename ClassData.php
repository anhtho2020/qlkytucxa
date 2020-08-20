<?php
class clsData{
     public static function welcometowork()
    {
        session_start();
        if(!isset($_SESSION["quyen"]) || ($_SESSION["quyen"]!="QT" && $_SESSION["quyen"]!="KTKTX" && $_SESSION["quyen"]!="CTCTHT")){
            echo "<script>";
            echo "alert('Ban khong co quyen quan tri');";
            echo "window.location=\"index.php\";";
            echo "</script>";
        }
        
        
    }
    public static function header_header()
    {
        ?>
	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="nthieu">
    	<!--<meta name="keyword" content="CTEC">-->
    	<link rel="shortcut icon" href="img/favicon.png">

    	<title>CHƯƠNG TRÌNH QUẢN LÝ KÝ TÚC XÁ | KHOA CNTT - TT</title>

    	<!-- Bootstrap core CSS -->
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/bootstrap-reset.css" rel="stylesheet">
    	<!--external css-->
    	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    	<link href="assets/isotope/jquery.isotope.css" rel="stylesheet" />
     	<link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    	<link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    	<!-- Custom styles for this template -->
    	<link href="css/style.css" rel="stylesheet">
    	<link href="css/style-responsive.css" rel="stylesheet" />
    	<link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />

    	<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    	<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <style rel='stylesheet' type='text/css'>
            body {
                margin: 0;
            }
            th, tfoot td {
                /*border: thin solid black;*/
                text-align: left;
                font-weight: bold;
                font-size: 130%;
            }
            tbody td {
                font-size: 100%;
                font-weight: bold;
            }
            body, td, div{
                    font-family:Arial, Helvetica, sans-serif;
                    font-size:12px; line-height:14px;
                    color:#838486;
                    font-weight:bold;
            }
            input{
                    height:20px;
                    font-weight:bold;
                    text-indent:3px;
            }
        </style>
<?php
    }
    public static function data_header()
    {
        ?>
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Ẩn Menu" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="index.html" class="logo">KTX<span>System</span></a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username"><?=$_SESSION["hodem"]." ".$_SESSION["ten"];?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <!--<div class="log-arrow-up"></div>-->
                            <li><a href="ktx_capnhatmatkhau.php"><i class="icon-credit-card"></i>Cập nhật MK</a></li>
                            <li><a href="ktx_phong.php"><i class="icon-table"></i> QL Phòng</a></li>
                            <li><a href="ktx_sinhviennoitru.php"><i class="icon-bell-alt"></i> QL Sinh Viên</a></li>
                            <li><a href="dangxuat.php"><i class="icon-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>

<?php
    }
    
    public static function data_menu()
    {
        ?>
        <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a href="index.php">
                          <i class="icon-dashboard"></i>
                          <span>Trang chủ</span>
                        </a>
                    </li>
                  
                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="icon-edit"></i>
                            <span>Quản lý</span>
                        </a>
                        <ul class="sub">
                            <!--<li ><a href="ktx_capnhatmatkhau.php"><i class="icon-key"></i> Cập nhật mật khẩu</a></li>-->
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="icon-home"></i>
                                    <span>Quản lý phòng</span>
                                </a>
                                <ul class="sub">
                                    <!--<li class="active"><a href="ktx_phong.php"><i class="icon-home"></i> Phòng</a></li>-->
                                    <li class="active"><a href="ktx_phong.php"> Phòng </a></li>
                                    <li><a  href="ktx_danhsachphong.php">Danh sách phòng</a></li>
                                    <!--<li><a  href="ktx_danhmuctaisan.php">Danh mục tài sản</a></li>-->
                                </ul>
                            </li>
                            
                            
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="icon-table"></i>
                                    <span>Cơ sở vật chất</span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="ktx_taisan.php">Nhập tài sản</a></li>
                                    <li><a  href="ktx_trangbi.php">Trang bị tài sản cho phòng</a></li>
                                    <li><a  href="ktx_danhmuctaisan.php">Danh mục tài sản</a></li>
				    <li><a  href="ktx_update_csdl.php">Update data</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span> Quản lý HSSV </span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="ktx_sinhviennoitru.php"> Đăng ký nội trú</a></li>
                                    <li><a  href="ktx_danhsachsinhviennoitru.php"> DS nội trú </a></li>
				    <li><a  href="ktx_capnhatthongtinsinhvien.php"> Cập nhật TT_SV </a></li>
                                    <li><a  href="ktx_thechap.php"> Thế chấp</a></li>
                                    <li><a  href="ktx_danhsachthechap.php"> In phiếu thu thế chấp </a></li>
                                    <li><a  href="ktx_danhsachthutienthechap.php"> DS thu thế chấp </a></li>
                                    <li><a  href="ktx_danhsachphieuthechap.php"> DS phiếu thu thế chấp </a></li>
                                    <li><a  href="ktx_ThongKeTheChap_TuNgay_DenNgay.php"> Thế chấp TN-DN</a></li>
                                    <li><a  href="ktx_dangkytamtru.php"> Đăng ký tạm trú </a></li>
                                    <li><a  href="ktx_danhsachsinhvienoktx_dangkytamtru.php"> DS tạm trú </a></li>
				    <li><a  href="ktx_danhsachsinhvienoktx_dangkytamtru_tn_dn.php"> DS tạm trú TN-DN </a></li>
<li ><a  href="ktx_ThongKe_SinhVien_ChinhSach_TuNgayDenNgay.php">TK SV Chính Sách</a>
                                    <li><a  href="ktx_traphong.php"> Trả phòng </a></li>
                                    <li><a  href="ktx_danhsachsinhvientraphong.php"> DS SV trả phòng </a></li>
                                    <li><a  href="ktx_tratienthechap.php"> Trả thế chấp </a></li>
                                    <li><a  href="ktx_inphieuchitienthechap.php">In phiếu trả thế chấp </a></li>
                                    <li><a  href="ktx_danhSachPhieuTraTheChap.php"> DS phiếu chi thế chấp </a></li>
                                    <!--<li><a  href="ktx_xuatexceldanhsachphieuchitrathechap.php">DS phiếu chi thế chấp </a></li>-->
                                    <li><a  href="ktx_danhsachphieuchithechap.php">DS chi thế chấp </a></li>
                                    <li><a  href="ktx_sinhvienviphamnoiquy.php">HSSV VP NQ </a></li>
                                    <li ><a  href="ktx_danhsachsinhvienviphamnoiquy.php">DS HSSV VP NQ </a></li>
                                </ul>
                            </li>
                            
		<li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span> Quản lý HSSV Từ 2017 </span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="ktx_nhapdanhsachhssv2017.php"> Nhập DS HSSV</a></li>
                                    <li><a  href="ktx_sinhviendangkynoitru2017.php"> HSSV Đăng Ký Nội Trú </a></li>
                                    <li><a  href="ktx_danhsachsinhviendangkynoitru2017.php"> DS_HSSV ĐK Nội Trú</a></li>
                                    <li><a  href="ktx_danhsachsinhviennoitru2017.php"> DS HSSV Nội Trú</a></li>
                                    <li><a  href="ktx_danhsachsinhvienoktx_dangkytamtru2017.php"> DS tạm trú </a></li>
                                    <li><a  href="ktx_danhsachsinhvienoktx_dangkytamtru_tn_dn2017.php"> DS tạm trú TN-DN </a></li>
                                    <li><a  href="ktx_traphong2017.php"> Trả phòng </a></li>
                                </ul>
                            </li>

                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span> Quản lý SVLT </span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="ktx_nhap_lienthong.php"> Nhập SVLT</a></li>
                                    <li><a  href="ktx_danhsachsinhvienlt.php"> DS SVLT </a></li>
									<li><a  href="ktx_nhap_nganhlt.php"> Nhập nganh_LT</a></li>
                                    <li><a  href="ktx_nhap_loplt.php"> Nhập lop_LT</a></li>
                                    <li><a  href="ktx_sinhvienlt_muonphong.php"> SVLT mướn phòng </a></li>
                                    <li><a  href="ktx_danhsachsinhvienlt_muonphong.php"> DS SVLT MP </a></li>
                                    <li><a  href="ktx_dangkytamtrult.php"> Đăng ký tạm trú </a></li>
                                    <li><a  href="ktx_danhsachsinhvienltdangkytamtru.php"> DS tạm trú </a></li>
                                    <li><a  href="ktx_thechap_svlt.php"> Thế chấp </a></li>
                                    <li><a  href="ktx_danhsachthechaplt.php"> In phiếu thế chấp </a></li>
                                    <li><a  href="ktx_danhsachphieuthechaplt.php"> DS phiếu thế chấp </a></li>
                                    <li><a  href="ktx_traphonglt.php"> Trả phòng </a></li>
                                    <li><a  href="ktx_danhsachsinhvientraphonglt.php"> DS trả phòng </a></li>
                                    <li><a  href="ktx_tratienthechaplt.php"> Trả thế chấp </a></li>
                                    <li><a  href="ktx_xuatexceldanhsachphieuchitrathechaplt.php">DS phiếu chi thế chấp </a></li>
                                    <li><a  href="ktx_sinhvienviphamnoiquylt.php">SVLT VP NQ </a></li>
                                    <li ><a  href="ktx_danhsachsinhvienviphamnoiquylt.php">DS SVLT VP NQ </a></li>
                                </ul>
                            </li>
                            <!--
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span> Khách </span>
                                </a>
                                <ul class="sub">
                                    <li ><a  href="ktx_khach.php">Thêm vào DS </a></li>
                                    <li><a  href="ktx_danhsachkhach.php">Danh sách</a></li>
                                    <li><a  href="ktx_khachthuephong.php">Mướn phòng</a></li>
                                    <li><a  href="ktx_danhsachkhachmuonphong.php">DS mướn phòng </a></li>
                                    <li ><a  href="ktx_thongke_khachmuonphong_tungaydenngay.php">TKê mướn phòng TN-DN</a></li>
                                  
                                    <li><a  href="ktx_khachthuephong.php"> Khách thuê phòng</a></li>
                                    <li><a  href="ktx_danhsachkhachthuphong.php"> DS khách thuê phòng </a></li>
                                    <li><a  href="ktx_khach.php"> Thêm khách vào danh sách </a></li>
                                </ul>
                            </li>
                            -->
                        </ul>
                    </li>
                  
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="icon-money"></i>
                            <span>Thu phí KTX</span>
                        </a>
                        <ul class="sub">
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span>Học sinh- Sinh viên </span>
                                </a>
                                <ul class="sub">
                                    <li ><a  href="ktx_thutienphong.php">Thu tiền phòng</a></li>
                                    <!--<li ><a  href="ktx_danhsachsinhviennoptienphong.php">DS nộp tiền phòng</a></li>-->
                                    <li ><a  href="ktx_xuatexceldanhsachsinhviennoptienphong.php">In DS tiền phòng</a>
                                    <li ><a  href="ktx_inphieuthutienphongsinhvien.php">In phiếu tiền phòng</a></li>
									<li ><a  href="ktx_suaphieuthutienphongsinhvien.php">Sửa phiếu TP SV</a></li>
                                    <li ><a  href="ktx_xoaphieuthutienphongsinhvien.php">Xóa phiếu TP SV</a></li>
                                    <li ><a  href="ktx_thongke_phieuthutienphong_sinhvien_tungaydenngay.php">TK phiếu thu TP</a>
<li ><a  href="ktx_thongke_thutienphong_sv_hk_nh.php">Phòng HK-NH</a></li>
                                    <li ><a  href="ktx_danhsachphieuthutienphong.php">DS phiếu thu TP</a></li>
                                    <li ><a  href="ktx_thongkesinhviendongtienphong_tungaydenngay.php">Phòng TN-DN</a></li>
									<li ><a  href="ktx_thongkesinhviendongtienphong_tungaydenngayKHTC.php">Phòng KHTC TN-DN</a></li>
                                    <li ><a  href="ktx_thongke_thutienphong_sv_hk_nh.php">Phòng HK-NH</a></li>
                                    <li ><a  href="ktx_thongke_sv_chuanoptienphong_hk_nh.php">Nợ phòng HK-NH</a></li>
                                    <li ><a  href="ktx_thudiennuoc.php">Tiền điện nước</a></li>
                                    <li ><a  href="ktx_danhsachphongdanoptiendiennuoc.php">In phiếu điện nước</a></li>
                                    <li ><a  href="ktx_xoaphieuthutiendiennuocsinhvien.php">Xóa phiếu điện nước</a></li>
                                    <li ><a  href="ktx_xuatexceldanhsachphongdanoptiendiennuoc.php">DS phiếu điện nước</a></li>
                                    <li ><a  href="ktx_thongke_phieuthudiennuoc_sinhvien_tungaydenngay.php">TK phiếu thu Đ.nước</a></li>
                                    <li ><a  href="ktx_thongke_thuhudiennuoc_tungaydenngay.php">Đ-N TN-DN</a></li>
                                    <li ><a  href="ktx_bangkethutiendiennuocthangnamday.php">Đ-N tháng năm dãy</a></li>
                                    <li ><a  href="ktx_bangkethutienphong_hockynamhoc_tungaydenngay.php">Phòng_HK_NH_TNDN</a></li>
                                    <li ><a  href="ktx_thongke_sv_chuanoptienphong_hk_nh.php">Nợ tiền PH HK-NH </a></li>
				    <li ><a  href="thp_thuhocphi.php">Thu học phí </a></li>
				    <li ><a  href="thp_capnhathocphi.php"> Cập nhật học phí </a></li>
                                </ul>
                            </li>

		<li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span>HSSV Từ 2017</span>
                                </a>
                                <ul class="sub">
                                    <li ><a  href="ktx_thutienphong2017.php">Tiền Phòng</a></li>
                                    
                                    <li ><a  href="ktx_inphieuthutienphong_2017.php">In Phiếu Thu Tiền Phòng</a></li>
                                    <li ><a  href="ktx_thechap2017.php">Thu Thế Chấp</a></li>
									<li ><a  href="ktx_thechap2017KHTC.php">KHTC Thu Thế Chấp</a></li>
                                    <li><a  href="ktx_thongkesinhviendongtienphong_tungaydenngay2017.php">TK T.PHÒNG TN-DN</a></li>
									<li><a  href="ktx_thongkesinhviendongtienphong_tungaydenngay2017KHTC.php">KHTC PHÒNG TN-DN</a></li>
                                    <li ><a  href="ktx_thongke_thutienphong_sv_hk_nh2017.php">Phòng HK-NH</a></li>
									<li ><a  href="ktx_suaphieuthutienphong_2017.php">Sửa P.Thu TP</a></li>
                                    <li ><a  href="ktx_xoaphieuthutienphongsinhvien2017.php">Xóa P.Thu TP</a></li>
                                    <li ><a  href="ktx_thongke_sv_chuanoptienphong_hk_nh2017.php">Nợ T.Phòng HK-NH</a></li>
                                    <li><a  href="ktx_danhsachthutienthechap2017.php">TK THẾ CHẤP TN-DN</a></li>
									<li><a  href="ktx_thongkethechap2017KHTC.php">KHTC TK TC TN-DN</a></li>
									<li><a  href="ktx_danhsachthechap2017.php">Xóa thu thế chấp</a></li>
                                </ul>
                            </li>

                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span> SV Liên thông </span>
                                </a>
                                <ul class="sub">
                                    
                                    <li ><a  href="ktx_thutienphongsinhvienlt.php">Thu tiền phòng </a></li>
                                    <li ><a  href="ktx_ds_svlt_tienphong.php">In phiếu thu</a></li>
                                    <li ><a  href="ktx_xuatexceldanhsachphieuthutienphongsinhvienlt.php"> DS phiếu thu TP</a>
                                    <!--<li ><a  href="ktx_bangke_thutien_nhakhach_thangnam-tungaydenngay.php">BK-thu-khach-M-Y-tungaydenngay</a></li>-->
                                    
                                    <li ><a  href="ktx_thongkesinhvienltdongtienphong_tungaydenngay.php">Phòng TN-DN</a></li>
                                    <li ><a  href="ktx_thongke_thutienphong_svlt_hk_nh.php">Phòng HK-NH</a></li>
                                    <li ><a  href="ktx_thongke_svlt_chuanoptienphong_hk_nh.php">Nợ tiền phòng HK-NH</a></li>
                                    <li ><a  href="ktx_thudiennuoc_svlt.php">Tiền điện nước</a></li>
                                    <li ><a  href="ktx_danhsachphongdanoptiendiennuoclt.php">In phiếu điện nước</a></li>
                                    <li ><a  href="ktx_xuatexceldanhsachphongdanoptiendiennuoclt.php">DS phiếu điện nước</a></li>
                                    <li ><a  href="ktx_thongke_thuhudiennuoc_tungaydenngay.php">Đ-N TN-DN</a></li>
                                    <li ><a  href="ktx_bangkethutiendiennuocthangnamdaylt.php">Đ-N tháng năm dãy</a></li>
                                    <li ><a  href="ktx_bangkethutienphong_hockynamhoc_tungaydenngaylt.php">Phòng_HK_NH_TNDN</a></li>
                                    <li ><a  href="ktx_thongke_svlt_chuanoptienphong_hk_nh.php">Nợ tiền PH HK-NH </a></li>
                                    
                                </ul>
                            </li>
                            <!--
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="icon-edit"></i>
                                    <span> Khách </span>
                                </a>
                                <ul class="sub">
                                    
                                    <li ><a  href="ktx_thutienphongkhach1.php">Thu tiền phòng khách</a></li>
                                    <li ><a  href="ktx_danhsachphongkhachdathutien.php">In phiếu thu</a></li>
                                    <li ><a  href="ktx_xoaphieuthutienphongkhach.php">Xóa phiếu thu</a></li>
                                    <li ><a  href="ktx_xuatexceldanhsachphieukhachnoptienphong.php">DS phiếu thu</a></li>
                                    <li ><a  href="ktx_thongke_phieuthu_tienphongkhach_tungaydenngay.php">Phiếu thu TN-DN</a></li>
<li ><a  href="ktx_ThongKe_Khach_MuonPhong_TuNgayDenNgay.php">TK-KHÁCH MƯỚN PHÒNG-TNDN</a></li>
                                    <li ><a  href="ktx_bangke_thutien_nhakhach_thangnam-tungaydenngay.php">TK-MY-TNDN</a></li>
                                    <li ><a  href="ktx_bangke_thutien_nhakhach_tungaydenngay.php">TK-TNDN</a></li>
                                   
                                    
                                </ul>
                            </li>
 
                            <!--<li><a  href="#">Thu ???</a></li>-->
                        </ul>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>

 <?php
    }
public static function footer_data()
{
    ?>
    <footer class="site-footer">
          <div class="text-center">
              2015 &copy; Phát triển bởi Nguyễn Minh Đợi, Khoa Công Nghệ Thông Tin - Truyền Thông.
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
  <?php  
}
public static function footer_footer()
{
    ?>
        <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <script type="text/javascript" language="javascript" src="assets/isotope/jquery.isotope.js"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/datatable.bootstrap.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/respond.min.js" ></script>

    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

  <script>
		function updateDiem(a){
			if ($(a).val()==""){
				$(a).parent('td').removeClass('has-success').addClass('has-error');
			}
			else{
				$(a).parent('td').removeClass('has-error').addClass('has-success');
			}
		}
      //owl carousel

      $(document).ready(function() {
        $('#example').dataTable({
				  "sPaginationType": "bootstrap",
        			"oLanguage": {
            "sLengthMenu": "Hiển thị _MENU_ mẫu tin trên mỗi trang",
            "sZeroRecords": "Không có dữ liệu",
            "sInfo": "Hiển thị từ _START_ đến _END_ of _TOTAL_ mẫu tin",
            "sInfoEmpty": "Có 0 đến 0 của 0 mẫu tin",
            "sInfoFiltered": "(lọc từ _MAX_ mẫu tin)",
			"sSearch": "Tìm kiếm:",
			"oPaginate": {
                        "sPrevious": "Trước đó",
                        "sNext": "Kế tiếp"
                    }
        }
    });
			  
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  function captaikhoan(){
		  $('#formcaptaikhoan').hide();
		  $('#ctkprogressbar').show();
	  }

  </script>
        <?php
}
public static function left($str, $length) {
     return substr($str, 0, $length);
}

public static function right($str, $length) {
     return substr($str, -$length);
}

    public static function convert_number_to_words($number) {
 
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
        0                   => 'Không',
        1                   => 'Một',
        2                   => 'Hai',
        3                   => 'Ba',
        4                   => 'Bốn',
        5                   => 'Năm',
        6                   => 'Sáu',
        7                   => 'Bảy',
        8                   => 'Tám',
        9                   => 'Chín',
        10                  => 'Mười',
        11                  => 'Mười một',
        12                  => 'Mười hai',
        13                  => 'Mười ba',
        14                  => 'Mười bốn',
        15                  => 'Mười năm',
        16                  => 'Mười sáu',
        17                  => 'Mười bảy',
        18                  => 'Mười tám',
        19                  => 'Mười chín',
        20                  => 'Hai mươi',
        30                  => 'Ba mươi',
        40                  => 'Bốn mươi',
        50                  => 'Năm mươi',
        60                  => 'Sáu mươi',
        70                  => 'Bảy mươi',
        80                  => 'Tám mươi',
        90                  => 'Chín mươi',
        100                 => 'trăm',
        1000                => 'ngàn',
        1000000             => 'triệu',
        1000000000          => 'tỷ',
        1000000000000       => 'nghìn tỷ',
        1000000000000000    => 'ngàn triệu triệu',
        1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
                $string .= $decimal;
                $words = array();
                foreach (str_split((string) $fraction) as $number) {
                    $words[] = $dictionary[$number];
                }
            $string .= implode(' ', $words);
            }

        return $string;
        }
    }
?>

