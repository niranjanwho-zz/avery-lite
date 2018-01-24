<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Avery Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Avery Lite
 */

if ( ! function_exists( 'avery_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function avery_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Avery Lite, use a find and replace
	 * to change 'avery-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'avery-lite', get_template_directory() . '/languages' );

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 320,
		'flex-height' => true,
	) );

	/*
	 * Add post formats
	 */
	add_theme_support('post-formats', array(
		'gallery',
		'video',
		'audio',
		'image',
	));

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	// Thumbnail sizes
	add_image_size('avery_lite_1920', 1920, '', true);
	add_image_size('avery_lite_800', 800, '', true);
	add_image_size('avery_lite_800_460', 800, 460, array( 'center', 'center') );
	add_image_size('avery_lite_600_395', 600, 395, array( 'center', 'center') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary Menu', 'avery-lite' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'avery_lite_custom_background_args', array(
		'default-color' => 'fefcff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'avery_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function avery_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'avery_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'avery_lite_content_width', 0 );

/**
 * Registers an editor stylesheet for the theme.
 */
function avery_lite_add_editor_styles() {
    add_editor_style( '/css/editor-style.css' );
}
add_action( 'admin_init', 'avery_lite_add_editor_styles' );

/**
 * Remove the suffix from excerpt.
*/
function avery_lite_excerpt_more( $more ) {
    return sprintf('..');
}
add_filter( 'excerpt_more', 'avery_lite_excerpt_more' );

/**
 * Change WordPress Tag Cloud Font Size.
*/
function avery_lite_tag_cloud_font_size($args) {
    $args['smallest'] = 10; /* Set the smallest size to 12px */
    $args['largest'] = 16;  /* set the largest size to 18px */
    return $args; 
}
add_filter('widget_tag_cloud_args','avery_lite_tag_cloud_font_size');

/**
 * Add class to image <a> anchor elements.
*/
function avery_lite_add_classes_to_linked_images($html) {
    $classes = 'media-img'; // can do multiple classes, separate with space
    $patterns = array();
    $replacements = array();
    $patterns[0] = '/<a(?![^>]*class)([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor tag where anchor has no existing classes
    $replacements[0] = '<a\1 class="' . $classes . '"><img\2></a>';
    $patterns[1] = '/<a([^>]*)class="([^"]*)"([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in double quotes
    $replacements[1] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';
    $patterns[2] = '/<a([^>]*)class=\'([^\']*)\'([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in single quotes
    $replacements[2] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';
    $html = preg_replace($patterns, $replacements, $html);
    return $html;
}
add_filter('the_content', 'avery_lite_add_classes_to_linked_images', 100, 1);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function avery_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'avery-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'avery-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'avery_lite_widgets_init' );

/**
 * Register Google Fonts
*/
function avery_lite_fonts_url() {
	$fonts_url = '';

	$AbrilFatface = _x( 'on', 'Abril Fatface: on or off', 'avery-lite' );
	$Questrial = _x( 'on', 'Questrial: on or off', 'avery-lite' );

	if ( 'off' !== $AbrilFatface || 'off' !== $Questrial ) {
		$font_families = array();

		$font_families[] = 'Abril Fatface';
		$font_families[] = 'Questrial:400';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function avery_lite_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'avery-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'avery_lite_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function avery_lite_scripts() {
	wp_enqueue_style( 'avery-style', get_stylesheet_uri() );

	wp_enqueue_style( 'avery-fonts', avery_lite_fonts_url(), array(), null );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7' );

	wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.min.css', array(), '1.0' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7' );

	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/css/animsition.min.css', array(), '4.0.2' );

	wp_enqueue_style( 'swipper', get_template_directory_uri() . '/css/swipper.min.css', array(), '3.2' );

	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.min.css', array(), '1.1.0' );

	wp_enqueue_style( 'avery-theme', get_template_directory_uri() . '/css/theme.css', array(), '1.0' );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-custom.js', array(), '3.3.1', false );

	wp_enqueue_script( 'prefixfree', get_template_directory_uri() . '/js/prefixfree.js', array(), '1.0.7', false );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/js/animsition.min.js', array('jquery'), '4.0.2', true );

	wp_enqueue_script( 'swiper.jquery.min', get_template_directory_uri() . '/js/swiper.jquery.min.js', array('jquery'), '3.2', true );

	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/magnific-popup.min.js', array('jquery'), '1.1.0', true );

	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'resize-sensor', get_template_directory_uri() . '/js/ResizeSensor.min.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'avery-theme', get_template_directory_uri() . '/js/theme.js', array('jquery','bootstrap'), '1.0', true );

	wp_enqueue_script( 'avery-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	wp_enqueue_script( 'avery-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'avery_lite_scripts' );

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
