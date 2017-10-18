<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: QOL Result
 *
 * @package A356
 */
get_header('new');
$info = $_SESSION['current_child'];
//print_r($info);
$info_user = a365_get_current_user();
qol_save_result();
?>

<div class="guideSurvey pt30">
	<div class="content">
		<div class="wrapper">
			<div id="print-all" class="box_result_mchat">	
			 <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/style.css" />
             <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/result.css" />				   					

				<div style="width:100%;height:20px;"></div>
				<div class="lbtest">
					  <div class="inforGuideSurvey pd20">
            <h2 class="ResultTitle" style="color:#ca2535">
                Bài QOL - Khảo sát chất lượng cuộc sống cha mẹ
            </h2>
            <div class="ResultSurvey" >
                <div class="" style="background-color: #eeecec">
                    <ul class="Ruserinfo">
                        <li>
                            <b class="ReLeft">• Tên của trẻ : </b>
                            <span><?php echo $info->name ?></span>
                        </li>
                        <li>
                            <span>
                    </span>
                        </li>
                        <li>
                            <b class="ReLeft">• Ngày sinh:</b>
                            <span><?php echo formatDate($info->date_of_birth) ?></span>
                        </li>
                        <li>
                            <b class="ReLeft">• Mã trẻ:</b>
                            <span><?php echo $info->id ?></span>
                        </li>
                    </ul>
                    <ul class="Ruserinfo2">
                        <li>
                            <b class="ReRight">• Người làm test: </b>
                            <span>
                                <?php                                
                                    echo $info_user->name;
                                ?>
                            </span>
                        </li>
                        <li>
                            <b class="ReRight">• Ngày làm sàng lọc: </b>
                            <span>
                               <?php echo date( 'd-m-Y') ?>
                            </span>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
						<table class="table_survey_result" width="100%">
							<tr>
							
								<p style="text-align: left;">
										<span style="font-size: 12pt;"><strong>Cám ơn bạn đã dành thời gian trả lời các câu hỏi. Các câu trả lời của bạn giúp chúng tôi hiểu rõ hơn về cuộc sống của các gia đình có con tự kỷ.</strong></span>
									</p>
								<td style="text-align: center" width="100%">
									<h4>Tổng điểm của bạn: <?php echo get_qol_total()?> </h4>
								</td>
							</tr>
							<tr>
								<td>										
									<b>Như vậy trong thang điểm về mức độ hài lòng với cuộc sống với mức 1 điểm là không hề hài lòng, và 5 điểm là rất hài lòng với cuộc sống thì mức độ hài lòng của bạn là: <?php echo get_qol_average()?> </b>

									<div class="pleasing">
										<div style="left:<?php echo get_qol_average()/5*100?>%" class="zero_pleasing">
											<?php echo get_qol_average()?>
										</div>
										<div class="min_pleasing">1</div>
										<div class="max_pleasing">5</div>
										<div class="bar_pleasing"></div>
									</div>
								</td>
							</tr>
						</table>
						<p>

						<p>
							<span style="font-size: 10pt;"><strong>Hãy tiếp tục đồng hành cùng con bạn và các thành viên khác trong gia đình. Can thiệp tích cực cho con và tìm kiếm sự hỗ trợ khi cần cũng góp phần cải thiện cuộc sống của chính bạn. Chúc bạn thành công.</strong></span>
						</p></p>
					</div>
				</div>
				<input type="button" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase share_mail" value="Gửi email">
                <button type="button" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase print_result"><i class="fa fa-print" style="padding-right:5px"></i> In</button>
                <?php
                    $pages = get_pages(array(
                        'meta_key' => '_wp_page_template',
                        'meta_value' => 'page-templates/child-information.php'
                    ));
                ?>
                <a href="<?php echo home_url($pages[0]->post_name); ?>" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase">Chọn trẻ khác</a>
                <div class="clear"></div>
			</div>
		</div>
		<div class="txt_thankyou" style="color:#ca2535">
                Cảm ơn gia đình đã tin tưởng sử dụng A365
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
                    'testname' : 'qol',
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
<?php get_footer('new'); ?>

