<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Can Thiệp
 *
 * @package A356
 */
get_header('new'); ?>
<?php the_content(); ?>
<div class="container">
	<div class="row">
				<div class="col-xs-12">
					<div class="can-thiep-textbox">
						<div class="box-title">Giới thiệu chung</div>
						<div class="box-content full-content qh-jumbotron" style="text-align: justify">
						Bố mẹ can thiệp tại nhà đóng vai trò rất quan trọng cho sự tiến bộ của con. Bởi lẽ, bố mẹ là người yêu thương và hiểu con nhất, có nhiều thời gian bên con nhất. Nếu biết cách tận dụng và biến thời gian ở nhà cùng con thành các cơ hội học tập vui vẻ và hiệu quả, bố mẹ không chỉ giúp con học được nhiều hơn, giúp con khái quát hóa các kiến thức ở nhiều nơi như ở trường, ở nhà, mà còn khiến mối quan hệ của bố mẹ và con thêm gắn kết để con luôn thấy mình được yêu thương, để con tự tin rằng mình đang phát triển và lớn lên mỗi ngày. Đó là bệ phóng vững chắc để con mở rộng ra các mối quan hệ với thầy cô và bạn bè, và học hỏi được ở mọi lúc, mọi nơi.
						<a href="#" onClick="show_more();">Xem thêm</a>
						</div>
					</div>
				</div>
	</div>
	<div class="row">
				<div class="col-xs-12 col-md-8">
					<div class="can-thiep-textbox">
						<div class="single-section">
							<div class="box-content">
								Chiến lược can thiệp gồm các nguyên tắc cơ bản cần nắm khi can thiệp tại nhà cho trẻ, có thể sử dụng xuyên suốt trong tất cả bài tập can thiệp
							</div>
							<div class="row">
								<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-6 pd-t15">
									<a href="<?php echo get_site_url().'/chien-luoc-can-thiep' ?>" class="qh-btn qh-btn-cblue qh-btn-lg btn-block text-uppercase">Xem chiến lược can thiệp</a>
								</div>
							</div>
						</div>
						<hr>
						<div class="single-section">
							<div class="box-content">
								<i class="c-red">Bạn cần đăng nhập và đăng ký trẻ tự kỷ hoặc chậm phát triển để sử dụng miễn phí các chức năng bên dưới.</i>
							</div>
							<div class="row pd-t20">
								<div class="col-xs-12 col-sm-6">
									Hướng dẫn can thiệp tại nhà cho trẻ với video minh họa cho từng kỹ năng cụ thể
								</div>
								<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 pd-t5">
									<a href="<?php echo get_site_url().'/bai-tap-can-thiep' ?>" class="qh-btn qh-btn-cblue qh-btn-lg btn-block text-uppercase">Xem bài tập can thiệp</a>
								</div>
							</div>
							<div class="row pd-t20">
								<div class="col-xs-12 col-sm-6">
									Làm bài ATEC để đánh giá tổng thể tình trạng của trẻ
								</div>
								<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 pd-t5">
									<a href="<?php echo get_site_url().'/atec' ?>" class="qh-btn qh-btn-cblue qh-btn-lg btn-block text-uppercase">Đánh giá tổng thể</a>
								</div>
							</div>
							<div class="row pd-t20">
								<div class="col-xs-12 col-sm-6">
									Theo dõi sự tiến bộ của trẻ trong quá trình can thiệp
								</div>
								<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 pd-t5">
									<a href="<?php echo get_site_url().'/theo-doi-hieu-qua-can-thiep' ?>" class="qh-btn qh-btn-cblue qh-btn-lg btn-block text-uppercase">Theo dõi can thiệp</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<div class="embed-responsive embed-responsive-16by9 mg-t45">
						<?php dynamic_sidebar( 'intervent-video' ); ?>
					</div>
					<div class="can-thiep-textbox mg-t15">
						<?php dynamic_sidebar( 'testimonial' ); ?>
					</div>
				</div>
	</div>
	<div class="mg-t30 pd-t15 c-grey-l20">
		<i>Các nội dung được cung cấp trên trang A365.vn có mục đích hỗ trợ phát hiện sớm và can thiệp sớm, và không thay thế cho công tác chẩn đoán cũng như chương trình can thiệp do các nhà chuyên môn thực hiện.</i>
	</div>
</div>
	<!-- <div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="can-thiep-textbox">
				<div class="box-title">Chiến lược can thiệp</div>
				<ul class="list-check-desc list-unstyled">
					<li><i class="fa fa-check"></i>Các nguyên tắc cơ bản cần nắm được khi can thiệp tại nhà cho trẻ</li>
					<li><i class="fa fa-check"></i>Có thể sử dụng xuyên suốt trong tất cả các bài tập can thiệp</li>
				</ul>
				<div class="box-footer text-center">
					<a href="<?php //echo get_site_url().'/chien-luoc-can-thiep' ?>" class="qh-btn qh-btn-cblue qh-btn-lg text-uppercase">Xem chiến lược can thiệp</a>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="can-thiep-textbox">
				<div class="box-title">Bài tập can thiệp</div>
				<ul class="list-check-desc list-unstyled">
					<li><i class="fa fa-check"></i>Hướng dẫn can thiệp tại nhà cho trẻ với video minh họa cho từng kĩ năng cụ thể</li>
					<li><i class="fa fa-check"></i>Đánh giá tình trạng tổng thể và theo dõi sự tiến bộ của trẻ</li>
					<li><i class="fa fa-check"></i>Bạn cần tạo tài khoản trên a365.vn để xem các bài can thiệp</li>
				</ul>
				<div class="box-footer text-center">
					<a href="<?php //echo get_site_url().'/bai-tap-can-thiep' ?>" class="qh-btn qh-btn-cblue qh-btn-lg text-uppercase">Làm bài tập can thiệp</a>
				</div>
			</div>
		</div>
	</div> -->
</div>
<?php get_footer('new'); ?>
<script type="text/javascript">
	var $=jQuery.noConflict();

		function show_more() {
			$(".full-content").html(
				"Bố mẹ can thiệp tại nhà đóng vai trò rất quan trọng cho sự tiến bộ của con. Bởi lẽ, bố mẹ là người yêu thương và hiểu con nhất, có nhiều thời gian bên con nhất. Nếu biết cách tận dụng và biến thời gian ở nhà cùng con thành các cơ hội học tập vui vẻ và hiệu quả, bố mẹ không chỉ giúp con học được nhiều hơn, giúp con khái quát hóa các kiến thức ở nhiều nơi như ở trường, ở nhà, mà còn khiến mối quan hệ của bố mẹ và con thêm gắn kết để con luôn thấy mình được yêu thương, để con tự tin rằng mình đang phát triển và lớn lên mỗi ngày. Đó là bệ phóng vững chắc để con mở rộng ra các mối quan hệ với thầy cô và bạn bè, và học hỏi được ở mọi lúc, mọi nơi.<br><br>Phần can thiệp tại nhà của A365 gồm 4 mục chính: (i) Chiến lược can thiệp chung; (ii) Bài tập can thiệp; (iii) Theo dõi hiệu quả can thiệp; (iiii) Đánh giá toàn diện sự phát triển của trẻ. Trong đó:<br><p><li><b>Chiến lược can thiệp</b> là những nguyên tắc, những phương pháp hay những cách thức chung nhất và rất hiệu quả để dạy cho trẻ, bao gồm: 1) Làm theo và tham gia cùng trẻ; 2) Giữ mặt bạn ngang tầm nhìn của trẻ; 3) Giữ ngôn ngữ thật ngắn gọn; 4) Bắt chước; 5) Chờ/ làm theo lượt; (6) Đưa ra lựa chọn và (7) Sắp đặt môi trường sống. Các nguyên tắc này nên được lồng vào khi bố mẹ thực hành các bài tập để giúp con tiếp thu hiệu quả hơn. Do đó, bố mẹ nên xem các bài về chiến lược can thiệp trước khi làm các bài tập cụ thể, và sau mỗi bài tập có thể tự xem lại để biết trong tương tác với con hôm nay, liệu có chiến lược nào có thể áp dụng để giúp con học tốt hơn không. Các bài về chiến lược can thiệp này thỉnh thoảng cũng nên được xem lại để bố mẹ có thể hiểu thêm và áp dụng vào từng bài tập cụ thể, và tốt nhất là bố mẹ có thể luyện để đưa các chiến lược này thành thói quen trong tương tác của bố mẹ với các con.</li></p><p><li><b>Bài tập can thiệp:</b> chia thành nhiều lĩnh vực: chơi mà học, tự chăm sóc bản thân, hòa nhập cộng đồng, v.v, với nhiều bài tập ở các mức độ khác nhau. Với mỗi lĩnh vực, các bài tập được thiết kế từ dễ đến khó. Ở mỗi thời điểm, bố mẹ nên can thiệp ở tất cả các lĩnh vực, vì con cần một sự phát triển toàn diện. Các lĩnh vực phát triển của con cũng liên quan tới nhau, vì vậy chỉ khi đẩy tất cả lĩnh vực cùng đi lên thì hiệu quả can thiệp mới được tối ưu. Ở mỗi lĩnh vực, bố mẹ chỉ nên tập trung một đến hai bài tập đang ở mức độ của con và đẩy lên một chút để giúp con tiến bộ. Khi con đã đạt được bài tập đó (tức là con có thể tự làm được ít nhất 80% hoạt động của bài tập mà không cần hỗ trợ), bố mẹ có thể tiến lên bài tập ở mức độ cao hơn.</li></p><p><li><b>Theo dõi hiệu quả can thiệp:</b> Sau khi chọn được các bài tập để thực hiện với con, bố mẹ nên làm theo dõi hiệu quả can thiệp để đánh giá xem tiến độ thực hiện có tốt không và điều chỉnh cách thực hiện khi cần thiết. Việc đánh giá cũng cho biết khi nào thì con đã đạt mục tiêu của bài tập và có thể chuyển sang mức độ bài tập khó hơn.</li></p><p><li><b>Đánh giá toàn diện tình trạng trẻ:</b> Bảng kiểm đánh giá can thiệp tự kỷ (ATEC) do Bernard Rimland và Stephen M. Edelson của Viện nghiên cứu tự kỷ (Autism Research Institute) phát triển, cho phép cha mẹ và cán bộ chuyên  môn tự làm để theo dõi sự thay đổi toàn diện của trẻ trong quá trình can thiệp. Bộ bảng kiểm này có 66 câu, ở 4 lĩnh vực khác nhau. Bạn nên làm bài đánh giá này trước khi can thiệp và ít nhất cứ mỗi 6 tháng để có góc nhìn tổng thể về tình trạng trẻ và hỗ trợ việc đặt mục tiêu và chọn bài học trong can thiệp cho con tại nhà.</li></p>Chúng tôi hy vọng rằng, với những hướng dẫn trên đây, bố mẹ sẽ tận dụng tốt những nguồn lực, thông tin mà a365 chia sẻ để giúp con phát triển tốt! <a href='#' onClick='show_less();'>Thu gọn</a>"
				);
		};

		function show_less() {
			$(".full-content").html(
				"Bố mẹ can thiệp tại nhà đóng vai trò rất quan trọng cho sự tiến bộ của con. Bởi lẽ, bố mẹ là người yêu thương và hiểu con nhất, có nhiều thời gian bên con nhất. Nếu biết cách tận dụng và biến thời gian ở nhà cùng con thành các cơ hội học tập vui vẻ và hiệu quả, bố mẹ không chỉ giúp con học được nhiều hơn, giúp con khái quát hóa các kiến thức ở nhiều nơi như ở trường, ở nhà, mà còn khiến mối quan hệ của bố mẹ và con thêm gắn kết để con luôn thấy mình được yêu thương, để con tự tin rằng mình đang phát triển và lớn lên mỗi ngày. Đó là bệ phóng vững chắc để con mở rộng ra các mối quan hệ với thầy cô và bạn bè, và học hỏi được ở mọi lúc, mọi nơi. <a href='#' onClick='show_more();'>Xem thêm</a>"
				);
		};
</script>