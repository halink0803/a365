<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * M-Chat R functions
 *
 **/


/**
 * Get M-Chat R questions
 */
function mchatr_get_questions() {
  global $wpdb;
  $questions = $wpdb->get_results("SELECT * FROM a365_mchatr_questions", OBJECT);
  return $questions;
}

function first_create_mchatr_result_in_db() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $creator_id = a365_get_current_user_id();
  if( isset($_SESSION['current_user_id']) ) {
    $creator_id = $_SESSION['current_user_id'];
  }
  $wpdb->insert("a365_mchatr_results", array(
            'child_id' => $_SESSION['current_child']->id,
            'creator_id' => $creator_id,
            'original_birth' => calculate_original_birth(),
            'adjusted_birth' => calculate_adjusted_birth($_SESSION['current_child']->week_of_birth),
            'begin_at' => date('Y-m-d H:i:s'),
  ));
  $newest_mchatr_id = $wpdb->insert_id;
  $_SESSION['mchatr_result_id'] = $newest_mchatr_id;
}

/**
 *  result
 **/
function mchatr_save_result() {

  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  if( isset( $_POST['result'] ) ) {
    if( $_POST['result'] != '' ) {
      $point = 0;
      $current_child = 0;
      if( !empty($_SESSION['current_child']) ) {
        $current_child = $_SESSION['current_child'];
      };
      $creator = a365_get_current_user();

      if( isset( $_POST['ajax_score'] ) ) {
        $user_id = $_SESSION['current_user_id'];
      } else {
        $user_id = $creator->id;
      }

      $answer = array();
      for($i = 1; $i<21; $i++) {
        $answer[$i] = $_POST['question-' . strval($i) ];
        //calculate point
        if( ($i != 2) && ($i != 5)  && ($i != 12) && ($answer[$i] == 0) ) {
          $point += 1;
        };
        if( (($i == 2) || ($i == 5)  || ($i == 12)) && ($answer[$i] == 1) ) {
          $point += 1;
        };
      }

      /**
       * Conclusion
       **/
      $conclusion = '';
      switch (true) {
        case $point < 3:
          $conclusion = 'Nguy cơ thấp.';
          break;
        case $point < 8:
          $conclusion = 'Nguy cơ trung bình.';
          break;
        default:
          $conclusion = "Nguy cơ cao.";
          break;
      }
      // echo $point;
      if( $point > 2 && $point < 8 &&  $creator->type == 'Cán bộ y tế') {
            /**
           * Save to database
           **/
          date_default_timezone_set('Asia/Ho_Chi_Minh');
          $wpdb->insert("a365_mchatrf_results", array(
              'child_id' => $current_child->id,
              'creator_id' => $user_id,
              'original_birth' => calculate_original_birth(),
              'adjusted_birth' => calculate_adjusted_birth($current_child->week_of_birth),
              'begin_at' => date('Y-m-d H:i:s'),
              'point' => $point,
              'conclusion' => $conclusion,
              'answer_1' => $answer[1],
              'answer_2' => $answer[2],
              'answer_3' => $answer[3],
              'answer_4' => $answer[4],
              'answer_5' => $answer[5],
              'answer_6' => $answer[6],
              'answer_7' => $answer[7],
              'answer_8' => $answer[8],
              'answer_9' => $answer[9],
              'answer_10' => $answer[10],
              'answer_11' => $answer[11],
              'answer_12' => $answer[12],
              'answer_13' => $answer[13],
              'answer_14' => $answer[14],
              'answer_15' => $answer[15],
              'answer_16' => $answer[16],
              'answer_17' => $answer[17],
              'answer_18' => $answer[18],
              'answer_19' => $answer[19],
              'answer_20' => $answer[20],
        ));
        $_SESSION['mchatrf_result_id'] = $wpdb->insert_id;

        $page_template = 'page-templates/m-chat-rf-follow.php';
        $pages = get_pages(array(
                            'meta_key' => '_wp_page_template',
                            'meta_value' => $page_template
                        ));
        if( isset( $_POST['ajax_score'] ) ) {
          echo json_encode(["page" => $pages[0]->guid]);
          wp_die();
        }
        wp_redirect($pages[0]->guid, 301);
        exit();
      }

      /**
       * Save to database
       **/
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $wpdb->update("a365_mchatr_results", array(
          'end_at' => date('Y-m-d H:i:s'),
          'point' => $point,
          'conclusion' => $conclusion,
          'answer_1' => $answer[1],
          'answer_2' => $answer[2],
          'answer_3' => $answer[3],
          'answer_4' => $answer[4],
          'answer_5' => $answer[5],
          'answer_6' => $answer[6],
          'answer_7' => $answer[7],
          'answer_8' => $answer[8],
          'answer_9' => $answer[9],
          'answer_10' => $answer[10],
          'answer_11' => $answer[11],
          'answer_12' => $answer[12],
          'answer_13' => $answer[13],
          'answer_14' => $answer[14],
          'answer_15' => $answer[15],
          'answer_16' => $answer[16],
          'answer_17' => $answer[17],
          'answer_18' => $answer[18],
          'answer_19' => $answer[19],
          'answer_20' => $answer[20],
    ), array( 'id' =>   $_SESSION['mchatr_result_id']));
    };
    // exit( var_dump( $wpdb->last_query ) );
    //$_SESSION['mchatr_result_id'] = $wpdb->insert_id;

    $page_template = 'page-templates/M-ChatR-Result.php';
    $pages = get_pages(array(
                        'meta_key' => '_wp_page_template',
                        'meta_value' => $page_template
                    ));
    if( isset( $_POST['ajax_score'] ) ) {
      echo json_encode(["page" => $pages[0]->guid]);
      wp_die();
    }
    wp_redirect($pages[0]->guid, 301);
    exit();
  }
}
add_action( 'wp_ajax_mchatr_save_result', 'mchatr_save_result' );
add_action( 'wp_ajax_nopriv_mchatr_save_result', 'mchatr_save_result' );
add_action( 'init', 'mchatr_save_result' );


/**
 * Get result
 **/
function a365_mchatr_get_result() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $result = $wpdb->get_results($wpdb->prepare('
    SELECT *
    FROM a365_mchatr_results
    WHERE id = %d
    ',
    array(
      $_SESSION['mchatr_result_id']
      ))
  );
  return $result;
}

/**
 * Get child information
 */
function a365_mchatr_get_child_information() {
  global $wpdb;
  $result = $wpdb->get_results($wpdb->prepare('
    SELECT *
    FROM a365_children
    WHERE id = %s
    ',
    array(
      $_SESSION['current_child']
      ))
  );
  return $result;
}

function create_nologin_mchatr() {
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

    $pages = get_pages(array(
          'meta_key' => '_wp_page_template',
          'meta_value' => 'page-templates/M-ChatR.php'
    ));
    echo json_encode(["page" => $pages[0]->guid]);
    wp_die();

}
add_action( 'wp_ajax_create_nologin_mchatr', 'create_nologin_mchatr' );
add_action( 'wp_ajax_nopriv_create_nologin_mchatr', 'create_nologin_mchatr' );


function get_no_login_user() {
  global $wpdb;
  $user =  $wpdb->get_results($wpdb->prepare("
    SELECT *
    FROM a365_users WHERE id = %s
    ", $_SESSION['current_user_id']), OBJECT);

  return $user[0];
}

/**
 * Update user information
 */
function update_user_information() {
  global $wpdb;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  if( isset($_POST['user_information']) ) {
    if( $_POST['user_information'] ) {

      $wpdb->update("a365_users", array(
          'child_relationship' => $_POST['relationship'],
          'year_of_birth' => $_POST['age'],
          'address' => $_POST['address'],
    ), array( 'id' =>   $_SESSION['current_user']));

      $wpdb->update("a365_mchatr_results", array(
          'dit_at' => $_POST['place'],
          'end_at' => date('Y-m-d H:i:s'),
    ), array( 'id' =>   $_SESSION['mchatr_result_id']));

      $page_template = 'page-templates/M-ChatR-Result.php';
      $pages = get_pages(array(
                          'meta_key' => '_wp_page_template',
                          'meta_value' => $page_template
                      ));
      wp_redirect($pages[0]->guid, 301);
      exit();
    }
  }
}
add_action( 'init', 'update_user_information' );

function update_no_login_user_information_mchatr() {
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  global $wpdb;
  $relationship = $_POST['relationship'];
  if ($_POST['relationship'] == "other")
    $relationship = $_POST['other_relationship'];
  $wpdb->update("a365_users", array(
          'child_relationship' => $relationship,
          'year_of_birth' => $_POST['age'],
          'address' => $_POST['address'],
          'sex' => $_POST['user_gender'],
          'known_from' => $_POST['source']
    ), array( 'id' =>   $_SESSION['current_user_id']));

  $wpdb->update("a365_mchatr_results", array(
          'dit_at' => $_POST['did_at'],
          'end_at' => date('Y-m-d H:i:s'),
    ), array( 'id' =>   $_SESSION['mchatr_result_id']));
    echo json_encode(["value" => 'ok']);
    wp_die();
}
add_action( 'wp_ajax_update_no_login_user_info_mchatr', 'update_no_login_user_information_mchatr' );
add_action( 'wp_ajax_nopriv_update_no_login_user_info_mchatr', 'update_no_login_user_information_mchatr' );

function a365_update_mchatr_respondent_info() {
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  global $wpdb;
  $relationship = $_POST['relationship'];
  if ($_POST['relationship'] == "other")
    $relationship = $_POST['other_relationship'];
  $wpdb->update("a365_mchatr_results", array(
          'who_did' => $relationship,
          'year' => $_POST['age'],
          'gender' => $_POST['gender'],
          'area' => $_POST['area'],
          'address' => $_POST['address'],
          'dit_at' => $_POST['did_at'],
          'end_at' => date('Y-m-d H:i:s'),
    ), array( 'id' =>   $_SESSION['mchatr_result_id']));
  //echo "đã chạy hàm này";
}
add_action( 'wp_ajax_update_mchatr_respondent_info', 'a365_update_mchatr_respondent_info' );
add_action( 'wp_ajax_nopriv_update_mchatr_respondent_info', 'a365_update_mchatr_respondent_info' );