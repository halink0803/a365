<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Register Child
 */

get_header('new');
?>

<div id="siteContent">
	<div class="container">
		<div class="qh-page-header">Đăng ký thông tin trẻ</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<form action="#" class="qh-form" method="post" id="register-child">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Họ và tên trẻ (*)</span></label>

							<div class="input-wrap">
								<input name="fullname" type="text" class="qh-form-control" required oninvalid="this.setCustomValidity('Bạn phải điền tên trẻ.')" onInput="this.setCustomValidity('')">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text"></span></label>
							
							<div class="input-wrap">
								<p><i>Nếu trẻ này không có thật, vui lòng đặt tên trẻ là test</i></p>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Ngày sinh (Ngày-Tháng-Năm) (*)</span></label>
							<div class="input-wrap">
								<input name="dd" type="number" class="qh-form-control iblock" min="1" max="31" required="" placeholder="ngày">
								<input name="mm" type="number" class="qh-form-control iblock" min="1" max="12" required="" placeholder="tháng">
								<input name="yyyy" type="number" class="qh-form-control iblock" min="2000" required="" placeholder="năm" style="width:120px"> 
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Giới tính (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="gender" value="Nam" required="">Nam</label> 
								<label class="radio-inline"><input type="radio" name="gender" value="Nữ" required="">Nữ</label>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Trẻ được sinh vào tuần thứ mấy của thai kỳ (*)</span></label>
							<div class="input-wrap">
								<input name="birthweek" type="number" min="21" max="45" class="qh-form-control iblock" style="width: 65px;" required>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Trẻ đã từng được chẩn đoán tự kỷ chưa?</span></label>
							<div class="input-wrap diagnose-information">
								<label class="radio-inline"><input id="detected" name="checked" type="radio" value="1" required> Rồi</label>
								<label class="radio-inline"><input name="checked" type="radio" value="0" required> Chưa</label>
							</div>
						</div>
						<div class="qh-form-row diagnose-result hidden">
							<label class="qh-label"><span class="align"></span><span class="text">Kết quả chẩn đoán của trẻ</span></label>
							<div class="input-wrap">
								<select name="status" class="qh-form-control" required>
									<option value="Rối loạn tự kỷ/Tự kỷ">Rối loạn tự kỷ/Tự kỷ</option>
									<option value="Rối loạn phát triển lan tỏa">Rối loạn phát triển lan tỏa</option>
									<option value="Theo dõi tự kỷ">Theo dõi tự kỷ</option>
									<option value="Rối loạn phát triển">Rối loạn phát triển</option>
									<option value="Chậm phát triển/ Theo dõi chậm phát triển">Chậm phát triển/ Theo dõi chậm phát triển</option>
									<option value="Không tự kỷ">Không tự kỷ</option>
									<option value="Khác">Khác</option>
								</select>
							</div>
						</div>
						<div class="qh-form-row diagnose-age hidden">
							<label class="qh-label"><span class="align"></span><span class="text">Tuổi của trẻ tại thời điểm được chẩn đoán (*)</span></label>
							<div class="input-wrap">
								<input name="birthage" id="birthage" type="text" class="qh-form-control iblock" style="width: 65px;">
								<span>tháng tuổi</span>
							</div>
						</div>
						<div class="qh-form-row diagnose-place hidden">
							<label class="qh-label"><span class="align"></span><span class="text">Nơi chẩn đoán</span></label>
							<div class="input-wrap">
								<select name="hospital" class="qh-form-control" required>
									<option value="Bệnh viện Nhi Trung Ương">Bệnh viện Nhi Trung Ương</option>
									<option value="Bệnh viện Đại học Y">Bệnh viện Đại học Y</option>
									<option value="Bệnh viện Nhi Đồng 1">Bệnh viện Nhi Đồng 1</option>
									<option value="Bệnh viện Nhi Đồng 2">Bệnh viện Nhi Đồng 2</option>
									<option value="Bệnh viện Tỉnh">Bệnh viện Tỉnh</option>
									<option value="Trung tâm Can thiệp">Trung tâm Can thiệp</option>
									<option value="Khác">Khác</option>
								</select>
							</div>
						</div>
						<div class="qh-form-row diagnose-person hidden">
							<label class="qh-label"><span class="align"></span><span class="text">Người chẩn đoán</span></label>
							<div class="input-wrap">
								<select name="doctor" class="qh-form-control" required>
									<option value="1">1. Bác sỹ chuyên khoa Nhi</option>
									<option value="2">2. Bác sỹ đa khoa</option>
									<option value="3">3. Cán bộ tâm lý</option>
									<option value="4">4. Bác sỹ chuyên ngành khác</option>
									<option value="5">5. Y tá/ Điều dưỡng</option>
									<option value="6">6. Giáo viên mầm non</option>
									<option value="7">7. Giáo viên Giáo dục đặc biệt</option>
									<option value="8">8. Khác</option>
								</select>
							</div>
						</div> 
					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20" style="display: none;"><b><i>Bạn cần điền đầy đủ thông tin để đăng ký trẻ</i></b></div>
							<button type="submit" name="signUpChild" value="1" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase">Lưu</button>
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function($) {
		// $("#register-child").validate({
  //           messages: {
  //               "yyyy": {
  //                   min: 'Năm sinh phải lớn hơn hoặc bằng 2000'
  //               }
  //           }
  //       });
  	jQuery.extend(jQuery.validator.messages, {
	    required: "Trường này là bắt buộc.",
	    remote: "Vui lòng chọn trường này.",
	    email: "Vui lòng nhập đúng địa chỉ email.",
	    url: "Vui lòng nhập đúng URL.",
	    date: "Vui lòng nhập đúng thời gian.",
	    dateISO: "Please enter a valid date (ISO).",
	    number: "Vui lòng nhập chính xác một số.",
	    digits: "Please enter only digits.",
	    creditcard: "Please enter a valid credit card number.",
	    equalTo: "Please enter the same value again.",
	    accept: "Please enter a value with a valid extension.",
	    maxlength: jQuery.validator.format("Vui lòng điền không quá {0} kí tự."),
	    minlength: jQuery.validator.format("Vui lòng điền ít nhất {0} kí tự."),
	    rangelength: jQuery.validator.format("Vui lòng nhập một giá trị trong khoảng {0} đến {1} kí tự."),
	    range: jQuery.validator.format("Vui lòng nhập một giá trị trong khoảng {0} đến {1}."),
	    max: jQuery.validator.format("Vui lòng nhập một giá trị nhỏ hơn hoặc bằng {0}."),
	    min: jQuery.validator.format("Năm sinh phải lớn hơn hoặc bằng {0}.")
		});
	});
</script>

<?php 
	get_footer('new');
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".diagnose-information input").click( function(){
   			if( $('#detected').is(':checked') ){
   				$('#birthage').prop('required',true);
   			}else{
   				$('#birthage').removeAttr('required');
   			} 
		});
	});
</script>