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
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/bootstrap.min.css" ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/sb-admin.css" ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/morris.css" ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/select.dataTables.min.css" ?>" />
        
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/jquery.dataTables.min.css" ?>">
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/buttons.dataTables.min.css" ?>">
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri()."/css/admin_css/dataTables.colVis.css" ?>">
 	<link rel="stylesheet" href="<?php echo get_template_directory_uri()."/css/admin_css/style.css" ?>"> 
	<link rel="stylesheet" href="<?php echo get_template_directory_uri()."/css/admin_css/tabcontent.css" ?>"><style>
		.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url('<?php echo get_template_directory_uri()."/images/page-loader.gif" ?>') 50% 50% no-repeat rgb(249,249,249);
		}
	</style> 

	<!--- JS -->
	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/admin_js/jquery-1.12.3.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/jquery.dataTables.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/dataTables.buttons.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/buttons.flash.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/jszip.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/pdfmake.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/vfs_fonts.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/buttons.html5.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/buttons.print.min.js" ?>"></script>

	<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/dataTables.select.min.js" ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri()."/js/admin_js/buttons.colVis.min.js" ?>"></script>

    <script src="<?php echo get_template_directory_uri()."/js/admin_js/jquery-ui.js" ?>"></script>   
    <script src="<?php echo get_template_directory_uri()."/js/admin_js/script.js" ?>"></script>
    <script src="<?php echo get_template_directory_uri()."/js/admin_js/bootstrap.min.js" ?>"></script> 
   	<script src="<?php echo get_template_directory_uri()."/js/admin_js/tabcontent.js" ?>"></script>
   	<script src="<?php echo get_template_directory_uri()."/js/admin_js/dataTables.colVis.js" ?>"></script>      
   	<script type="text/javascript">
		$(window).load(function() {
			$(".loader").fadeOut("fast");
		})
		function gettime()
		{
		    var date = new Date();
		    //var newdate = (date.getHours() % 12 || 12) + "_" + date.getMinutes() + "_" + date.getSeconds();
		    //setInterval(gettime, 1000);
		    return date.toString().substring(0, 22).replace(/\s/g, "_");
		}
	</script>

</head>
<body>