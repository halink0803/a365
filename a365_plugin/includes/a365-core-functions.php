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

