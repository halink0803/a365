<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Edit Child Status
 */

get_header('new');
$current_child = $_SESSION['current_child'];
$status = a365_get_child_status();
// print_r($status);
?>

<div id="siteContent">
	<div class="container">
		<div class="qh-page-header">Chỉnh sửa tình trạng trẻ</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<form action="#" class="qh-form" method="post" id="edit-child-status">
					<div class="qh-form-input-wrap">
						<div class="qh-form-row diagnose-result">
							<label class="qh-label"><span class="align"></span><span class="text">Kết quả chẩn đoán của trẻ</span></label>
							<div class="input-wrap">
								<select name="status" class="qh-form-control">
									<option value="" <?php if($status->child_status == "") echo "selected" ?>>Chưa cập nhật</option>
									<option value="Rối loạn tự kỷ/Tự kỷ" <?php if($status->child_status == "Rối loạn tự kỷ/Tự kỷ" || $status->child_status == "Tự kỷ") echo "selected" ?>>Rối loạn tự kỷ/Tự kỷ</option>
									<option value="Rối loạn phát triển lan tỏa" <?php if($status->child_status == "Rối loạn phát triển lan tỏa") echo "selected" ?>>Rối loạn phát triển lan tỏa</option>
									<option value="Theo dõi tự kỷ" <?php if($status->child_status == "Theo dõi tự kỷ") echo "selected" ?>>Theo dõi tự kỷ</option>
									<option value="Rối loạn phát triển" <?php if($status->child_status == "Rối loạn phát triển") echo "selected" ?>>Rối loạn phát triển</option>
									<option value="Chậm phát triển/ Theo dõi chậm phát triển" <?php if($status->child_status == "Chậm phát triển/ Theo dõi chậm phát triển") echo "selected" ?>>Chậm phát triển/ Theo dõi chậm phát triển</option>
									<option value="Không tự kỷ" <?php if($status->child_status == "Không tự kỷ") echo "selected" ?>>Không tự kỷ</option>
									<option value="Khác" <?php if($status->child_status == "Khác") echo "selected" ?>>Khác</option>
								</select>
							</div>
						</div>
						<div class="qh-form-row diagnose-age">
							<label class="qh-label"><span class="align"></span><span class="text">Tuổi của trẻ tại thời điểm được chẩn đoán</span></label>
							<div class="input-wrap">
								<input name="birthage" type="text" value="<?php echo $status->age_at_diagnose; ?>" class="qh-form-control iblock" style="width: 65px;">
								<span>tháng tuổi</span>
							</div>
						</div>
						<div class="qh-form-row diagnose-place">
							<label class="qh-label"><span class="align"></span><span class="text">Nơi chẩn đoán</span></label>
							<div class="input-wrap">
								<select name="hospital" class="qh-form-control">
									<option value="" <?php if($status->diagnosed_at == "") echo "selected" ?>>Chưa cập nhật</option>
									<option value="Bệnh viện Nhi Trung Ương" <?php if($status->diagnosed_at == "Bệnh viện Nhi Trung Ương") echo "selected" ?>>Bệnh viện Nhi Trung Ương</option>
									<option value="Bệnh viện Đại học Y" <?php if($status->diagnosed_at == "Bệnh viện Đại học Y") echo "selected" ?>>Bệnh viện Đại học Y</option>
									<option value="Bệnh viện Nhi Đồng 1" <?php if($status->diagnosed_at == "Bệnh viện Nhi Đồng 1") echo "selected" ?>>Bệnh viện Nhi Đồng 1</option>
									<option value="Bệnh viện Nhi Đồng 2" <?php if($status->diagnosed_at == "Bệnh viện Nhi Đồng 2") echo "selected" ?>>Bệnh viện Nhi Đồng 2</option>
									<option value="Bệnh viện Tỉnh" <?php if($status->diagnosed_at == "Bệnh viện Tỉnh") echo "selected" ?>>Bệnh viện Tỉnh</option>
									<option value="Trung tâm Can thiệp" <?php if($status->diagnosed_at == "Trung tâm Can thiệp") echo "selected" ?>>Trung tâm Can thiệp</option>
									<option value="Khác" <?php if($status->diagnosed_at == "Khác") echo "selected" ?>>Khác</option>
								</select>
							</div>
						</div>
						<div class="qh-form-row diagnose-person">
							<label class="qh-label"><span class="align"></span><span class="text">Người chẩn đoán</span></label>
							<div class="input-wrap">
								<select name="doctor" class="qh-form-control">
									<option value="" <?php if($status->diagnose_by == "0") echo "selected" ?>>Chưa cập nhật</option>
									<option value="1" <?php if($status->diagnose_by == "1") echo "selected" ?>>1. Bác sĩ chuyên khoa nhi</option>
									<option value="2" <?php if($status->diagnose_by == "2") echo "selected" ?>>2. Bác sỹ đa khoa</option>
									<option value="3" <?php if($status->diagnose_by == "3") echo "selected" ?>>3. Cán bộ tâm lý</option>
									<option value="4" <?php if($status->diagnose_by == "4") echo "selected" ?>>4. Bác sỹ chuyên ngành khác</option>	
									<option value="5" <?php if($status->diagnose_by == "5") echo "selected" ?>>5. Y tá/ Điều dưỡng</option>
									<option value="6" <?php if($status->diagnose_by == "6") echo "selected" ?>>6. Giáo viên mầm non</option>
									<option value="7" <?php if($status->diagnose_by == "7") echo "selected" ?>>7. Giáo viên Giáo dục đặc biệt</option>
									<option value="8" <?php if($status->diagnose_by == "8") echo "selected" ?>>8. Khác</option>
								</select>
							</div>
						</div> 
					</div>
					<div class="qh-form-row">
						<div class="input-wrap">
							<input name="editChildStatus" value="<?php echo $current_child->id ?>" type="hidden">
							<div class="qh-help-text c-red mg-b20"><b><i class="message"></i></b></div>
							<button type="submit" name="editChildStatus" value="<?php echo $current_child->id ?>" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase save-child-status">Lưu</button>
							<span class="loading-icon hidden"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i></span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.save-child-status').click(function(e){
			e.preventDefault();
			var status = $('select[name=status]').val();
			var birthage = $('input[name=birthage]').val();
			var hospital = $('select[name=hospital]').val();
			var doctor = $('select[name=doctor]').val();
			//console.log(status);
			//console.log(birthage);
			//console.log(hospital);
			//console.log(doctor);

			if( (status != null && status != 'Không tự kỷ') && (birthage == '' || hospital == ''  || doctor == '') ) {
				$('.message').html('Bạn phải cập nhật đầy đủ thông tin');
			} else {
				var data = $('#edit-child-status').serialize();
				$.ajax({
	              type: 'post',
	              dataType: 'json',
	              url: a365_ajax.ajax_url,
	              data: data + "&action=" + 'edit_child_status',
	              success: function(response) {
	                  //console.log(response);
	                  window.location.href=response.url;
	              },
	              error: function (xhr, ajaxOptions, thrownError) {
	                  alert(xhr.status);
	                  alert(thrownError);
	              } 
	            });
			}
		});
	});
</script>

<?php 
	get_footer('new');
?>