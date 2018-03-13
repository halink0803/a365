<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * A365 Core functions
 *
 **/
function formatDate($date) {
	if (count(split(" ", $date)) > 1 ) {
		$part = explode("-", split(" ", $date)[0]);
    	return $part[2].'-'.$part[1].'-'.$part[0];
	}
	$part = explode("-", $date);
    return $part[2].'-'.$part[1].'-'.$part[0];
}

function noToNameDiagnose($no) {
	switch ($no) {
		case 1:
			return "Bác sỹ chuyên khoa Nhi";
			break;
		case 2:
			return "Bác sỹ đa khoa";
			break;
		case 3:
			return "Cán bộ tâm lý";
			break;
		case 4:
			return "Bác sỹ chuyên ngành khác";
			break;
		case 5:
			return "Y tá/ Điều dưỡng";
			break;
		case 6:
			return "Giáo viên mầm non";
			break;
		case 7:
			return "Giáo viên Giáo dục đặc biệt";
			break;
		case 8:
			return "Khác";
			break;
		default:
			return "Không xác định";
			break;
	}
}

function session_init() {
	if (!session_id()) {
		session_start();
	}
}
add_action( 'init', 'session_init' );

function a365_session_destroy() {
	session_unset();
	session_destroy();
}
add_action('wp_logout', 'a365_session_destroy');
// function destroy_session() {
// 	header( 'Cache-Control: no-cache, no-store, must-revalidate' );
//     header( 'Pragma: no-cache' );
//     header( 'Expires: 0' );
// 	session_destroy();
// 	$sessions->destroy_all();
// }
// add_action( 'wp_ajax_destroy_session', 'destroy_session' );
// add_action( 'wp_ajax_nopriv_destroy_session', 'destroy_session' );

