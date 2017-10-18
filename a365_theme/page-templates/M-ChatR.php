<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Template Name: M-Chat R
 *
 **/

get_header('new');
$user = a365_get_current_user();
$current_child_obj = $_SESSION['current_child'];
$child_month_age = child_month_age($current_child_obj->week_of_birth);
first_create_mchatr_result_in_db();
?>
<body>
    <!-- MChat Modal -->
    <div id="mchatModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #eeecec">
                    <div class="tit_popup" align="left">
                       <p style="text-align: center;"><span style="font-size: 10pt;"><strong>Hiện tại A365 chỉ hỗ trợ bài sàng lọc này cho trẻ từ 16-48 tháng tuổi. Bạn hãy quay lại làm bài khi có trẻ ở trong độ tuổi này.</strong></span></p>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
                    <p>
              <br/>
              <button type="button" class="btn btn-default" onclick="window.location.href='../'" >Về trang chủ</button>            
            </p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      var $=jQuery.noConflict();
      var child_month_age = <?=$child_month_age?>;
      $(document).ready(function(){
        if (child_month_age < 16 || child_month_age > 48)
          $("#mchatModal").modal({
              backdrop: 'static',
              keyboard: true
          });
      })

    </script>
    <div class="siteContent">
        <div class="container">
            <img width="100%" src="<?php echo get_template_directory_uri().'/images/banner_m-chat.jpg'?>" title="mchatr-banner">
            <div class="qh-page-header">Bài sàng lọc tự kỷ MCHAT-R</div>
            <div class="wrapper">
                <!-- Header test and banner -->
                <div class="qh-jumbotron mg-b15">
                    <div class="txt_test">
                        <p><strong>M-CHAT-R</strong> là bảng kiểm sàng lọc tự kỷ cho trẻ từ 16 – 30 tháng (nhưng có thể dùng đến 48 tháng).</p>
                        <p>Không phải tất cả những trẻ em có điểm nguy cơ cao đều được chẩn đoán là rối loạn tự kỷ.</p>
                        <p>Công cụ này được thiết kế để cha mẹ làm sàng lọc cho con tại nhà, hoặc cho cán bộ y tế hoặc nhà chuyên môn sử dụng bộ công cụ này nhằm đánh giá những nguy cơ mắc rối loạn phổ tự kỷ.</p>
                        <p> Bạn có thể hoàn thành M-CHAT-R dưới 2 phút. </p>
                    </div>
                </div>
                <div class="row">
                        <div class="col-xs-12 col-sm-6 mg-t10 mg-b10">
                            <div class="child-month fw700 c-red text-uppercase"> M-CHAT R </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 mg-t10 mg-b10 text-right-sm">
                            <p> Ngày làm bài test: <?php echo date("d-m-Y") ?> </p>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                <!-- content test -->
                <form class="test-tab-container" accept-charset="utf-8" action="" id="TestingManagerBeginTestForm" method="post">
                    <div class="tab-content">
                        <div class="list-questions tab-pane active">
                            <div class="single-question mg-b5">
                                <div class="question-text"><span class="c-red"><i><!-- Hãy chắc chắn thử những hoạt động này cho trẻ --></i></span></div>
                                <div class="question-answer hidden-xs hidden-sm" style="float:right;">
                                    <div class="clearfix text-center c-red fw700">
                                        <div class="col-xs-4 pd-a0">Có</div>
                                        <div class="col-xs-4 pd-a0">Không</div>
                                    </div>
                                </div>
                            </div>
                            <?php $questions = mchatr_get_questions(); ?>
                            <?php for($i=0; $i<sizeof($questions); $i++): ?>
                            <div class="single-question">
                                <div class="question-text"><b>Câu <?php echo $i+1 ?>:</b> <?php echo $questions[$i]->q_content; ?></div>
                                <div class="question-answer">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="question-<?php echo $i+1;?>" value="1" required><span class="label-text">Có</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="question-<?php echo $i+1;?>" value="0" required><span class="label-text" required>Không</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                            <div class="tab-page-control">
                                <div class="row text-uppercase">
                                    <div class="col-xs-6 hidden "><a href="#" id="tabNavControl" class="qh-btn qh-btn-lg qh-btn-cblue">Quay lại</a></div>
                                    <?php if($user) : ?>
                                        <div class="col-xs-6 text-right"><input type="submit" id="tabNavControl" class="qh-btn qh-btn-lg qh-btn-blue submit_begin" name="result" value="Kết quả"></div>
                                    <?php else: ?>
                                        <input name="result" value="1" hidden>
                                        <input name="ajax_score" value="1" hidden>
                                        <div class="col-xs-6 text-right"><a href="#" id="tabNavControl" data-toggle="tab" class="qh-btn qh-btn-lg qh-btn-blue submit_begin tinhDiem tinhDiemMchatr" name="result" data-toggle="modal" data-target="#Modal_User_Info_Without_Login">Kết quả</a></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-footer">
                        <p>© 2009 Diana Robins, Deborah Fein, & Marianne Barton Translated by Center for Creative Initiatives in Health and Population (CCIHP), June 2015</p>
                        <p>© Bản quyền đã đăng ký bởi tác giả Diana Robins, Deborah Fein, & Marianne Barton
                        Dịch bởi Trung tâm Sáng Kiến Sức Khỏe và Dân Số (CCIHP) và chỉnh sửa bởi Nguyễn Thị Nha Trang, tháng 6 năm 2015</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
  var $=jQuery.noConflict();
  var child_month_age = <?=$child_month_age?>;
  
  var user_id = "<?=a365_get_current_user_id()?>";
  //console.log(user_id);
  var login = 1;
  if (user_id == 0){
    login = 0;
    //console.log("login1"+login);
  }
</script>
</body>
<?php
  get_footer('new');
?>
