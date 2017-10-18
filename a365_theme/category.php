<?php
/**
* A Simple Category Template
*/

get_header('new'); ?>
<?php
	$post_ids = get_posts(array(
	    'numberposts'   => -1, // get all posts.
	    'category'     => get_the_category()[0]->id,
	    'category_name' => get_the_category()[0]->name,
		'orderby'   => 'date',
		'order'     => 'ASC',
	));
?>

<div class="container">
	<div class="qh-page-header"><?php single_cat_title( '', true ); ?></div>
	<div class="row">
		<div class="col-xs-12 col-sm-3" id="sidebarSticky">
			<div class="single-sidebar">
				<ul class="sidebar-article-menu list-unstyled">
					<?php
						
            			if ( have_posts() ) :
            				while ( have_posts() ) : the_post();
            				?>
            					<li>
            						<a class="post-link" rel="<?php the_ID(); ?>" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
									</a>
									<i class="fa fa-angle-right"></i>
								</li>
            				<?php
            				endwhile;
            			endif;


            			$qol_test_link = get_pages(array(
				          'meta_key' => '_wp_page_template',
				          'meta_value' => 'page-templates/qol_test.php'
				     	 ));  

            			if(get_the_category()[0]->slug == 'ho-tro-tam-ly-cho-cha-me'){
            				echo '<li><a href="'.home_url($qol_test_link[0]->post_name).'">Đánh giá chất lượng sống của cha mẹ</a><i class="fa fa-angle-right"></i></li>';
            			}
            		?>

				</ul>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-9">
			<div class="qh-article-wrap">
				<div id="single-post-container">
					<?php
						if(isset($_GET["ASQ"])){
							$my_postid = $post_ids[1]->ID;
						}
						elseif (isset($_GET["MChat"])||isset($_GET["listClinic"])) {
							$my_postid = $post_ids[2]->ID;
						}
						elseif(isset($_GET["ASQTool"])){
							$my_postid = $post_ids[4]->ID;
						}else{
							$my_postid = $post_ids[0]->ID;//This is page id or post id
						}
						$content_post = get_post($my_postid);
						$content = $content_post->post_content;
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
         				echo '<h3 class="post-title">'.$content_post->post_title.'</h3>';
         				echo '<p class="post-date">Ngày cập nhật: <span>'; 
         				the_date('d-m-Y'); 
         				echo '</span></p>';
						echo $content;
						
			            $PhuHuynh = get_post_meta( $my_postid, 'PhuHuynh', true );
			            $ChuyenGia = get_post_meta( $my_postid, 'ChuyenGia', true );
			            if( $PhuHuynh) { // kiểm tra xem nó có dữ liệu hay không
			            	echo '<div class="feedback">';
			            	echo '<h4>Phụ huynh nói gì?</h4>';
			            	if(str_word_count($PhuHuynh)<=100){
			            		$content = '<p>'.$PhuHuynh.'</p>';
			            	}else{
			            		$content = '<p class="showing1">'.implode(' ', array_slice(explode(' ', $PhuHuynh), 0, 100)). '<span>...</span><a class="readmore1">Đọc thêm</a></p>';
			            		$content .= '<p class="hiding1">'.$PhuHuynh. '</p>';
			            	}
			                echo $content;
			                echo '</div>';
			            }
				       	if( $ChuyenGia) { // kiểm tra xem nó có dữ liệu hay không
			            	echo '<div class="feedback">';
			            	echo '<h4>Chuyên gia nói gì?</h4>';
			               if(str_word_count($ChuyenGia)<=100){
			            		$content = '<p>'.$ChuyenGia.'</p>';
			            	}else{
			            		$content = '<p class="showing2">'.implode(' ', array_slice(explode(' ', $ChuyenGia), 0, 100)). '<span>...</span><a class="readmore2">Đọc thêm</a></p>';
			            		$content .= '<p class="hiding2">'.$ChuyenGia. '</p>';
			            	}
			                echo $content;
			                echo '</div>';
			            }
          				edit_post_link( __('Chỉnh sửa nội dung'),'','',$my_postid );
					?>
				</div>

			</div>
		</div>
	</div>
</div>
<?php get_footer('new'); ?>
<script>
	(function($){
		$(document).ready(function(){

   		$(".single-exercise").click(function(){
       	var title = $('div.title',this).html();
		////console.log("canthiep_name: "+title);
		$.ajax({
			action: 'save_exercise_intervention_view',
        	type: 'post',
        	dataType: 'json',
        	data: { 'exercise_name' : title},
        	url: a365_ajax.ajax_url,
			success: function(response){
			},
			error: function(){
				alert("Đã có lỗi xảy ra! Xin vui lòng thử lại.");
			}
		});

	});
   		
	   		$.ajaxSetup({cache:false});
	   		<?php if(isset($_GET["ASQ"])): ?>
	   			$('.single-sidebar ul li:nth-child(2)').addClass('active');
	   		<?php elseif(isset($_GET["MChat"]) || isset($_GET["listClinic"]) ): ?>	
	   			$('.single-sidebar ul li:nth-child(3)').addClass('active');
   			<?php elseif(isset($_GET["ASQTool"])): ?>	
   			$('.single-sidebar ul li:nth-child(5)').addClass('active');
	   		<?php else: ?>
	   			$('.single-sidebar ul li:first-child').addClass('active');
	   		<?php endif; ?>
	        $(".post-link").click(function(){
	        	//var title = $('div.title',this).html();
				////console.log("canthiep_name: "+title);
	        	$('.single-sidebar ul li').removeClass('active');
	  			$(this).parent('li').addClass('active');
	            var post_link = $(this).attr("href");
	            $("#single-post-container").html("LOADING...");
	            $("#single-post-container").load(post_link);
	        return false;
	        });
    	});
	})(jQuery);
   	
</script>