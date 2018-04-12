<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Register functions
 *
 **/


/**
 * Get Register information
 */
require_once("vendor/phpmailer/phpmailer/PHPMailerAutoload.php");


function a365_insert_new_users(){
	global $wpdb;
	global $user_id;
	$reg_parent_arr = array();
	$reg_officer_arr = array();
	if(isset($_POST['reg_parent_submit'])){
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

			$reg_parent_arr['Type'] = 'Người chăm sóc';
			if(isset($_POST['reg_parent_email'])){
				$reg_parent_arr['Email'] = $_POST['reg_parent_email'];
			}
			if(isset($_POST['reg_parent_password'])){
				$reg_parent_arr['Password'] = $_POST['reg_parent_password'];
			}
			if(isset($_POST['reg_parent_phone'])){
				$reg_parent_arr['Phone'] = $_POST['reg_parent_phone'];
			}
			if(isset($_POST['reg_parent_role_user'])){
				if($_POST['reg_parent_role_user']=='others' && isset($_POST['reg_parent_job_add'])){
					$reg_parent_arr['UserRole'] = $_POST['reg_parent_job_add'];
				}else{
					$reg_parent_arr['UserRole'] = $_POST['reg_parent_role_user'];
				}
			}
			if(isset($_POST['reg_parent_job_next'])){
				$reg_parent_arr['UserJob'] = $_POST['reg_parent_job_next'];
			}
			if(isset($_POST['reg_parent_name'])){
				$reg_parent_arr['Name'] = $_POST['reg_parent_name'];
			}
			if(isset($_POST['reg_parent_birth_year'])){
				$reg_parent_arr['BirthYear'] = $_POST['reg_parent_birth_year'];
			}
			if(isset($_POST['reg_parent_gender'])){
				$reg_parent_arr['Gender'] = $_POST['reg_parent_gender'];
			}
			if(isset($_POST['reg_parent_city'])){
				$reg_parent_arr['City'] = $_POST['reg_parent_city'];
			}
			if(isset($_POST['reg_parent_address'])){
				$reg_parent_arr['Address'] = $_POST['reg_parent_address'];
			}

            if(isset($_POST['source'])) {
                $reg_parent_arr['Source'] = $_POST['source'];
            }

			if( $_POST['reg_parent_password'] == $_POST['reg_parent_password_check']  && !email_exists($reg_parent_arr['Email']) && $reg_parent_arr['Email'] != ""){
				$area_order = $wpdb->get_results($wpdb->prepare('
		        SELECT  user_count
		        FROM a365_areas
		        WHERE area_code = %d
		          ', $reg_parent_arr['City']))[0]->user_count + 1;
				$user_id =  str_pad($reg_parent_arr['City'], 2, '0', STR_PAD_LEFT) . str_pad($area_order, 7, '0', STR_PAD_LEFT);
				$wpdb->query(
					$wpdb->prepare("
	                  INSERT INTO a365_users (id, area_code, area_order, email, name, type, sex, year_of_birth, child_relationship, occupation, phone, address, known_from) VALUES (%s, %d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
	            	",
	                    array(
	                      $user_id,
	                      $reg_parent_arr['City'],
	                      $area_order,
	                      $reg_parent_arr['Email'],
	                      $reg_parent_arr['Name'],
	                      $reg_parent_arr['Type'],
	                      $reg_parent_arr['Gender'],
	                      $reg_parent_arr['BirthYear'],
	                      $reg_parent_arr['UserRole'],
	                      $reg_parent_arr['UserJob'],
	                      $reg_parent_arr['Phone'],
	                      $reg_parent_arr['Address'],
                          $reg_parent_arr['Source']
	                    )
                	)
                );

			}

		}

	}



	if(isset($_POST['reg_officer_submit'])){
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
			$reg_officer_arr['Type'] = 'Cán bộ y tế';
			if(isset($_POST['reg_officer_email'])){
				$reg_officer_arr['Email'] = $_POST['reg_officer_email'];
			}
			if(isset($_POST['reg_officer_password'])){
				$reg_officer_arr['Password'] = $_POST['reg_officer_password'];
			}
			if(isset($_POST['reg_officer_name'])){
				$reg_officer_arr['Name'] = $_POST['reg_officer_name'];
			}
			if(isset($_POST['reg_officer_birth_year'])){
				$reg_officer_arr['BirthYear'] = $_POST['reg_officer_birth_year'];
			}
			if(isset($_POST['reg_officer_job'])){
				if($_POST['reg_officer_job']=='another' && isset($_POST['reg_officer_job_add'])){
					$reg_officer_arr['Job'] = $_POST['reg_officer_job_add'];
				}else{
					$reg_officer_arr['Job'] = $_POST['reg_officer_job'];
				}
			}
			if(isset($_POST['reg_officer_working_place'])){
				$reg_officer_arr['WorkingPlace'] = $_POST['reg_officer_working_place'];
			}
			if(isset($_POST['reg_officer_gender'])){
				$reg_officer_arr['Gender'] = $_POST['reg_officer_gender'];
			}
			if(isset($_POST['reg_officer_city'])){
				$reg_officer_arr['City'] = $_POST['reg_officer_city'];
			}

            if(isset($_POST['source'])) {
                $reg_officer_arr['Source'] = $_POST['source'];
            }

			if( $_POST['reg_officer_password'] == $_POST['reg_officer_password_check']  && !email_exists($reg_officer_arr['Email']) && $reg_officer_arr['Email'] != ""){
				$area_order = $wpdb->get_results($wpdb->prepare('
		        SELECT  user_count
		        FROM a365_areas
		        WHERE area_code = %d
		          ', $reg_officer_arr['City']))[0]->user_count + 1;
				$user_id = str_pad($reg_officer_arr['City'], 2, '0', STR_PAD_LEFT) . str_pad($area_order, 7, '0', STR_PAD_LEFT);
				$wpdb->query(
					$wpdb->prepare("
	                  INSERT INTO a365_users (id, area_code, area_order, email, name, type, sex, year_of_birth, occupation, work_place, known_from) VALUES (%s, %d, %d, %s, %s, %s, %s, %s, %s, %s, %s)
	            	",
	                    array(
	                      $user_id,
	                      $reg_officer_arr['City'],
	                      $area_order,
	                      $reg_officer_arr['Email'],
	                      $reg_officer_arr['Name'],
	                      $reg_officer_arr['Type'],
	                      $reg_officer_arr['Gender'],
	                      $reg_officer_arr['BirthYear'],
	                      $reg_officer_arr['Job'],
	                      $reg_officer_arr['WorkingPlace'],
                          $reg_officer_arr['Source']
	                    )
                	)
                );
			}
		}
	}

}


// add_action('init','a365_insert_new_users');
?>
<?php
// register a new user
function a365_add_new_member() {
  	if (isset( $_POST["reg_parent_submit"] ) || isset( $_POST["reg_officer_submit"] )) {
  		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
  		 //your site secret key
       	$secret = '6Lem_g4UAAAAAC0D7MZs3ThXxeBkN1Xrxc_NRvv8';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
	    if($responseData->success){
		if(isset($_POST['reg_parent_email'])){
			$user_login		= $_POST["reg_parent_email"];
		}
		if(isset($_POST['reg_officer_email'])){
			$user_login		= $_POST["reg_officer_email"];
		}
		if(isset($_POST['reg_parent_email'])){
			$user_email		= $_POST["reg_parent_email"];
		}
		if(isset($_POST['reg_officer_email'])){
			$user_email		= $_POST["reg_officer_email"];
		}
		if(isset($_POST['reg_parent_name'])){
			$user_name		= $_POST["reg_parent_name"];
		}
		if(isset($_POST['reg_officer_name'])){
			$user_name		= $_POST["reg_officer_name"];
		}
		if(isset($_POST['reg_officer_password'])){
			$user_pass		= $_POST["reg_officer_password"];
		}
		if(isset($_POST['reg_parent_password'])){
			$user_pass		= $_POST["reg_parent_password"];
		}
		if(isset($_POST['reg_parent_password_check'])){
			$pass_confirm		= $_POST["reg_parent_password_check"];
		}
		if(isset($_POST['reg_officer_password_check'])){
			$pass_confirm		= $_POST["reg_officer_password_check"];
		}

		// this is required for username checks
		require_once(ABSPATH . WPINC . '/registration.php');
 		$a365_errors_messages = '';
		if(username_exists($user_login)) {
			// Username already registered
			$a365_errors_messages = 'Tên tài khoản đã tồn tại';
		}
		if(!validate_username($user_login)) {
			// invalid username
			$a365_errors_messages = 'Tên tài khoản không hợp lý';
		}

		if(!is_email($user_email)) {
			//invalid email
			$a365_errors_messages = 'Email không hợp lý';
		}
		if(email_exists($user_email)) {
			//Email address already registered
			$a365_errors_messages = 'Email đã được sử dụng';
		}
		if($user_pass == '') {
			// passwords do not match
			$a365_errors_messages = 'Vui lòng nhập mật khẩu';
		}
		if($user_pass != $pass_confirm) {
			// passwords do not match
			$a365_errors_messages = 'Mật khẩu xác nhận không trùng khớp';
		}
 		if($a365_errors_messages !=''){
 			echo "<script type='text/javascript'>alert('$a365_errors_messages');</script>";
 		}

		// only create the user in if there are no errors
		if($a365_errors_messages == '' ) {
 			a365_insert_new_users();
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'first_name'		=> $user_name,
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> 'subscriber',
				)
			);

			$user_id = $new_user_id;
			if ( $user_id && !is_wp_error( $user_id ) ) {
		        $code = sha1( $user_id . time() );
		        $page = get_page_by_path( 'email-activatation' );
		        $activation_link = get_permalink( $page->ID) . '?key='.$code.'&user='.$user_id;

		        add_user_meta( $user_id, 'has_to_be_activated', $code, true );
		        $mail = new PHPMailer(); // create a new object
				$mail->IsSMTP(); // enable SMTP
				$mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
				$mail->SMTPAuth = true; // authentication enabled
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 587; // or 587
				$mail->SMTPSecure = 'tls';
				$mail->IsHTML(true);
				// $mail->Username = "a365@ccihp.org";
				// $mail->Password = "smartcare";
			    $mail->Username = "support.a365@ccihp.org";
    			$mail->Password = "Smartcare2015";
				$mail->SetFrom("support.a365@ccihp.org", "A365");
				$mail->AddAddress($user_email);
				$mail->Subject = "=?UTF-8?B?".base64_encode("[A365.vn] Kích hoạt tài khoản")."?=";
				$mail->Body = '
<table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
<tbody>
<tr>
<td align="center"><center>
<table style="margin-left:auto;margin-right:auto;width:598px;text-align:center;height:611px" border="0" width="600" cellspacing="0" cellpadding="30">
<tbody>
<tr>
<td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
<table style="width:531px;height:505px" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
</tr>
<tr>
<td style="border-top:1px solid #dce1e5">
<h3><span style="font-size:12pt">Chúc mừng bạn đã đăng ký thành công tài khoản trên <a href="https://a365.vn">a365.vn</a></span></h3>
<h4 style="font-weight:normal"><span style="font-size:10pt">Chúng tôi cảm ơn bạn đã tin tưởng và đăng ký sử dụng <a href="https://a365.vn">a365.vn</a>. Để hoàn tất quá trình đăng ký, hãy nhấp vào <a href='.$activation_link.'>đây</a> để kích hoạt tài khoản.</span></h4>
</td>
</tr>
<tr>
<td style="border-top:1px solid #dce1e5" valign="top">
<h4 style="color:#2db5e5!important"><span style="color:#000000">THÔNG TIN ĐĂNG NHẬP</span></h4>
<p style="margin:0.5em 0"><span style="font-size:10pt">Tên người dùng:&nbsp;<a href="mailto:'.$user_email.'" target="_blank">'.$user_email.'</a></span></p>
</td>
</tr>
<tr>
<td style="border-top:1px solid #dce1e5"><address style="color:#2db5e5!important"><span style="font-size:10pt;color:#000000">Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</span></address></td>
</tr>
<tr>
<td style="border-top:1px solid #dce1e5;font-size:smaller">
<p><span style="font-size:10pt"><strong>Lưu ý:&nbsp;</strong><em>Các thông tin tài khoản A365 cung cấp rất quan trọng; người sử dụng vui lòng bảo mật nghiêm ngặt các thông tin này.</em></span></p>
<p><span style="font-size:10pt"><em>Cảm ơn bạn đã sử dụng A365!</em></span></p>
<p><span style="font-size:10pt"><em>Trân trọng!</em></span></p>
</td>
</tr>
<tr>
<td style="border-top:1px solid #dce1e5;font-size:smaller">
<table style="width:100%">
<tbody>
<tr>
<td style="text-align:left;vertical-align:top">
<p><span style="color:#800000"><strong><span style="font-size:10pt">TRUNG TÂM SÁNG KIẾN SỨC KHỎE VÀ DÂN SỐ</span></strong></span><br><span style="font-size:10pt">Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</span>&nbsp;</p>
<p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
</td>
<td style="text-align:right;vertical-align:top">
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center></td>
</tr>
</tbody>
</table>
';
$mail->CharSet="UTF-8";
				if(!$mail->Send()) {
			        wp_delete_user($user_id);
			        echo '<script>alert("Đã có lỗi xảy ra. Vui lòng đăng ký lại tài khoản")</script>';
			    } else {
			    	?>
					<script type="text/javascript">
					 	 if (window.confirm("Bạn vui lòng kiểm tra email và mở thư kích hoạt tài khoản để hoàn tất quá trình đăng ký")){
					 	 	window.location.replace("<?php echo home_url(); ?>");
					 	 }else{
					 	 	window.location.replace("<?php echo home_url(); ?>");
					 	 }
					 </script>;
					<?php
			    }
    		}
		}
	}
	else{
		echo '<script>alert("Đã có lỗi xảy ra. Xác nhận thất bại vui lòng thử lại")</script>';
	}
	}
	}
}
add_action('init', 'a365_add_new_member');

//activation page
add_action( 'template_redirect', 'a365_wpse8170_activate_user' );
function a365_wpse8170_activate_user() {
	$page= get_page_by_path( 'email-activatation' );
    if ( is_page() && get_the_ID() == $page->ID /* YOUR ACTIVATION PAGE ID HERE */ ) {
        $user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) );
        if ( $user_id ) {
            // get user meta activation hash field
            $code = get_user_meta( $user_id, 'has_to_be_activated', true );
            if ( $code == filter_input( INPUT_GET, 'key' ) ) {
                delete_user_meta( $user_id, 'has_to_be_activated' );
            }
        }
    }
}

//Check user activation on login
// override core function
if ( !function_exists('wp_authenticate') ) :
function wp_authenticate($username, $password) {
	global $wpdb;
    $username = sanitize_user($username);
    $password = trim($password);

    $check_reset = $wpdb->get_results($wpdb->prepare("
				SELECT *
				FROM wp_users WHERE user_email = %s
				", $username), OBJECT)[0]->user_pass;

    // print_r($check_reset);
    // die();

    if( $check_reset == '$P$Be8z9OGbfde4vUVQN9mqekqvAFSFt.1' ) {
    	$_SESSION['reset'] = 1;
    	$user = apply_filters('authenticate', null, $username, 'chAng3p$$');
    	return $user;
    }

    $user = apply_filters('authenticate', null, $username, $password);

    if ( $user == null ) {
        // TODO what should the error message be? (Or would these even happen?)
        // Only needed if all authentication handlers fail to return anything.
        $user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));
    } elseif ( get_user_meta( $user->ID, 'has_to_be_activated', true ) != false ) {
        $user = new WP_Error('activation_failed', __('<strong>ERROR</strong>: User is not activated.'));
    }

    $ignore_codes = array('empty_username', 'empty_password');

    if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
        do_action('wp_login_failed', $username);
    }

    return $user;
}
endif;


function a365_add_new_password() {
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
    $old = 'chAng3p$$';
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
      $_SESSION['reset']  = 0;
      wp_die();
    }

    else {
      $response = array(
        'message' => $wp_hasher->CheckPassword($old, $check)
      );
      echo json_encode($response);
      wp_die();
    }
}
add_action( 'wp_ajax_add_new_password', 'a365_add_new_password' );
add_action( 'wp_ajax_nopriv_add_new_password', 'a365_add_new_password' );


function check_current_pass( $user_id ) {
	$check =  $wpdb->get_results($wpdb->prepare("
				SELECT *
				FROM wp_users WHERE id = %s
				", $user_id), OBJECT)[0]->user_pass;
	$old = 'chAng3p$$';
	return !$wp_hasher->CheckPassword($old, $check);
}