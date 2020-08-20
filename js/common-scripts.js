/*---LEFT BAR ACCORDION----*/
$(function() {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
});

var Script = function () {

//    sidebar dropdown menu auto scrolling

    jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 250 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar toggle

    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled:false,  cursorborder: '', zindex: '1000'});

// widget tools

    jQuery('.panel .tools .icon-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .icon-remove').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();
	
//owl carousel for Announcement
	$("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true
          });
//custom select box
	$('select.styled').customSelect();
//datePicker
		$('.default-date-picker').datepicker({
            format: 'dd-mm-yyyy'
        });
//Form Validation
		$(".kiemtraForm").validate();
//Active DataTable Plugin By Classname
$('.bangcochonclass').dataTable({
			"sPaginationType": "bootstrap",
			"aaSorting": [[ 1, "asc" ]], // Sort by first column descending
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
//Table Multi Select Handler Code
	$('.chonxoa').change(function() {
				if ($(this).is(':checked')) { 
					$(this).parents('tr').addClass("danhdauxoa");
					// Deleting Handler
					$('#nutxoapt').removeClass('disabled');
					$('#sophantuxoa').html(parseInt($('#sophantuxoa').html())+1);
					// Editing Handler
					$('#nutsuapt').removeClass('disabled');
					$('#sophantusua').html(parseInt($('#sophantusua').html())+1);
					// Adding Handler
					$('#nutthempt').removeClass('disabled');
					$('#sophantuthem').html(parseInt($('#sophantuthem').html())+1);	
					// Copying Handler
					$('#nutcopypt').removeClass('disabled');
					$('#sophantucopy').html(parseInt($('#sophantucopy').html())+1);				
				} else { 
					$(this).parents('tr').removeClass("danhdauxoa"); 
					//Deleteing Handler
					$('#sophantuxoa').html(parseInt($('#sophantuxoa').html())-1);
					if (parseInt($('#sophantuxoa').html())==0){
						$('#nutxoapt').addClass('disabled');
					}
					//Editing Handler
					$('#sophantusua').html(parseInt($('#sophantusua').html())-1);
					if (parseInt($('#sophantusua').html())==0){
						$('#nutsuapt').addClass('disabled');
					}
					//Adding Handler
					$('#sophantuthem').html(parseInt($('#sophantuthem').html())-1);
					if (parseInt($('#sophantuthem').html())==0){
						$('#nutthempt').addClass('disabled');
					}
					//Copying Handler
					$('#sophantucopy').html(parseInt($('#sophantucopy').html())-1);
					if (parseInt($('#sophantucopy').html())==0){
						$('#nutcopypt').addClass('disabled');
					}
				}
			});
//SelectAll Button Handler Code
	$('#nutchontatca').click(function(e) {
        $('.chonxoa').prop('checked', true);
		$('#bangcochon tbody tr').addClass('danhdauxoa');
		$('#sophantusua').html($('.chonxoa').size());
		$('#sophantuxoa').html($('.chonxoa').size());
		$('#sophantuthem').html($('.chonxoa').size());
		$('#sophantucopy').html($('.chonxoa').size());
		$('#nutsuapt').removeClass('disabled');
		$('#nutxoapt').removeClass('disabled');
		$('#nutthempt').removeClass('disabled');
		$('#nutcopypt').removeClass('disabled');
    });
//DeSelectAll Button Handler Code
	$('#nutbochontatca').click(function(e) {
        $('.chonxoa').prop('checked',false);
		$('#bangcochon tbody tr').removeClass('danhdauxoa');
		$('#sophantusua').html(0);
		$('#sophantuxoa').html(0);
		$('#sophantuthem').html(0);
		$('#sophantucopy').html(0);
		$('#nutsuapt').addClass('disabled');
		$('#nutxoapt').addClass('disabled');
		$('#nutthempt').addClass('disabled');
		$('#nutcopypt').addClass('disabled');
    });
//SelectAll Button 1 - Two Tables
$('#nutchontatca1').click(function(e) {
        $('.chonxoa').prop('checked', true);
		$('#bang1in2 tbody tr').addClass('danhdauxoa');
    });
//DeSelectAll Button 1 - Two Tables
$('#nutbochontatca1').click(function(e) {
        $('.chonxoa').prop('checked', false);
		$('#bang1in2 tbody tr').removeClass('danhdauxoa');
    });
//SelectAll Button 2 - Two Tables
$('#nutchontatca2').click(function(e) {
        $('.chonxoa').prop('checked', true);
		$('#bang2in2 tbody tr').addClass('danhdauxoa');
    });
//DeSelectAll Button 2 - Two Tables
$('#nutbochontatca2').click(function(e) {
        $('.chonxoa').prop('checked', false);
		$('#bang2in2 tbody tr').removeClass('danhdauxoa');
    });
// custom bar chart

    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }


}();