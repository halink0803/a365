<?php 
$panel_list = $instance['panel'] ? $instance['panel'] : '';
$tag_title = $instance['tag_title'] ? $instance['tag_title'] : '';
?>
<div class="qh-page-header">
	<?php  
		$title = substr(get_the_title(),10);
		$title[0] = strtoupper($title[0]);
		echo $title;
	?>	
</div>
<div class="qh-jumbotron mg-b15">
  <p>* Số lần con làm theo = Số lần con cố gắng làm theo cha/mẹ thực hiện hoạt động, có thể thành công hoặc không.</p>
  <p>**Mức độ hỗ trợ con: 1 = Trẻ tự làm độc lập (không cần trợ giúp), 2 = Gợi ý bằng cử chỉ, 3 = Gợi ý bằng lời nói, 4 = Gợi ý hoàn toàn.</p>
  <p>*** Số lần trẻ thực hiện hoạt động thành công = Số lần trẻ hoàn thành hoạt động đó một cách thành công, có thể có hoặc không có hỗ trợ của cha mẹ</p>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-6 mg-t10 mg-b10">
    <div class="child-month fw700 c-red text-uppercase">
      <?php 
      	echo $tag_title;
      ?>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 mg-t10 mg-b10 text-right-sm">Ngày làm: <?php echo date('d-m-Y') ?></div>
</div>
<div class="test-tab-container">
	<?php $pages = get_pages(array(
			          'meta_key' => '_wp_page_template',
			          'meta_value' => 'page-templates/subscription-exe-result.php'
			)); ?> 
	<form accept-charset="utf-8" action="../<?php echo $pages[0]->post_name ?>"  method="post">
		<input type="hidden" name="title" value="<?php echo get_the_title(); ?>">
		<div class="tab-content">
		    <div class="question" id="box-paing">
		    <?php
		    	$count = 1; 
		    	foreach ($panel_list as $question) {
		    		echo '<div class="tab-pane paging_list">';
		    			echo '<div class="single-question">';
	                      	echo '<p class="question"><b>Câu ' . $count . ':</b> '. $question['panel_text'] . '</p>';
	                      	echo '<p><b>Số lần phụ huynh thực hiện/ thử hoạt động</b></p><p><input type="number" name="parent_test['.$count.']" required></p>';
	                      	echo '<p><b>Số lần con làm theo</b></p><p><input type="number" name="imitative['.$count.']" required></p>';
	                      	echo '<p><b>Mức độ hỗ trợ con</b></p><p><input type="number" name="support['.$count.']" required></p>';
	                      	echo '<p><b>Số lần trẻ thực hiện hoạt động thành công</b></p><p><input type="number" name="excecute['.$count.']" required></p>';
	                    echo '</div>';
		    		echo '</div>';
		    		echo '<input type="hidden" name="questions['.$count.']" value="'.$question['panel_text'].'">';
		    		$count++;
		    	}
		    ?>
			</div>
		</div>
		<div class="tab-pane tab-page-control" style="padding: 30px 15px;">
	          <div class="text-left"><input type="submit" class="qh-btn qh-btn-lg qh-btn-cblue" name="subscription_result" value="KẾT QUẢ"/></div>
	        <div class="clear"></div>
	    </div>
	</form>
</div>

