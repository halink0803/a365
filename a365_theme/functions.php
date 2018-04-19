<?php
/**
 * A365 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package A365
 */
// if (!session_id()) {
//     session_start();
// }
if ( ! function_exists( 'a365_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function a365_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on A365, use a find and replace
	 * to change 'a365' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'a365', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'a365' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'a365_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'a365_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function a365_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'a365_content_width', 640 );
}
add_action( 'after_setup_theme', 'a365_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function a365_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'a365' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'a365' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'a365' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Footer Sidebar', 'a365' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Top', 'a365' ),
		'id'            => 'footer-top',
		'description'   => esc_html__( 'Footer Sidebar Top', 'a365' ),
		'before_widget' => '<div id="%1$s" class="list-menu list-unstyled widget %2$s footer_widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Intervention Video', 'a365' ),
		'id'            => 'intervent-video',
		'description'   => esc_html__( 'intervent video block', 'a365' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Testimonial', 'a365' ),
		'id'            => 'testimonial',
		'description'   => esc_html__( 'Testimonial block', 'a365' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Contact Information', 'a365' ),
		'id'            => 'contact-information',
		'description'   => esc_html__( 'Contact Information Sidebar', 'a365' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'a365_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function a365_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/css/jquery-ui.min.css' );

	wp_enqueue_style( 'a365-style', get_stylesheet_uri() );

	wp_enqueue_style( 'datatable.css', get_template_directory_uri() . '/css/jquery.dataTables.min.css' );

	// wp_enqueue_style( 'font-lato', 'https://use.typekit.net/ccd0tuu.js' );

	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), true );

	wp_enqueue_script( 'jquery-validate', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array('jquery'), true );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery', true) );

	wp_enqueue_script( 'datepicker-vi', get_template_directory_uri() . '/js/datepicker-vi.js', array('jquery'), true );

	wp_enqueue_script( 'writer', get_template_directory_uri() . '/js/writer.js', array('jquery'), true );


	wp_enqueue_script( 'a365-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'a365-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js/?v=123');
	wp_enqueue_script( 'canthiep-js', get_template_directory_uri() . '/js/canthiep.js');
	wp_enqueue_script( 'datatable', get_template_directory_uri() . '/js/jquery.dataTables.min.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	};
	wp_localize_script( 'script', 'a365_ajax',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'a365_scripts' );

 if ( is_admin() ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

//Add widget siteorigin
function a365_add_widget_folders( $folders ){
    $folders[] = get_template_directory() . '/widgets/';
    return $folders;
}
add_action('siteorigin_widgets_widget_folders', 'a365_add_widget_folders');

function a365_activate_bundled_widgets(){
    if( is_plugin_active('so-widgets-bundle/so-widgets-bundle.php') ) {
        SiteOrigin_Widgets_Bundle::single()->activate_widget( 'banner-slider-widget' );
        SiteOrigin_Widgets_Bundle::single()->activate_widget( 'banner-image-widget' );
        SiteOrigin_Widgets_Bundle::single()->activate_widget( 'icon-box-widget' );
         SiteOrigin_Widgets_Bundle::single()->activate_widget( 'brand-logo-widget' );
         SiteOrigin_Widgets_Bundle::single()->activate_widget( 'list-widget' );
         SiteOrigin_Widgets_Bundle::single()->activate_widget( 'testimonial-widget' );
        set_theme_mod( 'bundled_widgets_activated', true );
    }
}
add_filter('admin_init', 'a365_activate_bundled_widgets');

function a365_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('A365 Widget', 'a365'),
        'filter' => array(
            'groups' => array('a365')
        )
    );

    return $tabs;
}

//Sort post by date
add_action( 'pre_get_posts', 'a365_get_posts' );

function a365_get_posts( $query )
{
    $query->set('orderby', array('date' => 'ASC'));

    return $query;
}

add_filter('siteorigin_panels_widget_dialog_tabs', 'a365_add_widget_tabs', 20);

//add news post type
function a365_create_posttype() {

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'News', 'Post Type General Name', 'a365' ),
		'singular_name'       => _x( 'News', 'Post Type Singular Name', 'a365' ),
		'menu_name'           => __( 'News', 'a365' ),
		'parent_item_colon'   => __( 'Parent News', 'a365' ),
		'all_items'           => __( 'All News', 'a365' ),
		'view_item'           => __( 'View News', 'a365' ),
		'add_new_item'        => __( 'Add New News', 'a365' ),
		'add_new'             => __( 'Add News', 'a365' ),
		'edit_item'           => __( 'Edit News', 'a365' ),
		'update_item'         => __( 'Update News', 'a365' ),
		'search_items'        => __( 'Search News', 'a365' ),
		'not_found'           => __( 'Not Found', 'a365' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'a365' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'News', 'a365' ),
		'description'         => __( 'News and reviews', 'a365' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres'),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
	);

	// Registering your Custom Post Type
	register_post_type( 'news', $args );

}
// Hooking up our function to theme setup
add_action( 'init', 'a365_create_posttype' );

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}

// add_action('login_form','a365_homepage_redirect',1);
// function a365_homepage_redirect(){
// 	wp_safe_redirect(home_url('/'));
// 	exit();
// }
add_action('login_form','a365_login_check');
function a365_login_check(){
	$pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/child-information.php'
    ));
	if(isset($_POST['log'])&&isset($_POST['pwd'])){
		if(!wp_login( $_POST['log'], $_POST['pwd'])){
			?>
			<script type="text/javascript">
			 	 if (window.confirm("Nhập sai email,mật khẩu hoặc email chưa được kích hoạt. Vui lòng đăng nhập lại và kiểm tra lại email.")){
			 	 	window.location.replace("<?php echo home_url(); ?>");
			 	 }else{
			 	 	window.location.replace("<?php echo home_url(); ?>");
			 	 }
			 </script>;
			<?php
		}else{
			wp_safe_redirect(home_url($pages[0]->post_name));
			exit();
		};
	}
}

//chang email sender
function wpb_sender_email( $original_email_address ) {
    return 'a365@ccihp.org';
}

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
	return 'A365';
}

// Hooking up our functions to WordPress filters
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



