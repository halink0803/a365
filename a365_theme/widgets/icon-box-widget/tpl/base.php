<?php 
	$title = $instance['title'] ? $instance['title'] : '';
	$feature_image = $instance['feature_image'] ? $instance['feature_image'] : '';
	$panel_list = $instance['panel'] ? $instance['panel'] : '';
	$button_link = $instance['button_link'] ? $instance['button_link'] : '';
?>
<div class="home-action-box">
	<div class="box-title"><?php echo $title ?></div>
	<div class="box-body">
		<?php 
			$image_url = wp_get_attachment_url($feature_image);
		?>
		<div class="sample-image bg-cover" style="background-image: url(<?php echo $image_url; ?>);"></div>
		<div class="intro-text">
			<?php 
				foreach ($panel_list as $panel) {
					echo '<p>'.$panel['panel_text'].'</p>';
				}
			?>
			
		</div>
		<?php if($button_link['text']!='') {
		echo '<a href="'.$button_link['link'].'" class="action-button"><i class="fa fa-play"></i>'.$button_link['text'].'</a>';
		} ?>
	</div>
</div>