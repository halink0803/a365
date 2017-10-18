<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Sàng Lọc
 *
 * @package A356
 */
get_header('new');
the_content();
?>
<div class="container">
	<div class="qh-jumbotron has-triangle-bottom">
		<p><b>Hai bộ công cụ được sử dụng để sàng lọc phát triển và tự kỷ </b></p>
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-2 text-right-sm">
				<p><a href="<?php echo get_site_url().'/sang-loc/?ASQ=1' ?>"><b>ASQ</b></a></p>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-10">
				<p>Theo dõi sự phát triển toàn diện của trẻ từ 9-48 tháng tuổi ở 5 lĩnh vực: Giao tiếp, Vận động tinh, Vận động thô, Cá nhân - Xã hội, Giải quyết vấn đề</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-2 text-right-sm">
				<p><a href="<?php echo get_site_url().'/sang-loc?MChat=1' ?>"><b>M-CHAT</b></a></p>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-10">
				<p>Sàng lọc nguy cơ tự kỷ cho trẻ từ 16 – 48 tháng. </p>
			</div>
		</div>
		<div class="triangle"></div>
	</div>
	
	<?php if(!is_user_logged_in()) : ?>

	<h2 class="text-center c-red fw800">Tại sao bạn nên đăng nhập khi làm bài sàng lọc?</h2>
	<div class="sang-loc-info-wrap">
		<div class="single-row clearfix">
			<div class="single-col"></div>
			<div class="single-col text-center fz18 fw800 c-red">Người dùng không đăng nhập</div>
			<div class="single-col text-center fz18 fw800 c-green">Người dùng có tài khoản</div>
		</div>
		<div class="single-row clearfix">
			<div class="single-col fw700 text-right">Làm bài sàng lọc cho trẻ</div>
			<div class="single-col text-center c-green"><i class="fa fa-check fa-lg"></i></div>
			<div class="single-col text-center c-green"><i class="fa fa-check fa-lg"></i></div>
		</div>
		<div class="single-row clearfix">
			<div class="single-col fw700 text-right">In và gửi kết quả sau khi hoàn thành</div>
			<div class="single-col text-center c-green"><i class="fa fa-check fa-lg"></i></div>
			<div class="single-col text-center c-green"><i class="fa fa-check fa-lg"></i></div>
		</div>
		<div class="single-row clearfix">
			<div class="single-col fw700 text-right">Lưu lại thông tin để sàng lọc nhiều lần</div>
			<div class="single-col"></div>
			<div class="single-col text-center c-green"><i class="fa fa-check fa-lg"></i></div>
		</div>
		<div class="single-row clearfix">
			<div class="single-col fw700 text-right">Quản lý thông tin nhiều trẻ một lúc</div>
			<div class="single-col"></div>
			<div class="single-col text-center c-green"><i class="fa fa-check fa-lg"></i></div>
		</div>
		<div class="single-row clearfix bgc-white mg-t10">
			<div class="single-col"></div>
				<div class="single-col text-center">
					<a class="qh-btn qh-btn-cblue qh-btn-lg text-uppercase fw800 noLogin">Làm bài sàng lọc</a>
					<div class="mg-t5 c-blue"><b><i>(Không cần đăng nhập)</i></b></div>
				</div>
				<div class="single-col text-center">
				<a href="#" class="qh-btn qh-btn-cblue qh-btn-lg text-uppercase fw800" data-toggle="modal" data-target="#modalSignUp2">Đăng ký miễn phí</a>
				<div class="mg-t5 c-blue"><b><i>(Làm sàng lọc và theo dõi trẻ)</i></b></div>
				</div>
		</div>
	</div>
	<?php else : ?>
	<div class="sang-loc-info-wrap">
		<?php $pages = get_pages(array(
		          'meta_key' => '_wp_page_template',
		          'meta_value' => 'page-templates/child-information.php'
		)); ?>
		<div class="single-col text-center">
			<a href="<?php echo home_url( $pages[0]->post_name ) ?>" class="qh-btn qh-btn-cblue qh-btn-lg text-uppercase fw800">Làm bài sàng lọc</a>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php get_footer('new'); ?>