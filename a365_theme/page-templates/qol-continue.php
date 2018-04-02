<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: QOL Continue
 *
 * @package A356
 */
get_header('new');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$_SESSION['start_qol'] = date('Y-m-d H:i:s');
$result = load_data_for_qol_continue($_SESSION['qol_result_id']);
$answers = array();
$i = 1;
$answers[$i++] = $result->answer_1;
$answers[$i++] = $result->answer_2;
$answers[$i++] = $result->answer_3;
$answers[$i++] = $result->answer_4;
$answers[$i++] = $result->answer_5;
$answers[$i++] = $result->answer_6;
$answers[$i++] = $result->answer_7;
$answers[$i++] = $result->answer_8;
$answers[$i++] = $result->answer_9;
$answers[$i++] = $result->answer_10;
$answers[$i++] = $result->answer_11;
$answers[$i++] = $result->answer_12;
$answers[$i++] = $result->answer_13;
$answers[$i++] = $result->answer_14;
$answers[$i++] = $result->answer_15;
$answers[$i++] = $result->answer_16;
$answers[$i++] = $result->answer_17;
$answers[$i++] = $result->answer_18;
$answers[$i++] = $result->answer_19;
$answers[$i++] = $result->answer_20;
$answers[$i++] = $result->answer_21;
$answers[$i++] = $result->answer_22;
$answers[$i++] = $result->answer_23;
$answers[$i++] = $result->answer_24;
$answers[$i++] = $result->answer_25;
$answers[$i++] = $result->answer_26;
$answers[$i++] = $result->answer_27;
$answers[$i++] = $result->answer_28;
?>
<body>
<div class="exit_test">
    <a onclick="save_all_click_out('qol')" >
        <img src="<?php echo get_template_directory_uri().'/images/btn_exit.png' ?>" alt="" />    </a>
</div>
<!-- Thông báo không có trẻ tự kỉ -->
<div id="autism_child_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 10pt;"><strong>Bạn không thể xem phần này vì trong danh sách của bạn không có trẻ nào bị tự kỷ hoặc chậm phát triển. Nếu bạn có trẻ tự kỷ hoặc chậm phát triển, hãy vào TRANG QUẢN LÝ TRẺ để cập nhật tình trạng chẩn đoán của trẻ.</strong></span></p>
				</div>
            </div>
            <div class="modal-footer" style="text-align: center;">
               	<p>
					<br/>
					<button type="button" class="btn btn-default" onclick="window.location.href='../quan-ly-tre'" >Trang quản lý trẻ</button>
					<button type="button" class="btn btn-default" onclick="window.location.href='../'" >Về trang chủ</button>
				</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal Chọn trẻ -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 10pt;"><strong>KHẢO SÁT CHẤT LƯỢNG CUỘC SỐNG CHA MẸ</strong></span></p>
				</div>
				<p style="text-align: center;"><strong><span style="font-size: 11pt;">Bạn vui lòng "Chọn trẻ" sau đó ấn "Xác nhận trẻ" để bắt đầu làm bài khảo sát này.</span></strong></p>
            </div>
            <div class="modal-body" style="text-align: center;">
	            <select class="select_contact" required="required" id="TestChildAction">
					<option value="">--chọn trẻ--</option>
					<?php foreach ($autismChild as $value) { ?>
						<option value="<?=$value->id?>"><?=$value->name?></option>

					<?php } ?>
				</select>
            </div>
            <div class="modal-footer" style="text-align: center;">
               	<p>
					<br/>
					<button type="button" class="btn btn-default" onclick="lock_sesion_child()" id="save_current_child" >Xác nhận trẻ</button>
					<button type="button" class="btn btn-default" onclick="window.location.href='../'" >Về trang chủ</button>
				</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	var $=jQuery.noConflict();
	//var is_exist_child = <?=$_SESSION['exist_child']?>;
	var num_autism = <?=$num_autism?>;
	//console.log(num_autism);
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
  		//
		if (is_exist_child == 0){
			if (num_autism == 0) {
			//console.log("abc");
			$("#autism_child_Modal").modal({
		  		backdrop: 'static',
		  		keyboard: true
			});
		}
		if (num_autism > 1)
			$("#myModal").modal({
		  		backdrop: 'static',
		  		keyboard: true
			});
		}
	})

</script>
<script>
	var number_quest = 0;
	var set_id = 'none';
	function load_quest_next(actionQuest, myRadio, id_complete) {
		set_id = id_complete;
		var lang = 'vn';
		var obj = JSON.parse(actionQuest);
		//	alert(obj[myRadio.value].quest_next);
		if (obj[myRadio.value].quest_next == 'NO') {
			$("#" + id_complete).val(1);
		}
		if (obj[myRadio.value].quest_next == 'YES') {
			$("#" + id_complete).val(0);
		}
		if (obj[myRadio.value].quest_next == '') {
			$("#" + id_complete).val(0);
		} else {
			$("#" + id_complete).val(obj[myRadio.value].quest_next + '&' + id_complete);
			//load_quest_extra();
		}
	}
</script>
<div id="siteContent">

	<div class="container">
		<div class="qh-page-header">Bộ câu hỏi về chất lượng cuộc sống của cha mẹ có con tự kỷ</div>
		<div class="row">
	      <div class="col-xs-12 col-sm-6 mg-t10 mg-b10">
	        <div class="child-month fw700 c-red text-uppercase">Đánh giá chất lượng cuộc sống cha mẹ</div>
	      </div>
	      <div class="col-xs-12 col-sm-6 mg-t10 mg-b10 text-right-sm">Ngày làm: <?php echo date('d-m-Y') ?></div>
	    </div>
		<div class="test-tab-container">
			<?php $pages = get_pages(array(
			          'meta_key' => '_wp_page_template',
			          'meta_value' => 'page-templates/qol_result.php'
			)); ?>

			<form action="<?php echo $pages[0]->guid ?>" onsubmit="return validateForm()" id="TestingManagerBeginTestForm" method="post" accept-charset="utf-8">
				<div class="tab-content">
	        		<div class="question" id="box-paing">
						<script>
							var numberset = [];
						</script>
						<?php
							$qol_questions = get_qol_questions();
						?>
						<script>
							// điếm số câu hỏi trong bài
							var number0 = <?php echo count($qol_questions) ?>;
							numberset[0] = <?php echo count($qol_questions) ?>;
							number_quest += <?php echo count($qol_questions) ?>;
						</script>
						<?php
							$i=0;
							$count = 1;
							foreach ($qol_questions as $qol_question) {
								echo '<div class="tab-pane paging_list" id="paging_list'. $i .'">';
									echo '<div class="single-question">';
										echo '<div class="question-survey bold w100">';
											echo '<span>Câu ' . $count . ': '. $qol_question->q_content . '</span>';
										echo '</div>';
										echo '<div>
												<div class="divCell" style="margin-top: 10px; float: left; width: 16.66%;">
													<input type="radio" name="qol_question['.$count.']" id="qol_question'.$count.'1" class="tab_quest0 name_radio'.$count.'" value="1" '.gen_qol_checkbox($answers[$count], "1").'"/>
													<label for="qol_question'.$count.'1">Không hề</label>
												</div>
												<div class="divCell" style="margin-top: 10px;float: left; width: 16.66%;">
													<input type="radio" name="qol_question['.$count.']" id="qol_question'.$count.'2" class="tab_quest0 name_radio'.$count.'" value="2" '.gen_qol_checkbox($answers[$count], "2").'/>
													<label for="qol_question'.$count.'2">Một chút</label>
												</div>
												<div class="divCell" style="margin-top: 10px;float: left; width: 16.66%;">
													<input type="radio" name="qol_question['.$count.']" id="qol_question'.$count.'3" class="tab_quest0 name_radio'.$count.'" value="3" '.gen_qol_checkbox($answers[$count], "3").'/>
													<label for="qol_question'.$count.'3">Tương đối</label>
												</div>
												<div class="divCell" style="margin-top: 10px;float: left; width: 16.66%;">
													<input type="radio" name="qol_question['.$count.']" id="qol_question'.$count.'4" class="tab_quest0 name_radio'.$count.'" value="4" '.gen_qol_checkbox($answers[$count], "4").'/>
													<label for="qol_question'.$count.'4">Khá nhiều</label>
												</div>
												<div class="divCell" style="margin-top: 10px;float: left; width: 16.66%;">
													<input type="radio" name="qol_question['.$count.']" id="qol_question'.$count.'5" class="tab_quest0 name_radio'.$count.'" value="5" '.gen_qol_checkbox($answers[$count], "5").'/>
													<label for="qol_question'.$count.'5">Rất nhiều</label>
												</div>
												<div class="divCell" style="margin-top: 10px;float: left; width: 16.66%;">
													<input type="radio" name="qol_question['.$count.']" id="qol_question'.$count.'6" class="tab_quest0 name_radio'.$count.'" value="6" '.gen_qol_checkbox($answers[$count], "6").'/>
													<label for="qol_question'.$count.'6">Không phù hợp</label>
												</div>
											</div>';
									echo '</div>';
								echo '</div>';
						        $count++;
								$i++;
							}
						?>

						<div class="tab-pane tab-page-control">

						    <div class="row text-uppercase">
						      <div class="col-xs-6"><a href="#" id="prv-button-one" class=" qh-btn qh-btn-lg qh-btn-cblue" onclick="prev_page()">Quay lại</a></div>
						      <div class="col-xs-6 text-right"><a href="#" id="nex-button-one" data-toggle="tab" class=" qh-btn qh-btn-lg qh-btn-blue" onclick="next_page()">Tiếp tục</a></div>
						      <div class="col-xs-6 text-right"><input type="submit" class="qh-btn qh-btn-lg qh-btn-cblue submit_begin" name="qolketqua" value="KẾT QUẢ"/></div>
						    </div>
						    <div class="clear"></div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
<?php get_footer('new') ?>
<script>
		var data = $('#box-paing');
		var number = 14;
		var stt = data.find('.paging_list').length;
		var size = (stt / number) * 10;
		var page_set_timer = Math.round((stt / number) + 0.45);
		var text_add_time = '';
		var rate = Math.round((100 / page_set_timer) - 0.45);
		text_add_time = '<span class="number_local" style="width: 1%;"></span> 99%';
		$('.number_step').html(text_add_time);
		// update rate complete
		function update_rate_passed(pages) {
			var rate_ting = 1;
			for (i = 1; i < pages; i++) {
				rate_ting += rate;
			}
			var text_add_time = '<span class="number_local" style="width:' + rate_ting + '%;"></span> ' + rate_ting + '%';
			$('.number_step').html(text_add_time);
			return;
		}
		$(".submit_begin").hide();
		var data = $('#box-paing');
		var page = 1;
		var stt = data.find('.paging_list').length;
		for (i = 0; i < stt; i++) {
			$('#paging_list' + i).hide();
		}
		var number = 14;
		var size_z = (stt / number) * 10;
		var page_set_timer_z = Math.round((stt / number) + 0.45);
		var start = (page - 1) * number;
		var stop = page * number;
		for (start; start < stop; start++) {
			$('#paging_list' + start).show();
		}
		if (stop >= stt) {
			$(".submit_begin").show();
		} else {
			$(".submit_begin").hide();
		}
		$('#nex-button-one').addClass("select_hover");
		//
		var page_set = 0;
		function prev_page() {
			if (page_set <= 0) {
			} else {
				$('#nex-button-one').addClass("select_hover");
				page_set--;
			}
			if (page_set <= 0) {
				$("#prv-button-one").removeClass("select_hover");
			}
			var number_start = 0;
			var number_stop = 0;
			for (i = 0; i < page_set; i++) {
				number_start += number;
			}
			for (i = 0; i <= page_set; i++) {
				number_stop += number;
			}
			update_rate_passed(page_set);
			var data = $('#box-paing');
			var stt = data.find('.paging_list').length;
			for (i = 0; i < stt; i++) {
				$('#paging_list' + i).hide();
			}
			var start = number_start;
			var stop = number_stop;
			for (start; start < stop; start++) {
				$('#paging_list' + start).show();
			}
			if (stop >= stt) {
				$(".submit_begin").show();
				$("#prv-button-one").removeClass("select_hover");
			} else {
				$(".submit_begin").hide();
				$('#nex-button-one').addClass("select_hover");
			}
		}
		//next
		function next_page() {
			if (page_set >= page_set_timer_z) {
			} else {
				$("#prv-button-one").addClass("select_hover");
				page_set++;
				$('html, body').animate({ scrollTop: 20 }, 'fast');
			}
			if (page_set >= page_set_timer_z) {
				$('#nex-button-one').removeClass("select_hover");
			}
			var number_start = 0;
			var number_stop = 0;
			update_rate_passed(page_set);
			for (i = 0; i < page_set; i++) {
				number_start += number;
			}
			for (i = 0; i <= page_set; i++) {
				number_stop += number;
			}
			var data = $('#box-paing');
			var stt = data.find('.paging_list').length;
			for (i = 0; i < stt; i++) {
				$('#paging_list' + i).hide();
			}
			var start = number_start;
			var stop = number_stop;
			for (start; start < stop; start++) {
				$('#paging_list' + start).show();
			}
			if (stop >= stt) {
				$(".submit_begin").show();
				$('#nex-button-one').removeClass("select_hover");
			} else {
				$(".submit_begin").hide();
				$('#nex-button-one').addClass("select_hover");
			}
		}
		// next page
		function page_tab(page) {
			if (page <= 0) {
				$("#prv-button-one").removeClass("select_hover");
			} else {
				$("#prv-button-one").addClass("select_hover");
			}
			if (page >= page_set_timer_z) {
				$('#nex-button-one').removeClass("select_hover");
			} else {
				$('#nex-button-one').addClass("select_hover");
			}
			page_set = page;
			update_rate_passed(page);
			var number_start = 0;
			var number_stop = 0;
			for (i = 0; i < page; i++) {
				number_start += number;
			}
			for (i = 0; i <= page; i++) {
				number_stop += number;
			}
			var data = $('#box-paing');
			var stt = data.find('.paging_list').length;
			for (i = 0; i < stt; i++) {
				$('#paging_list' + i).hide();
			}
			var start = number_start;
			var stop = number_stop;
			for (start; start < stop; start++) {
				$('#paging_list' + start).show();
			}
			if (stop >= stt) {
				$(".submit_begin").show();
			} else {
				$(".submit_begin").hide();
			}
		}
	</script>
	<script>
	var not_check_double = false;
	var validate = false;
	var val = 0;
	function validate_tab(qty) {
		var tab = $('.tab_quest0:radio:checked').length;
		var all = numberset[0];
		if ((all - tab) > qty) {
			not_check_double = false;
			alert("Bạn cần phải chọn hết câu hỏi");
			page_tab(0);
			return  false;
		}
		return true;
	}
	function validate_tab_survey(qty) {
		var redective = 99999;
		for (s = 1; s < number_quest; s++) {
			if ($(".name_radio" + s + ":radio").is(':checked')) {
			} else {
				redective = Math.round(s / number + 0.49);
				break;
			}
		}
		if (redective != 99999) {
			not_check_double = false;
			alert("Bạn cần phải chọn hết câu hỏi");
			page_tab((redective - 1));
			return  false;
		}
		return true;
	}
	// khi click submit
	function validateForm() {
		if (not_check_double) {
			return false;
		}
		not_check_double = true;
		return validate_tab_survey(0);
		return true;
	}
</script>

<script>
	var next = 0;
	var obj_otion;
	function save_ajax_call_back() {
		var str = $("#TestingManagerBeginTestForm").serialize();
		$.ajax({
			type   : "POST",
			url    : "/StartTestings/manager_test_ajax/5768b0c8bd53473b6fe08d94/test",
			data   : $("#TestingManagerBeginTestForm").serialize(),
			success: function (response) {
				obj = JSON.parse(response);
				//  alert(obj.point);
				if (obj.point >= 3 && obj.point <= 7) {
					getdataquest();
					$('#content-follow').slideDown();
				} else {
					validate = true;
					$('#TestingManagerBeginTestForm').submit();
				}
			}
		});
	}
	var next_quest = true;
	function load_quest_extra(id, id_complete, zen, zen_true, zen_false) {
		$("#load_quest").addClass("xample_post_form");
		$("#load_quest").removeClass("xpro");
		var targeturl = "/StartTestings/get_form" + '/' + id + '/' + id_complete
			+ '/' + zen + '/' + zen_true +
			'/' + zen_false + '/' + "5768b0c8bd53473b6fe08d94";
		if (next_quest) {
			next_quest = false;
			jQuery.ajax({
				type      : 'get',
				url       : targeturl,
				beforeSend: function (xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				},
				success   : function (response) {
					next_quest = true;
					if (response) {
						$('#load_quest').html(response);
					}
				},
				error     : function (e) {
					//alert("An error occurred: " + e.responseText.message);
					//console.log(e);
				}
			});
		}
	}
</script>