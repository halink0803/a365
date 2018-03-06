<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * User functions
 **/
require_once( ABSPATH . 'wp-includes/class-phpass.php');

global $current_child;
// $current_child = '0';

global $user_id;
// $user_id = '0';
function a365_get_areas() {
 global $wpdb;
 $areas = $wpdb->get_results("
    SELECT *
    FROM a365_areas
  ", OBJECT);
 return $areas;
}

function a365_get_area_by_id($id) {
 global $wpdb;
 $areas = $wpdb->get_results("
    SELECT *
    FROM a365_areas where area_code = $id
  ", OBJECT);
 return $areas[0];
}

/**
 * Get child information
 * @return object child
 */
function asq_get_child_info() {
  //echo "child".$_SESSION['current_child'];
    global $wpdb;
    global $info;
    $info = $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_children where id = %s
    ", $_SESSION['current_child']), OBJECT);
    //print_r($info);
    return $info[0];
}

function a365_get_child_status() {
  global $wpdb;
  // print_r($_SESSION['current_child']);
  $status = $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_diagnostic_statuses WHERE child_id = %s
  ", $_SESSION['current_child']->id), OBJECT);
  // print $wpdb->last_query;
  return $status[0];
}

/**
 * get user info
 * @return [type] [description]
 */
function asq_get_user_info() {
  //echo "user".$_SESSION['current_user'];
    global $wpdb;
    global $info_user;
    // $current_user = '010000001';
    $info_user = $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_users where id = %s
    ", $_SESSION['current_user']), OBJECT);
    //print_r($info_user);
    return $info_user[0];
}

/**
 * Get current user id
 * @return int user id
 */
function a365_get_current_user_id() {
  global $wpdb;
  $current_user = wp_get_current_user();

  $user_email = $current_user->user_email;
  if ($user_email == '')
    return 0;
  //print_r($current_user);
  //wp_die();
  $user_id =  $wpdb->get_results($wpdb->prepare("
    SELECT id
    FROM a365_users WHERE email = %s
    ", $user_email), OBJECT);
  //print_r($user_id[0]->id);
  if( !empty($user_id) ) {
    $_SESSION['current_user_id'] = $user_id[0]->id;
    return (string)$user_id[0]->id;
  }

  return 0;
}

/**
 * Get current user information
 * @return object user
 */
function a365_get_current_user() {
  global $wpdb;
  $current_user = wp_get_current_user();
  //print_r($current_user);
  //wp_die();
  $user_email = $current_user->user_email;

  $user =  $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_users WHERE email = %s
    ", $user_email), OBJECT);
  if(!empty($user)) {
    return $user[0];
  }
  return 0;
}

/**
 * Save child information to database after sign up child
 * @return redirect to child information page
 */
function a365_save_child_to_db() {
  global $wpdb;
  if(isset($_POST['signUpChild'])) {
    $fullname = $_POST['fullname'];
    $birthday = $_POST['birthday'];
    $gender   = $_POST['gender'];
    $birthweek = $_POST['birthweek'];
    $checked  = $_POST['checked'];
    if ($_POST['checked'] == 1){
      $status = $_POST['status'];
      $birthage = $_POST['birthage'];
      $hospital = $_POST['hospital'];
      $doctor   = $_POST['doctor'];
    }
    else {
      $status = "";
      $birthage = "";
      $hospital = "";
      $doctor   = "";
    }

    $birthday = strval($_POST['yyyy']) . '-' . str_pad(strval($_POST['mm']), 2, '0', STR_PAD_LEFT) . '-' . str_pad(strval($_POST['dd']), 2, '0', STR_PAD_LEFT);

    $creator_id = a365_get_current_user_id();

    $created_order = $wpdb->get_results($wpdb->prepare("
        SELECT number_of_children
        FROM a365_users
        WHERE id = %s
        ", $creator_id),OBJECT)[0]->number_of_children+1;

    $id = $creator_id . str_pad($created_order, 4, '0', STR_PAD_LEFT);
    $true_id = $id;
    // print_r($id);
    // wp_die();
    //$bool = false;
    do {
      $bool = $wpdb->query( $wpdb->prepare("
                  INSERT INTO a365_children (id, creator_id, created_order, name, sex, date_of_birth, week_of_birth) VALUES (%s, %s, %d, %s, %s, %s, %d)
            ",
            array(
              $id,
              $creator_id,
              $created_order,
              $fullname,
              $gender,
              $birthday,
              $birthweek
              )
            )
          );
      $true_id = $id;
      $id = $creator_id . str_pad($created_order++, 4, '0', STR_PAD_LEFT);
    } while ($bool == false);
    //wp_die();
    $wpdb->query( $wpdb->prepare("
                  INSERT INTO a365_diagnostic_statuses (child_id, child_status, age_at_diagnose, diagnosed_at, diagnose_by) VALUES (%s, %s, %s, %s, %d)
            ",
            array(
              $true_id,
              $status,
              $birthage,
              $hospital,
              $doctor
              )
            )
          );
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/child-information.php'
    ));
    wp_redirect( home_url($pages[0]->post_name) );
    exit();
  }
}
add_action('init', 'a365_save_child_to_db');


function a365_edit_child_status() {
  global $wpdb;
  if(isset($_POST['editChildStatus'])) {
    $status   = $_POST['status'];
    $birthage = $_POST['birthage'];
    $hospital = $_POST['hospital'];
    $doctor   = $_POST['doctor'];
    $id = $_POST['editChildStatus'];


    $check = $wpdb->get_results( $wpdb->prepare("
                  SELECT * from a365_diagnostic_statuses WHERE child_id = %s
            ", $id), OBJECT);
    //print_r(count($check));
    //wp_die();
    if (count($check) == 0) {
        $wpdb->query( $wpdb->prepare("
                  INSERT INTO a365_diagnostic_statuses (child_id, child_status, age_at_diagnose, diagnosed_at) VALUES (%s, %s, %s, %s)
            ",
            array(
              $id,
              "",
              "",
              ""
              )
            )
          );
    }

    $wpdb->query( $wpdb->prepare("
                  UPDATE a365_diagnostic_statuses SET child_status=%s, age_at_diagnose=%d, diagnosed_at=%s, diagnose_by=%d WHERE child_id=%s
            ",
            array(
              $status,
              $birthage,
              $hospital,
              $doctor,
              $id
              )
            )
          );

    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/child-information.php'
    ));
    // wp_redirect( home_url($pages[0]->post_name) );
    $message = [
      'url' => home_url($pages[0]->post_name)
    ];
    echo json_encode($message);
    wp_die();
    exit();
  }
}
// add_action('init', 'a365_edit_child_status');
add_action( 'wp_ajax_edit_child_status', 'a365_edit_child_status' );
add_action( 'wp_ajax_nopriv_edit_child_status', 'a365_edit_child_status' );

function a365_change_user_password() {
  global $wpdb;
  $wp_hasher = new PasswordHash(8, TRUE);

  $current_user = wp_get_current_user();
  $user_email = $current_user->user_email;

  $check =  $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM wp_users WHERE user_email = %s
    ", $user_email), OBJECT)[0]->user_pass;


  //if(isset($_POST['changePassword'])) {
    $new = wp_hash_password($_POST['new-pass']);
    $old = $_POST['old-pass'];
    if($wp_hasher->CheckPassword($old, $check)) {
      $wpdb->query( $wpdb->prepare("
                    UPDATE wp_users SET user_pass = %s WHERE user_email= %s
              ",
              array(
                $new,
                $user_email
                )
              )
            );
      $response = array(
        'message' => 'successful'
      );
      echo json_encode($response);
      wp_die();
    }

    else {
      $response = array(
        'message' => 'fail'
      );
      echo json_encode($response);
      wp_die();
    }

  //}
}
add_action( 'wp_ajax_change_password', 'a365_change_user_password' );
add_action( 'wp_ajax_nopriv_change_password', 'a365_change_user_password' );

function a365_edit_child_information() {
  global $wpdb;
  if(isset($_POST['editChild'])) {
    $fullname = $_POST['fullname'];
    $gender   = $_POST['gender'];
    $birthweek = $_POST['birthweek'];
    $id = $_POST['editChild'];

    $birthday = strval($_POST['yyyy']) . '-' . str_pad(strval($_POST['mm']), 2, '0', STR_PAD_LEFT) . '-' . str_pad(strval($_POST['dd']), 2, '0', STR_PAD_LEFT);

    $wpdb->query( $wpdb->prepare("
                  UPDATE a365_children SET name=%s, sex=%s, date_of_birth=%s, week_of_birth=%d WHERE id=%s
            ",
            array(
              $fullname,
              $gender,
              $birthday,
              $birthweek,
              $id
              )
            )
          );

    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/child-information.php'
    ));
    wp_redirect( home_url($pages[0]->post_name) );
    exit();
  }
}
add_action('init', 'a365_edit_child_information');
// add_action( 'wp_ajax_a365_edit_child_information', 'a365_edit_child_information' );
// add_action( 'wp_ajax_nopriv_a365_edit_child_information', 'a365_edit_child_information' );

function a365_edit_user_information() {
  global $wpdb;
  if(isset($_POST['editUser'])) {
    $fullname = $_POST['fullname'];
    $gender   = $_POST['gender'];
    $year = $_POST['year'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $edu_level = $_POST['edu_level'];
    $id = $_POST['editUser'];

    $wpdb->query( $wpdb->prepare("
                  UPDATE a365_users SET name=%s, sex=%s, year_of_birth=%d, phone=%d, address=%s, educational_level=%s WHERE id=%s
            ",
            array(
              $fullname,
              $gender,
              $year,
              $phone,
              $address,
              $edu_level,
              $id
              )
            )
          );

    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/user-information.php'
    ));
    wp_redirect( home_url($pages[0]->post_name) );
    exit();
  }
}
add_action('init', 'a365_edit_user_information');

/**
 * Delete a child from database
 * @return json query result
 */
function a365_delete_child() {
  global $wpdb;
  if(isset($_POST['current_child'])) {
    // $wpdb->delete('a365_diagnostic_statuses', array('child_id' => $_POST['current_child']));
    // $wpdb->delete('a365_asq_results', array('child_id' => $_POST['current_child']));
    // $wpdb->delete('a365_mchatrf_results', array('child_id' => $_POST['current_child']));
    // $wpdb->delete('a365_mchatr_results', array('child_id' => $_POST['current_child']));
    $wpdb->update('a365_children', array('active' => "0"), array('id' => $_POST['current_child']));
    //$wpdb->delete('a365_children', array('id' => $_POST['current_child']));
    $response = array(
      'message' => 'delete succes'
      );
    echo json_encode($response);
    wp_die();
  }
}
add_action( 'wp_ajax_a365_delete_child', 'a365_delete_child' );
add_action( 'wp_ajax_nopriv_a365_delete_child', 'a365_delete_child' );


/**
 * Delete a child from database
 * @return json query result
 */
function a365_delete_history() {
  global $wpdb;
  if(isset($_POST['current_history'])) {
    switch ($_POST['type']) {
      case 'ASQ':
        $wpdb->delete('a365_asq_results', array('id' => $_POST['current_history']));
        break;

      case "M-CHAT R":
        $wpdb->delete('a365_mchatr_results', array('id' => $_POST['current_history']));
        break;

      case "M-CHAT R/F":
        $wpdb->delete('a365_mchatrf_results', array('id' => $_POST['current_history']));
        break;

      case "QOL":
        $wpdb->delete('a365_qol_results', array('id' => $_POST['current_history']));
        break;

      case "ATEC":
        $wpdb->delete('a365_atec_results', array('id' => $_POST['current_history']));
        break;
      default:
        $wpdb->delete('a365_intervention_gumsue', array('id' => $_POST['current_history']));
    }
    $response = array(
      'message' => 'delete succes'
      );
    echo json_encode($response);
    wp_die();
  }
}
add_action( 'wp_ajax_a365_delete_history', 'a365_delete_history' );
add_action( 'wp_ajax_nopriv_a365_delete_history', 'a365_delete_history' );

/**
 * Save current child information to session
 * @return NULL
 */
function a365_get_current_child() {
  global $wpdb;
  $children = "";
  if (isset($_POST['current_child_id'])) {
    $children = $wpdb->get_results($wpdb->prepare("
      SELECT *
      FROM a365_children where id = %s
    ", $_POST['current_child_id']), OBJECT);
    $_SESSION['current_child'] = $children[0];

    $status = $wpdb->get_results($wpdb->prepare("
      SELECT *
      FROM a365_diagnostic_statuses
      WHERE child_id = %s", $_POST['current_child_id']), OBJECT);

    echo json_encode(["status" => $status[0]->child_status]);
    wp_die();
  }
}
add_action( 'wp_ajax_get_current_child', 'a365_get_current_child' );
add_action( 'wp_ajax_nopriv_get_current_child', 'a365_get_current_child' );

/**
 * get child by id
 * @return NULL
 */
function a365_get_child_by_id($id) {
  global $wpdb;
  $children = $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_children where id = %s
    ", $id), OBJECT);
  $_SESSION['current_child'] = $children[0];
}

/**
 * Get list children of an account
 * @return array of child object
 */
function a365_get_children() {
  global $wpdb;
  $current_user = wp_get_current_user();

  $user_email = $current_user->user_email;

  $user_id =  $wpdb->get_results($wpdb->prepare("
    SELECT id
    FROM a365_users WHERE email = %s
    ", $user_email), OBJECT);

  $_SESSION['current_user'] = $user_id[0]->id;

  $children = $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_children where creator_id = %s
    ", $_SESSION['current_user']), OBJECT);

  return $children;
}

function cmp($a, $b)
{
    return strcmp($a->begin_at, $b->begin_at);
}

/**
 * Get children history
 */
function a365_get_children_history() {
  global $wpdb;
  $current_child = $_SESSION['current_child'];

  $asq = $wpdb->get_results($wpdb->prepare("
    SELECT id, begin_at, end_at
    FROM a365_asq_results
    WHERE child_id = %s
    ", $current_child->id), OBJECT);
  foreach($asq as $a) {
    $a->type  = 'asq';
    $a->exercise_name  = '';
  }
  $mchatr = $wpdb->get_results($wpdb->prepare("
    SELECT id, begin_at, end_at
    FROM a365_mchatr_results
    WHERE child_id = %s
    ", $current_child->id), OBJECT);
  foreach($mchatr as $a) {
    $a->type = 'mchatr';
    $a->exercise_name  = '';
  }
  $mchatrf = $wpdb->get_results($wpdb->prepare("
    SELECT id, begin_at, end_at
    FROM a365_mchatrf_results
    WHERE child_id = %s
    ", $current_child->id), OBJECT);
  foreach($mchatrf as $a) {
    $a->type  = 'mchatrf';
    $a->exercise_name  = '';
  }
  $qol = $wpdb->get_results($wpdb->prepare("
    SELECT id, begin_at, end_at
    FROM a365_qol_results
    WHERE child_id = %s
    ", $current_child->id), OBJECT);
  foreach($qol as $a) {
    $a->type  = 'qol';
     $a->exercise_name  = '';
  }
  $atec = $wpdb->get_results($wpdb->prepare("
    SELECT id, begin_at, end_at
    FROM a365_atec_results
    WHERE child_id = %s
    ", $current_child->id), OBJECT);
  foreach($atec as $a) {
    $a->type  = 'atec';
    $a->exercise_name  = '';
  }
  $theodoi = $wpdb->get_results($wpdb->prepare("
    SELECT id, begin_at, end_at, exercise_name
    FROM a365_intervention_gumsue
    WHERE child_id = %s
    ", $current_child->id), OBJECT);
  foreach($theodoi as $a) {
    $a->type  = 'gumsue';
  }
  $history = array_merge($asq, $mchatr, $mchatrf, $qol, $atec, $theodoi);

  usort($history, "cmp");
  echo json_encode($history, true);
  wp_die();

  return $history;
}
add_action( 'wp_ajax_get_child_history', 'a365_get_children_history' );
add_action( 'wp_ajax_nopriv_get_child_history', 'a365_get_children_history' );

function a365_set_result_id() {
  if( isset($_POST['test_type']) ) {
    if($_POST['test_type']  == 'mchatr') {
      $_SESSION['mchatr_result_id'] = $_POST['test_id'];
    }
    else if($_POST['test_type']  == 'asq') {
      $_SESSION['asq_result_id'] = $_POST['test_id'];
    }
    else if($_POST['test_type']  == 'mchatrf') {
      $_SESSION['mchatrf_result_id'] = $_POST['test_id'];
    }
    else if($_POST['test_type']  == 'atec') {
      $_SESSION['atec_result_id'] = $_POST['test_id'];
    }
    else if($_POST['test_type']  == 'qol') {
      $_SESSION['qol_result_id'] = $_POST['test_id'];
    }
    else
      $_SESSION['gumsue_result_id'] = $_POST['test_id'];
  }
}
add_action( 'wp_ajax_set_result_id', 'a365_set_result_id' );
add_action( 'wp_ajax_nopriv_set_result_id', 'a365_set_result_id' );