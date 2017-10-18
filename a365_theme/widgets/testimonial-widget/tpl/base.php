
<?php 
	$panels = $instance['panel'] ? $instance['panel'] : '';
?>
<div id="testimonial" class="owl-carousel owl-theme">
	<?php 
		if($panels != ''){
			foreach ($panels as $panel) {
				echo '<div class="item"><h3 class="mg-t0">Nhận xét của phụ huynh</h3>';
				echo '<p>"'.$panel['panel_feedback'].'"</p>';
				echo '<div class="text-right"><i>'.$panel['panel_parent'].'</i></div></div>';
			}
		}
	?>
</div>