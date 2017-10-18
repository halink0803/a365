<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Review Gumsue Result
 *
 * @package A356
 */
get_header('new');
$result = load_data_for_review_gumsue_result($_SESSION['gumsue_result_id']);
$questions = explode("|", $result->result);
$info_user = a365_get_current_user();
?>
<div class="container">
	<div class="qh-page-header text-uppercase">
		<?php  
			echo 'BẠN ĐÃ HOÀN THÀNH CÂU HỎI CỦA BÀI '.$result->exercise_name;
		?>	
	</div>
	<div class="qh-jumbotron mg-b15">
	  <p>* Số lần con làm theo = Số lần con cố gắng làm theo cha/mẹ thực hiện hoạt động, có thể thành công hoặc không.</p>
	  <p>** Mức độ hỗ trợ con: 1 = Trẻ tự làm độc lập (không cần trợ giúp), 2 = Gợi ý bằng cử chỉ, 3 = Gợi ý bằng lời nói, 4 = Gợi ý hoàn toàn.</p>
	  <p>*** Số lần trẻ thực hiện hoạt động thành công = Số lần trẻ hoàn thành hoạt động đó một cách thành công, có thể có hoặc không có hỗ trợ của cha mẹ</p>
	</div>
	<div class="qh-jumbotron mg-b15">
        <p>Tên của trẻ : <?php echo $_SESSION['current_child']->name ?></p>
 		<p>Ngày sinh: <?php echo formatDate($_SESSION['current_child']->date_of_birth) ?></p>
        <p>Mã trẻ: <?php echo $_SESSION['current_child']->id ?></p>
        <p>Người làm test: <?php echo $info_user->name;?></p>
        <p>Ngày làm sàng lọc: <?php echo formatDate($result->begin_at); ?></p>
	</div>
	<div class="row">
	</div>
	<div class="test-tab-container">
		<div class="tab-content">
		    <div class="question" id="box-paing">
		    		<?php 
		    			$count = 1;
		    			foreach ($questions as $question) {
		    				if ($question == "")
		    					break;
		    				echo '<div class="tab-pane paging_list">';
		    				echo '<p class="question"><b>Câu ' . $count . ':</b> '. explode("#", $question)[0] . '</p>';
		    				echo '<p><b>Số lần phụ huynh thực hiện/ thử hoạt động: </b>'.explode(" ", explode("#", $question)[1])[0].'</p>';
		    				echo '<p><b>Số lần con làm theo: </b>'.explode(" ", explode("#", $question)[1])[1].'</p>';
		    				echo '<p><b>Mức độ hỗ trợ con: </b>'.explode(" ", explode("#", $question)[1])[2].'</p>';
		    				echo '<p><b>Số lần trẻ thực hiện hoạt động thành công: </b>'.explode(" ", explode("#", $question)[1])[3].'</p>';
		    				$count++;
		    				echo '</div>';
		    		} ?>
		    		<div class="tab-pane paging_list"><b><i>Cám ơn bạn. Bạn hãy lưu lại kết quả này để so sánh với lần làm tiếp theo sau 1 tháng.</i></b></div>
		    		 <input type="button" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase share_mail" value="Gửi email">
              <button type="button" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase print_result"><i class="fa fa-print" style="padding-right:5px"></i> In</button>
                    <div class="clear"></div>
		    </div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('siteContent');
        var popupWin = window.open('','_blank');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

    function send() {
      
        var oEl = document.getElementById('siteContent');
        // Getting the outerHTML of an element:
        var sOuterHTML = oEl.outerHTML;
        var data = encodeURIComponent(sOuterHTML);
        //console.log(data);

        $.post("../send-email", 
                {   
                    'testname' : 'theodoi',
                    'source' : data,
                    'field': $('#send_mail_form').serialize()
                }, 
                function() {
                    //alert("Email đã được gửi thành công!");
                }).success(
                    function(response) {
                        //console.log("status:"+response);
                        if (response.includes('success')){
                            alert( "Email đã được gửi thành công!" );
                            $("#Modal_Send_Mail").modal('hide');
                        }
                        else{
                            alert( "Đã có lỗi xảy ra vui lòng thử lại!" );
                            $("#Modal_Send_Mail").modal('hide');
                        }
                    });
    }                    
</script>
<?php get_footer('new') ?>