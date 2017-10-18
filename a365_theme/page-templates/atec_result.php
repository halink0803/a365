<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: ATEC Result
 *
 * @package A356
 */
get_header('new');
$info = $_SESSION['current_child'];
//print_r($info);
$info_user = a365_get_current_user();
atec_save_result();
?>   
<div class="guideSurvey pt30">
    <div class="content">
        <div class="wrapper">
            <div class="box_result_mchat" id="print-all">
             <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/style.css" />
             <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/result.css" />
                <div style="width:100%;height:20px;">
                </div>
                <div class="lbtest">
                    <div class="inforGuideSurvey pd20" id="tab1">
                        <h1 class="ResultTitle" style="color:#ca2535">
            BÀI ĐÁNH GIÁ TÌNH TRẠNG TRẺ
        </h1>
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
                        <b class="ReRight">• Người làm bài: </b>
                        <span>
                            <?php                                
                                echo $info_user->name;
                            ?>
                        </span>
                    </li>
                    <li>
                        <b class="ReRight">• Ngày làm bài: </b>
                        <span>
                           <?php echo date( 'd-m-Y') ?>
                        </span>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
                        <table class="table_survey_result" width="100%">
                            <tr>
                                <td width="100%">
                                    <h4>
                                        Kết quả đánh giá:
                                        <?php echo get_total_score()?>
                                    </h4>
                                    <p style="text-align: left;">
                                        <strong>
                                            Cám ơn bạn đã dành thời gian làm bài đánh giá tình trạng trẻ.
                                        </strong>
                                    </p>
                                    <p>
                                        <strong>
                                            Bảng kiểm đánh giá can thiệp tự kỷ (ATEC)
                                        </strong>
                                        không phải là bảng kiểm để chẩn đoán, mà giúp người chăm sóc trẻ và các cán bộ chuyên môn theo dõi tình trạng của trẻ trong quá trình can thiệp. 
                                        <strong>Điểm càng thấp thì có nghĩa trẻ càng ít vấn đề. Điểm lần đánh giá sau thấp hơn so với lần trước có nghĩa là trẻ đang có sự cải thiện.</strong> Hãy lưu lại kết quả các lần đánh giá bằng cách gửi kết quả này vào email của bạn để tiện theo dõi.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title_quest_survey">
                                        Lĩnh vực 1: Lời nói/ ngôn ngữ/ giao tiếp
                                    </div>
                                    <div class="quest_survey_point">
                                        Kết quả đánh giá:
                                        <?php echo get_cate1_score()?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title_quest_survey">
                                        Lĩnh vực 2: Kỹ năng xã hội
                                    </div>
                                    <div class="quest_survey_point">
                                        Kết quả đánh giá:
                                        <?php echo get_cate2_score()?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title_quest_survey">
                                        Lĩnh vực 3: Nhận thức
                                    </div>
                                    <div class="quest_survey_point">
                                        Kết quả đánh giá:
                                        <?php echo get_cate3_score()?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title_quest_survey">
                                        Lĩnh vực 4: Sức khỏe/thể chất/hành vi
                                    </div>
                                    <div class="quest_survey_point">
                                        Kết quả đánh giá:
                                        <?php echo get_cate4_score()?>
                                    </div>
                                </td>
                            </tr>
                        </table>
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
                    <div class="clear"></div>
            </div>
        </div>
        <div class="txt_thankyou" style="color:#ca2535">
                Cảm ơn gia đình đã tin tưởng sử dụng A365
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
                    'testname' : 'atec',
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
