<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * A365 QOL functions
 *
 **/

// tổng số lượng trẻ
function getRecordsForNumOfChild() {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_children
      WHERE a365_children.creator_id = '%s' 
      "
  , $current_user_id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results;
}

function get_qol_questions() {
  global $wpdb;
  $result = $wpdb->get_results(
                                "
                                  SELECT q_content
                                  FROM a365_qol_questions
                                "
                             , OBJECT );
  return $result;
}

function get_qol_total() {
	return calculate_qol_total($_POST['qol_question']);
}

function get_qol_average() {
  return calculate_qol_average($_POST['qol_question']);
}

function calculate_qol_total($points_array) {
  $num_of_anwer = 1; 
  $sum = 0;
  foreach ($points_array as $point) {
    if ($point != 6) {
      if ($num_of_anwer == 2 || $num_of_anwer == 4 || $num_of_anwer == 17 || $num_of_anwer == 22) {
        $point = 6 - $point;
      }
      $sum += $point;
    }
    $num_of_anwer++;
  }
  return $sum;
}

function calculate_qol_average($points_array) {
  $num_of_anwer = 1; 
  $count = 0;
  $sum = 0;
  foreach ($points_array as $point) {
    if ($point != 6) {
     	if ($num_of_anwer == 2 || $num_of_anwer == 4 || $num_of_anwer == 17 || $num_of_anwer == 22) {
     		$point = 6 - $point;
     		//echo "$num_of_anwer: ".$point.'<br>';
     	}
      $count++;
      $sum += $point;
    }
    $num_of_anwer++;
  }
  return round($sum / $count, 2);
}

function qol_save_result() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $answers = array(
            'end_at' => date('Y-m-d H:i:s'),
            'sum_point' => get_qol_total(),
            'avg_point' => get_qol_average()
      );
  $i = 1;
  foreach ($_POST['qol_question'] as $val) {
    $answers['answer_'.$i] = $val;
    $i++;
  }
  $wpdb->update("a365_qol_results", $answers, array( 'id' =>   $_SESSION['qol_result_id']));
}

function first_create_qol_result() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $answers = array(
            'child_id' => $_SESSION['current_child']->id,
            'creator_id' => a365_get_current_user_id(),
            'begin_at' => $_SESSION['start_qol'],
      );
  $wpdb->insert("a365_qol_results", $answers);
  $newest_qol_id = $wpdb->insert_id;
  $_SESSION['qol_result_id'] = $newest_qol_id;
}

// load data for review qol result
function load_data_for_review_qol_result($id) {
  global $wpdb;
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_qol_results
      WHERE a365_qol_results.id = '%s' 
      "
  , $id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results[0];
}

function qol_save_test() {
  global $wpdb;
  $answers = array();
  $i = 1;

  for ($i = 1; $i <= 28; $i ++) {
    if (isset($_POST['qol_question'][$i]))
      $answers['answer_'.$i] = $_POST['qol_question'][$i];
    else
      $answers['answer_'.$i] = "0";
  }
  
  $wpdb->update("a365_qol_results", $answers
    , array( 'id' =>   $_SESSION['qol_result_id']));
  //echo "đã chạy hàm này";
}
add_action( 'wp_ajax_qol_save_and_exit', 'qol_save_test' );
add_action( 'wp_ajax_nopriv_qol_save_and_exit', 'qol_save_test' );

// load data qol continue test
function load_data_for_qol_continue($id) {
  global $wpdb;
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_qol_results
      WHERE a365_qol_results.id = '%s' 
      "
  , $id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results[0];
}

function gen_qol_checkbox($point, $expect) {
  if ($point == $expect) {
    return 'checked="checked"';
  }
  return '';
}