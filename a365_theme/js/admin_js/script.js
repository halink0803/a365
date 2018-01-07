	/*
	Created by DQV
	*/
var $=jQuery.noConflict();
// init variables
var savebutton = "ajaxSave";
var deletebutton = "ajaxDelete";
var editbutton = "ajaxEdit";
var updatebutton = "ajaxUpdate";
var cancelbutton = "cancel";
var viewbutton = "ajaxView";
var trcopy = new Array();
var editing = 0;
var tdediting = 0;
var editingtrid = 0;
var editingtdcol = 0;
var inputs = ':checked,:selected,:text,textarea';
var but;
var idx;

$(document).ready(function(){
	//$('.loader').remove();

	// set images for edit and delete
	$(".eimage").attr("src",editImage);
	$(".dimage").attr("src",deleteImage);

	// Delete record
	$(document).on("click","."+deletebutton,function(){
		var btn = $(this);
		var id = $(this).attr("id");
		var table_id = $(this).closest('table').attr('id');
		if (table_id == "a365_users") {
			if(id){
				if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")){
				ajax("rid="+id,"del",table_id);
				pri_table
                        .row(btn.parents('tr'))
                        .remove()
                        .draw();
				}
			}
		}

		if (table_id == "a365_children") {
			if(id){
				if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")){
				ajax("rid="+id,"del",table_id);
				child_table
                        .row(btn.parents('tr'))
                        .remove()
                        .draw();
				}
			}
		}

		if (table_id == "a365_asq_results") {
			if(id){
				if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")){
				ajax("rid="+id,"del",table_id);
				asq_table
                        .row(btn.parents('tr'))
                        .remove()
                        .draw();
				}
			}
		}

		if (table_id == "a365_mchatr_results") {
			if(id){
				if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")){
				ajax("rid="+id,"del",table_id);
				mchatr_table
                        .row(btn.parents('tr'))
                        .remove()
                        .draw();
				}
			}
		}

		if (table_id == "a365_mchatrf_results") {
			if(id){
				if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")){
				ajax("rid="+id,"del",table_id);
				mchatrf_table
                        .row(btn.parents('tr'))
                        .remove()
                        .draw();
				}
			}
		}


	});

	// edit record
	$(document).on("click","."+editbutton,function(){
		but = $(this);
		var id = $(this).attr("id");
		//console.log("id: "+id);
		var table_id = $(this).closest('table').attr('id');
		//idx = child_table.row('.selected').index();
		var tr = $("#"+table_id+" tr[id="+id+"]");
		var row;
		var columns;
		var action = 0;
		if (table_id == "a365_children") {
			columns = children_columns;
			row = child_table.row(tr);
			action = 8;
		}
		if (table_id == "a365_users") {
			columns = user_columns;
			row = pri_table.row(tr);
			action = 8;
		}
		if (table_id == "a365_children_dy") {
			columns = children_columns;
			row = child_table.row(tr);
		}
  		var rowData = row.data();
  		var input;

		//console.log("table_id: "+table_id);

		if(id && editing == 0 && tdediting == 0){
			// hide editing row, for the time being
			//$("#"+table_id+" tbody tr:last-child").fadeOut("fast");

			//html += "<td>"+$("#"+table_id+" tr[id="+id+"] td:first-child").html()+"</td>";
			for(i=0;i<columns.length;i++){
  				var val = $(document).find("#"+table_id+" tr[id="+id+"] td[class='"+columns[i]+"']").html();
  				trcopy[i] = val;
				input = createInput(i,rowData[i+1],table_id);
				//console.log("input: "+input);
					rowData[i+1] = input;

			}
			input = '<a href="javascript:;" id="'+id+'" class="'+updatebutton+'"><img src="'+updateImage+'"></a> <a href="javascript:;" id="'+id+'" class="'+cancelbutton+'"><img src="'+cancelImage+'"></a>';
			rowData[action] = input;
  			row.data(rowData);
			editing = 1;
		}
	});

	$(document).on("click","."+cancelbutton,function(){
		var table_id = $(this).closest('table').attr('id');
		var id = $(this).attr("id");
		var tr = $("#"+table_id+" tr[id="+id+"]");
		var row;
		var columns;
		var action = 0;
		if (table_id == "a365_children") {
			columns = children_columns;
			row = child_table.row(tr);
			action = 8;
		}
		if (table_id == "a365_users") {
			columns = user_columns;
			row = pri_table.row(tr);
			action = 8;
		}
		if (table_id == "a365_children_dy") {
			columns = children_columns;
			row = child_table.row(tr);
			action = 8;
		}
  		var rowData = row.data();
  		var input;
  		for(i=0;i<columns.length;i++){
  			//if(trcopy[i]){
				rowData[i+1] = trcopy[i];
				//console.log("dqv: "+trcopy[i]);
  			//}
		}
		input = '<a href="javascript:;" id="'+id+'" class="'+editbutton+'"><img src="'+editImage+'"></a> <a href="javascript:;" id="'+id+'" class="'+deletebutton+'"><img src="'+deleteImage+'"></a>';
		editing = 0;
		rowData[action] = input;
  		row.data(rowData);
	});

	$(document).on("click","."+updatebutton,function(){
		var data;
		but = $(this);
		id = $(this).attr("id");
		var table_id = $(this).closest('table').attr('id');
		serialized = $("#"+table_id+" tr[id='"+id+"']").find(inputs).serialize();
		//console.log("sserialized: "+serialized);
		ajax(serialized+"&rid="+id,"update",table_id);
		serialized = $("#"+table_id+" tr[id='"+id+"']").find(inputs).serializeArray();
		var serializedObject = {};
		$.each(serialized,
    			function(i, v) {
        			serializedObject[v.name] = v.value;
    	});
		//idx = child_table.row('.selected').index();
		var tr = $("#"+table_id+" tr[id="+id+"]");
		var row;
		var columns;
		var action = 0;
		if (table_id == "a365_children") {
			columns = children_columns;
			row = child_table.row(tr);
			action = 8;
		}
		if (table_id == "a365_users") {
			columns = user_columns;
			row = pri_table.row(tr);
			action = 8;
		}
  		var rowData = row.data();
  		var input;
				for(i=0;i<columns.length;i++){
				 	input = serializedObject[columns[i]];
				 	//console.log("input: "+serializedObject[columns[i]]);
				 	//if (input) {
						rowData[i+1] = input;
					//}
				}
			input = '<a href="javascript:;" id="'+id+'" class="'+editbutton+'"><img src="'+editImage+'"></a> <a href="javascript:;" id="'+id+'" class="'+deletebutton+'"><img src="'+deleteImage+'"></a>';
			rowData[action] = input;
  			row.data(rowData);
  			//row.invalidate().draw();
			//console.log("rowData: "+rowData);
		editing = 0;

	});

	// $(document).on("click","."+viewbutton,function(){
	// 	var child_id = $(this).parents('tr').attr('id');
	// 	window.open("../admin-child-information?id="+child_id, '_blank');
	// });

	// tr click event
	$(document).on("click","table"+" tr",function(e){
		var table_id = $(this).parent().parent().attr('id');
		var selected_row;
		//console.log("click+"+table_id);
		if (table_id == "a365_users") {
			selected_row = $(this).attr("id");
			//console.log(selected_row);
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
           		 xmlhttp = new XMLHttpRequest();
           		 //xmlhttp.setRequestHeader('Authorization', "");
        	} else {
        	    // code for IE6, IE5
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       		}
        	xmlhttp.onreadystatechange = function() {
            	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            		var table_content = xmlhttp.responseText.replace(/(\r\n|\n|\r)/gm,"").replace(/<(.)+css">/gim, '')
                	document.getElementById("txtHint").innerHTML = table_content;
                	//var child_table;
			        $(document).ready(function() {
			        // Setup - add a text input to each footer cell
				        $('#a365_children tfoot th').each( function () {
				            var title = $(this).text();
				            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				        } );

				        // DataTable
				        child_table = $('#a365_children').DataTable({
				            "scrollX": true,
				            "scrollY": true,
				            dom: 'Bfrtlip',
					        select: true,
					        buttons: [
					            {
					                extend: 'colvis',
					                text: 'Ẩn/Hiện cột',
					                collectionLayout: 'fixed two-column'
					            },

					            {
					                extend: 'collection',
					                text: 'Xuất dữ liệu',
					                buttons: [
					                    {
					                        extend: 'print',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'copy',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'csv',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'excel',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'pdf',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    }
					                ]
					                //'copy', 'csv', 'excel', 'pdf']
					            }

					        ]
				        });
				        // Apply the search
				        child_table.columns().every( function () {
				            var that = this;

				            $( 'input', this.footer() ).on( 'keyup change', function () {
				                if ( that.search() !== this.value ) {
				                    that.search( this.value ).draw();
				                }
				            } );
				        } );
			         } );
                	//console.log(table_content);
            	}
        	};
        	xmlhttp.open("GET","../ajax?q="+selected_row+"&table=a365_children",true);
        	xmlhttp.send();

		}
		if (table_id == "a365_children") {
			selected_row = $(this).attr("id");
			//console.log(selected_row);
		}

		if (table_id == "a365_users_report") {
			selected_row = $(this).attr("id");
			//console.log(selected_row);
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
           		 xmlhttp = new XMLHttpRequest();
           		 //xmlhttp.setRequestHeader('Authorization', "");
        	} else {
        	    // code for IE6, IE5
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       		}
        	xmlhttp.onreadystatechange = function() {
            	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            		var table_content = xmlhttp.responseText.replace(/(\r\n|\n|\r)/gm,"").replace(/<(.)+css">/gim, '')
                	document.getElementById("txtHint").innerHTML = table_content;
                	//var child_table;
			        $(document).ready(function() {
			        // Setup - add a text input to each footer cell
				        $('#a365_children_report tfoot th').each( function () {
				            var title = $(this).text();
				            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				        } );

				        // DataTable
				        child_table = $('#a365_children_report').DataTable({
				            "scrollX": true,
				            "scrollY": true,
				            dom: 'Bfrtlip',
					        select: true,
					        buttons: [
					            {
					                extend: 'colvis',
					                text: 'Ẩn/Hiện cột',
					                collectionLayout: 'fixed two-column'
					            },

					            {
					                extend: 'collection',
					                text: 'Xuất dữ liệu',
					                buttons: [
					                    {
					                        extend: 'print',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'copy',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'csv',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'excel',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'pdf',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    }
					                ]
					                //'copy', 'csv', 'excel', 'pdf']
					            }

					        ]
				        });
				        // Apply the search
				        child_table.columns().every( function () {
				            var that = this;

				            $( 'input', this.footer() ).on( 'keyup change', function () {
				                if ( that.search() !== this.value ) {
				                    that.search( this.value ).draw();
				                }
				            } );
				        } );
			         } );
                	//console.log(table_content);
            	}
        	};
        	xmlhttp.open("GET","../ajax?q="+selected_row+"&table=a365_children_report",true);
        	xmlhttp.send();

		}
		// click a row of a365_children_report
		if (table_id == "a365_children_report") {
			selected_row = $(this).attr("id");
			//console.log(selected_row);
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
           		 xmlhttp = new XMLHttpRequest();
           		 //xmlhttp.setRequestHeader('Authorization', "");
        	} else {
        	    // code for IE6, IE5
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       		}
        	xmlhttp.onreadystatechange = function() {
            	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            		var table_content = xmlhttp.responseText.replace(/(\r\n|\n|\r)/gm,"").replace(/<(.)+css">/gim, '')
                	document.getElementById("txtHint").innerHTML = table_content;
                	//var child_table;
			        $(document).ready(function() {
			        // Setup - add a text input to each footer cell
				        $('#a365_sangloc tfoot th').each( function () {
				            var title = $(this).text();
				            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				        } );

				        // DataTable
				        sangloc_table = $('#a365_sangloc').DataTable({
				            "scrollX": true,
				            "scrollY": true,
				            dom: 'Bfrtlip',
					        select: true,
					        buttons: [
					            {
					                extend: 'colvis',
					                text: 'Ẩn/Hiện cột',
					                collectionLayout: 'fixed two-column'
					            },

					            {
					                extend: 'collection',
					                text: 'Xuất dữ liệu',
					                buttons: [
					                    {
					                        extend: 'print',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'copy',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'csv',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'excel',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    },
					                    {
					                        extend: 'pdf',
					                        exportOptions: {
					                            columns: ':visible',
                            					//rows: ':visible'
					                        }
					                    }
					                ]
					                //'copy', 'csv', 'excel', 'pdf']
					            }

					        ]
				        });
				        // Apply the search
				        child_table.columns().every( function () {
				            var that = this;

				            $( 'input', this.footer() ).on( 'keyup change', function () {
				                if ( that.search() !== this.value ) {
				                    that.search( this.value ).draw();
				                }
				            } );
				        } );
			         } );
                	//console.log(table_content);
            	}
        	};
        	xmlhttp.open("GET","../ajax?q="+selected_row+"&table=a365_sangloc",true);
        	xmlhttp.send();

		}
		return;
	});

});

createInput = function(i,str,table_id){
	str = typeof str !== 'undefined' ? str : null;
	var placeholder;
	var columns;
	if ( table_id == "a365_users"){
		columns = user_columns;
		placeholder = user_placeholder;
	}
	if ( table_id == "a365_children" || table_id == "a365_children_dy"){
		columns = children_columns;
		placeholder = children_placeholder;
	}
	if(inputType[i] == "text"){
		input = '<input type="'+inputType[i]+'" name="'+columns[i]+'" placeholder="'+placeholder[i]+'" value="'+str+'" >';
	}else if(inputType[i] == "textarea"){
		input = '<textarea name="'+columns[i]+'" placeholder="'+placeholder[i]+'">'+str+'</textarea>';
	}
	return input;
}

ajax = function (params,action,table_id){

	params = params.replace("&name=", "&fname=");
	if (params.startsWith("name="))
		params = "f"+params;
	//console.log("reponse: "+params+"&action="+action+"&table="+table_id);
	$.ajax({
		type: "post",
		url: "../ajax",
		data : params+"&action="+action+"&table="+table_id,
		success: function(response){
			//var dataObject = jQuery.parseJSON(data);
			////console.log(dataObject);
			//console.log("success: "+response);

			response = response.replace(/(\r\n|\n|\r)/gm,"").replace(/<(.)+>/gim, '').replace("fname", "name");
			response = JSON.parse(response);
			data = response;
			//console.log("success: "+data);
			////console.log("id: "+response.id);
			////console.log("success: "+response.success);
			var columns;
		  switch(action){
			case "save":
				//console.log("save");
				var seclastRow = $("#"+table_id+" tr").length;
				if(response.success == 1){
					var html = "";

					html += "<td>"+parseInt(seclastRow - 1)+"</td>";
					for(i=0;i<columns.length;i++){
						html +='<td class="'+columns[i]+'">'+response[columns[i]]+'</td>';
					}
					html += '<td><a href="javascript:;" id="'+response.id+'" class="ajaxEdit"><img src="'+editImage+'"></a> <a href="javascript:;" id="'+response["id"]+'" class="'+deletebutton+'"><img src="'+deleteImage+'"></a></td>';
					// Append new row as a second last row of a table
					$("#"+table_id+" tr").last().before('<tr id="'+response.id+'">'+html+'</tr>');

					if(effect == "slide"){
						// Little hack to animate TR element smoothly, wrap it in div and replace then again replace with td and tr's ;)
						$("#"+table_id+" tr:nth-child("+seclastRow+")").find('td')
						 .wrapInner('<div style="display: none;" />')
						 .parent()
						 .find('td > div')
						 .slideDown(700, function(){
							  var $set = $(this);
							  $set.replaceWith($set.contents());
						});
					}
					else if(effect == "flash"){
					   $("#"+table_id+" tr:nth-child("+seclastRow+")").effect("highlight",{color: '#acfdaa'},100);
					}else
					   $("#"+table_id+" tr:nth-child("+seclastRow+")").effect("highlight",{color: '#acfdaa'},1000);

					// Blank input fields
					$(document).find("#"+table_id+" tr[class='inputform']").find(inputs).filter(function() {
						// check if input element is blank ??
						this.value = "";
						$(this).removeClass("success").removeClass("error");
					});
				}
			break;
			case "del":
				//console.log("del");
				//var seclastRow = $("#"+table_id+" tr").length;
				if(response.success == 1){
					// $("#"+table_id+" tr[id='"+response.id+"']").effect("highlight",{color: '#f4667b'},500,function(){
					// 	$("#"+table_id+" tr[id='"+response.id+"']").remove();
					// });
				}
			break;
			case "update":
				//console.log("update");

				if (table_id == "a365_children") {
					columns = children_columns;
				}
				if (table_id == "a365_users") {
					columns = user_columns;
				}
				//var idx = child_table.row('.selected').index();
    			//console.log("idx: "+idx);
				$("."+cancelbutton).trigger("click");
				 ////console.log("input: "+response[columns[2]]);
				var tr = $("#"+table_id+" tr[id='0100000180001']") ;
					// //console.log(tr);

	////console.log("rowData: "+rowData);

			break;
		  }
		},
		error: function(){
			alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
		}
		// error: function(xhr, error, data){
		// 	alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
		// 	//console.log("reponse: "+data);
		// 	console.debug(xhr); console.debug("lỗi: "+error);
		// }
	});
}
    function formatDate(date) {
        if (date.includes("-")) {
            var dateParts = date.split("-");
            var newdate = dateParts[2]+'-'+dateParts[1]+'-'+dateParts[0];
            return newdate;
        }

        if (date.includes("/")) {
            var dateParts = date.split("/");
            var newdate = dateParts[2]+'-'+dateParts[1]+'-'+dateParts[0];
            return newdate;
        }

    }