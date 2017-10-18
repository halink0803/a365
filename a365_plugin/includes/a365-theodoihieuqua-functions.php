<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * A365 theodoihieuqua functions
 *
 **/

function saveInterventionGumsue($questions, $answer1, $answer2, $answer3, $answer4) {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $begin_at = date('Y-m-d');
  $end_at = date('Y-m-d');
  $result = "";
  $index = 1;
  foreach ($questions as $question) {
    # code...
    $result .= $question."#".$answer1[$index]." ".$answer2[$index]." ".$answer3[$index]." ".$answer4[$index]."|";
    $index++;
  }

    $wpdb->insert( 'a365_intervention_gumsue', 
      array( 'user_id' => $current_user_id, 'child_id' => $_SESSION['current_child']->id, 
        'exercise_name' => $_POST['title'], 'begin_at' => $begin_at, 'end_at' => $end_at, 'result' => $result),
      array( '%s', '%s', '%s', '%s' , '%s') 
    );
}

function load_data_for_review_gumsue_result($id) {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT *
      FROM a365_intervention_gumsue
      WHERE a365_intervention_gumsue.id = '%s' 
      "
  , $id
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results[0];
}