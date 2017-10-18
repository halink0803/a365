<?php 
	$panel_logos = $instance['panel'] ? $instance['panel'] : '';
?>

<div class="container partner-slider-container">
	<div class="partner-slider">
		<div id="footerPartnerCarousel" class="owl-carousel owl-theme">
			<?php 
				if($panel_logos != ''){
					foreach ($panel_logos as $panel_logo) {
						$image_url = wp_get_attachment_url($panel_logo['panel_logo']);
						echo '<div class="item"><a target="_blank" href="'.$panel_logo['panel_link'].'"><img src="'.$image_url.'"></a></div>';
					}
				}
			?>
		</div>
	</div>
</div>