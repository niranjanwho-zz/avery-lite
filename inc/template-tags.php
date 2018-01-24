<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Avery Lite
 */

if ( ! function_exists( 'avery_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function avery_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

if ( ! function_exists( 'avery_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function avery_lite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		//esc_html_x( 'Posted on %s', 'post date', 'avery-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$post_content = get_post_field('post_content', get_the_ID());
	$strip_shortcodes = strip_shortcodes($post_content);
	$strip_tags = strip_tags($strip_shortcodes);
	$word_count = str_word_count($strip_tags);
	$reading_time = ceil($word_count / 250);
	$reading_time_text = esc_attr( ' Minute', 'avery-lite' );

	echo '<span class="posted-on"><span class="glyphicon glyphicon-calendar"></span>' . $posted_on . '</span><span class="reading-time"> <span class="glyphicon glyphicon-time"></span>' . $reading_time . $reading_time_text .'</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'avery_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function avery_lite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'avery-lite' ) );
		if ( $categories_list && avery_lite_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="glyphicon glyphicon-folder-open"></span>' . esc_html__( '%1$s', 'avery-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'avery-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="glyphicon glyphicon-tags"></span>' . esc_html__( '%1$s', 'avery-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'avery-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'avery-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function avery_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'avery_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'avery_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so avery_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so avery_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in avery_lite_categorized_blog.
 */
function avery_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'avery_lite_categories' );
}
add_action( 'edit_category', 'avery_lite_category_transient_flusher' );
add_action( 'save_post',     'avery_lite_category_transient_flusher' );
