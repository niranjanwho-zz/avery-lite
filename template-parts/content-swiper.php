<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Template part for displaying swiper posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Avery Lite
 */

?>

<div <?php post_class('swiper-item'); ?> <?php $post_thumbnail_id = get_post_thumbnail_id($post->ID);$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );if ( has_post_thumbnail() ) : ?>style="background-image: url(<?php echo esc_url( $post_thumbnail_url ); ?>);"<?php endif; ?>>
	<div class="swiper-content text-center">
		<header class="entry-header" data-swiper-parallax="-200">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header>

		<footer class="entry-footer" data-swiper-parallax="-300">
			<a href="<?php echo get_permalink(); ?>" class="more-link more-link2"><?php echo __( 'Read More', 'avery-lite' ) ?></a>
		</footer><!-- .entry-footer -->
	</div>
</div>