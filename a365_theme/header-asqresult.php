<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 *
 * @package A365
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/style.css" ?>" />
        <!--- JS -->
<!--     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script> -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri()."/js/jquery-1.9.1.min.js" ?>"></script>
</head>
<body>

