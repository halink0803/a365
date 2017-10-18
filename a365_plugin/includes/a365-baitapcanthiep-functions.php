<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * A365 baitapcanthiep functions
 *
 **/

function currentChild() {
  if (isset($_POST['child_id'])) {
    global $wpdb;
 
    $children = $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_children where id = '%s'
    ", $_POST['child_id']), OBJECT);
    $_SESSION['current_child'] = $children[0];
    print json_encode(['message' => $_SESSION['current_child']->id]);
    wp_die();
  }
}
add_action( 'wp_ajax_update_Current_Child', 'currentChild' );
add_action( 'wp_ajax_nopriv_update_Current_Child', 'currentChild' );
add_action( 'init', 'currentChild');

function saveExerciseInterventionView() {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $view_at = date('Y-m-d H:i:s');
  if(isset($_POST['exercise_name'])){
    $wpdb->insert( 'a365_intervention_exercise', 
      array( 'user_id' => $current_user_id, 'child_id' => $_SESSION['current_child']->id, 
        'exercise_name' => $_POST['exercise_name'], 'view_at' => $view_at), 
      array( '%s', '%s', '%s', '%s' ) 
    );
  }
}
add_action( 'wp_ajax_save_exercise_intervention_view', 'saveExerciseInterventionView' );
add_action( 'wp_ajax_save_exercise_intervention_view', 'saveExerciseInterventionView' );
add_action( 'init', 'saveExerciseInterventionView');

// đếm trẻ tự kỉ
function getRecordsForAutismChild() {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT a365_children.*
      FROM a365_children
      INNER JOIN a365_diagnostic_statuses
      ON a365_diagnostic_statuses.child_id = a365_children.id
      WHERE a365_diagnostic_statuses.child_status != %s AND a365_diagnostic_statuses.child_status != %s
      AND a365_children.creator_id = %s
      AND a365_children.active = %s", 
      '','Không tự kỷ',  $current_user_id, '1'
  ), OBJECT );
  //echo "vu";
  //print_r( $results );
  return $results;
}

function checkUserType() {
  global $wpdb;
  $current_user_id = a365_get_current_user_id();
  if ($current_user_id == 0)
    return false;
  $results = $wpdb->get_results( $wpdb->prepare( 
     "
      SELECT a365_users.type
      FROM a365_users
      WHERE a365_users.id = %s"
  , $current_user_id
  ), OBJECT );
  if ($results[0]->type == 'Cán bộ y tế') {
    return true;
  }
  return false;
}