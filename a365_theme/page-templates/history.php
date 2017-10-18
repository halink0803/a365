<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Template Name: History
 * 
 */
get_header('new');
$history = a365_get_children_history();
print_r($history);
?>

<div class="child-history row">
			<div class="col-md-9 col-lg-10">
				<div class="children-list-table">
					<div class="table-responsive">
						<table class="table">
						 	<thead>
						 		<tr>
						 			<th class="child-checkbox"></th> 
							 		<th class="child-test-date">Ngày làm bài</th> 
							 		<th class="child-test-type">Bài sàng lọc</th> 
							 		<th class="child-test-status">Trạng thái</th> 
						 		</tr>
						 	</thead>
						 	<tbody>
						 		<?php foreach($history as $index => $his) : ?>
								 	<tr>
							 			<td class="child-checkbox"><label class="row-data"><input type="radio" name="history" id="checkbox<?php echo $index ?>"></label></td>
									 	<td class="child-test-date"><label class="row-data" for="checkbox<?php echo $index ?>"><?php echo $his->begin_at?></label></td>
									 	<td class="child-test-type"><label class="row-data" for="checkbox<?php echo $index ?>"><?php 
									 		if( $his->type == 'asq' ) {
									 			echo 'ASQ';
									 		} else if( $his->type == 'mchatr' ) {
									 			echo 'M-CHAT R';
									 		} else if( $his->type == 'mchatrf' ) {
									 			echo 'M-CHAT R/F';
									 		}
									 	?></label></td>
									 	<td class="child-test-status"><label class="row-data" for="checkbox<?php echo $index ?>"><?php
									 		if(!empty($his->end_at)) {
									 			echo 'Đã hoàn thành';
									 		} else {
									 			echo 'Chưa hoàn thành';
									 		}
									 	?></label></td>
								 	</tr>
							 	<?php endforeach; ?>
						 	</tbody>
						</table>
					</div>
					<div class="qh-pagination text-right">
						<ul class="list-unstyled">
							<li class="mg-r10">
								<span class="text-inline">Hiển thị</span>
								<select class="iblock">
									<option value="">5</option>
									<option value="">10</option>
									<option value="">15</option>
									<option value="">20</option>
								</select>
								<span class="text-inline">kết quả/trang. Trang 1/99</span>
							</li>
							<li><a href="#" class="has-border"><i class="fa fa-angle-left"></i></a></li>
							<li><a href="#" class="has-border"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-lg-2">
				<div class="child-action-wrap">
					<div class="single-action"><a href="#"><i class="fa fa-file-text-o c-blue"></i> Xem bài làm</a></div>
					<div class="single-action"><a href="#"><i class="fa fa-calendar-check-o c-blue"></i> Xem kết quả</a></div>
					<div class="single-action"><a href="#" class="disabled"><i class="fa fa-pencil-square-o c-blue"></i> Làm tiếp</a></div>
					<div class="single-action"><a href="#"><i class="fa fa-print c-blue"></i> In</a></div>
					<div class="single-action"><a href="#" data-target="#modalDeleteChild" data-toggle="modal"><i class="fa fa-close c-red"></i> Xóa</a></div>
				</div>
			</div>
		</div>

<?php get_footer('new') ?>