<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Edit Child Information
 */

get_header('new');
$current_child = $_SESSION['current_child'];
$dateFormat = 'Y-m-d';
$stringDate = $current_child->date_of_birth;
$date = DateTime::createFromFormat($dateFormat, $stringDate);
?>

<div id="siteContent">
	<div class="container">
		<div class="qh-page-header">Chỉnh sửa thông tin trẻ</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<form action="#" class="qh-form" method="post">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Họ và tên trẻ</span></label>
							<div class="input-wrap">
								<input name="fullname" type="text" class="qh-form-control" value="<?php echo $current_child->name ?>" required>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Ngày sinh (Ngày-Tháng-Năm) (*)</span></label>
							<div class="input-wrap">
								<input name="dd" type="number" class="qh-form-control iblock" min="1" max="31" required="" placeholder="01" value="<?php echo $date->format('d') ?>">
								<input name="mm" type="number" class="qh-form-control iblock" min="1" max="12" required="" placeholder="01" value="<?php echo $date->format('m') ?>">
								<input name="yyyy" type="number" class="qh-form-control iblock" min="2000" required="" placeholder="2000" value="<?php echo $date->format('Y') ?>">
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Giới tính</span></label>
							<div class="input-wrap">
								<label class="radio-inline"><input type="radio" name="gender" value="Nam" <?php if($current_child->sex == "Nam") echo "checked" ?>>Nam</label>
								<label class="radio-inline"><input type="radio" name="gender" value="Nữ" <?php if($current_child->sex == "Nữ") echo "checked" ?>>Nữ</label>
							</div>
						</div>
						<div class="qh-form-row">
							<label class="qh-label"><span class="align"></span><span class="text">Trẻ được sinh vào tuần thứ mấy của thai kỳ</span></label>
							<div class="input-wrap">
								<input name="birthweek" type="number" class="qh-form-control iblock" style="width: 65px;" value="<?php echo $current_child->week_of_birth ?>" min="21" required>
							</div>
						</div>
					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<div class="qh-help-text c-red mg-b20" style="display: none;"><b><i>Bạn cần điền đầy đủ thông tin để đăng ký trẻ</i></b></div>
							<button type="submit" name="editChild" value="<?php echo $current_child->id ?>" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase">Lưu</button>
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	get_footer('new');
?>