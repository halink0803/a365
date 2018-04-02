<?php
if ( ! defined( 'ABSPATH' ) ) exit;
  /**
   * Template Name: ASQ® Continue
   *
   * @package A356
   */

  get_header('new');
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $current_child_obj = $_SESSION['current_child'];
  $child_month_age = child_month_age($current_child_obj->week_of_birth);
  $result = load_data_for_asq_continue($_SESSION['asq_result_id']);
  $_SESSION['asq_set'] =  get_month_test($child_month_age);

?>

<div class="exit_test">
    <a onclick="save_all_click_out('asq')" >
        <img src="<?php echo get_template_directory_uri().'/images/btn_exit.png' ?>" alt="" />    </a>
</div>
<!-- ASQ Modal -->
<div id="ASQModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
                <div class="tit_popup" align="left">
                   <p style="text-align: center;"><span style="font-size: 10pt;"><strong>Hiện tại A365 chỉ có các bộ công cụ sàng lọc dành cho trẻ từ 9-48 tháng tuổi (đã được điều chỉnh theo tuần sinh của trẻ). Bạn hãy quay lại làm bài khi có trẻ ở trong độ tuổi này. Xem thêm về bộ ASQ® tại <a href="../sang-loc/" target="blank">đây</a></strong></span></p>
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
<input id="user_id_value" type="hidden" user_id="<?php echo a365_get_current_user_id() ?>" />
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
  $(document).ready(function(){
    if (child_month_age < 9 || child_month_age > 51)
      $("#ASQModal").modal({
          backdrop: 'static',
          keyboard: true
      });
  })
  ////console.log("login"+login);
</script>
<script>
  var number_quest = 0;
  var set_id = 'none';
  function load_quest_next(actionQuest, myRadio, id_complete) {
  set_id = id_complete;
  var lang = 'vn';
  var obj = JSON.parse(actionQuest);
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
    <div class="qh-page-header">Bộ câu hỏi đánh giá phát triển theo độ tuổi (ASQ®)</div>
    <div class="qh-jumbotron mg-b15">
      <p><li>Với mỗi hoạt động, hãy đánh dấu vào ô <b>CÓ</b> (nếu trẻ thực hiện thường xuyên), <b>THỈNH THOẢNG</b> (nếu trẻ thỉnh thoảng thực hiện được hoạt động) và <b>CHƯA</b> (nếu trẻ chưa thực hiện được hoạt động).</li></p>
      <p><li>Bạn cần để cho trẻ thực hiện thử mỗi hoạt động trước khi bạn đánh dấu vào ô.</li></p>
      <p><li>Hãy hoàn thành bảng câu hỏi này như một trò chơi vui vẻ đối với bạn và trẻ.</li></p>
      <p><li>Đảm bảo rằng trẻ được nghỉ ngơi, ăn uống đầy đủ và sẵn sàng tham gia cùng bạn.</li></p>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6 mg-t10 mg-b10">
        <div class="child-month fw700 c-red text-uppercase">
           Bài ASQ® <?php echo $_SESSION['asq_set']  ?> tháng tuổi</div>
      </div>

      <div class="col-xs-12 col-sm-6 mg-t10 mg-b10 text-right-sm">Ngày làm: <?php echo date('d-m-Y') ?></div>
    </div>
    <!-- content test -->
    <div class="test-tab-container">
      <ul class="idTabs nav nav-tabs">
        <li id="li_tab1" class="active">
          <a class="selected" id="tab1" onclick="page_tab(1)">
          Giao tiếp
          </a>
        </li>
        <li id="li_tab2">
          <a class="" id="tab2" onclick="page_tab(2)">
          Vận động thô
          </a>
        </li>
        <li id="li_tab3">
          <a class="" id="tab3" onclick="page_tab(3)">
          Vận động tinh
          </a>
        </li>
        <li id="li_tab4">
          <a class="" id="tab4" onclick="page_tab(4)">
          Giải quyết vấn đề
          </a>
        </li>
        <li id="li_tab5">
          <a class="" id="tab5" onclick="page_tab(5)">
          Cá nhân xã hội
          </a>
        </li>
        <li id="li_tab6">
          <a class="" id="tab6" onclick="page_tab(6)">
          Tổng kết
          </a>
        </li>
      </ul>
      <form accept-charset="utf-8" action="" id="TestingManagerBeginTestForm" method="post">
      </script>
      <div class="tab-content">
        <div class="question" id="box-paing">
          <script>
            var numberset = [];
          </script>
          <?php

            $main_array = get_asq_questions($_SESSION['asq_set']);
            ?>
          <script>
            // điếm số câu hỏi trong bài
            var number0 = <?php echo count($main_array[0])+1 ?>;
            numberset[0] = <?php echo count($main_array[0]) ?>;
            number_quest += <?php echo count($main_array[0])+1 ?>;
          </script>
          <div class="tab-pane paging_list" id="paging_list0">
            <div class="single-question mg-b5">
              <div class="question-text"><span class="c-red"><i>Hãy chắc chắn thử những hoạt động này cho trẻ</i></span></div>
              <div class="question-answer hidden-xs hidden-sm">
                <div class="clearfix text-center c-red fw700">
                  <div class="col-xs-4 pd-a0">Có</div>
                  <div class="col-xs-4 pd-a0">Thỉnh thoảng</div>
                  <div class="col-xs-4 pd-a0">Chưa</div>
                </div>
              </div>
            </div>
          </div>
          <?php $result_array1 =  array();?>
          <?php
            $i=1;
            $count =1;
            foreach ($main_array[0] as $quest) {
                if(isset($_POST['giao_tiep'.$count.'1']) && $_POST['giao_tiep'.$count.'1']==1){
                    array_push($result_array1, 10);
                }
                elseif(isset($_POST['giao_tiep'.$count.'2']) && $_POST['giao_tiep'.$count.'2']==2){
                    array_push($result_array1, 5);
                }
                elseif(isset($_POST['giao_tiep'.$count.'3']) && $_POST['giao_tiep'.$count.'3']==3){
                    array_push($result_array1, 0);
                }
                else{
                    array_push($result_array1, 99);
                }
                echo '<div class="tab-pane paging_list" id="paging_list'. $i .'">';
                  echo '<div class="single-question">';
                    echo '<div class="question-text">' ;
                      echo '<p class="question"><b>Câu ' . $count . ':</b> '. $quest->q_content . '</p>';
                      if($quest->q_img){
                          echo '<img alt="" class="img_dai" src="'. plugins_url( 'a365_plugin/assets/img/asq/'.$quest->q_img ).'"/>';
                      }
                      if($quest->q_list){
                          $list_quests =  explode('|', $quest->q_list);
                          $num = 65;
                          echo '<div class="list-quest">';
                              foreach ($list_quests as $list_quest) {
                                  echo'<div>
                                          <label>
                                              '.strtolower(chr($num)).'. '. $list_quest .'
                                          </label>
                                      </div>';
                                  $num++;
                              }
                          echo '</div>';
                      }
                    echo '</div>';
                    echo '<div class="question-answer">
                            <div class="radio">
                                <label>
                                  <input id="giao_tiep'.$count.'1" name="giao_tiep['.$count.']" type="radio" value="10" class="tab_quest0" '.gen_checkbox($result->cate_1_answers, $count-1, "10").'/>
                                  <span class="label-text" for="giao_tiep'.$count.'1">
                                      CÓ
                                  </span>
                                </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="giao_tiep'.$count.'2" name="giao_tiep['.$count.']" type="radio" value="5" class="tab_quest0" '.gen_checkbox($result->cate_1_answers, $count-1, "5").'/>
                                <span class="label-text" for="giao_tiep'.$count.'2">
                                    THỈNH THOẢNG
                                </span>
                              </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="giao_tiep'.$count.'3" name="giao_tiep['.$count.']" type="radio" value="0" class="tab_quest0" '.gen_checkbox($result->cate_1_answers, $count-1, "0").'/>
                                <span class="label-text" for="giao_tiep'.$count.'3">
                                    CHƯA
                                </span>
                              </label>
                            </div>
                            <input name="giao_tiep['.$count.']" style="display:none;" type="radio" value="99" '.gen_checkbox($result->cate_1_answers, $count-1, "99").'/>
                          </div>';
                  echo '</div>';
                echo '</div>';
                $count++;
                $i++;
            }
          ?>
          <script>
            // điếm số câu hỏi trong bài
            var number1 =<?php echo count($main_array[1])+1 ?>;
            numberset[1] = <?php echo count($main_array[1]) ?>;
            number_quest += <?php echo count($main_array[1])+1 ?>;
          </script>
          <div class="tab-pane paging_list" id="paging_list<?php echo $i ?>">
            <div class="single-question mg-b5">
              <div class="question-text"><span class="c-red"><i>Hãy chắc chắn thử những hoạt động này cho trẻ</i></span></div>
              <div class="question-answer hidden-xs hidden-sm">
                <div class="clearfix text-center c-red fw700">
                  <div class="col-xs-4 pd-a0">Có</div>
                  <div class="col-xs-4 pd-a0">Thỉnh thoảng</div>
                  <div class="col-xs-4 pd-a0">Chưa</div>
                </div>
              </div>
            </div>
          </div>
          <?php $result_array2 =  array();?>
          <?php
            $i++;
            $count =1;
             foreach ($main_array[1] as $quest) {
                if(isset($_POST['van_dong_tho'.$count.'1']) && $_POST['van_dong_tho'.$count.'1']==1){
                    array_push($result_array2, 10);
                }
                elseif(isset($_POST['van_dong_tho'.$count.'2']) && $_POST['van_dong_tho'.$count.'2']==2){
                    array_push($result_array2, 5);
                }
                elseif(isset($_POST['van_dong_tho'.$count.'3']) && $_POST['van_dong_tho'.$count.'3']==3){
                    array_push($result_array2, 0);
                }
                else{
                    array_push($result_array2, 99);
                }
                echo '<div class="tab-pane paging_list" id="paging_list'. $i .'">';
                  echo '<div class="single-question">';
                    echo '<div class="question-text">' ;
                      echo '<p class="question"><b>Câu ' . $count . ':</b> '. $quest->q_content . '</p>';
                      if($quest->q_img){
                          echo '<img alt="" class="img_dai" src="'. plugins_url( 'a365_plugin/assets/img/asq/'.$quest->q_img ).'"/>';
                      }
                      if($quest->q_list){
                          $list_quests =  explode('|', $quest->q_list);
                          $num = 65;
                          echo '<div class="list-quest">';
                              foreach ($list_quests as $list_quest) {
                                  echo'<div>
                                          <label>
                                              '.strtolower(chr($num)).'. '. $list_quest .'
                                          </label>
                                      </div>';
                                  $num++;
                              }
                          echo '</div>';
                      }
                    echo '</div>';
                    echo '<div class="question-answer">
                            <div class="radio">
                                <label>
                                  <input id="van_dong_tho'.$count.'1" name="van_dong_tho['.$count.']" type="radio" value="10" class="tab_quest1" '.gen_checkbox($result->cate_2_answers, $count-1, "10").'/>
                                  <span class="label-text" for="van_dong_tho'.$count.'1">
                                      CÓ
                                  </span>
                                </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="van_dong_tho'.$count.'2" name="van_dong_tho['.$count.']" type="radio" value="5" class="tab_quest1" '.gen_checkbox($result->cate_2_answers, $count-1, "5").'/>
                                <span class="label-text" for="van_dong_tho'.$count.'2">
                                    THỈNH THOẢNG
                                </span>
                              </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="van_dong_tho'.$count.'3" name="van_dong_tho['.$count.']" type="radio" value="0" class="tab_quest1" '.gen_checkbox($result->cate_2_answers, $count-1, "0").'/>
                                <span class="label-text" for="van_dong_tho'.$count.'3">
                                    CHƯA
                                </span>
                              </label>
                            </div>
                            <input name="van_dong_tho['.$count.']" style="display:none;" type="radio" value="99" '.gen_checkbox($result->cate_2_answers, $count-1, "99").'/>
                          </div>';
                  echo '</div>';
                echo '</div>';
                $count++;
                $i++;
            }
          ?>
          <script>
            // điếm số câu hỏi trong bài
            var number2 = <?php echo count($main_array[2])+1 ?>;
            numberset[2] = <?php echo count($main_array[2]) ?>;
            number_quest += <?php echo count($main_array[2])+1 ?>;
          </script>
          <div class="tab-pane paging_list" id="paging_list<?php echo $i ?>">
            <div class="single-question mg-b5">
              <div class="question-text"><span class="c-red"><i>Hãy chắc chắn thử những hoạt động này cho trẻ</i></span></div>
              <div class="question-answer hidden-xs hidden-sm">
                <div class="clearfix text-center c-red fw700">
                  <div class="col-xs-4 pd-a0">Có</div>
                  <div class="col-xs-4 pd-a0">Thỉnh thoảng</div>
                  <div class="col-xs-4 pd-a0">Chưa</div>
                </div>
              </div>
            </div>
          </div>
          <?php $result_array3 =  array();?>
          <?php
            $i++;
            $count =1;
             foreach ($main_array[2] as $quest) {
                if(isset($_POST['van_dong_tinh'.$count.'1']) && $_POST['van_dong_tinh'.$count.'1']==1){
                    array_push($result_array3, 10);
                }
                elseif(isset($_POST['van_dong_tinh'.$count.'2']) && $_POST['van_dong_tinh'.$count.'2']==2){
                    array_push($result_array3, 5);
                }
                elseif(isset($_POST['van_dong_tinh'.$count.'3']) && $_POST['van_dong_tinh'.$count.'3']==3){
                    array_push($result_array3, 0);
                }
                else{
                    array_push($result_array3, 99);
                }
                echo '<div class="tab-pane paging_list" id="paging_list'. $i .'">';
                  echo '<div class="single-question">';
                    echo '<div class="question-text">' ;
                      echo '<p class="question"><b>Câu ' . $count . ':</b> '. $quest->q_content . '</p>';
                      if($quest->q_img){
                          echo '<img alt="" class="img_dai" src="'. plugins_url( 'a365_plugin/assets/img/asq/'.$quest->q_img ).'"/>';
                      }
                      if($quest->q_list){
                          $list_quests =  explode('|', $quest->q_list);
                          $num = 65;
                          echo '<div class="list-quest">';
                              foreach ($list_quests as $list_quest) {
                                  echo'<div>
                                          <label>
                                              '.strtolower(chr($num)).'. '. $list_quest .'
                                          </label>
                                      </div>';
                                  $num++;
                              }
                          echo '</div>';
                      }
                    echo '</div>';
                    echo '<div class="question-answer">
                            <div class="radio">
                                <label>
                                  <input id="van_dong_tinh'.$count.'1" name="van_dong_tinh['.$count.']" type="radio" value="10" class="tab_quest2" '.gen_checkbox($result->cate_3_answers, $count-1, "10").'/>
                                  <span class="label-text" for="van_dong_tinh'.$count.'1">
                                      CÓ
                                  </span>
                                </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="van_dong_tinh'.$count.'2" name="van_dong_tinh['.$count.']" type="radio" value="5" class="tab_quest2" '.gen_checkbox($result->cate_3_answers, $count-1, "5").'/>
                                <span class="label-text" for="van_dong_tinh'.$count.'2">
                                    THỈNH THOẢNG
                                </span>
                              </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="van_dong_tinh'.$count.'3" name="van_dong_tinh['.$count.']" type="radio" value="0" class="tab_quest2" '.gen_checkbox($result->cate_3_answers, $count-1, "0").'/>
                                <span class="label-text" for="van_dong_tinh'.$count.'3">
                                    CHƯA
                                </span>
                              </label>
                            </div>
                            <input name="van_dong_tinh['.$count.']" style="display:none;" type="radio" value="99" '.gen_checkbox($result->cate_3_answers, $count-1, "99").'/>
                          </div>';
                  echo '</div>';
                echo '</div>';
                $count++;
                $i++;
            }
          ?>
          <script>
            // điếm số câu hỏi trong bài
            var number3 = <?php echo count($main_array[3])+1 ?>;
            numberset[3] = <?php echo count($main_array[3]) ?>;
            number_quest += <?php echo count($main_array[3])+1 ?>;
          </script>
          <div class="tab-pane paging_list" id="paging_list<?php echo $i ?>">
            <div class="single-question mg-b5">
              <div class="question-text"><span class="c-red"><i>Hãy chắc chắn thử những hoạt động này cho trẻ</i></span></div>
              <div class="question-answer hidden-xs hidden-sm">
                <div class="clearfix text-center c-red fw700">
                  <div class="col-xs-4 pd-a0">Có</div>
                  <div class="col-xs-4 pd-a0">Thỉnh thoảng</div>
                  <div class="col-xs-4 pd-a0">Chưa</div>
                </div>
              </div>
            </div>
          </div>
          <?php $result_array4 =  array();?>
          <?php
            $i++;
            $count =1;
             foreach ($main_array[3] as $quest) {
                if(isset($_POST['giai_quyet'.$count.'1']) && $_POST['giai_quyet'.$count.'1']==1){
                    array_push($result_array4, 10);
                }
                elseif(isset($_POST['giai_quyet'.$count.'2']) && $_POST['giai_quyet'.$count.'2']==2){
                    array_push($result_array4, 5);
                }
                elseif(isset($_POST['giai_quyet'.$count.'3']) && $_POST['giai_quyet'.$count.'3']==3){
                    array_push($result_array4, 0);
                }
                else{
                    array_push($result_array4, 99);
                }
                echo '<div class="tab-pane paging_list" id="paging_list'. $i .'">';
                  echo '<div class="single-question">';
                    echo '<div class="question-text">' ;
                      echo '<p class="question"><b>Câu ' . $count . ':</b> '. $quest->q_content . '</p>';
                      if($quest->q_img){
                          echo '<img alt="" class="img_dai" src="'. plugins_url( 'a365_plugin/assets/img/asq/'.$quest->q_img).'"/>';
                      }
                      if($quest->q_list){
                          $list_quests =  explode('|', $quest->q_list);
                          $num = 65;
                          echo '<div class="list-quest">';
                              foreach ($list_quests as $list_quest) {
                                  echo'<div>
                                          <label>
                                              '.strtolower(chr($num)).'. '. $list_quest .'
                                          </label>
                                      </div>';
                                  $num++;
                              }
                          echo '</div>';
                      }
                    echo '</div>';
                    echo '<div class="question-answer">
                            <div class="radio">
                                <label>
                                  <input id="giai_quyet'.$count.'1" name="giai_quyet['.$count.']" type="radio" value="10" class="tab_quest3" '.gen_checkbox($result->cate_4_answers, $count-1, "10").'/>
                                  <span class="label-text" for="giai_quyet'.$count.'1">
                                      CÓ
                                  </span>
                                </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="giai_quyet'.$count.'2" name="giai_quyet['.$count.']" type="radio" value="5" class="tab_quest3" '.gen_checkbox($result->cate_4_answers, $count-1, "5").'/>
                                <span class="label-text" for="giai_quyet'.$count.'2">
                                    THỈNH THOẢNG
                                </span>
                              </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="giai_quyet'.$count.'3" name="giai_quyet['.$count.']" type="radio" value="0" class="tab_quest3" '.gen_checkbox($result->cate_4_answers, $count-1, "0").'/>
                                <span class="label-text" for="giai_quyet'.$count.'3">
                                    CHƯA
                                </span>
                              </label>
                            </div>
                            <input name="giai_quyet['.$count.']" style="display:none;" type="radio" value="99" '.gen_checkbox($result->cate_4_answers, $count-1, "99").'/>
                          </div>';
                  echo '</div>';
                echo '</div>';
                $count++;
                $i++;
            }
          ?>
          <script>
            // điếm số câu hỏi trong bài
            var number4 = <?php echo count($main_array[4])+1 ?>;
            numberset[4] = <?php echo count($main_array[4]) ?>;
            number_quest += <?php echo count($main_array[4])+1 ?>;
          </script>
           <div class="tab-pane paging_list" id="paging_list<?php echo $i ?>">
            <div class="single-question mg-b5">
              <div class="question-text"><span class="c-red"><i>Hãy chắc chắn thử những hoạt động này cho trẻ</i></span></div>
              <div class="question-answer hidden-xs hidden-sm">
                <div class="clearfix text-center c-red fw700">
                  <div class="col-xs-4 pd-a0">Có</div>
                  <div class="col-xs-4 pd-a0">Thỉnh thoảng</div>
                  <div class="col-xs-4 pd-a0">Chưa</div>
                </div>
              </div>
            </div>
          </div>
          <?php $result_array5 =  array();?>
          <?php
            $i++;
            $count =1;
              foreach ($main_array[4] as $quest) {
                if(isset($_POST['ca_nhan'.$count.'1']) && $_POST['ca_nhan'.$count.'1']==1){
                    array_push($result_array5, 10);
                }
                elseif(isset($_POST['ca_nhan'.$count.'2']) && $_POST['ca_nhan'.$count.'2']==2){
                    array_push($result_array5, 5);
                }
                elseif(isset($_POST['ca_nhan'.$count.'3']) && $_POST['ca_nhan'.$count.'3']==3){
                    array_push($result_array5, 0);
                }
                else{
                    array_push($result_array5, 99);
                }
                echo '<div class="tab-pane paging_list" id="paging_list'. $i .'">';
                  echo '<div class="single-question">';
                    echo '<div class="question-text">' ;
                      echo '<p class="question"><b>Câu ' . $count . ':</b> '. $quest->q_content . '</p>';
                      if($quest->q_img){
                          echo '<img alt="" class="img_dai" src="'. plugins_url( 'a365_plugin/assets/img/asq/'.$quest->q_img).'"/>';
                      }
                      if($quest->q_list){
                          $list_quests =  explode('|', $quest->q_list);
                          $num = 65;
                          echo '<div class="list-quest">';
                              foreach ($list_quests as $list_quest) {
                                  echo'<div>
                                          <label>
                                              '.strtolower(chr($num)).'. '. $list_quest .'
                                          </label>
                                      </div>';
                                  $num++;
                              }
                          echo '</div>';
                      }
                    echo '</div>';
                    echo '<div class="question-answer">
                            <div class="radio">
                                <label>
                                  <input id="ca_nhan'.$count.'1" name="ca_nhan['.$count.']" type="radio" value="10" class="tab_quest4" '.gen_checkbox($result->cate_5_answers, $count-1, "10").'/>
                                  <span class="label-text" for="ca_nhan'.$count.'1">
                                      CÓ
                                  </span>
                                </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="ca_nhan'.$count.'2" name="ca_nhan['.$count.']" type="radio" value="5" class="tab_quest4" '.gen_checkbox($result->cate_5_answers, $count-1, "5").'/>
                                <span class="label-text" for="ca_nhan'.$count.'2">
                                    THỈNH THOẢNG
                                </span>
                              </label>
                            </div>
                            <div class="radio"">
                              <label>
                                <input id="ca_nhan'.$count.'3" name="ca_nhan['.$count.']" type="radio" value="0" class="tab_quest4" '.gen_checkbox($result->cate_5_answers, $count-1, "0").'/>
                                <span class="label-text" for="ca_nhan'.$count.'3">
                                    CHƯA
                                </span>
                              </label>
                            </div>
                            <input name="ca_nhan['.$count.']" style="display:none;" type="radio" value="99" '.gen_checkbox($result->cate_5_answers, $count-1, "99").'/>
                          </div>';
                  echo '</div>';
                echo '</div>';
                $count++;
                $i++;
            }
          ?>
          <script>
            // điếm số câu hỏi trong bài
            var number5 = <?php echo count($main_array[5])+1 ?>;
            numberset[5] = <?php echo count($main_array[5]) ?>;
            number_quest += <?php echo count($main_array[5])+1 ?>;
          </script>
          <div class="tab-pane paging_list" id="paging_list<?php echo $i ?>">
            <div class="single-question mg-b5">
              <div class="question-text"><span class="c-red"><i>Hãy chắc chắn thử những hoạt động này cho trẻ</i></span></div>
            </div>
          </div>
          <?php $result_array6 =  array();?>
          <?php
            $i++;
            $count = 1;
            foreach ($main_array[5] as $quest) {
                $child_array = array();
                array_push($child_array, $quest->q_content_id);


                if(isset($_POST['tong_ket'.$count]) && $_POST['tong_ket'.$count]==1){
                    array_push($child_array, 'Có');
                }
                elseif(isset($_POST['tong_ket'.$count]) && $_POST['tong_ket'.$count]==2){
                    array_push($child_array, 'Không');
                }
                else{
                    array_push($child_array, '');
                }
                if(isset($_POST['tong_ket'.$count.'text'])){
                array_push($child_array, $_POST['tong_ket'.$count.'text']);
                }
                array_push($result_array6, $child_array);

                echo '
                <div class="tab-pane paging_list" id="paging_list'.$i.'">
                    ';
                    echo '
                    <div class="chooseAnswer box_dt pt10">
                        ';
                        echo '
                        <div class="question1 bold w100">
                            ';
                            echo '
                            <p class="quest">
                                Câu ' . $count . ' : '. $quest->q_content . '
                            </p>
                            ';
                        echo '
                        </div>
                        ';
                        echo '
                        <div class="answer pt10">
                            <div class="input4Survey">
                                <input class="tab_quest5 radio_check" id="tong_ket'.$count.'1" name="tong_ket['.$count.']" onclick="" type="radio" value="Có" '.gen_checkbox_tongket($result->cate_6_answers, $count-1, "Có").'">
                                    <label class="color_red" for="tong_ket'.$count.'1">
                                        CÓ
                                    </label>
                                </input>
                            </div>
                            <div class="input4Survey">
                                <input class="tab_quest5 radio_check" id="tong_ket'.$count.'2" name="tong_ket['.$count.']" onclick="" type="radio" value="Không" '.gen_checkbox_tongket($result->cate_6_answers, $count-1, "Không").'>
                                    <label class="color_red" for="tong_ket'.$count.'2">
                                        KHÔNG
                                    </label>
                                </input>
                            </div>
                            <input id="tong_ket'.$count.'3" name="tong_ket['.$count.']" onclick="" type="radio" value="Bỏ trống" style="display:none;" '.gen_checkbox_tongket($result->cate_6_answers, $count-1, "Bỏ trống").'>
                            </input>
                        </div>
                        ';

                        echo '
                        <div class="textAreaSurvey">
                            <div class="input textarea">
                                <textarea class="radio_check" cols="30" id="tong_ket'.$count.'text" name="tong_ket_text['.$count.']" rows="6" style="width:100%">
                                  '.gen_text_for_tongket($result->cate_6_answers, $count-1).'
                                </textarea>
                            </div>
                        </div>
                        ';
                    echo '
                    </div>
                    ';
                echo '
                </div>
                ';
                $count++;
                $i++;


            }
            ?>
          </form>
          <div class="tab-pane tab-page-control">
            <div class="row text-uppercase">
              <div class="col-xs-6"><a href="#" id="prv-button-one" class=" qh-btn qh-btn-lg qh-btn-cblue" onclick="prev_page()">Quay lại</a></div>
              <div class="col-xs-6 text-right"><a href="#" id="nex-button-one" data-toggle="tab" class=" qh-btn qh-btn-lg qh-btn-cblue" onclick="next_page()">Tiếp tục</a></div>
              <div class="col-xs-6 text-right"><a href="#" class="qh-btn qh-btn-lg qh-btn-cblue submit_begin score-asq" name="asqketqua">Kết quả</a></div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer('new'); ?>
<script>
  var not_check_double = false;
  var validate = false;
  // validate chỉ đc phép bỏ qua 4 câu
  var val = 0;
  function validate_tab(qty) {

  //class="input1Survey tab_quest4"
      var tab = $('input[type=radio].tab_quest0:checked').length;
      var all = numberset[0];
      if ((all - tab) > qty) {
          not_check_double = false;
          alert('Bạn chỉ có thể bỏ trống ' + qty + ' câu trong 1 phần');
          page_tab(1);

          return  false;
      }

      var tab = $('input[type=radio].tab_quest1:checked').length;
      var all = numberset[1];
      if ((all - tab) > qty) {
          not_check_double = false;
          alert('Bạn chỉ có thể bỏ trống ' + qty + ' câu trong 1 phần');
          page_tab(2);

          return  false;
      }

      var tab = $('input[type=radio].tab_quest2:checked').length;
      var all = numberset[2];
      if ((all - tab) > qty) {
          not_check_double = false;
          alert('Bạn chỉ có thể bỏ trống ' + qty + ' câu trong 1 phần');
          page_tab(3);

          return  false;
      }

      var tab = $('input[type=radio].tab_quest3:checked').length;
      var all = numberset[3];
      if ((all - tab) > qty) {
          not_check_double = false;
          alert('Bạn chỉ có thể bỏ trống ' + qty + ' câu trong 1 phần');
          page_tab(4);

          return  false;
      }

      var tab = $('input[type=radio].tab_quest4:checked').length;
      var all = numberset[4];
      if ((all - tab) > qty) {
          not_check_double = false;
          alert('Bạn chỉ có thể bỏ trống ' + qty + ' câu trong 1 phần');
          page_tab(5);

          return  false;
      }

      var tab = $('input[type=radio].tab_quest5:checked').length;
      var all = numberset[5];
      if ((all - tab) > qty) {
          not_check_double = false;
          alert('Bạn chỉ có thể bỏ trống ' + qty + ' câu trong 1 phần');
          page_tab(6);

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
      //alert($('.radio_check:radio:checked').length);
      return validate_tab(2);
      return true;
  }
</script>
<script>
  var next = 0;
  var next_quest = true;
  function load_quest_extra(id, id_complete, zen, zen_true, zen_false) {
      $("#load_quest").addClass("xample_post_form");
      $("#load_quest").removeClass("xpro");
      var targeturl = "/StartTestings/get_form" + '/' + id + '/' + id_complete
          + '/' + zen + '/' + zen_true +
          '/' + zen_false + '/' + "5760dd4cbd53474d10a98550";
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
                  //console.log(e);
              }
          });
      }
  }
</script>
<script>
  var data = $('#box-paing');
  var number = <?php echo count($main_array[0])+1 ?>;
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

  //$(".submit_begin").hide();

  var data = $('#box-paing');
  var page = 1;
  var stt = data.find('.paging_list').length;
  for (i = 0; i < stt; i++) {
  $('#paging_list' + i).hide();
  }

  var number = <?php echo count($main_array[0])+1 ?>;
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

  //$('.nex-button-one')

  $('#nex-button-one').addClass("select_hover");
  //


  var page_set = 1;
  function prev_page() {
  if (page_set <= 1) {
  } else {
  $('#nex-button-one').addClass("select_hover");
  page_set--;
  }
  if (page_set <= 1) {
  $("#prv-button-one").removeClass("select_hover");
  }
  $("ul.idTabs li").removeClass("active");
  var number_start = 0;
  var number_stop = 0;

  switch (page_set) {
  case  1:
  $("#li_tab1").addClass("active");
  number_start = 0;
  number_stop = number0;


  break;
  case  2:
  $("#li_tab2").addClass("active");
  number_start = number0;
  number_stop = number0 + number1;
  break;
  case  3:
  $("#li_tab3").addClass("active");
  number_start = number0 + number1;
  number_stop = number0 + number1 + number2;
  break;
  case  4:
  $("#li_tab4").addClass("active");
  number_start = number0 + number1 + number2;
  number_stop = number0 + number1 + number2 + number3;
  break;
  case  5:
  $("#li_tab5").addClass("active");
  number_start = number0 + number1 + number2 + number3;
  number_stop = number0 + number1 + number2 + number3 + number4;
  break;
  case  6:
  $("#li_tab6").addClass("active");
  number_start = number0 + number1 + number2 + number3 + number4;
  number_stop = number0 + number1 + number2 + number3 + number4 + number5;
  break;
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
  //save_ajax();
  }

  //next
  function next_page() {
    if (page_set >= 6) {
    } else {
    $("#prv-button-one").addClass("select_hover");
    page_set++;
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    }
    if (page_set >= 6) {
    $('#nex-button-one').removeClass("select_hover");
    }

    $("ul.idTabs li").removeClass("active");
    var number_start = 0;
    var number_stop = 0;
    switch (page_set) {
    case  1:
    $("#li_tab1").addClass("active");
    number_start = 0;
    number_stop = number0;
    break;
    case  2:
    $("#li_tab2").addClass("active");
    number_start = number0;
    number_stop = number0 + number1;
    break;
    case  3:
    $("#li_tab3").addClass("active");
    number_start = number0 + number1;
    number_stop = number0 + number1 + number2;
    break;
    case  4:
    $("#li_tab4").addClass("active");
    number_start = number0 + number1 + number2;
    number_stop = number0 + number1 + number2 + number3;
    break;
    case  5:
    $("#li_tab5").addClass("active");
    number_start = number0 + number1 + number2 + number3;
    number_stop = number0 + number1 + number2 + number3 + number4;
    break;
    case  6:
    $("#li_tab6").addClass("active");
    number_start = number0 + number1 + number2 + number3 + number4;
    number_stop = number0 + number1 + number2 + number3 + number4 + number5;
    break;
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
    //save_ajax();
  }
  // next page
    function page_tab(page) {

  if (page <= 1) {
  $("#prv-button-one").removeClass("select_hover");
  } else {
  $("#prv-button-one").addClass("select_hover");
  }
  if (page >= 6) {
  $('#nex-button-one').removeClass("select_hover");
  } else {
  $('#nex-button-one').addClass("select_hover");
  }
  $("ul.idTabs li a").removeClass("selected");
  $("ul.idTabs li").removeClass("active");
  var number_start = 0;
  var number_stop = 0;
  page_set = page;
  switch (page) {
  case  1:
  $("#li_tab1").addClass("active");
  $("#tab1").addClass("selected");
  number_start = 0;
  number_stop = number0;
  break;
  case  2:
  $("#li_tab2").addClass("active");
  $("#tab2").addClass("selected");
  number_start = number0;
  number_stop = number0 + number1;
  break;
  case  3:
  $("#li_tab3").addClass("active");
  $("#tab3").addClass("selected");
  number_start = number0 + number1;
  number_stop = number0 + number1 + number2;
  break;
  case  4:
  $("#li_tab4").addClass("active");
  $("#tab4").addClass("selected");
  number_start = number0 + number1 + number2;
  number_stop = number0 + number1 + number2 + number3;
  break;
  case  5:
  $("#li_tab5").addClass("active");
  $("#tab5").addClass("selected");
  number_start = number0 + number1 + number2 + number3;
  number_stop = number0 + number1 + number2 + number3 + number4;
  break;
  case  6:
  $("#li_tab6").addClass("active");
  $("#tab6").addClass("selected");
  number_start = number0 + number1 + number2 + number3 + number4;
  number_stop = number0 + number1 + number2 + number3 + number4 + number5;
  break;
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

  //save_ajax();
  }
</script>