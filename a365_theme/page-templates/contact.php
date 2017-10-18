<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Liên hệ
 *
 * @package A356
 */
get_header('new');
the_content();
?>

	<div class="container">
		<div class="qh-page-header">Liên hệ - Chia sẻ - Góp ý</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<form class="qh-form" id="contact-form">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Họ và tên (*)</span></label>
							<div class="input-wrap">
								<input name="fullname" id="fullname" type="text" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Email (*)</span></label>
							<div class="input-wrap">
								<input name="email" id="email" type="text" class="qh-form-control">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Tiêu đề</span></label>
							<div class="input-wrap">
								<input name="title" type="text" class="qh-form-control" value="[A365] Liên hệ - Chia sẻ - Góp ý">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Nội dung (*)</span></label>
							<div class="input-wrap">
								<textarea name="content" id="content" form="contact-form" class="qh-form-control"></textarea>
							</div>
						</div>
						
					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20"><b><i class="message"></i></b></div>
							<button name="contact" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase send-message">Gửi tin nhắn</button>
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	var $=jQuery.noConflict();
	$(document).ready(function() {
		$('.send-message').click(function(e){
			e.preventDefault();
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var content = $('#content').val();

			if( fullname == '' || email == ''  || content == '' ) {
				$('.message').html('Bạn phải điền đầy đủ thông tin những trường có dấu (*)');
			} else {
				$('.message').html('Tin nhắn đang được gửi đi, vui lòng đợi trong giây lát ...');
				var data = $('#contact-form').serialize();
				$.ajax({
	              type: 'post',
	              //dataType: 'json',
	              url: a365_ajax.ajax_url,
	              data: data + "&action=contact",
	              success: function(msg) {
	              	//console.log(msg);
	              	if(msg.includes("success")) 
	              		$('.message').html('Đã gửi tin nhắn thành công!');
	              	else
	              		$('.message').html('Đã có lỗi xảy ra, vui lòng thử lại!');
	              }
	            });
			}
		});
	});
</script>

<?php 
	get_footer('new');
?>