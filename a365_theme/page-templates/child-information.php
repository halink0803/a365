<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Children Information
 */

get_header('new');
// $children = a365_get_children();
$user = a365_get_current_user();

$query             = "SELECT * FROM a365_children WHERE creator_id = $user->id and active = 1";
$total_query     = "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total             = $wpdb->get_var( $total_query );
$items_per_page = isset( $_GET['amount'] ) ? abs( (int) $_GET['amount'] ) : 5;
$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset         = ( $page * $items_per_page ) - $items_per_page;
$children         = $wpdb->get_results( $query . " ORDER BY created_at DESC LIMIT ${offset}, ${items_per_page}" );
// print_r($children);
$totalPage         = ceil($total / $items_per_page);
?>

<div id="siteContent">
	<div class="container">
		<div class="qh-page-header">Thông tin trẻ</div>
		<div class="children-info-page-header clearfix">
			<div class="pull-left">
				<?php $pages = get_pages(array(
			          'meta_key' => '_wp_page_template',
			          'meta_value' => 'page-templates/register-child.php'
			      )); ?>
				<a href="<?php echo home_url($pages[0]->post_name) ?>" class="qh-btn qh-btn-lg qh-btn-blue text-uppercase">Đăng ký trẻ mới</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="children-list-table">
					<div class="table-responsive">
						<table class="table">
						 	<thead>
						 		<tr>
						 			<th class="child-checkbox"></th>
							 		<th class="child-name">Họ tên</th>
							 		<th class="child-dob">Ngày sinh</th>
							 		<th class="child-sex">Giới tính</th>
						 		</tr>
						 		<tr class="search-row">
						 			<th></th>
						 			<th><input type="text" class="search-input hidden" placeholder="Tìm tên"></th>
						 			<th><input type="text" class="search-input hidden" placeholder="Tìm ngày sinh"></th>
						 			<th></th>
						 		</tr>
						 	</thead>
						 	<tbody>

						 		<?php if(count($children) > 0) : ?>
							 		<?php foreach($children as $index => $child) : ?>
							 		<tr id="<?=$child->id?>">
						 				<td class="child-checkbox"><label class="row-data"><input type="radio" name="child" value="<?php echo $child->id ?>" id="checkbox<?php echo $index ?>"></label></td>
										<td class="child-name"><label class="row-data" for="checkbox<?php echo $index ?>"><?php echo $child->name; ?></label></td>
										<td class="child-dob"><label class="row-data" for="checkbox<?php echo $index ?>"><?php echo $child->date_of_birth; ?></label></td>
										<td class="child-sex"><label class="row-data" for="checkbox<?php echo $index ?>"><?php echo $child->sex ?></label></td>
										<?php
											$pages = get_pages(array(
										        'meta_key' => '_wp_page_template',
										        'meta_value' => 'page-templates/edit-child-information.php'
										    ));
										?>
										<td class="child-sex"><label class="row-data" for="checkbox<?php echo $index ?>"><a style="color:#3f3f3f;" href="#" data-target="#modalDeleteChild" data-toggle="modal" disabled><i class="fa fa-close c-red"></i> Xóa</a></label></td>
										<td class="child-sex"><label class="row-data" for="checkbox<?php echo $index ?>"><a style="color:#3f3f3f;" href="<?php echo home_url($pages[0]->post_name) ?>" disabled><i class="fa fa-cog c-blue"></i> Sửa</a></label></td>
							 		</tr>
							 		<?php endforeach; ?>
								<?php endif; ?>
						 	</tbody>
						</table>
					</div>
					<?php if(count($children) == 0) : ?>
						<div class="list-empty-notify text-center">Hiện chưa có trẻ nào trong danh sách. Vui lòng ấn đăng ký mới để bắt đầu.</div>
					<?php endif; ?>
					<?php if(count($children) > 0) : ?>
						<div class="qh-pagination text-right mg-b0">
							<ul class="list-unstyled">
								<li class="mg-r10">
									<span class="text-inline">Hiển thị</span>
									<select id="number_per_page" class="iblock">
										<option value="5" <?php if($items_per_page == 5) echo 'selected'; ?> >5</option>
										<option value="10" <?php if($items_per_page == 10) echo 'selected'; ?> >10</option>
										<option value="15" <?php if($items_per_page == 15) echo 'selected'; ?> >15</option>
										<option value="20" <?php if($items_per_page == 20) echo 'selected'; ?> >20</option>
									</select>
									<span class="text-inline">kết quả/trang. Trang <?php echo $page ?>/<?php echo $totalPage ?></span>
								</li>
									<?php
										global $wp;
										$current_url = home_url(add_query_arg(array(),$wp->request));
									?>
									<?php if($totalPage > 1 && $page > 1) : ?>
										<li><a href="<?php echo $current_url . '?cpage=' . ($page - 1) ?>" class="has-border"><i class="fa fa-angle-left"></i></a></li>
									<?php endif; ?>
									<?php if($page <  $totalPage) : ?>
										<li><a href="<?php echo $current_url . '?cpage=' . ($page + 1) ?>" class="has-border"><i class="fa fa-angle-right"></i></a></li>
									<?php endif;?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php if( $user->type == "Cán bộ y tế" ) : ?>
		<div class="children-action-box">
			<div class="triangle"></div>
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
					<div class="action-btn-group">
						<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/asq.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width" disabled>Làm bài theo dõi phát triển (ASQ®)</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/M-ChatR.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width" disabled>Làm bài sàng lọc tự kỷ (MCHAT)</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/history.php'
							    ));
							?>
							<a href="#child-history-rows" class="action-single qh-btn qh-btn-cblue full-width history" disabled>Xem lịch sử các bài làm</a>
					</div>
				</div>
			</div>
		</div>
		<?php else: ?>
			<div class="children-action-box">
				<div class="triangle"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-1">
						<div class="action-title">Sàng lọc</div>
						<div class="action-btn-group">
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/asq.php'
							    ));
							?>
							<a href="<?php echo $pages[0]->guid ?>" class="action-single qh-btn qh-btn-cblue full-width" disabled>Làm bài theo dõi phát triển (ASQ®)</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/M-ChatR.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width" disabled=>Làm bài sàng lọc tự kỷ (MCHAT)</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/history.php'
							    ));
							?>
							<a href="#child-history-rows" class="action-single qh-btn qh-btn-cblue full-width history" disabled>Xem lịch sử các bài làm</a>
						</div>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-5">
						<div class="action-title">Can thiệp</div>
						<div class="action-btn-group">
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/edit-child-status.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width" disabled>Cập nhật tình trạng chẩn đoán</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/atec.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width tuky" disabled>Đánh giá tình trạng của con</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/intervent-exe.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width tuky" disabled>Xem bài tập can thiệp</a>
							<?php
								$pages = get_pages(array(
							        'meta_key' => '_wp_page_template',
							        'meta_value' => 'page-templates/intervent-subscription.php'
							    ));
							?>
							<a href="<?php echo home_url($pages[0]->post_name) ?>" class="action-single qh-btn qh-btn-cblue full-width tuky" disabled>Theo dõi từng kĩ năng cụ thể của trẻ</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div id="child-history-rows" class="child-history row hidden">
			<div class="col-md-9 col-lg-10">
				<div class="children-list-table">
					<div>
						<table class="display" id="test-table" cellspacing="0" width="100%">
						 	<thead>
						 		<tr>
						 			<th>Chọn</th>
							 		<th>Ngày làm bài</th>
							 		<th>Bài sàng lọc</th>
							 		<th>Trạng thái</th>
						 		</tr>
						 	</thead>
						 	<tfoot>
						 		<tr>
							 		<th>Tìm</th>
								 	<th class="xxx">Ngày làm bài</th>
								 	<th class="xxx">Bài sàng lọc</th>
								 	<th class="xxx">Trạng thái</th>
						 		</tr>
						 	</tfoot>
						 	<tbody>
								<!-- History Content -->
						 	</tbody>
						</table>
					</div>

				</div>
			</div>
			<div class="col-md-3 col-lg-2">
				<div class="history-action child-action-wrap hidden">
					<div class="hidden">
						<!-- ASQ -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-asq-result.php'
						    ));
						?>
						<div class="asq-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>

						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/asq-continue.php'
						    ));
						?>
						<div class="asq-continue-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>

						<!--  MCHAT R -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/M-ChatR-Result.php'
						    ));
						?>
						<div class="mchatr-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/m-chat-rf-result.php'
						    ));
						?>
						<div class="mchatrf-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<!-- QOL -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-qol-result.php'
						    ));
						?>
						<div class="qol-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/qol-continue.php'
						    ));
						?>
						<div class="qol-continue-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<!-- ATEC -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-atec-result.php'
						    ));
						?>
						<div class="atec-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/atec-continue.php'
						    ));
						?>
						<div class="atec-continue-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>

						<!-- GUMSUE -->
						<?php
							$pages = get_pages(array(
						        'meta_key' => '_wp_page_template',
						        'meta_value' => 'page-templates/review-gumsue-result.php'
						    ));
						?>
						<div class="gumsue-result-link" link="<?php echo home_url($pages[0]->post_name) ?>"></div>
					</div>
					<!-- <div class="single-action"><a href="#"><i class="fa fa-file-text-o c-blue"></i> Xem bài làm</a></div> -->
					<div class="single-action"><a href="#" class="view-result"><i class="fa fa-calendar-check-o c-blue"></i> Xem kết quả</a></div>
					<div class="single-action"><a href="#" class="disabled continue-test" id="lamtiep"><i class="fa fa-pencil-square-o c-blue"></i> Làm tiếp</a></div>
					<!-- <div class="single-action"><a href="#"><i class="fa fa-print c-blue"></i> In</a></div> -->
					<div class="single-action"><a href="#" data-target="#deleteHistory" data-toggle="modal"><i class="fa fa-close c-red"></i> Xóa</a></div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalDeleteChild" tabindex="-1">
      <div class="modal-dialog modal-sm" role="document">
        <div class="qh-modal-content">
          <div class="qh-modal-body">
            <p>Bạn có chắc chắn muốn xóa thông tin trẻ?</p>
          </div>
          <div class="qh-modal-footer">
          	<a href="#" class="pull-left" data-dismiss="modal">Hủy bỏ</a>
          	<a href="#" class="pull-right deleteChild">Đồng ý</a>
          	<span class="clearfix"></span>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteHistory" tabindex="-1">
      <div class="modal-dialog modal-sm" role="document">
        <div class="qh-modal-content">
          <div class="qh-modal-body">
            <p>Bạn có chắc chắn muốn xóa kết quả bài làm?</p>
          </div>
          <div class="qh-modal-footer">
          	<a href="#" class="pull-left" data-dismiss="modal">Hủy bỏ</a>
          	<a href="#" class="pull-right deleteHistory">Đồng ý</a>
          	<span class="clearfix"></span>
          </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
	var $=jQuery.noConflict();
	$(document).ready(function(){
		// check login
		var user_id = "<?=a365_get_current_user_id() ?>" ;
		//console.log('type of user id: ' + typeof(user_id));
	  	//console.log(user_id);
	  	var login = 1;
	  	if (user_id == 0){
	    	login = 0;
	    	//console.log("login1"+login);
	  	}

	  	if (login == 0) {
	  		$("#modalSignIn").modal({
		  		backdrop: 'static',
		  		keyboard: false
			});
	  	}
  	})
</script>
<?php
	get_footer('new');
?>