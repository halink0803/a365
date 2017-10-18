<?php
/*
 * Plugin Name: A365
 * Description: Plugin quản lý câu hỏi
 * Version: 1.0
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: a365
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Hugh Lashbrooke
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-a365.php' );
require_once( 'includes/class-a365-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-a365-admin-api.php' );
require_once( 'includes/lib/class-a365-post-type.php' );
require_once( 'includes/lib/class-a365-taxonomy.php' );

//Main functions
require_once( 'includes/a365-core-functions.php' );
require_once( 'includes/a365-asq-functions.php' );
require_once( 'includes/a365-mchatr-functions.php');
require_once( 'includes/a365-user-functions.php' );
require_once( 'includes/a365-qol-functions.php' );
require_once( 'includes/a365-atec-functions.php' );
require_once( 'includes/a365-user-registration-functions.php' );
require_once( 'includes/a365-mchatrf-functions.php' );
require_once( 'includes/a365-baitapcanthiep-functions.php' );
require_once( 'includes/a365-theodoihieuqua-functions.php' );
require_once( 'includes/a365-mailer-functions.php' );
/**
 * Returns the main instance of A365 to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object A365
 */
function A365 () {
  $hello = "Hi";
	$instance = A365::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = A365_Settings::instance( $instance );
	}

	return $instance;
}

A365();
