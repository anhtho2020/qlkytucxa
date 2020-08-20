// JavaScript Document
var EditableTable = function () {

    return {

        //init function
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="form-control small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control small" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="form-control small" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<a class="edit" href="">Lưu</a>';
                jqTds[5].innerHTML = '<a class="cancel" href="">Hủy</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 4, false);
                oTable.fnUpdate('<a class="delete" href="">Xóa</a>', nRow, 5, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 4, false);
                oTable.fnDraw();
            }

            var oTable = $('#editable-sample').dataTable({
                /*"aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],*/
                // set the initial value
                /*"iDisplayLength": 5,*/
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
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
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $('#editable-sample_new').click(function (e) {
                e.preventDefault();
                var aiNew = oTable.fnAddData(['', '', '', '',
                        '<a class="edit" href="">Sửa</a>', '<a class="cancel" data-mode="new" href="">Hủy</a>'
                ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
            });

            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();

                if (confirm("Bạn có chắc chắn xóa ?") == false) {
                    return;
                }
				/* 
				//Code AJAX POST gửi các tham số (như id) đến file xử lý .php trên server
				$.post( "xoa.php",{ id1: "value1" , id2: "value2"}, function(data) {
                if (data=="Xong") //Bên phía PHP, nếu code xóa thành công thì echo "Xong";
				{*/
					var nRow = $(this).parents('tr')[0];
                	oTable.fnDeleteRow(nRow);
                	alert("Xóa dữ liệu thành công! Anh sửa code AJAX POST tại đây");
				/*}
				else
				{
					alert("Lỗi rồi! Đéo xóa được");
				}
             }
			 	// Bên phía PHP, anh cứ $_REQUEST["id1"] hoặc $_POST["id1"] là get được "value1"
          );*/
                
            });

            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();

                /* Get thẻ tr - parent của phần tử vừa click */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Lưu") {
                    /* Editing this row and save it */
					/* 
				//Code AJAX POST gửi các tham số (như id) đến file xử lý .php trên server
				$.post( "editadd.php",{ id1: "value1" , id2: "value2"}, function(data) {
                if (data=="Xong") //Bên phía PHP, nếu code edit/add thành công thì echo "Xong";
				{*/
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Cập nhật dữ liệu thành công! Anh sửa code AJAX POST tại đây");
				/*}
				else
				{
					alert("Lỗi rồi! Đéo cập nhật được");
					editRow(oTable, nRow);
                    nEditing = nRow;
				}
             }
			 	// Bên phía PHP, anh cứ $_REQUEST["id1"] hoặc $_POST["id1"] là get được "value1"
          );*/
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();