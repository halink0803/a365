<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * A365 ASQ functions
 *
 **/

  $cut_o_m['10'] = array(array(22.87, 35.52), array(30.07, 41.55), array(37.97, 46.34), array(32.51, 42.35), array(27.25, 38.37));
  $cut_o_m['12'] = array(array(15.64, 29.43), array(21.49, 35.7), array(34.5, 43.36), array(27.32, 38.15), array(21.73, 33.73));
  $cut_o_m['14'] = array(array(17.4, 31.62), array(25.8, 39.45), array(23.06, 34.96), array(22.56, 34.82), array(23.18, 35.76));
  $cut_o_m['16'] = array(array(16.81, 30.44), array(37.91, 47.11), array(31.98, 41.97), array(30.51, 40.95), array(26.43, 37.22));
  $cut_o_m['18'] = array(array(13.06, 27.68), array(37.38, 46.42), array(34.32, 43.38), array(25.74, 35.86), array(27.19, 37.55));
  $cut_o_m['20'] = array(array(20.5, 34.32), array(39.89, 47.86), array(36.05, 44.39), array(28.84, 38.54), array(33.36, 42.7));
  $cut_o_m['22'] = array(array(13.04, 28.99), array(27.75, 39.11), array(29.61, 39.09), array(29.3, 39.16), array(30.07, 40.3));
  $cut_o_m['24'] = array(array(25.17, 38.2), array(38.07, 46.4), array(35.16, 43.43), array(29.78, 39.59), array(31.54, 41.34));
  $cut_o_m['27'] = array(array(24.02, 37.22), array(28.01, 39.14), array(18.42, 31.08), array(27.62, 38.79), array(25.31, 36.1));
  $cut_o_m['30'] = array(array(33.3, 43.56), array(36.14, 44.84), array(19.25, 33.02), array(27.08, 38.63), array(32.01, 41.94));
  $cut_o_m['33'] = array(array(25.36, 37.37), array(34.8, 44.04), array(12.28, 27.9), array(26.92, 38.79), array(28.96, 39.85));
  $cut_o_m['36'] = array(array(30.99, 41.44), array(36.99, 45.84), array(18.07, 32.57), array(30.29, 41.13), array(35.33, 44.08));
  $cut_o_m['42'] = array(array(27.06, 38.54), array(36.27, 45.15), array(19.82, 33.68), array(28.11, 39.82), array(31.12, 41.26));
  $cut_o_m['48'] = array(array(30.72, 41.82), array(32.78, 42.74), array(15.81, 30.58), array(31.3, 42.04), array(26.6, 38.47));

// function get_child_info() {
//   global $current_child;
//   global $wpdb;
//   $info = $wpdb->get_results("select * from a365_children where id = $current_child")[0];                   
  
//   //print_r($info);
//   return $info;
// }

function get_month_test($month){
   switch ( true ) {
    case ( $month < 11  ):
      $month = 10;
      break;
    case ( $month < 13  ):
      $month = 12;
      break;
    case ( $month < 15  ):
      $month = 14;
      break;
    case ( $month < 17  ):
      $month = 16;
      break;
    case ( $month < 19  ):
      $month = 18;
      break;
    case ( $month < 21  ):
      $month = 20;
      break;
    case ( $month < 23  ):
      $month = 22;
      break;
    case ( $month <= 25.5  ):
      $month = 24;
      break;
    case ( $month <= 28.5  ):
      $month = 27;
      break;
    case ( $month <= 31.5  ):
      $month = 30;
      break;
    case ( $month <= 34.5  ):
      $month = 33;
      break;
    case ( $month < 39  ):
      $month = 36;
      break;
    case ( $month < 45  ):
      $month = 42;
      break;
    default:
      $month = 48;
      break;
  }
  return $month;
}

function asq_save_test() {
  //$cache_array;
  //parse_str($_POST["cache"], $cache_array);
  //print_r($searcharray); // Only for print array
  $cate_1_answers = implode("|", $_POST['giao_tiep']);
  $cate_2_answers = implode("|", $_POST['van_dong_tho']);
  $cate_3_answers = implode("|", $_POST['van_dong_tinh']);
  $cate_4_answers = implode("|", $_POST['giai_quyet']);
  $cate_5_answers = implode("|", $_POST['ca_nhan']);
  $cate_6_answers = array();
  //echo count($_POST['tong_ket']);
  for ($i = 0; $i < count($_POST['tong_ket']); $i++) {
    //echo $_POST['tong_ket'][$i+1].'<br>';
    //echo $_POST['tong_ket_text'][$i+1].'<br>';
    $cate_6_answers[$i] = $_POST['tong_ket'][$i+1].":".$_POST['tong_ket_text'][$i+1];
  }
  $cate_6_answers = implode("|", $cate_6_answers);

  global $wpdb;
  $wpdb->update("a365_asq_results", array(
          'cate_1_answers' => $cate_1_answers,
          'cate_2_answers' => $cate_2_answers,
          'cate_3_answers' => $cate_3_answers,
          'cate_4_answers' => $cate_4_answers,
          'cate_5_answers' => $cate_5_answers,
          'cate_6_answers' => $cate_6_answers,
    ), array( 'id' =>   $_SESSION['asq_result_id']));
  //echo "đã chạy hàm này";
}
add_action( 'wp_ajax_asq_save_and_exit', 'asq_save_test' );
add_action( 'wp_ajax_nopriv_asq_save_and_exit', 'asq_save_test' );

// new function
function a365_update_respondent_info() {
  global $wpdb;
  $relationship = $_POST['relationship'];
  if ($_POST['relationship'] == "other")
    $relationship = $_POST['other_relationship'];
  $wpdb->update("a365_asq_results", array(
          'who_did' => $relationship,
          'year' => $_POST['age'],
          'gender' => $_POST['gender'],
          'area' => $_POST['area'],
          'address' => $_POST['address'],
          'did_at' => $_POST['did_at'],
    ), array( 'id' =>   $_SESSION['asq_result_id']));
  //echo "đã chạy hàm này";
}
add_action( 'wp_ajax_update_respondent_info', 'a365_update_respondent_info' );
add_action( 'wp_ajax_nopriv_update_respondent_info', 'a365_update_respondent_info' );


function calculate_score() {
  //echo "chạy qua hàm calculate này rồi";

  global $wpdb;
  global $current_child;
  global $user_id;

  $scores_table = array();
  $point1;
  $point2;
  $point3;
  $point4;
  $point5;
  $point6;
  $point7;
  // if( isset( $_POST['asqketqua'] ) ) {
  //   //echo "cahy day roi";
  //   die("");
  //   if( $_POST['asqketqua'] != '' ) {
      $point1 = calculate_average($_POST['giao_tiep']);
      $point2 = calculate_average($_POST['van_dong_tho']);
      $point3 = calculate_average($_POST['van_dong_tinh']);
      $point4 = calculate_average($_POST['giai_quyet']);
      $point5 = calculate_average($_POST['ca_nhan']);
      $point6 = calculate_average($_POST['tong_ket']);
      array_push($scores_table, $point1);
      array_push($scores_table, $point2);
      array_push($scores_table, $point3);
      array_push($scores_table, $point4);
      array_push($scores_table, $point5);
      array_push($scores_table, $point6);
      $_SESSION['asq_scores_table'] = $scores_table;
      $cate_1_point = $point1;
      $cate_2_point = $point2;
      $cate_3_point = $point3;
      $cate_4_point = $point4;
      $cate_5_point = $point5;
      $cate_1_answers = implode(" ", $_POST['giao_tiep']);
      $cate_2_answers = implode(" ", $_POST['van_dong_tho']);
      $cate_3_answers = implode(" ", $_POST['van_dong_tinh']);
      $cate_4_answers = implode(" ", $_POST['giai_quyet']);
      $cate_5_answers = implode(" ", $_POST['ca_nhan']);
      //print_r($_POST['tong_ket_text']);
      //($_POST['tong_ket']);
      $cate_6_answers = array();
      //echo count($_POST['tong_ket']);
      for ($i = 0; $i < count($_POST['tong_ket']); $i++) {
        //echo $_POST['tong_ket'][$i+1].'<br>';
        //echo $_POST['tong_ket_text'][$i+1].'<br>';
        $cate_6_answers[$i] = $_POST['tong_ket'][$i+1].":".$_POST['tong_ket_text'][$i+1];
      }
      $_SESSION['tongket'] = $_POST['tong_ket'];
      $cate_6_answers = implode("|", $cate_6_answers);
      //print_r($cate_5_answers);
      //print_r($cate_7_answers);
      //echo $cate_1_answers;
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $wpdb->update("a365_asq_results", array(
              'end_at' => date('Y-m-d H:i:s'),
              'cate_1_point' => $cate_1_point,
              'cate_2_point' => $cate_2_point,
              'cate_3_point' => $cate_3_point,
              'cate_4_point' => $cate_4_point,
              'cate_5_point' => $cate_5_point,
              'cate_1_answers' => $cate_1_answers,
              'cate_2_answers' => $cate_2_answers,
              'cate_3_answers' => $cate_3_answers,
              'cate_4_answers' => $cate_4_answers,
              'cate_5_answers' => $cate_5_answers,
              'cate_6_answers' => $cate_6_answers,
        ), array( 'id' => $_SESSION['asq_result_id']));
      //print json_encode(['s' => "s"]);

      $page_template = 'page-templates/asq_result.php';
      $pages = get_pages(array(
                          'meta_key' => '_wp_page_template',
                          'meta_value' => $page_template
                      ));      
      // wp_redirect($pages[0]->guid, 301);
      // exit;
      echo json_encode(["page" => $pages[0]->guid]);
      wp_die();
  //   }
  // }

}

add_action( 'wp_ajax_calculate_score', 'calculate_score' );
add_action( 'wp_ajax_nopriv_calculate_score', 'calculate_score' );
//add_action( 'init', 'calculate_score');

function calculate_average($points_array) {
  $count = 0;
  $sum = 0;
  foreach ($points_array as $point) {
    if ($point != 99) {
      $count++;
      if ($count > 6) {
        $count = 6;
        break;
      }
      $sum += $point;
    }
  }
  return ($sum / $count * 6);
}

function generate_general_results( $month_test, $point_array ) {
  $results = array("", "", "");
  global $cut_o_m;
  global $wpdb;
  $com = $cut_o_m[''.$month_test.''];
  //print_r($com2);
  $skills = array("Giao tiếp", "Vận động thô", "Vận động tinh", "Giải quyết vấn đề", "Cá nhân xã hội");
  for ($i = 0; $i < 5; $i++){
    if ($point_array[$i] < $com[$i][0]){
      //echo $com2[$i][0];
      //echo $skills[$i].":".$point_array[0].",".$com[$i][0];
      $results[2] .= $skills[$i].", ";
      $wpdb->update("a365_asq_results", array(
            'cate_'.($i+1).'_conclusion' => 'Nguy cơ'
        ), array( 'id' =>   $_SESSION['asq_result_id']));
    }
    elseif ($point_array[$i] < $com[$i][1]) {
      $results[1] .= $skills[$i].", ";
       $wpdb->update("a365_asq_results", array(
            'cate_'.($i+1).'_conclusion' => 'Theo dõi'
        ), array( 'id' =>   $_SESSION['asq_result_id']));
      //echo $com2[$i][1];
       //echo $skills[$i];
    }
    else{
      $results[0] .= $skills[$i].", ";
       $wpdb->update("a365_asq_results", array(
            'cate_'.($i+1).'_conclusion' => 'Bình thường',
        ), array( 'id' =>   $_SESSION['asq_result_id']));
     // echo $com[$i][0];
      //echo $skills[$i];
    }

  }

  //calculate_score();
  $results[0] = substr( $results[0],  0, strlen($results[0])-2);
  $results[1] = substr( $results[1],  0, strlen($results[1])-2);
  $results[2] = substr( $results[2],  0, strlen($results[2])-2);
  if ( $results[0] != "") {
    echo "<p>&#8226; Có sự phát triển bình thường ở các lĩnh vực <em><b>".$results[0]."</b></em>. Điều này có nghĩa là trẻ phát triển tương đương với các trẻ cùng độ tuổi ở các lĩnh vực này.</p>";
  }
  if ( $results[1] != "") {
    echo "<p>&#8226; Các lĩnh vực như <em><b>".$results[1]."</b></em> có điểm nằm trong vùng xanh nhạt. Điều đó có nghĩa có một số kỹ năng trẻ chưa thực hiện được, hoặc đã thực hiện được nhưng chưa thường xuyên. </p>";
  }
    if ( $results[2] != "") {
    echo "<p>&#8226; Các lĩnh vực như <em><b>".$results[2]."</b></em> có điểm nằm trong vùng xanh đậm. Tức là trẻ phát triển chậm hơn so với các trẻ khác cùng tuổi ở các lĩnh vực này.";
  }

  //echo $results[0]."<br/>";
  //echo $results[1]."<br/>";
  //echo $results[2]."<br/>";
  return $results;

}

function generate_suggestion_1($month_test, $point_array) {

  global $cut_o_m;
  global $wpdb;
  $current_child_obj = $_SESSION['current_child'];
  $child_month_age = child_month_age($current_child_obj->week_of_birth);
  $com = $cut_o_m[''.$month_test.''];
  $fields = array("Giao tiếp", "Vận động thô", "Vận động tinh", "Giải quyết vấn đề", "Cá nhân xã hội");
  $bool = false;
  $field_color = array();

  for ($i = 0; $i < 5; $i ++) {
    if ($point_array[$i] > $com[$i][1]) {
      $field_color[$fields[$i]] = "Trắng";
    }
    elseif($point_array[$i] > $com[$i][0]) {
      $field_color[$fields[$i]] = "Xám";
    }
    else
      $field_color[$fields[$i]] = "Xanh";
  }
  $array = array_count_values ( $field_color );

  if ($field_color['Giao tiếp'] != "Xám")
    $bool = true;
  if ($field_color['Giải quyết vấn đề'] != "Xám")
    $bool = true;
  if ($field_color['Cá nhân xã hội'] != "Xám")
    $bool = true;

  //print_r($array);

  //print_r($field_color);
  $refer = false;
  $id_refer = array(
      '250'  => array('Có' => 'hành vi'),
      '253'  => array('Không' => 'khả năng ngôn ngữ'),
      '254'  => array('Không' => 'khả năng ngôn ngữ'),
      '256'  => array('Không' => 'khả năng ngôn ngữ')
  );

  $tongket_results;
  //print_r($id_array);
  if( isset( $_SESSION['tongket'] ) ) {
    if( $_SESSION['tongket'] != '' ) {
      //print_r($_POST['tong_ket']);
      $tongket_results = $_SESSION['tongket'];
    }
  }

  $tongket_objects = get_asq_questions($month_test)[5];
  $content_id = array();
  foreach ($tongket_objects as $object) {
    array_push($content_id, $object->q_content_id);
  }

  $ques_ans = array_combine($content_id,$tongket_results);
  //print_r($ques_ans);
  $ban_khoan_array = array();

  foreach ($ques_ans as $key => $val) {
    if ($key == '250' && $val == 'Có') {
      $refer = true;
      break;
    }
    if (( $key == '253' || $key == '254' || $key == '256') && $val == 'Không') {
      $refer = true;
      break;
    }
  }
  //echo $refer;
  foreach ($ques_ans as $key => $val) {
    if ($key == '250' && $val == 'Có') {
      array_push($ban_khoan_array, 'hành vi');
    }
    if (($key == '253' || $key == '254' || $key == '256') && $val == 'Không') {
      array_push($ban_khoan_array, 'khả năng ngôn ngữ');
    }
  }

  $ban_khoan_array = array_unique($ban_khoan_array);
  //print_r($ban_khoan_array);
  $ban_khoan_fields = "";
  if ( count($ban_khoan_array) == 1 ) {
    $ban_khoan_fields =  $ban_khoan_array[0];
  }
  else
    $ban_khoan_fields =  'cả hành vi và khả năng ngôn ngữ' ;

  if ($array["Trắng"] == 5 && $refer != true) {
    echo "&#8226; Gia đình không cần phải lo lắng gì cho trẻ ở thời điểm này. Gia đình tiếp tục chơi và xây dựng các kỹ năng cho trẻ để trẻ có sự phát triển tốt nhất. Gia đình nên quay lại làm câu hỏi đánh giá phát triển ASQ sau 4-6 tháng.<br>";
  }

  elseif ($array["Trắng"] == 5 && $refer == true) {
    echo "&#8226; Tính theo điểm của từng lĩnh vực gia đình không cần phải lo lắng gì cho trẻ ở thời điểm này. Gia đình tiếp tục chơi và xây dựng các kỹ năng cho trẻ để trẻ có sự phát triển tốt nhất. Gia đình nên quay lại làm câu hỏi đánh giá phát triển ASQ sau 4-6 tháng.<br>";

    if($child_month_age >= 16) {
      $wpdb->update("a365_asq_results", array(
              'send_to_expert' => "Có",
        ), array( 'id' => $_SESSION['asq_result_id']));
      echo "&#8226; Tuy nhiên, do gia đình vẫn còn lo lắng về ".$ban_khoan_fields." của con, gia đình nên làm thêm câu hỏi sàng lọc tự kỷ M-CHAT-R để đánh giá về nguy cơ tự kỷ của trẻ bằng cách ấn vào đây<a href = '../mchatr' style='color:#1478b9'><b>M-CHAT-R</b></a>. ";
    }
  }

  elseif( $array["Xám"] >=1 && $array["Xám"] <=3 && $bool == true && $array["Xanh"] == 0) {
    echo "&#8226; Gia đình không nên lo lắng nhiều về sự phát triển của trẻ. Gia đình nên tập cho bé các kĩ năng như: <br/> ";
    if ($field_color['Giao tiếp'] == "Xám")
      echo "&nbsp;- Phát âm, nghe, hiểu, thể hiện yêu cầu và nhờ giúp đỡ</br>";
    if ($field_color['Vận động thô'] == "Xám")
      echo "&nbsp;- Vận động tổng thể của cơ thể</br>";
    if ($field_color['Vận động tinh'] == "Xám" || $field_color['Giải quyết vấn đề'] == "Xám")
      echo "&nbsp;- Chơi với nhiều loại đồ chơi</br>";
    if ($field_color['Cá nhân xã hội'] == "Xám")
      echo "&nbsp;- chơi với những người xung quanh</br>";
    echo "trong một thời gian và theo dõi xem con có làm được không. Sau 1 tháng, gia đình nên làm lại bộ câu hỏi ASQ cho trẻ. <br/> ";

    if ($refer == true && $child_month_age >= 16) {
      $wpdb->update("a365_asq_results", array(
              'send_to_expert' => "Có",
        ), array( 'id' => $_SESSION['asq_result_id']));
      echo "&#8226; Tuy nhiên, do gia đình vẫn còn lo lắng về ".$ban_khoan_fields." của con, gia đình nên làm thêm câu hỏi sàng lọc tự kỷ M-CHAT-R để đánh giá về nguy cơ tự kỷ của trẻ bằng cách ấn vào đây<a href = '../mchatr' style='color:#1478b9'><b>M-CHAT-R</b></a>. ";
    }
  }
  else {
    if($child_month_age >= 16) {
      $wpdb->update("a365_asq_results", array(
              'send_to_expert' => "Có",
        ), array( 'id' => $_SESSION['asq_result_id']));
      echo "&#8226; Vì trẻ có sự phát triển chậm hơn các trẻ khác cùng độ tuổi, gia đình nên làm thêm câu hỏi sàng lọc tự kỷ M-CHAT-R theo đường link <a href = '../mchatr' style='color:#1478b9'><b>M-CHAT-R</b></a> để đánh giá về nguy cơ tự kỷ của trẻ.";
    }
    
    if($child_month_age <= 10 && $child_month_age >= 1)
    echo "&#8226; Trẻ có sự phát triển chậm hơn các trẻ khác cùng độ tuổi, gia đình cần đưa trẻ đi khám trong thời gian sớm nhất.";
  }
}

function generate_suggestion_2($month_test, $point_array) {
  $id_array = array(
      '241' => array('Có' => 'Kiểm tra về thính lực cho trẻ', 'Không' => ''),
      // '243' => array('Có' => 'Rối loạn điều chỉnh, Tự kỷ, Rối loạn tập trung, Rối loạn khả năng vâng lệnh, Rối loạn căng thẳng, lo sợ', 'Không' => ''),
      '244'  => array('Có' => 'Khám chuyên khoa để kiểm tra thêm', 'Không' => ''),
      '245'  => array('Có' => '', 'Không' => 'Kiểm tra vận động của trẻ'),
      '246'  => array('Có' => '', 'Không' => 'Kiểm tra vận động của trẻ'),
      '247'  => array('Có' => 'Kiểm tra về thính lực cho trẻ', 'Không' => ''),
      '248'  => array('Có' => 'Kiểm tra về thị lực cho trẻ', 'Không' => ''),
      '249'  => array('Có' => 'Khám chuyên khoa để kiểm tra thêm', 'Không' => ''),
      '251'  => array('Có' => '', 'Không' => 'Kiểm tra về thính lực cho trẻ'),
      '252'  => array('Có' => '', 'Không' => 'Kiểm tra về thính lực cho trẻ'),
      // '253'  => array('Có' => '', 'Không' => 'Chậm phát âm, rối loạn khả năng phát triển ngôn ngữ'),
      // '254'  => array('Có' => '', 'Không' => 'Chậm phát âm, rối loạn khả năng phát triển ngôn ngữ'),
      '255'  => array('Có' => '', 'Không' => 'Kiểm tra về vận động của trẻ'),
      // '256'  => array('Có' => '', 'Không' => 'Chậm phát âm, rối loạn khả năng phát triển ngôn ngữ')
    );

  $tongket_results;
  //print_r($id_array);
  if( isset( $_SESSION['tongket'] ) ) {
    if( $_SESSION['tongket'] != '' ) {
      //print_r($_POST['tong_ket']);
      $tongket_results = $_SESSION['tongket'];
    }
  }

  $tongket_objects = get_asq_questions($month_test)[5];
  $content_id = array();
  foreach ($tongket_objects as $object) {
    array_push($content_id, $object->q_content_id);
  }

  $ques_ans = array_combine($content_id,$tongket_results);
  //print_r($ques_ans);
  $suggest = array();
  foreach ($ques_ans as $ques => $val) {
    if ($id_array[''.$ques.''][''.$val.''] != '')
      array_push($suggest, $id_array[''.$ques.''][''.$val.'']);
  }
  // for ($i = 0; $i < count($tongket); $i++) {
  $suggest_final = array_unique($suggest);
  // }
  if (count($suggest_final) == 0) {
    echo "&#8226; Trong trường hợp gia đình vẫn còn băn khoăn, lo lắng, gia đình có thể đưa trẻ đến các cơ sở y tế để trao đổi thêm với cán bộ chuyên môn hoặc có đánh giá chuyên sâu hơn về sự phát triển của trẻ.<br/>";
  }
  else {
    echo '&#8226; Gia đình nên đưa trẻ đi đến cơ sở y tế để đánh giá thêm về sự phát triển của trẻ và:'.'<br/>';
    foreach ($suggest_final as $val) {
      echo '- '.$val.'</br>';
    }
  }

}

function generate_suggestion_3() {
  echo "&#8226; Gia đình có thể tham khảo một số trò chơi hữu ích cho sự phát triển của trẻ theo đường link sau:<a href='../giup-tre-phat-trien-ki-nang' style='color:#1478b9'><b>http://www.a365.vn/giup-tre-phat-trien-ky-nang</b></a>";
}

function get_asq_questions( $month_test ) {
  global $wpdb;
  $final_result = array();
  for($i = 1; $i <= 6; $i++) {
    $result = $wpdb->get_results( $wpdb->prepare(
                                "
                                  SELECT q_content_id, q_content, q_list, q_img
                                  FROM a365_asq_questions
                                  INNER JOIN a365_asq_questions_content
                                    ON a365_asq_questions.q_content_id = a365_asq_questions_content.id
                                  WHERE q_set = %s
                                  AND q_category = %d
                                  ORDER BY q_order ASC
                                ",
                                $month_test,
                                $i
                              ), OBJECT );
    array_push($final_result, $result);
  }
  return $final_result;
}

function first_create_asq_result_in_db() {
  global $wpdb;
  $creator_id = a365_get_current_user_id();
  if( isset($_SESSION['current_user_id']) ) {
    $creator_id = $_SESSION['current_user_id'];
  }
  $wpdb->insert("a365_asq_results", array(
            'child_id' => $_SESSION['current_child']->id,
            'creator_id' => $creator_id,
            'original_birth' => calculate_original_birth(),
            'adjusted_birth' => calculate_adjusted_birth($_SESSION['current_child']->week_of_birth),
            'begin_at' => date('Y-m-d H:i:s'),
            'asq_set' => $_SESSION['asq_set'],
      ));

  $newest_asq_id = $wpdb->insert_id;
  $_SESSION['asq_result_id'] = $newest_asq_id;
}

function create_nologin_asq() {
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  global $wpdb;
  //global $asq_set;
    $week_of_birth = $_POST['birthweek'];
    $area_code = $_POST['area'];
    $created_order = $wpdb->get_results($wpdb->prepare('
      SELECT  user_count
      FROM a365_areas
      WHERE area_code = %d
          ', $area_code))[0]->user_count + 1;
    $user_id = 'A' . str_pad($area_code, 2, '0', STR_PAD_LEFT) . str_pad($created_order, 7, '0', STR_PAD_LEFT);
    $wpdb->query( $wpdb->prepare("
                          INSERT INTO a365_users (id, area_code, area_order, created_at) VALUES (%s, %d, %d, %s)
                    ",
                    array(
                      $user_id,
                      $area_code,
                      $created_order,
                      date('Y-m-d H:i:s')
                      )
                    )
                  );
    /**
    * Save child to database
    **/
    $created_order = $wpdb->get_results($wpdb->prepare("
        SELECT number_of_children
        FROM a365_users
        WHERE id = %s
        ", $creator_id),OBJECT)[0]->number_of_children+1;

    $current_child = $user_id . str_pad($created_order, 4, '0', STR_PAD_LEFT);
    //echo 'birthday '.$_POST['birthday'];
    $birthday = DateTime::createFromFormat('d-m-Y',  $_POST['dd'].'-'.$_POST['mm'].'-'.$_POST['yyyy'])->format('Y-m-d');

    $wpdb->query( $wpdb->prepare("
                        INSERT INTO a365_children (id, creator_id, created_order, name, sex, date_of_birth, week_of_birth, created_at) VALUES (%s, %s, %d, %s, %s, %s, %d, %s)
                    ",
                    array(
                      $current_child,
                      $user_id,
                      $created_order,
                      $_POST['fullname'],
                      $_POST['child_gender'],
                      $birthday,
                      $week_of_birth,
                      date('Y-m-d H:i:s')
                      )
                    )
                  );
    $asq_set = get_month_test(child_month_age($week_of_birth));
    
     //echo "set: ".$asq_set;
    $_SESSION['asq_set'] = $asq_set;
    $_SESSION['current_user_id'] = $user_id;
    $_SESSION['current_child'] = $wpdb->get_results($wpdb->prepare("
    SELECT * FROM a365_children WHERE id = %s
    ", $current_child), OBJECT)[0];
    $_SESSION['child_month_age'] = child_month_age($week_of_birth);
    
    // // create asq result in db
    // $wpdb->insert("a365_asq_results", array(
    //         'child_id' => $current_child,
    //         'creator_id' => $user_id,
    //         'original_birth' => calculate_original_birth(),
    //         'adjusted_birth' => calculate_adjusted_birth($week_of_birth),
    //         'begin_at' => date('Y-m-d H:i:s'),
    //         'asq_set' => $asq_set,
    // ));

    // $newest_asq_id = $wpdb->insert_id;
    // $_SESSION['asq_result_id'] = $newest_asq_id;
    $pages = get_pages(array(
          'meta_key' => '_wp_page_template',
          'meta_value' => 'page-templates/asq.php'
    ));
    echo json_encode(["page" => $pages[0]->guid]);
    wp_die();

}
add_action( 'wp_ajax_create_nologin_asq', 'create_nologin_asq' );
add_action( 'wp_ajax_nopriv_create_nologin_asq', 'create_nologin_asq' );

function child_month_age($week_of_birth) {
  $birthday = $_SESSION['current_child']->date_of_birth;
  $now = date('d-m-Y');
  $time = strtotime(date('d-m-Y')) - strtotime($birthday);
  $time = $time / (3600*24);

  if( $time < 24*30  && $week_of_birth <= 37 ) {
    $time = $time - (40 - $week_of_birth)*7;
  }

  return $time / 30;
}

function calculate_original_birth() {
  $birthday = $_SESSION['current_child']->date_of_birth;
  $time = strtotime("now") - strtotime($birthday);
  $time = $time / (3600*24);
  return $time / 30;
}

function calculate_adjusted_birth($week_of_birth) {
  $birthday = $_SESSION['current_child']->date_of_birth;
  $time = strtotime('now') - strtotime($birthday);
  $time = $time / (3600*24);

  if( $time < 24*30 && $week_of_birth <= 37 ) {
    return ($time - (40 - $week_of_birth) * 7) / 30;
  } else {
    return $time / 30;
  }
}

function update_no_login_user_information() {
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  global $wpdb;
  $relationship = $_POST['relationship'];
  if ($_POST['relationship'] == "other")
    $relationship = $_POST['other_relationship'];
  $wpdb->update("a365_users", array(
          'child_relationship' => $relationship,
          'year_of_birth' => $_POST['age'],
          'address' => $_POST['address'],
          'sex' => $_POST['user_gender']      
    ), array( 'id' =>   $_SESSION['current_user_id']));

  $wpdb->update("a365_asq_results", array(
          'did_at' => $_POST['did_at'],
          'end_at' => date('Y-m-d H:i:s'),        
    ), array( 'id' =>   $_SESSION['asq_result_id']));
    echo json_encode(["value" => 'ok']);
    wp_die();
}
add_action( 'wp_ajax_update_no_login_user_info', 'update_no_login_user_information' );
add_action( 'wp_ajax_nopriv_update_no_login_user_info', 'update_no_login_user_information' );

// load data asq continue test
function load_data_for_asq_continue($id) {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_asq_results
      WHERE a365_asq_results.id = '%s' 
      "
  , $id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results[0];
}

function gen_checkbox($point_array, $number, $expect) {
  $new_point_array = explode("|", $point_array);
  if ($new_point_array[$number] == $expect) {
    return 'checked="checked"';
  }
  return '';
}

function gen_checkbox_tongket($point_array, $number, $expect) {
  $new_point_array = explode("|", $point_array);
  if (explode(":", $new_point_array[$number])[0] == $expect) {
    return 'checked="checked"';
  }
  return '';
}

function gen_text_for_tongket($point_array, $number) {
  $new_point_array = explode("|", $point_array);
  return explode(":", $new_point_array[$number])[1];

}