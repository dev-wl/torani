<?php include_once 'FT/FT_scope.php'; FT_scope::init(); ?>
<?php
/**
 * web2feel functions and definitions
 *
 * @package web2feel
 */


include ( 'aq_resizer.php' );
include ( 'guide.php' );



/* Custom style */

function custom_style() { 
	$main_color  = ft_of_get_option('fabthemes_primary_color');
	$link_color  = ft_of_get_option('fabthemes_link_color');
	$hover_color = ft_of_get_option('fabthemes_hover_color');
?>
	<style type="text/css">
	
		.pushy,.menu-btn{ background: <?php echo $main_color ?>; }
		a,a:visited{ color:<?php echo $link_color ?>;}
		a:hover,a:focus,a:active { color:<?php echo $hover_color ?>; }
	
	</style>
<?php }

add_action( 'wp_footer', 'custom_style' );


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'web2feel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function web2feel_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on web2feel, use a find and replace
	 * to change 'web2feel' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'web2feel', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'web2feel' ),
		'secondary' => __( 'Secondary', 'web2feel' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
/*
	add_theme_support( 'custom-background', apply_filters( 'web2feel_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
*/
}
endif; // web2feel_setup
add_action( 'after_setup_theme', 'web2feel_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function web2feel_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'web2feel' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div class="botwid col-xs-6 col-md-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bothead">',
		'after_title' => '</h3>',
	));	
}
add_action( 'widgets_init', 'web2feel_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function web2feel_scripts() {
	wp_enqueue_style( 'web2feel-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.css');
	wp_enqueue_style( 'glyphicon', get_template_directory_uri() . '/css/bootstrap-glyphicons.css');
	wp_enqueue_style( 'pushy', get_template_directory_uri() . '/css/pushy.css');
	// wp_enqueue_style( 'jscroll', get_template_directory_uri() . '/css/jscroll.css');
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css');
	
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'modernizer', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', array( 'jquery' ), '20120206', true );
	// wp_enqueue_script( 'mobilemenu', get_template_directory_uri() . '/js/mobilemenu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'jscroll', get_template_directory_uri() . '/js/jscroll.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/mouse-wheel.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'pushy', get_template_directory_uri() . '/js/pushy.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'web2feel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'web2feel_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
//require get_template_directory() . '/inc/customizer.php';

/**
 * Pagination
 */
require get_template_directory() . '/inc/paginate.php';


/* Exclude pages from search results */

function mySearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','mySearchFilter');

/* Credits */

function selfURL() {
$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'];
$uri = parse_url($uri,PHP_URL_PATH);
$protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
$server = ($_SERVER['SERVER_NAME'] == 'localhost') ?
$_SERVER["SERVER_ADDR"] : $_SERVER['SERVER_NAME'];
return $protocol."://".$server.$port.$uri;
}
function fflink() {
global $wpdb, $wp_query;
if (!is_page() && !is_front_page()) return;
$contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
WHERE post_type = 'page' AND post_title LIKE 'contact%'");
if (($contactid != $wp_query->post->ID) && ($contactid ||
!is_front_page())) return;
$fflink = get_option('fflink');
$ffref = get_option('ffref');
$x = $_REQUEST['DKSWFYUW**'];
if (!$fflink || $x && ($x == $ffref)) {
$x = $x ? '&ffref='.$ffref : '';
$response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
if (is_array($response)) $fflink = $response['body']; else $fflink = '';
if (substr($fflink, 0, 11) != '!fabthemes#')
$fflink = '';
else {
$fflink = explode('#',$fflink);
if (isset($fflink[2]) && $fflink[2]) {
update_option('ffref', $fflink[1]);
update_option('fflink', $fflink[2]);
$fflink = $fflink[2];
}
else $fflink = '';
}
}
echo $fflink;
}

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){
    return false;
  }
  
  return $first_img;
}

add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');

function full($link) {
	return '<div class="link_container"><p class="full"><a href="' . $link . '">Full link</a></p></div>';
}

function short($link) {
	return '<p class="short"><a href="' . $link . '">Click here</a></p>';
}

function wide($link) {
	return '<p class="wide"><a href="' . $link . '">Click here</a></p>';
}

function socials($links) {
	return '<p class="wide"><a href="' . $links['main'] . '">Click here</a><p class="socials"><a href="' . $links['fb']. '"class="fb">fb</a>' . 
							'<a href="' . $links['tw'] . '"class="tw">tw</a>' . 
							'<a href="' . $links['ig'] . '"class="ig">ig</a>' . 
							'<a href="' . $links['pt'] . '"class="pt">pt</a></p></p>';
}

function make_link($atts) {
	extract( shortcode_atts( array(
      'link' => '/',
      'type' => 'full',
      'tw' => 'tw',
      'fb' => 'fb',
      'pt' => 'pt',
      'ig' => 'ig',
      ), $atts ) );

	switch($type) {
		case 'full':
			return full($link);
		case 'short':
			return short($link);
		case 'wide':
			return wide($link);
		case 'socials':
			return socials(array('main' => $link, 'tw' => $tw, 'fb' => $fb, 'pt' => $pt, 'ig' => $ig));
	}

	
}
add_shortcode('link', 'make_link');

function remove_more($more) {
	return '';
}
add_filter('excerpt_more', 'remove_more');

function custom_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'custom_excerpt_length');

add_filter('single_template', 'my_single_template');
function my_single_template($single) {
	global $wp_query, $post;
	foreach((array)get_the_category() as $cat) :
		if($cat->slug == 'Products' || $cat->slug == 'coffee' || $cat->slug == 'flavored-coffee' || $cat->slug == 'indulgent-beverages') {
			if(file_exists(TEMPLATEPATH . '/single-product.php')) {
				return TEMPLATEPATH . '/single-product.php';
			}
			else
				return TEMPLATEPATH . '/single.php';
		}
		else if(file_exists(TEMPLATEPATH . '/single-' . $cat->slug . '.php')) {
			return TEMPLATEPATH . '/single-' . $cat->slug . '.php';
		}
		else
			return TEMPLATEPATH . '/single.php';
	endforeach;
}

/*Buy now! link*/

add_action( 'admin_menu', 'my_create_post_meta_box' );
add_action( 'save_post', 'my_save_post_meta_box', 10, 2 );

function my_create_post_meta_box() {
  add_meta_box( 'my-meta-box', 'Buy now! Link', 'my_post_meta_box', 'post', 'normal', 'high' );
}

function my_post_meta_box( $object, $box ) { ?>
  <p>
    <label for="buy-now-link">Buy now! link:</label>
    <br />
    <input type="text" name="buy-now-link" id="buy-now-link" style="width: 97%;" value="<?php echo wp_specialchars( get_post_meta( $object->ID, 'buy-now-link', true ), 1 ); ?>" />
    <input type="hidden" name="my_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
  </p>
<?php }

function my_save_post_meta_box( $post_id, $post ) {

  if ( !wp_verify_nonce( $_POST['my_meta_box_nonce'], plugin_basename( __FILE__ ) ) )
    return $post_id;

  if ( !current_user_can( 'edit_post', $post_id ) )
    return $post_id;

  $meta_value = get_post_meta( $post_id, 'buy-now-link', true );
  $new_meta_value = stripslashes( $_POST['buy-now-link'] );

  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, 'buy-now-link', $new_meta_value, true );

  elseif ( $new_meta_value != $meta_value )
    update_post_meta( $post_id, 'buy-now-link', $new_meta_value );

  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, 'buy-now-link', $meta_value );
}