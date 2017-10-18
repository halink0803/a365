<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: User Information
 */

get_header('new');
// $children = a365_get_children();
$user = a365_get_current_user();
$year = $user->year_of_birth;

?>

<div id="siteContent">
	<div class="container">
		<div class="qh-page-header">Thông tin tài khoản</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<form action="#" class="qh-form" method="post">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Email</span></label>
							<div class="input-wrap">
								<input name="email" type="email" disabled="disabled" class="qh-form-control" value="<?php echo $user->email ?>">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Loại tài khoản</span></label>
							<div class="input-wrap">
								<input name="type" type="type" disabled="disabled" class="qh-form-control" value="<?php echo $user->type ?>">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Họ và tên  (*)</span></label>
							<div class="input-wrap">
								<input name="fullname" type="text" required="required" class="qh-form-control" value="<?php echo $user->name ?>">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Năm sinh (*)</span></label>
							<div class="input-wrap">
								<input name="year" type="number" class="qh-form-control iblock" min="1900" required="required" value="<?php echo $user->year_of_birth; ?>">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Giới tính (*)</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="gender" value="Nam" <?php if($user->sex == "Nam") echo "checked" ?>>Nam</label>
								<label class="radio-inline"><input type="radio" name="gender" value="Nữ" <?php if($user->sex == "Nữ") echo "checked" ?>>Nữ</label>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Điện thoại</span></label>
							<div class="input-wrap">
								<input name="phone" type="text" class="qh-form-control iblock" value="<?php echo $user->phone; ?>">
							</div>
						</div>
						<div class="qh-form-row">
				            <label class="qh-label">
				               <span class="align"></span><span class="text">Trình độ học vấn</span>
				            </label>
				            <div class="input-wrap">
				               <select name="edu_level" id="role_user" class="select_contact qh-form-control">
				                  <option value="" <?php if($user->educational_level == "") echo "selected" ?>>-- Chọn --</option>
				                  <option value="Từ cấp 2 trở xuống" <?php if($user->educational_level == "Từ cấp 2 trở xuống") echo "selected" ?>>Từ cấp 2 trở xuống</option>
				                  <option value="Cấp 3" <?php if($user->educational_level == "Từ cấp 2 trở xuống") echo "Cấp 3" ?>>Cấp 3</option>
				                  <option value="Trung cấp/Cao đẳng/Đại học" <?php if($user->educational_level == "Trung cấp/Cao đẳng/Đại học") echo "selected" ?>>Trung cấp/Cao đẳng/Đại học</option>
				                  <option value="Sau đại học" <?php if($user->educational_level == "Sau đại học") echo "selected" ?>>Sau đại học</option>
				               </select>
				            </div>
				        </div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Khu vực (*)</span></label>
							<div class="input-wrap">
								<input name="area" type="text" disabled="disabled" class="qh-form-control iblock" required="required" value="<?php echo a365_get_area_by_id($user->area_code)->name; ?>">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Địa chỉ</span></label>
							<div class="input-wrap">
								<input name="address" type="text" class="qh-form-control iblock" value="<?php echo $user->address; ?>">
							</div>
						</div>

					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20" style="display: none;"><b><i>Bạn cần điền đầy đủ thông tin để đăng ký trẻ</i></b></div>
							<button type="submit" name="editUser" value="<?php echo $user->id ?>" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase">Lưu</button>
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
  })
</script>
<?php 
	get_footer('new');
?>