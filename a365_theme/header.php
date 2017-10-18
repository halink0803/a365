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
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'a365' ); ?></a>

  <header id="masthead" class="site-header" role="banner">
    <div class="header_new">
                <div class="wrapper">
                    <div class="login_form">
                    <?php if( !is_user_logged_in () ): ?>
                      <ul>
                          <li><a href="<?php echo get_site_url() . '/login'; ?>"><span class="icon_login">Đăng nhập</span></a></li>
                          <li>/</li>
                          <li><a href="/dang-nhap.html" data-mimo="modal:default_modal;"><span class="icon_register">Đăng ký</span></a></li>
                      </ul>

                    <?php  else: ?>
                      <ul>
                          <li>
                              <a href="http://a365.vn/quan-ly-bai-test-tai-khoan.html">
                                  <span class="icon_account">
                                      <?php
                                        $user = wp_get_current_user();
                                        echo $user->display_name;
                                       ?>
                                  </span>
                              </a>
                              <div class="small_menu">
                                  <ul>
                                      <li>
                                          <a href="#">
                                              Tra cứu thông tin trẻ
                                          </a>
                                      </li>
                                      <li>
                                          <a href="<?php ?>">
                                              Sửa tài khoản
                                          </a>
                                      </li>
                                      <li>
                                          <a href="/thay-doi-mat-khau.html">
                                              Thay đổi mật khẩu
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                          </li>
                          <li>
                              /
                          </li>
                          <li>
                              <a href="#">
                                  <span class="icon_noti">
                                      Thông báo
                                      <i>
                                          0
                                      </i>
                                  </span>
                              </a>
                          </li>
                          <li>
                              /
                          </li>
                          <li>
                              <a href="<?php echo wp_logout_url( home_url()); ?>">
                                  <span class="icon_exit">
                                      Thoát
                                  </span>
                              </a>
                          </li>
                      </ul>
                    <?php endif; ?>
                  </div>
                  <div class="logo">
                      <a href="<?php echo home_url( '/' )?>">
                          <img alt="" src="<?php echo get_template_directory_uri() ?>/images/logo.png"/>
                      </a>
                  </div>
                  <div class="menu_container">
                      <nav id="site-navigation" class="main-navigation" role="navigation">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'a365' ); ?></button>
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                      </nav><!-- #site-navigation -->
                  </div>
              </div>
              <div class="txt_signin">
                <div class="mimo_modal" id="default_modal" style="display:none">
                    <h3 class="title_popup">
                        Đăng ký tài khoản
                    </h3>
                    <div class="popup_dangky">
                        <a class="dkchame" href="<?php echo get_site_url() . '/dang-ky-cha-me'; ?>">
                            Cha mẹ/người chăm sóc
                            <em>
                                (Đăng ký vào đây nếu bạn là cha mẹ, ông bà, hoặc người chăm sóc cho trẻ)
                            </em>
                        </a>
                        <a class="dkcanbo" href="<?php echo get_site_url() . '/dang-ky-can-bo'; ?>">
                            Cán bộ chuyên môn
                            <em>
                                (Đăng ký vào đây nếu bạn là cán bộ y tế hay giáo viên)
                            </em>
                        </a>
                        <div class="clear">
                        </div>
                    </div>
                </div>
            </div>
          </div>
  </header><!-- #masthead -->

  <div id="content" class="site-content">
