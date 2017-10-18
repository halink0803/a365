<?php
if ( ! defined( 'ABSPATH' ) ) exit;/**
 *
 * M-Chat R/F  functions
 *
 **/


/**
 * Get M-Chat R questions
 */
function mchatrf_get_questions() {
  global $wpdb;
  $questions = $wpdb->get_results("SELECT * FROM a365_mchatr_questions", OBJECT);

  $wpdb->insert("a365_mchatrf_results", array(
        'child_id' => $current_child,
        'creator_id' => $user_id,
        'original_birth' => calculate_original_birth(),
        'adjusted_birth' => calculate_adjusted_birth($week_of_birth),
  ));

  $_SESSION['mchatrf_result_id'] = $wpdb->insert_id;
  return $questions;
}

// /**
//  * Save result
//  **/
// function mchatrf_save_result() {
//   // die("da chay mchatr_save_result");
//   $point = 0;
//   $child_id = a365_get_current_child();
//   $creator_id = a365_get_current_user();
//   global $wpdb;
//   if( isset( $_POST['mchatrf_result'] ) ) {
//     if( $_POST['mchatrf_result'] != '' ) {
//       $answer = array();
//       for($i = 1; $i<21; $i++) {
//         $answer[$i] = $_POST['question-' . strval($i) ];
//         //calculate point
//         if( ($i != 2) && ($i != 5)  && ($i != 12) && ($answer[$i] == 0) ) {
//           $point += 1;
//         };
//         if( ($i == 2) || ($i == 5)  || ($i == 12) && ($answer[$i] == 1) ) {
//           $point += 1;
//         };
//       }

//       /**
//        * Conclusion
//        **/
//       $conclusion = '';
//       switch (true) {
//         case $point < 3:
//           $conclusion = 'Nguy cơ thấp.';
//           break;
//         case $point < 8:
//           $conclusion = 'Nguy cơ trung bình.';
//           break;
//         default:
//           $conclusion = "Nguy cơ cao.";
//           break;
//       }

//       /**
//        * Save to database
//        **/
//       $wpdb->update("a365_mchatrf_results", array(
//           'end_at' => date('Y-m-d H:i:s'),
//           'point' => $point,
//           'conclusion' => $conclusion,
//           'answer_1' => $answer[1],
//           'answer_2' => 1 - $answer[2],
//           'answer_3' => $answer[3],
//           'answer_4' => $answer[4],
//           'answer_5' => 1- $answer[5],
//           'answer_6' => $answer[6],
//           'answer_7' => $answer[7],
//           'answer_8' => $answer[8],
//           'answer_9' => $answer[9],
//           'answer_10' => $answer[10],
//           'answer_11' => $answer[11],
//           'answer_12' => 1 - $answer[12],
//           'answer_13' => $answer[13],
//           'answer_14' => $answer[14],
//           'answer_15' => $answer[15],
//           'answer_16' => $answer[16],
//           'answer_17' => $answer[17],
//           'answer_18' => $answer[18],
//           'answer_19' => $answer[19],
//           'answer_20' => $answer[20],
//     ), array( 'id' =>   $_SESSION['mchatrf_result_id']));
//     };

//     // fix to come to follow
//     $point = 6;

//     if( $point > 2 && $point < 8 ) {
//       $pages = get_pages(array(
//           'meta_key' => '_wp_page_template',
//           'meta_value' => 'page-templates/m-chat-rf-follow.php'
//       ));
//     } else {
//       $pages = get_pages(array(
//           'meta_key' => '_wp_page_template',
//           'meta_value' => 'page-templates/m-chat-rf-result.php'
//       ));
//     }
//     wp_redirect( $pages[0]->guid );
//     exit();
//   }  
// }
// add_action( 'wp_ajax_mchatrf_save_result', 'mchatrf_save_result' );
// add_action( 'wp_ajax_nopriv_mchatrf_save_result', 'mchatrf_save_result' );
// add_action( 'init', 'mchatrf_save_result');


/**
 * Get result
 **/
function a365_mchatrf_get_result() {
  global $wpdb;

  $result = $wpdb->get_results($wpdb->prepare('
    SELECT *
    FROM a365_mchatrf_results
    WHERE id = %d
    ',
    array(
      $_SESSION['mchatrf_result_id']
      ))
  );
  return $result;
}

/**
 * Update result after follow up
 * @return  result
 */
function a365_update_mchatrf_result() {
  global $wpdb;
  $result = $wpdb->get_results($wpdb->prepare('
    SELECT *
    FROM a365_mchatrf_results
    WHERE id = %d
    ',
    array(
      $_SESSION['mchatrf_result_id']
      ))
  );

  // print_r($result);
  /**
   * Conclusion
   **/
  $conclusion = '';
  switch (true) {
    case $result[0]->point < 2:
      $conclusion = 'Nguy cơ thấp.';
      break;
    default:
      $conclusion = "Nguy cơ cao.";
      break;
  }

  $wpdb->update("a365_mchatrf_results", array(
          'begin' => date('Y-m-d H:i:s'),
          'conclusion' => $conclusion,
    ), array( 'id' =>   $_SESSION['mchatrf_result_id']));
  echo json_encode(['success' => $point]);
  wp_die();
}
add_action( 'wp_ajax_a365_update_mchatrf_result', 'a365_update_mchatrf_result' );
add_action( 'wp_ajax_nopriv_a365_update_mchatrf_result', 'a365_update_mchatrf_result' );

/**
 * Save follow up
 */
function save_follow_up( $question_number, $follow_question, $answer, $point ) {
  global $wpdb;
  /**
   * Save to database
   **/
  $follow_question_id = 'follow_' . $question_number . '_' . $follow_question;
  $result = 'answer_' . $question_number;
  $answer = implode("|", $answer);
  $wpdb->query($wpdb->prepare("UPDATE a365_mchatrf_results SET point = point + %d, $follow_question_id = %s WHERE id = %s", array($point, $answer, $_SESSION['mchatrf_result_id'] ))); 
  if( $point == -1 ) {
    $wpdb->query($wpdb->prepare("UPDATE a365_mchatrf_results SET $result = 1 - $result WHERE id = %s", array($_SESSION['mchatrf_result_id'] )));
  }
}
add_action( 'wp_ajax_load_follow_up_question', 'load_follow_up_question' );
add_action( 'wp_ajax_nopriv_load_follow_up_question', 'load_follow_up_question' );


function a365_update_mchatrf_respondent_info() {
  global $wpdb;
  $relationship = $_POST['relationship'];
  if ($_POST['relationship'] == "other")
    $relationship = $_POST['other_relationship'];
  $wpdb->update("a365_mchatrf_results", array(
          'who_did' => $relationship,
          'year' => $_POST['age'],
          'gender' => $_POST['gender'],
          'area' => $_POST['area'],
          'address' => $_POST['address'],
          'did_at' => $_POST['did_at'],
    ), array( 'id' =>   $_SESSION['mchatrf_result_id']));
  //echo "đã chạy hàm này";
}
add_action( 'wp_ajax_update_mchatrf_respondent_info', 'a365_update_mchatrf_respondent_info' );
add_action( 'wp_ajax_nopriv_update_mchatrf_respondent_info', 'a365_update_mchatrf_respondent_info' );

/**
 * Load ajax question content
 * @return [type] [description]
 */
function load_follow_up_question() {  
  if( isset($_POST['question_number']) ) {
    if( $_POST['question_number'] != '' ) {
      $question_number = $_POST['question_number'];
    }
  } else {
    $question_number = 1;
  }
  /**
   * The number of follow question
   */
  $follow_question = 0;
  $answer = [];
  if( isset( $_POST['follow_question'] ) && $_POST['follow_question'] != '' ) {
    $follow_question = $_POST['follow_question'];
    if(isset($_POST['option-0'])) { array_push($answer, $_POST['option-0']); }
    if(isset($_POST['option-1'])) { array_push($answer, $_POST['option-1']); }
    if(isset($_POST['option-2'])) { array_push($answer, $_POST['option-2']); }
    if(isset($_POST['option-3'])) { array_push($answer, $_POST['option-3']); }
    if(isset($_POST['option-4'])) { array_push($answer, $_POST['option-4']); }
    if(isset($_POST['option-5'])) { array_push($answer, $_POST['option-5']); }
    if(isset($_POST['option-6'])) { array_push($answer, $_POST['option-6']); }
    if(isset($_POST['option-7'])) { array_push($answer, $_POST['option-7']); }
    if(isset($_POST['option-8'])) { array_push($answer, $_POST['option-8']); }
    if(isset($_POST['option-9'])) { array_push($answer, $_POST['option-9']); }
    if(isset($_POST['option-10'])) { array_push($answer, $_POST['option-10']); }
  }
  $results = a365_mchatrf_get_result();
  $previous_question = mchatr_get_questions();

  /**
   * content that return for ajax       
   */      
  $question = [];  
  $question['content'] = '';
  $question['options'] = array();  
  $question['pre_question'] = '';
  $question['pre_answer'] = '';

  /**
   * Check each question
   */
  while( $question_number < 21 && $question['content'] == '' ) {
    switch ($question_number) {
      case 1:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_1 == 0 ) {
            $question['content'] = 'Nếu bạn chỉ vào một cái gì đó, trẻ thường làm gì?';
            $question['options'] = [];
            array_push($question['options'], 'Nhìn vào đồ vật');
            array_push($question['options'], 'Chỉ vào đồ vật');
            array_push($question['options'], 'Nhìn và nhận xét về đồ vật');
            array_push($question['options'], 'Nhìn nếu cha/ mẹ chỉ và nói “nhìn kìa!”');
            array_push($question['options'], 'Không phản ứng gì/ lờ cha/ mẹ đi');
            array_push($question['options'], 'Nhìn xung quanh phòng một cách ngẫu nhiên');
            array_push($question['options'], 'Nhìn vào ngón tay của cha/ mẹ');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            break;
          } else if( array_sum($answer) - ($answer[0] + $answer[1] + $answer[2] + $answer[3]) == 0) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
            break;
          } else if( array_sum($answer) - ($answer[4] + $answer[5] + $answer[6]) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else if( $answer[0] + $answer[1] + $answer[2] + $answer[3] > 0 ) {
            $question['content'] = 'Hành động nào trẻ thực hiện thường xuyên hơn ?';
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $option = '';
            if( $answer[0] == 1 ) {
              $option .= 'Nhìn vào đồ vật?' . '</br>';
            }
            if( $answer[1] == 1 ) {
              $option .= 'Chỉ vào đồ vật?' . '</br>';
            }
            if( $answer[2] == 1 ) {
              $option .= 'Nhìn và nhận xét về đồ vật?' . '</br>';
            }
            if( $answer[3] == 1 ) {
              $option = $option . 'Nhìn nếu cha/ mẹ chỉ và nói “nhìn kìa!”?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
            if( $answer[4] == 1 ) {
              $option = $option . 'Không phản ứng gì/ lờ cha/ mẹ đi?' . '</br>';
            }
            if( $answer[5] == 1 ) {
              $option = $option . 'Nhìn xung quanh phòng một cách ngẫu nhiên?' . '</br>';
            }
            if( $answer[6] == 1 ) {
              $option = $option . 'Nhìn vào ngón tay của cha/ mẹ?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
            break;
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 2:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_2 == 1 ) {
            $question['content'] = 'Trẻ có ...';
            array_push($question['options'], 'Lờ âm thanh không');
            array_push($question['options'], 'Có lờ người khác đi không');
          }
        } else if( $follow_question == 1 ) {          
          $question['content'] = 'Trẻ đã bao giờ kiểm tra khả năng nghe chưa ?';
          if(array_sum($answer) > 0) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          }
        } else if( $follow_question == 2 ) {
          save_follow_up($question_number, $follow_question - 1, $answer, 0);
          if( $answer[0] == 1 ) {
            $question['content'] = 'Kết quả khả năng nghe của trẻ thế nào ?';
            array_push($question['options'], 'Khả năng nghe bình thường');
            array_push($question['options'], 'Khả năng nghe dưới mức bình thường');
            array_push($question['options'], 'Không cho kết quả rõ ràng');
          }
        } else if( $follow_question == 3 ) {
          save_follow_up($question_number, $follow_question - 1, $answer, 0);
        }
        break;
      case 3:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_3 == 0 ) {
            $question['content'] = 'Trẻ đã từng...';
            array_push($question['options'], 'Giả vờ uống nước từ 1 cái cốc đồ chơi chưa?');
            array_push($question['options'], 'Giả vờ ăn từ 1 cái thìa hoặc dĩa đồ chơi chưa?');
            array_push($question['options'], 'Giả vờ nói chuyện điện thoại chưa?');
            array_push($question['options'], 'Giả vờ cho búp bê hoặc thú nhồi bông ăn thức ăn thật hoặc tưởng tượng chưa?');
            array_push($question['options'], 'Đẩy 1 cái xe như thể nó đang đi trên 1 con đường giả vờ chưa?');
            array_push($question['options'], 'Giả vờ là một robot, một máy bay, một nữ diễn viên ballet, hoặc bất kỳ nhân vật yêu thích khác chưa?');
            array_push($question['options'], 'Đặt một nồi đồ chơi trên một bếp giả vờ chưa?');
            array_push($question['options'], 'Giả vờ khuấy thức ăn chưa?');
            array_push($question['options'], 'Đặt một vật hoặc một con búp bê vào một chiếc xe hơi hoặc xe tải như thể nó là người lái xe hoặc hành khách chưa?');
            array_push($question['options'], 'Giả vờ hút bụi thảm, quét nhà hoặc cắt cỏ chưa?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 4:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_4 == 0 ) {
            $question['content'] = 'Trẻ có thích trèo lên ...';
            array_push($question['options'], 'Cầu thang không?');
            array_push($question['options'], 'Ghế không?');
            array_push($question['options'], 'Đồ đạc trong nhà không?');
            array_push($question['options'], 'Thiết bị sân chơi ngoài trời không?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 5:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_5 == 1 ) {
            $question['content'] = 'Hãy mô tả những chuyển động ngón tay của trẻ, trẻ có từng…';
            array_push($question['options'], 'Nhìn vào bàn tay chưa?');
            array_push($question['options'], 'Chuyển động ngón tay khi chơi trò ú tìm chưa?');
            array_push($question['options'], 'Ngọ nguậy ngón tay gần mắt của trẻ chưa?');
            array_push($question['options'], 'Giữ tay của mình ở phía bên của mắt?');
            array_push($question['options'], 'Vỗ tay ở gần mặt của trẻ chưa?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else if( array_sum($answer) - $answer[0] - $answer[1] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
            break;
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content']  = 'Trẻ có ...';
            if($answer[2] == 1) {
              array_push($question['options'], 'Ngọ nguậy ngón tay gần mắt của trẻ hơn 2 lần 1 tuần không?');
            }
            if($answer[3] == 1) {
              array_push($question['options'], 'Giữ tay của mình ở phía bên của mắt hơn 2 lần 1 tuần không?');
            }
            if($answer[4] == 1) {
              array_push($question['options'], 'Vỗ tay ở gần mặt của trẻ hơn 2 lần 1 tuần không?');
            }
          }
        } else if( $follow_question == 2 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 6:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_6 == 0 ) {
            $question['content'] = 'Nếu có thứ gì trẻ muốn nhưng ngoài tầm với, ví dụ như bim bim, đồ chơi ngoài tầm với, làm thế nào để trẻ lấy được chúng? trẻ có…';
            array_push($question['options'], 'Với đồ vật đó bằng cả tay không?');
            array_push($question['options'], 'Dẫn bạn đến đồ vật đó không?');
            array_push($question['options'], 'Cố gắng tự lấy đồ vật đó không?');
            array_push($question['options'], 'Yêu cầu lấy đồ vật bằng từ ngữ hoặc tạo ra âm thanh không?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content']  = 'Nếu bạn nói “Chỉ cho cha/ mẹ xem nào”, trẻ có chỉ vào thứ đó?';
          } else {
            save_follow_up($question_number, $follow_question - 1 , $answer, 0);
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          }
        }
        break;
      case 7:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_7 == 0 ) {
            $question['content'] = 'Có bao giờ trẻ muốn bạn nhìn thấy những thứ thú vị như…';
            array_push($question['options'], 'Một cái máy bay trên trời?');
            array_push($question['options'], 'Một chiếc xe tải trên đường?');
            array_push($question['options'], 'Một con bọ trên mặt đất?');
            array_push($question['options'], 'Một con vật trong sân?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up( $question_number, $follow_question  - 1, $answer, 0 );
            $question['content'] = 'Làm thế nào để trẻ thu hút sự chú ý của bạn đến thứ đó?';
            array_push($question['options'], 'Trẻ có dùng 1 ngón tay để chỉ');
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Trẻ làm vậy để thể hiện sự thích thú, chứ không phải để được giúp đỡ phải không?';
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        } else if( $follow_question == 3 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 8:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_8 == 0 ) {
            $question['content'] = 'Khi bạn và trẻ ở sân chơi hoặc siêu thị, trẻ có ...';
            array_push($question['options'], 'Chơi với 1 trẻ khác không?');
            array_push($question['options'], 'Nói chuyện với 1 trẻ khác không?');
            array_push($question['options'], 'Bập bẹ hoặc phát ra các âm thanh không?');
            array_push($question['options'], 'Quan sát hoặc nhìn trẻ khác');
            array_push($question['options'], 'Cười với trẻ khác không?');
            array_push($question['options'], 'Ban đầu ngại ngùng, nhưng sau đó cười?');
            array_push($question['options'], 'Hào hứng với 1 trẻ khác không?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Trẻ của bạn có phản ứng với những trẻ em khác hơn một nửa thời gian chúng chơi với nhau không?';
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0]  == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 9:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_9 == 0 ) {
            $question['content'] = 'Trẻ có thỉnh thoảng mang tới cho bạn...';
            array_push($question['options'], '1 bức tranh/ảnh hoặc đồ chơi để khoe không?');
            array_push($question['options'], '1 bức tranh mà bé mới vẽ xong không?');
            array_push($question['options'], '1 bông hoa bé mới hái không?');
            array_push($question['options'], '1 con bọ bé tìm thấy trong bãi cỏ không?');
            array_push($question['options'], '1 vài khối hình mà bé mới xếp không?');
          }
        } else if ( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Có phải thỉnh thoảng những hành động đó chỉ để khoe bạn, chứ không phải để được bạn giúp đỡ phải không?';
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        } else if( $follow_question == 2 ) {
          if($answer[0] == 1) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 10:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_10 == 0 ) {
            $question['content'] = 'Khi trẻ đang không tập trung vào một việc gì vui hoặc thú vị, trẻ làm gì khi bạn gọi tên trẻ?';
            array_push($question['options'], 'Tìm kiếm người gọi?');
            array_push($question['options'], 'Nói bập bẹ?');
            array_push($question['options'], 'Ngừng những việc đang làm lại?');            
            array_push($question['options'], 'Không trả lời/ phản ứng?');
            array_push($question['options'], 'Có vẻ nghe nhưng phớt lờ?');
            array_push($question['options'], 'Trả lời/ phản ứng chỉ khi bố mẹ đứng trước mặt?');
            array_push($question['options'], 'Trả lời/ phản ứng chỉ khi có người chạm vào?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else if( array_sum($answer) - $answer[0] - $answer[1] - $answer[2] == 0  ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else if( array_sum($answer) - $answer[3] - $answer[4] - $answer[5] - $answer[6] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content']  = 'Những phản ứng nào trẻ thể hiện nhiều hơn?';
            $option = '';
            if( $answer[0] == 1 ) {
              $option .= 'Tìm kiếm người gọi?' . '</br>';
            }
            if( $answer[1] == 1 ) {
              $option .= 'Nói bập bẹ?' . '</br>';
            }
            if( $answer[2] == 1 ) {
              $option .= 'Ngừng những việc đang làm lại?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
            if( $answer[3] == 1 ) {
              $option = $option . 'Không trả lời/ phản ứng?' . '</br>';
            }
            if( $answer[4] == 1 ) {
              $option = $option . 'Có vẻ nghe nhưng phớt lờ?' . '</br>';
            }
            if( $answer[5] == 1 ) {
              $option = $option . 'Trả lời/ phản ứng chỉ khi bố mẹ đứng trước mặt?' . '</br>';
            }
            if( $answer[6] == 1 ) {
              $option = $option . 'Trả lời/ phản ứng chỉ khi có người chạm vào?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 11:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_11 == 0 ) {
            $question['content'] = 'Điều gì khiến trẻ cười? Trẻ có ...';
            array_push($question['options'], 'Cười khi bạn cười không?');
            array_push($question['options'], 'Cười khi bạn vào phòng không?');
            array_push($question['options'], 'Cười khi bạn đi xa về không?');
            array_push($question['options'], 'Thường xuyên mỉm cười không?');
            array_push($question['options'], 'Cười với đồ chơi hoặc hoạt động trẻ yêu thích không?');
            array_push($question['options'], 'Cười vu vơ hoặc cười với một thứ không cụ thể?');            
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else if( array_sum($answer) - $answer[0] - $answer[1] - $answer[2] == 0  ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else if( array_sum($answer) - $answer[3] - $answer[4] - $answer[5] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content']  = 'Trẻ thường xuyên làm giống nhóm ví dụ nào?';
            $option = '';
            if( $answer[0] == 1 ) {
              $option .= 'Cười khi bạn cười?' . '</br>';
            }
            if( $answer[1] == 1 ) {
              $option .= 'Cười khi bạn vào phòng?' . '</br>';
            }
            if( $answer[2] == 1 ) {
              $option .= 'Cười khi bạn đi xa về?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
            if( $answer[3] == 1 ) {
              $option = $option . 'Thường xuyên mỉm cười?' . '</br>';
            }
            if( $answer[4] == 1 ) {
              $option = $option . 'Có vẻ nghe nhưng phớt lờ?' . '</br>';
            }
            if( $answer[5] == 1 ) {
              $option = $option . 'Cười với đồ chơi hoặc hoạt động trẻ yêu thích?' . '</br>';
            }
            if( $answer[6] == 1 ) {
              $option = $option . 'Cười vu vơ hoặc cười với một thứ không cụ thể?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 12:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_12 == 1 ) {
            $question['content'] = 'Trẻ có phản ứng tiêu cực với ...';
            array_push($question['options'], 'Máy giặt không?');
            array_push($question['options'], 'Trẻ em đang khóc không?');
            array_push($question['options'], 'Máy sấy tóc không?');
            array_push($question['options'], 'Xe cộ không?');
            array_push($question['options'], 'Trẻ em hò hét và gào thét?');
            array_push($question['options'], 'Nhạc to không?');
            array_push($question['options'], 'Điện thoại/chuông cửa reo?');
            array_push($question['options'], 'Khu vực ồn ã như là siêu thị hoặc nhà hàng không?');
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Trẻ phản ứng với các âm thanh như thế nào?';
            array_push($question['options'], 'Bình tĩnh che tai của mình không?');
            array_push($question['options'], 'Nói với bạn là trẻ không thích tiếng ồn đó không?');
            array_push($question['options'], 'La hét không?');
            array_push($question['options'], 'Khóc không');
            array_push($question['options'], 'Che tai lại trong khi khó chịu?');
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          }
        } else if( $follow_question == 2 ) {
          if( array_sum($answer) - $answer[0] - $answer[1] == 0  ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else if( array_sum($answer) - $answer[2] - $answer[3] - $answer[4] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content']  = 'Trẻ thường xuyên làm giống nhóm ví dụ nào?';
            $option = '';
            if( $answer[0] == 1 ) {
              $option .= 'Bình tĩnh che tai của mình?' . '</br>';
            }
            if( $answer[1] == 1 ) {
              $option .= 'Nói với bạn là trẻ không thích tiếng ồn đó?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
            if( $answer[2] == 1 ) {
              $option = $option . 'La hét?' . '</br>';
            }
            if( $answer[3] == 1 ) {
              $option = $option . 'Khóc?' . '</br>';
            }
            if( $answer[4] == 1 ) {
              $option = $option . 'Che tai lại trong khi khó chịu?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
          }
        } else if( $follow_question == 3 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 13:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_13 == 0 ) {
            $question['content'] = 'Trẻ có đi bộ mà không cần nắm/giữ thứ gì không?';
          }
        } else if( $follow_question == 1 ) {
          if($answer[0] == 1) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }        
        break;
      case 14:
        if( $follow_question == 0) {
          if( $results[0]->answer_14 == 0 ) {
            $question['content'] = 'Trẻ có nhìn vào mắt bạn ...';
            array_push($question['options'], 'Khi trẻ cần gì đó không?');
            array_push($question['options'], 'Khi bạn đang chơi với trẻ không?');
            array_push($question['options'], 'Khi bạn cho trẻ ăn không?');
            array_push($question['options'], 'Khi bạn thay tã cho trẻ không?');
            array_push($question['options'], 'Khi bạn đọc truyện cho trẻ nghe?');
            array_push($question['options'], 'Khi bạn nói chuyện với trẻ không?');
            array_push($question['options'], 'Hằng ngày, trẻ nhìn vào mắt bạn không?');
          }
        } else if( $follow_question == 1 ) {
            if(array_sum($answer) > 1) {
              save_follow_up($question_number, $follow_question - 1, $answer, -1);
            } else if(array_sum($answer) == 0){
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
            } else {
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
              $question['content'] = 'Hàng ngày, trẻ có nhìn vào mắt bạn không?';
            }
        } else if( $follow_question == 2 ) {
            if($answer[0] == 1) {
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
              $question['content']  = 'Khi bạn và trẻ ở cùng nhau cả ngày, trẻ có nhìn vào mắt bạn ít nhất 5 lần không?';
            } else {
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
            }
        } else if( $follow_question == 3 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 15:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_15 == 0 ) {
            $question['content'] = 'Trẻ có cố gắng bắt chước bạn nếu bạn ...';
            array_push($question['options'], 'Lè lưỡi của bạn?');
            array_push($question['options'], 'Tạo ra tiếng động vui tai?');
            array_push($question['options'], 'Vẫy chào tạm biệt?');
            array_push($question['options'], 'Vỗ tay?');
            array_push($question['options'], 'Đặt ngón tay lên môi để ra ký hiệu "suỵt"?');
            array_push($question['options'], 'Hôn gió?');
          }
        } else if( $follow_question == 1 ) {
          if(array_sum($answer) > 1) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 16:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_16 == 0 ) {
            $question['content'] = 'Trẻ làm gì khi bạn quay đầu nhìn thứ gì đó? Trẻ có...';
            array_push($question['options'], 'Nhìn theo hướng mà bạn đang nhìn không?');
            array_push($question['options'], 'Chỉ vào vật mà bạn đang nhìn không?');
            array_push($question['options'], 'Nhìn xung quanh xem bạn đang nhìn cái gì không?');
            array_push($question['options'], 'Lờ bạn đi không?');
            array_push($question['options'], 'Nhìn vào mặt bạn không?');            
          }
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else if( array_sum($answer) - $answer[0] - $answer[1] - $answer[2] == 0  ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else if( array_sum($answer) - $answer[3] - $answer[4] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content']  = 'Hành động nào trẻ thực hiện thường xuyên hơn?';
            $option = '';
            if( $answer[0] == 1 ) {
              $option .= 'Nhìn theo hướng mà bạn đang nhìn?' . '</br>';
            }
            if( $answer[1] == 1 ) {
              $option .= 'Chỉ vào vật mà bạn đang nhìn?' . '</br>';
            }
            if( $answer[2] == 1 ) {
              $option .= 'Nhìn xung quanh xem bạn đang nhìn cái gì?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
            if( $answer[3] == 1 ) {
              $option = $option . 'Lờ bạn đi?' . '</br>';
            }
            if( $answer[4] == 1 ) {
              $option = $option . 'Có vẻ nghe nhưng phớt lờ?' . '</br>';
            }
            if( $answer[5] == 1 ) {
              $option = $option . 'Nhìn vào mặt bạn?' . '</br>';
            }
            array_push($question['options'], $option);
            $option = '';
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 17:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_17 == 0 ) {
            $question['content'] = 'Để cố gắng gây chú ý để bạn nhìn vào bé, trẻ có...';
            array_push($question['options'], 'Nói "Mẹ, nhìn này!" hoặc "Nhìn con này!" không?');
            array_push($question['options'], 'Nói bập bẹ hoặc gây tiếng động để kéo sự chú ý của bạn vào trẻ không?');
            array_push($question['options'], 'Nhìn bạn để được bạn khen hoặc nhận xét không?');
            array_push($question['options'], 'Cứ nhìn bạn để xem bạn có đang nhìn trẻ không?');
          }
        } else if( $follow_question == 1 ) {
          if(array_sum($answer) > 0) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 18:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_18 == 0 ) {
            $question['content'] = 'Khi có gợi ý cho trẻ, trẻ có làm theo yêu cầu không? Ví dụ như khi bạn mặc quần áo để đi chơi, bạn bảo trẻ hãy đi lấy giầy của mình, trẻ có hiểu không?';
          }
        } else if( $follow_question == 1 ) {
          if( $answer[0] == 1 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Khi không có gợi ý, trẻ của bạn có làm theo được yêu cầu không?';
            array_push($question['options'], 'Khi bạn nói, "Cho mẹ xem giầy của con" mà không chỉ vào giầy, không có điệu bộ hoặc đưa ra gợi ý, trẻ có chỉ vào giầy của bé không?');
            array_push($question['options'], 'Nếu bạn nói, "Lấy cho mẹ cái chăn" hoặc nhờ lấy vài đồ khác mà không chỉ, không có điệu bộ hoặc không đưa ra gợi ý, trẻ có lấy cho bạn không?');
            array_push($question['options'], 'Nếu bạn nói, "Để quyển sách lên ghế" mà không chỉ, không tỏ điệu bộ, hoặc không đưa gợi ý, trẻ có để quyển sách lên ghế không?');
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Nếu đến bữa cơm tối và thức ăn đã dọn lên bàn, và bạn bảo trẻ ngồi xuống, trẻ có ngồi xuống bàn ăn không?';
          }
        } else if( $follow_question == 2 ) {
          if( sizeof($answer)  == 1 ) {
            if(array_sum($answer) == 0) {
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
            } else {
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
              $question['content'] = 'Khi không có gợi ý, trẻ của bạn có làm theo được yêu cầu không?';
              array_push($question['options'], 'Khi bạn nói, "Cho mẹ xem giầy của trẻ" mà không chỉ vào giầy, không có điệu bộ hoặc đưa ra gợi ý, trẻ có chỉ vào giầy của bé không?');
              array_push($question['options'], 'Nếu bạn nói, "Lấy cho mẹ cái chăn" hoặc nhờ lấy vài đồ khác mà không chỉ, không có điệu bộ hoặc không đưa ra gợi ý, trẻ có lấy cho bạn không?');
              array_push($question['options'], 'Nếu bạn nói, "Để quyển sách lên ghế" mà không chỉ, không tỏ điệu bộ, hoặc không đưa gợi ý, trẻ có để quyển sách lên ghế không?');
            }
          } else {
            if(array_sum($answer) == 0) {
              save_follow_up($question_number, $follow_question - 1, $answer, 0);
            } else {
              save_follow_up($question_number, $follow_question - 1, $answer, -1);
            }
          }
        } else if( $follow_question == 3 ) {
          if( array_sum($answer) == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          }
        }
        break;
      case 19:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_19 == 0 ) {
            $question['content'] = 'Nếu trẻ nghe thấy 1 tiếng động lạ hoặc tiếng động ghê sợ, trẻ có nhìn mặt bạn trước khi có phản ứng không?';
          }
        } else if( $follow_question == 1 ) {
          if( $answer[0] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Trẻ có nhìn bạn khi gặp một người mới gặp/mới quen không?';
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          }
        } else if( $follow_question == 2 ) {
          if( $answer[0] == 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
            $question['content'] = 'Trẻ có nhìn bạn khi trẻ tiếp xúc với một cái gì đó xa lạ hay đáng sợ một chút không?';
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          }
        } else if( $follow_question == 3 ) {
          if($answer[0] == 1) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
      case 20:
        if( $follow_question == 0 ) {
          if( $results[0]->answer_20 == 0 ) {
            $question['content'] = 'Khi bạn đung đưa hoặc tung trẻ lên, trẻ của bạn có phản ứng như thế nào?';
            array_push($question['options'], 'Cười hoặc mỉm cười không?');
            array_push($question['options'], 'Nói chuyện hoặc nói bập bẹ được không?');
            array_push($question['options'], 'Đòi chơi thêm bằng cách đưa tay ra không?');
          }          
        } else if( $follow_question == 1 ) {
          if( array_sum($answer) > 0 ) {
            save_follow_up($question_number, $follow_question - 1, $answer, -1);
          } else {
            save_follow_up($question_number, $follow_question - 1, $answer, 0);
          }
        }
        break;
    }
    if( $question['content'] == '' ) {
      echo $question['content'];
      // die();
      $question_number ++;
      $follow_question = 0;
    }
  }
  $question['number'] = $follow_question + 1;
  $question['question_number'] = $question_number;
  $question['pre_question']  = $previous_question[$question_number-1]->q_content;
  $current = 'answer_' . strval($question_number);
  $question['pre_answer'] = $results[0]->$current;
  if( isset($_POST['question_number']) ) {        
    echo json_encode($question);
    wp_die();
  }
  return json_encode($question);
}
add_action( 'wp_ajax_load_follow_up_question', 'load_follow_up_question' );
add_action( 'wp_ajax_nopriv_load_follow_up_question', 'load_follow_up_question' );