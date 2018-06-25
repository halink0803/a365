var $=jQuery.noConflict();
$(document).ready(function(){
	////console.log("vào ddaah rồi");
	$(".theodoicanthiep").click(function(){
		var title = $('div.title',this).html();
		//console.log("follow_name: "+title);
		$.ajax({
			action: 'save_follow_intervention',
        	type: 'post',
        	dataType: 'json',
        	data: { 'follow_name' : title},
        	url: a365_ajax.ajax_url,
			success: function(response){
			},
			error: function(){
				// alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
			}
		});

	});

	//handle click bai tap can thiep
	// $(".single-exercise").click(function(){
 //       	var title = $('div.title',this).html();
	// 	//console.log("canthiep_name: "+title);
	// 	$.ajax({
	// 		action: 'save_exercise_intervention_view',
 //        	type: 'post',
 //        	dataType: 'json',
 //        	data: { 'exercise_name' : title},
 //        	url: a365_ajax.ajax_url,
	// 		success: function(response){
	// 		},
	// 		error: function(){
	// 			alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
	// 		}
	// 	});

	// });
})

function click_baitapcanthiep() {
		var title = $('div.title',this).html();
		//console.log("canthiep_name: "+title);
		// $.ajax({
		// 	action: 'save_exercise_intervention_view',
  //       	type: 'post',
  //       	dataType: 'json',
  //       	data: { 'exercise_name' : title},
  //       	url: a365_ajax.ajax_url,
		// 	success: function(response){
		// 	},
		// 	error: function(){
		// 		alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
		// 	}
		// });
}

function lock_sesion_child() {
       var id_action = $('#TestChildAction').val();
       if (id_action == "") {
    		return null;
       }
       //alert(id_action);
       var data = { 'child_id' : id_action};
       $.ajax({
			action: 'update_Current_Child',
        	type: 'post',
        	dataType: 'json',
        	data: data,
        	url: a365_ajax.ajax_url,
			success: function(response){
				$("#myModal").modal('hide');
			},
			error: function(response){
				//console.log(response);
			}
		});
}
