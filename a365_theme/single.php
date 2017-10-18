<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package A365
 */

?>
    <script type="text/javascript">
        $(document).ready(function() {
          $('.feedback .readmore1').on('click',function(){
            $('.feedback .showing1').removeClass('show').addClass('hide');
            $('.feedback .hiding1').removeClass('hide').addClass('show');
            $('#shorting1').removeClass('hide').addClass('show');
          });
          $('#shorting1').on('click',function(){
            $('#shorting1').removeClass('show').addClass('hide');
            $('.feedback .showing1').removeClass('hide').addClass('show');
            $('.feedback .hiding1').removeClass('show').addClass('hide');
          });
          $('.feedback .readmore2').on('click',function(){
            $('.feedback .showing2').removeClass('show').addClass('hide');
            $('.feedback .hiding2').removeClass('hide').addClass('show');
            $('#shorting2').removeClass('hide').addClass('show');
          });
          $('#shorting2').on('click',function(){
            $('#shorting2').removeClass('show').addClass('hide');
            $('.feedback .showing2').removeClass('hide').addClass('show');
            $('.feedback .hiding2').removeClass('show').addClass('hide');
          });
        });
    </script>
	<?php
    if( isset( $_POST['id'] ) ) {
      $post = get_post($_POST['id']);
    }
	?>
    <div id="single-post post-<?php the_ID(); ?>">
    <?php while (have_posts()) : the_post(); ?>

        <h3 class="post-title"><?php echo get_the_title(); ?></h3>
        <p class="post-date">Ngày cập nhật: <?php the_date('d-m-Y') ?></p>
        <div class="post-content">
        <?php the_content();?>
        </div>
        <?php
            $PhuHuynh = get_post_meta( get_the_ID(), 'PhuHuynh', true );
            $ChuyenGia = get_post_meta( get_the_ID(), 'ChuyenGia', true );
            if( $PhuHuynh) { // kiểm tra xem nó có dữ liệu hay không
                echo '<div class="feedback">';
                echo '<h4>Phụ huynh nói gì?</h4>';
                if(str_word_count($PhuHuynh)<=100){
                    $content = '<p>'.$PhuHuynh.'</p>';
                }else{
                    $content = '<p class="showing1">'.implode(' ', array_slice(explode(' ', $PhuHuynh), 0, 100)). '<span>...</span><a class="readmore1">Đọc thêm</a></p>';
                    $content .= '<p class="hiding1">'.$PhuHuynh. '</p><a id="shorting1">Thu gọn</a>';
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
                    $content .= '<p class="hiding2">'.$ChuyenGia. '</p><a id="shorting2">Thu gọn</a>';
                }
                echo $content;
                echo '</div>';
            }
        ?>
        <?php edit_post_link( __('Chỉnh sửa nội dung')); ?>

    <?php endwhile;?>

    </div>


