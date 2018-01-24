<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Avery Lite
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses avery_lite_header_style()
 */
function avery_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'avery_lite_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '050b1c',
		'width'                  => 1366,
		'height'                 => 800,
		'flex-height'            => true,
		'wp-head-callback'       => 'avery_lite_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'avery_lite_custom_header_setup' );

if ( ! function_exists( 'avery_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see avery_lite_custom_header_setup().
 */
function avery_lite_header_style() {
	$header_image = get_header_image();
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( empty( $header_image ) && display_header_text() ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Short header for when Header Text is hidden.
		if ( ! display_header_text() ) :
	?>
		.site-title a,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php
		else: ?>
		.site-title a,
		.site-description {
			clip: auto;
			position: relative;
		}
		.site-title a,
		.site-title a:hover,
		.site-title a:focus,
		.site-title a:active,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php
		endif;

		// Has a Custom Header been added?
		if ( ! empty( $header_image ) ) :
	?>
		.site-header {
			/*
			 * No shorthand so the Customizer can override individual properties.
			 * @see https://core.trac.wordpress.org/ticket/31460
			 */
			background-image: url(<?php header_image(); ?>);
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			border: none !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
