<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Template Name: M ChatR Result
 *
 **/
    get_header('new');
    $results = a365_mchatr_get_result();
    $child_information = $_SESSION['current_child'];
    $user = a365_get_current_user();
    if( !$user ) {
      $user = get_no_login_user();
    }
    $child_month_age = child_month_age($child_information->week_of_birth);
?>
<body>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/result.css" />
    <div class="guideSurvey pt30">
        <div class="content container">
            <div class="qh-page-header">Kết quả bài sàng lọc tự kỷ MCHAT-R</div>
            <div class="wrapper" id="print-all">
                <div class="header_test">
                    <div class="title_date row">
                        <div class="title_test">
                            <div class="col-xs-12 col-sm-6 mg-t10 mg-b10">

                            </div>
                        </div>
                        <div class="date_test child-month fw700 c-red text-uppercase">
                            <!-- <p>
                                Ngày làm bài test: <?php
                                    $date = new DateTime($results[0]->begin_at);
                                    echo $date->format('Y/m/d');
                                ?>
                            </p> -->
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                </div>
                <div class="box_result_mchat">
                    <div class="result_mchat">
                        <h4 class="center uppercaseSurveyWait pdbt22">
                            BẠN ĐÃ HOÀN THÀNH XONG M-CHAT-R
                        </h4>
                        <table class="kq_mchat" style="width: 100%;">
                            <tr>
                                <th>Thông tin trẻ</th>
                                <th>Người thực hiện</th>
                            </tr>
                            <tr>
                                <td valign="top">
                                    Tên trẻ: <b><?php echo $child_information->name; ?></b>
                                    <br/>
                                    Mã số trẻ: <b><?php echo $child_information->id; ?></b>
                                    <br/>
                                    Ngày sinh: <b><?php $date = new DateTime( $child_information->date_of_birth); echo $date->format('d/m/Y') ?></b>
                                    <br/>
                                </td>
                                <td valign="top">
                                    Tên: <b><?php echo $user->name; ?></b>
                                    <br/>
                                    Ngày hoàn thành: <strong><?php $date = new DateTime( $results[0]->end_at); echo $date->format('d/m/Y') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Số điểm đạt được: </td>
                                <td><strong><?php echo $results[0]->point; ?></strong></td>
                            </tr>
                        </table>
                        <div class="answer_test_mchat">
                            <div class="qh-jumbotron mg-b15">
                                <?php
                                    echo "<strong>" . $results[0]->conclusion . "</strong>";
                                    $message = '';
                                    if( $child_month_age < 24 ) {
                                        $message = 'Bạn nên quay lại website a365.vn sau sinh nhật 2 tuổi của trẻ để thực hiện lại M-CHAT-R.';
                                    }
                                    switch ( $results[0]->conclusion ) {
                                        case 'Nguy cơ thấp.':
                                            echo " Kết quả cho thấy bạn không cần phải lo lắng nguy cơ tự kỷ của trẻ.
                                                Bạn chưa cần phải hành động gì trừ khi trong quá trình theo dõi bạn thấy lo lắng về sự phát triển hay các dấu hiệu nguy cơ tự kỷ của trẻ.". $message ." Lưu ý rằng M-CHAT-R chỉ là bộ công cụ sàng lọc để phát hiện trẻ có nguy cơ tự kỷ hoặc các rối loạn phát triển khác. <b>Kết quả M-CHAT-R  không phải là kết quả chẩn đoán.</b>";
                                            break;
                                        case 'Nguy cơ trung bình.':
                                            echo " Kết quả của M-CHAT-R cho thấy trẻ có thể có nguy cơ tự kỷ. Bạn nên đưa trẻ đến cán bộ y tế để thực hiện bước tiếp theo – Trả lời Bộ câu hỏi Theo dõi nhằm có kết quả sàng lọc chính xác hơn. Bạn cũng có thể đưa trẻ đi đánh giá, chẩn đoán chuyên sâu tự kỷ tại các cơ sở trong danh sách:
                                                <a href='https://a365.vn/chan-doan-tu-ky/?listClinic=1' style='color:#1478b9;'>Danh sách một số cơ sở y tế được tập huấn và hiện đang có thực hiện đánh giá và chẩn đoán tự kỷ</a>. Lưu ý rằng M-CHAT- R chỉ là bộ công cụ sàng lọc để phát hiện trẻ có nguy cơ tự kỷ hoặc các rối loạn phát triển khác. <b>Kết quả M-CHAT- R không phải là kết quả chẩn đoán.</b>";
                                            break;
                                        default:
                                            echo " Kết quả của sàng lọc cho thấy trẻ có nguy cơ tự kỷ. Bạn nên đến các cơ sở có uy tín về đánh giá và chẩn đoán tự kỷ để xác định tình trạng của con mình. <a style='color: #1478b9;' href='https://a365.vn/chan-doan-tu-ky/?listClinic=1'>Danh sách một số cơ sở y tế được tập huấn và hiện đang có thực hiện đánh giá và chẩn đoán tự kỷ</a>. Bạn hãy mang theo kết quả đánh giá phát triển theo độ tuổi (ASQ® - nếu có) và bản kết quả này khi đến cơ sở y tế. Lưu ý rằng M- CHAT-R chỉ là bộ công cụ sàng lọc để phát hiện trẻ có nguy cơ tự kỷ hoặc các rối loạn phát triển khác. <b>Kết quả M-CHAT-R không phải là kết quả chẩn đoán</b>.";
                                            break;
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="test-tab-container">
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <div class="single-question mg-b5">
                                    <div class="question-text"><span class="c-red"><i>Danh sách câu hỏi</i></span></div>
                                    <div class="question-answer hidden-xs hidden-sm">
                                        <div class="clearfix text-center c-red fw700">
                                            <div class="col-xs-4 pd-a0">Có</div>
                                            <div class="col-xs-4 pd-a0">Không</div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $questions = mchatr_get_questions();
                                    for($i=0; $i<20; $i++):
                                        $current = 'answer_' . strval($i + 1);
                                ?>
                                    <div class="single-question">
                                        <div class="question-text"><b>Câu <?php echo $i+1 ?>:</b> <?php echo $questions[$i]->q_content; ?></div>
                                        <div class="question-answer">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="question-<?php echo $i+1;?>"
                                                    <?php if($results[0]->$current == 1) echo "checked" ?> value="1" disabled="disabled"><span class="label-text">Có</span>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="question-<?php echo $i+1;?>"
                                                    <?php if($results[0]->$current == 0) echo "checked" ?> value="0" disabled="disabled"><span class="label-text">Không</span>
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
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
            </div>
        </div>
    </div>

</body>
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
                    'testname' : 'mchatr',
                    'source' : data,
                    'field': $('#send_mail_form').serialize()
                },
                function() {
                    //alert("Email đã được gửi thành công!");
                }).success(
                    function(response) {
                        ////console.log("status:"+response);
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

    var $=jQuery.noConflict();
    $(document).ready(function(){

        var user_check = <?php
                            if(checkUserType()==true)
                                echo "true";
                            else
                                echo "false";
                        ?>;
        //console.log(user_check);

        if (user_check == true) {
            $("#Modal_Respondent").modal({
                backdrop: 'static',
                keyboard: true
            });

            $('.cancel').click(function(event) {
                window.location.href = '<?php echo home_url('/'); ?>';
            });

            $('.view_result').click(function(event) {
                //console.log("chạy vào đây rồi");
                var age = $("#age").val();
                var role_user = $("#relationship").val();
                var gender = $("input[name='gender']:checked").val();
                var other_role = $("#other_relationship").val();
                //console.log("age:"+age);
                //console.log("role_user:"+role_user);
                //console.log("gender:"+gender);
                //console.log("other_role:"+other_role);
                //check empty fields
                if (age == '' || role_user == '' || gender == '' || (role_user == 'Khác' && other_role == '')) {
                    //console.log("đã check rồi");
                    $("#notice3").html("Bạn cần điền đầy đủ các trường được đánh dấu (*)!");
                } else {
                    //console.log("đã gửi request rồi");
                    $user_info = $("#respondent").serialize();
                    //console.log( $user_info );
                    //event.preventDefault();
                    $.ajax({
                      type: 'post',
                      dataType: 'json',
                      url: a365_ajax.ajax_url,
                      data: $user_info + "&action=" + 'update_mchatr_respondent_info',
                      success: function(response) {
                        $("#Modal_Respondent").modal('hide');
                      }

                    });
                }
            });
        }
    })
</script>
<?php

    get_footer('new');

?>
