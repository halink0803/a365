<?php
	$panel_list = $instance['panel'] ? $instance['panel'] : '';
?>

<div id="homePageSlider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	<?php foreach ($panel_list as $key => $panel) {
  		if($key==0){
  			echo '<li data-target="#homePageSlider" data-slide-to="0" class="active"></li>';
  		}else{
  			echo '<li data-target="#homePageSlider" data-slide-to="'.$key.'" ></li>';
  		}
  	} ?>
  </ol>
  <div class="carousel-inner" role="listbox">

  	<?php foreach ($panel_list as $key => $panel) { 
  		$active = $key==0? 'active' : '';
  		$image_id = $panel['panel_background_image'];
  		$size = $panel['content_size'] ? $panel['content_size'] : '';
  		$style_size = '';
  		if($size!=''){
  			$style_size .= 'style="font-size:'.$size.'px"';
  		}
  		echo '<div class="item '.$active.'" style="background-image: url('.wp_get_attachment_url( $image_id ).');">';
  	?>
	    	<div class="container">
	    		<div class="item-content left">
	    			<?php if($panel['panel_title']!='') {?>
	    				<h3 class="title"><?php echo $panel['panel_title'] ?></h3>
	    			<?php }
	    			if($panel['panel_content']!='') {?>
	    				<div <?php echo $style_size; ?> class="content"><?php echo $panel['panel_content'] ?></div>
	    			<?php } 
	    			if($panel['panel_link']['button_text']!='') {?>
		    			<div class="call-to-action">
		    				<a href="<?php echo $panel['panel_link']['button_link'] ?>"><?php echo $panel['panel_link']['button_text'] ?></a>
		    			</div>
	    			<?php } ?>
	    		</div>
	    	</div>
	    </div>
	 <?php } ?>
  </div>
  <a class="left qh-carousel-control" href="#homePageSlider" role="button" data-slide="prev"><i class="fa fa-angle-left fa-2x"></i></a>
  <a class="right qh-carousel-control" href="#homePageSlider" role="button" data-slide="next"><i class="fa fa-angle-right fa-2x"></i></a>
</div>