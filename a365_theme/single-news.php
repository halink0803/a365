<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package A365
 */
get_header('new');
?>
<div class="container">
    <div class="qh-page-header"><?php echo get_the_title(); ?></div>
    <div class="qh-article-wrap">
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content();?>
        <?php edit_post_link( __('Chỉnh sửa nội dung') ); ?>
    <?php endwhile;?>
    </div>
    <h3 class="related-news">Các tin tức khác</h3>
    <ul class="list-news-update list-unstyled">
        <?php 
            $args = array(
                'numberposts' => 5,
                'offset' => 0,
                'category' => 0,
                'orderby' => 'post_date',
                'order' => 'ASC',
                'include' => '',
                'exclude' => '',
                'meta_key' => '',
                'meta_value' =>'',
                'post_type' => 'news',
                'post_status' => 'draft, publish, future, pending, private',
                'suppress_filters' => true
            );
        $posts = wp_get_recent_posts( $args );
        $recent_posts = [];
        foreach( $posts as $post ){
            array_unshift($recent_posts, $post);
        }
        foreach( $recent_posts as $recent ){
            echo '<li><div class="news-link"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a></div></li> ';
        }
        wp_reset_query();
        ?>
        
    </ul>
</div>
<?php get_footer('new'); ?>

