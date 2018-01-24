<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Avery Lite
 */

get_header(); ?>

		<?php

		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation( array(
			    'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'avery-lite' ) . '</span> ' .
			        '<span class="navigation-post" style="background-image: url(' . get_the_post_thumbnail_url(get_previous_post()->ID,'large') . ');"><span class="post-title">%title</span></span>',
			    'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'avery-lite' ) . '</span> ' .
			        '<span class="navigation-post" style="background-image: url(' . get_the_post_thumbnail_url(get_next_post()->ID,'large') . ');"><span class="post-title">%title</span></span>',
			) );

		endwhile; // End of the loop.
		?>

<?php
get_footer();
