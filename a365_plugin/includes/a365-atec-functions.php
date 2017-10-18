<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * A365 ATEC functions
 *
 **/

function get_atec_questions() {
  global $wpdb;
  $final_result = array();
  for($i = 1; $i <= 4; $i++) {
    $result = $wpdb->get_results( $wpdb->prepare(
                                "
                                  SELECT q_content
                                  FROM a365_atec_questions
                                  WHERE q_category = %d
                                ", $i
                              ), OBJECT );
    array_push($final_result, $result);
  }
  return $final_result;
}

function get_total_score() {
  return get_cate1_score()+get_cate2_score()+get_cate3_score()+get_cate4_score();
}

function get_cate1_score() {
  $sum = 0;
  $points_array = $_POST['atec_giaotiep'];
  foreach ($points_array as $point) {
    $sum += 2-($point - 1);
  }
  return $sum;
}

function get_cate2_score() {
  $sum = 0;
  $points_array = $_POST['atec_kynang'];
  foreach ($points_array as $point) {
    $sum += $point - 1;
  }
  return $sum;
}

function get_cate3_score() {
  $sum = 0;
  $points_array = $_POST['atec_nhanthuc'];
  foreach ($points_array as $point) {
    $sum += 2-($point - 1);
  }
  return $sum;
}

function get_cate4_score() {
  $sum = 0;
  $points_array = $_POST['atec_suckhoe'];
  foreach ($points_array as $point) {
    $sum += $point - 1;
  }
  return $sum;
}

function first_create_atec_result() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $answers = array(
            'child_id' => $_SESSION['current_child']->id,
            'creator_id' => a365_get_current_user_id(),
            'begin_at' => $_SESSION['start_atec'],
      );
  $wpdb->insert("a365_atec_results", $answers);
  $newest_atec_id = $wpdb->insert_id;
  $_SESSION['atec_result_id'] = $newest_atec_id;
}

function atec_save_result() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $answers = array(
            'end_at' => date('Y-m-d H:i:s'),
            'cate_1_point' => get_cate1_score(),
            'cate_2_point' => get_cate2_score(),
            'cate_3_point' => get_cate3_score(),
            'cate_4_point' => get_cate4_score()
            );
  $i = 1;
  foreach ($_POST['atec_giaotiep'] as $val) {
    $answers['answer_'.$i] = $val;
    $i++;
  }
  foreach ($_POST['atec_kynang'] as $val) {
    $answers['answer_'.$i] = $val;
    $i++;
  }
  foreach ($_POST['atec_nhanthuc'] as $val) {
    $answers['answer_'.$i] = $val;
    $i++;
  }
  foreach ($_POST['atec_suckhoe'] as $val) {
    $answers['answer_'.$i] = $val;
    $i++;
  }
  $wpdb->update("a365_atec_results", $answers, array( 'id' =>   $_SESSION['atec_result_id']));
 
}

// load data for review qol result
function load_data_for_review_atec_result($id) {
  global $wpdb;
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_atec_results
      WHERE a365_atec_results.id = '%s' 
      "
  , $id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results[0];
}

function atec_save_test() {
  global $wpdb;
  $answers = array();
  $i = 1;
  for ($j = 1; $j <= 14; $j++) {
    if (isset($_POST['atec_giaotiep'][$j]))
      $answers['answer_'.$i] = $_POST['atec_giaotiep'][$j];
    else
      $answers['answer_'.$i] = "0";
    $i++;
  }
  for ($j = 1; $j <= 20; $j++) {
    if (isset($_POST['atec_kynang'][$j]))
      $answers['answer_'.$i] = $_POST['atec_kynang'][$j];
    else
      $answers['answer_'.$i] = "0";
    $i++;
  }
  for ($j = 1; $j <= 18; $j++) {
    if (isset($_POST['atec_nhanthuc'][$j]))
      $answers['answer_'.$i] = $_POST['atec_nhanthuc'][$j];
    else
      $answers['answer_'.$i] = "0";
    $i++;
  }
  for ($j = 1; $j <= 25; $j++) {
    if (isset($_POST['atec_suckhoe'][$j]))
      $answers['answer_'.$i] = $_POST['atec_suckhoe'][$j];
    else
      $answers['answer_'.$i] = "0";
    $i++;
  }
  
  $wpdb->update("a365_atec_results", $answers
    , array( 'id' =>   $_SESSION['atec_result_id']));
  //echo "đã chạy hàm này";
}
add_action( 'wp_ajax_atec_save_and_exit', 'atec_save_test' );
add_action( 'wp_ajax_nopriv_atec_save_and_exit', 'atec_save_test' );

// load data atec continue test
function load_data_for_atec_continue($id) {
  global $wpdb;
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_atec_results
      WHERE a365_atec_results.id = '%s' 
      "
  , $id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results[0];
}

function gen_atec_checkbox($point, $expect) {
  if ($point == $expect) {
    return 'checked="checked"';
  }
  return '';
}