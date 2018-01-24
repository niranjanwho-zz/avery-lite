<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Avery Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('standard-post'); ?>>
	<?php if ( is_single() ) : ?>
	<div class="block-effect <?php if ( !has_post_thumbnail() ) : ?>block-effect-no-thumbnail<?php endif; ?>"></div>
	<?php endif; ?>
	<header class="entry-header text-center <?php if ( is_single() && has_post_thumbnail() ): ?>padding-top-30<?php endif; ?>">
		<?php
		if ( is_single() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php avery_lite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_front_page() && has_post_thumbnail() ): ?>
    <div class="post-featured-image">
        <?php echo get_the_post_thumbnail($post->ID, 'avery_lite_1920', array('class' => 'img-responsive img-center img-fill'));?>
    </div><!-- .post-featured-image -->
    <?php endif; ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Read More', 'avery-lite' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'avery-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php avery_lite_entry_footer(); ?>
		<ul class="share-this">
			<li><?php echo esc_attr('Share :', 'avery-lite') ?></li>
			<li><a target="_blank" rel="nofollow" href="https://www.facebook.com/sharer.php?u=<?php echo get_permalink() ;?>"><i class="fa fa-facebook"></i></a></li>
			<li><a target="_blank" rel="nofollow" href="https://twitter.com/share?text=<?php echo get_the_title();?>&amp;url=<?php echo get_permalink() ;?>"><i class="fa fa-twitter"></i></a></li>
			<li><a target="_blank" rel="nofollow" href="https://pinterest.com/pin/create/bookmarklet/?media=<?php the_post_thumbnail_url(); ?>&amp;url=<?php echo get_permalink() ;?>"><i class="fa fa-pinterest"></i></a></li>
		</ul><!-- .share-this -->
	</footer><!-- .entry-footer -->

	<?php if( is_single() && get_the_author_meta('description') != '' ): ?>
	<div class="entry-author author vcard text-center">
		<?php echo get_avatar( get_the_author_meta('email'), '100', null, false, array('class' => 'img-circle') ); ?>
		<h5 class="font-family-inherit"><?php the_author_posts_link(); ?></h5>
		<p><?php the_author_meta('description'); ?></p>
	</div><!-- .entry-auther-->
	<?php endif; ?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif; ?>
</article><!-- #post-## -->
