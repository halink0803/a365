<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A365
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" type="image/x-icon" rel="icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68148284-1', 'auto');
  ga('send', 'pageview');

</script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/owl.carousel.css" ?>">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/font-awesome.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()."/css/main.css" ?>">
<link rel="shortcut icon" sizes="16x16" href="<?php echo get_template_directory_uri().'/images/shortcut.png' ?>">
  <style type="text/css">
    .exit_test,
    .save_test {
      position: fixed;
      bottom: 10px;
      right: 10px;
      z-index: 5
    }
    .exit_test,
    .save_test {
        top: 120px;
        right: 0
    }
    .exit_test {
        height: 33px
    }
    .no-copy {
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
  </style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
<header id="siteHeader">
    <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" aria-controls="primary-menu" data-target="#siteNavbarCollapse"><i class="fa fa-lg"></i></button>
          <h1 class="header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-cover">A365</a></h1>
      </div>
      <div class="collapse navbar-collapse" id="siteNavbarCollapse">
        <div class="header-menu clearfix">
          <ul class="user-menu">
            <?php if(!is_user_logged_in()) : ?>
              <li><a href="#"  data-toggle="modal" data-target="#modalSignIn">Đăng nhập</a></li>
              <li><a href="#"  data-toggle="modal" data-target="#modalSignUp2">Ðăng ký</a></li>
            <?php else :
            $current_user = wp_get_current_user();
            $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-templates/child-information.php'
            ));

            $user_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-templates/user-information.php'
            ));

            $pass_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-templates/change-password.php'
            ));
            ?>
            <li><a href="<?php echo esc_url( home_url( $pages[0]->post_name ) ) ?>"><i class="fa fa-user"></i>Xin chào <?php echo $current_user->display_name ?></a>
              <ul>
                <li><a href="<?php echo esc_url( home_url( $pages[0]->post_name ) ) ?>">Quản lý trẻ</a></li>
                <li><a href="<?php echo esc_url( home_url( $user_pages[0]->post_name ) ) ?>">Quản lý tài khoản</a>
                <li><a href="<?php echo esc_url( home_url( $pass_pages[0]->post_name ) ) ?>">Thay đổi mật khẩu</a>
                </li>
              </ul>
            </li>
            <li><a class="logout" href="<?php  echo wp_logout_url( home_url() ); ?>" >Thoát</a></li>
            <?php endif; ?>
          </ul>
          <?php wp_nav_menu( array( 
            'theme_location' => 'primary', 
            'menu_class' => 'main-menu',
            'container' => '' 
          ) ); ?>
        </div>
      </div>
  
    </div>
    
	</header><!-- #masthead -->

  <div id="siteContent">
