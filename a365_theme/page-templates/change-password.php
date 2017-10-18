<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Change Password
 */

get_header('new');
// $children = a365_get_children();
$user = a365_get_current_user();
$year = $user->year_of_birth;

?>

<div id="siteContent">
	<div class="container">
		<div class="qh-page-header">Đổi mật khẩu</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<form class="qh-form" id="change_pass_form">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Mật khẩu cũ  (*)</span></label>
							<div class="input-wrap">
								<input name="old-pass" type="password" required="required" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Mật khẩu mới  (*)</span></label>
							<div class="input-wrap">
								<input name="new-pass" id="new-pass" type="password" required="required" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Xác nhận mật khẩu mới  (*)</span></label>
							<div class="input-wrap">
								<input name="new-pass-confirm" id="new-pass-confirm" type="password" required="required" class="qh-form-control">
							</div>
						</div>
					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20"><b><i id="warning"></i></b></div>
							<input type="button" name="changePassword" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase" id="changepass" value="Lưu thay đổi">
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var $=jQuery.noConflict();
	$(document).ready(function(){
		// check login
		var user_id = "<?=a365_get_current_user_id()?>";
	  	//console.log(user_id);
	  	var login = 1;
	  	if (user_id == 0){
	    	login = 0;
	    	//console.log("login1"+login);
	  	}

	  	if (login == 0) {
	  		$("#modalSignIn").modal({
		  		backdrop: 'static',
		  		keyboard: false
			});
	  	}

	  	$('#changepass').click(function(event) {
	  		////console.log($("#new-pass-confirm").val());
	  		////console.log($("#new-pass").val());
			if ($("#new-pass-confirm").val() == $("#new-pass").val()) {
				////console.log("aaa");
				$data = $("#change_pass_form").serialize();
				$.ajax({
		        	type: 'post',
		        	dataType: 'json',
		        	url: a365_ajax.ajax_url,
		        	data: $data + "&action=change_password",
		        	success: function(response) {
		        		//console.log(response.message);
		          		if (response.message == "successful") {
		          			$("#warning").html("Mật khẩu đã được thay đổi thành công!");
		          			window.location.href = "../";
		          		}
		          		else
		          			$("#warning").html("Mật khẩu cũ không chính xác, vui lòng kiểm tra lại!");
		        	}
      			});
			}
			else 
				$("#warning").html("Mật khẩu mới không trùng khớp, vui lòng kiểm tra lại!");
		})
  	})
	
</script>
<?php 
	get_footer('new');
?>