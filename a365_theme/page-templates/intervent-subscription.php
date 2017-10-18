<?php
if ( ! defined( 'ABSPATH' ) ) exit;
  /**
   * Template Name: Danh Sách Theo dõi
   *
   * @package A356
   */
   get_header('new');
   //$_SESSION['current_child'] = '';
	//$current_user_id = a365_get_current_user_id();
	$autismChild = getRecordsForAutismChild();
	$num_autism = count($autismChild);

	//echo $num_autism;
	if (checkUserType() == false) {
		if ( $num_autism == 1 )
			$_SESSION['current_child'] = $autismChild[0];
	}
?>
<!-- Thông báo không có trẻ tự kỉ -->
<div id="autism_child_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 10pt;"><strong>Bạn không thể xem phần này vì trong danh sách của bạn không có trẻ nào bị tự kỷ hoặc chậm phát triển. Nếu bạn có trẻ tự kỷ hoặc chậm phát triển, hãy vào TRANG QUẢN LÝ TRẺ để cập nhật tình trạng chẩn đoán của trẻ.</strong></span></p>
				</div>
            </div>
            <div class="modal-footer" style="text-align: center;">
               	<p>
					<br/>
					<button type="button" class="btn btn-default" onclick="window.location.href='../quan-ly-tre'" >Trang quản lý trẻ</button>
					<button type="button" class="btn btn-default" onclick="window.location.href='../'" >Về trang chủ</button>            
				</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eeecec">
               	<div class="tit_popup" align="left">
					<p style="text-align: center;"><span style="font-size: 10pt;"><strong>BÀI THEO DÕI HIỆU QUẢ CAN THIỆP</strong></span></p>
				</div>
				<p style="text-align: center;"><strong><span style="font-size: 12pt;">Bạn vui lòng "Chọn trẻ" sau đó ấn "Xác nhận trẻ" để làm các bài theo dõi hiệu quả can thiệp.</span></strong></p>
            </div>
            <div class="modal-body" style="text-align: center;">
	            <select class="select_contact" required="required" id="TestChildAction">
					<option value="">--chọn trẻ--</option>
					<?php foreach ($autismChild as $value) { ?>
						<option value="<?=$value->id?>"><?=$value->name?></option>
					
					<?php } ?>
				</select>
            </div>
            <div class="modal-footer" style="text-align: center;">
               	<p>
					<br/>
					<button type="button" class="btn btn-default" onclick="lock_sesion_child()" id="save_current_child" >Xác nhận trẻ</button>
					<button type="button" class="btn btn-default" onclick="window.location.href='../'" >Về trang chủ</button>            
				</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var $=jQuery.noConflict();
$(document).ready(function(){
	// check login
	var user_id = "<?=a365_get_current_user_id()?>";
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
  	else {
  		// check number of autism child
		var num_autism = <?=$num_autism?>;
		var user_check = <?php if(checkUserType()==true) echo "true";
							else
								echo "false";
						?>;
		//console.log(num_autism);
		//console.log(user_check);
		//if (is_exist_child == 0){
			if (user_check == false && num_autism == 0) {
				//console.log("abc");
				$("#autism_child_Modal").modal({
		  			backdrop: 'static',
		  			keyboard: true
				});
			}
			if (num_autism > 1)
				$("#myModal").modal({
		  			backdrop: 'static',
		  			keyboard: true
				});
	  		}
  		//}
	})

</script>
<div id="siteContent">
  <div class="container">
    <div class="qh-page-header"><?php the_title(); ?></div>
    <div class="qh-article-wrap">
    	<?php
			$args = array(
			    'hide_empty' => false,
			);
			$intervention = get_tags();
			
			foreach ($intervention as $value) {
			?>
				<div class="child-month fw700 c-red text-uppercase"><?php echo $value->name ?></div><br/>
				<?php 
				if($value != ''):
					$args = array ( 'tag_id' => $value->term_id );
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) : ?>

						<div class="intervention-list row">

							<?php
							/* Start the Loop */
							while ( $query->have_posts() ) : $query->the_post();
								$post = get_post(get_the_ID());
							?>
								<div class="col-xs-6 col-md-6 subscription">
									<a class="theodoicanthiep" href="<?php echo get_site_url().'/theo-doi-'.$post->post_name; ?>" rel="bookmark">
										<div class="title"><?php the_title(); ?></div>
									</a>
								</div>
							
							<?php

							endwhile;
							?>
						</div>
						<?php
					endif;
				endif;
				?>
				<?php wp_reset_query();?>
				<br/>
			<?php } ?>
    </div>	
   </div>
</div>

<?php get_footer('new'); ?>