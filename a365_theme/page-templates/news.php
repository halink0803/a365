<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Tin Tức
 *
 * @package A356
 */
get_header('new');

function a365_get_news( $query ) {
	
	// do not modify queries in the admin
	if( is_admin() ) {
		
		return $query;
		
	}
	

	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'news' ) {
		
		$query->set('orderby', 'date');	
		$query->set('order', 'DESC'); 
		
	}
	

	// return
	return $query;

}

add_action('pre_get_posts', 'a365_get_news');

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = array( 
	'post_type' => 'news',
	'order' => 'DESC',
	'orderby' => 'date',
    'paged' => $paged,	 
	'posts_per_page' => 5, 
);
$the_query = new WP_Query( $args );

?>
<div class="container">
			<div class="qh-page-header">Tin tức</div>
			<div class="list-news-posts">
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="single-news-post clearfix">
							<div class="featured-image"><?php the_post_thumbnail(); ?></div>
							<div class="post-content">
								<h3 class="title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
								<?php 
									$post_year = mysql2date("Y", $post->post_date_gmt);
									$post_month = mysql2date("n", $post->post_date_gmt);
									$post_day = mysql2date("j", $post->post_date_gmt);
								?>
								<div class="meta"><?php echo 'Ngày '.$post_day.' Tháng '.$post_month.' Năm '.$post_year; ?></div>
								<div class="excerpt"><?php the_excerpt(); ?> </div>
								<div class="read-more text-right"><a href="<?php echo esc_url( get_permalink() ); ?>" class="qh-btn qh-btn-cblue">Đọc thêm</a></div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</div>
			<div class="qh-pagination text-center">
				<?php
					$big = 999999999; // need an unlikely integer

					$links =  paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $the_query->max_num_pages,
						'add_args'  => array_map( 'urlencode', array() ),
						'prev_text' => esc_html__( 'Trang sau', 'a365' ),
						'next_text' => esc_html__( 'Trang tiếp', 'a365' ),
						'type'      => 'list'
					) );

					echo ent2ncr( $links );
				?>
			</div>
		</div>
<?php get_footer('new'); ?>