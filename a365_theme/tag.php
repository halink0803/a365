


<?php
	if ( have_posts() ) : ?>

		<div id="list-post-container " class="row">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			?>
			
				<div class="col-xs-6 col-md-4">
					<a class="post-link single-exercise" href="<?php  the_permalink(); ?>" rel="bookmark">
						<div class="fet-img"><?php the_post_thumbnail() ?></div>
						<div class="title"><?php the_title(); ?></div>
					</a>
				</div>
			<?php

			endwhile;
			?>
		</div>
		<?php
	endif; 
?>
<script>
(function($) {
   	$(document).ready(function(){

   		$(".single-exercise").click(function(){
       	var title = $('div.title',this).html();
		//console.log("canthiep_name: "+title);
		$.ajax({
			action: 'save_exercise_intervention_view',
        	type: 'post',
        	dataType: 'json',
        	data: { 'exercise_name' : title},
        	url: a365_ajax.ajax_url,
			success: function(response){
			},
			error: function(){
				// alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
			}
		});

	});

   		$.ajaxSetup({cache:false});
        $(".post-link").click(function(){
   //      	var title = $('div.title',this).html();
			// //console.log("canthiep_name: "+title);
            var post_link = $(this).attr("href");
            $("#single-post-container").html("LOADING...");
            $("#single-post-container").load(post_link);
        return false;
        });

    });
})(jQuery);
</script>