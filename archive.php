<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Avery Lite
 */

get_header(); ?>

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header text-center">
				<?php
					the_archive_title( '<h3 class="page-title">', '</h3>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
        		get_template_part('template-parts/content',  get_post_format() );

			endwhile; ?>

			<?php
			the_posts_navigation( array(
		        'prev_text' => sprintf( esc_html__( 'Older Posts %s', 'avery-lite' ), '<span class="screen-reader-text">%title</span>' ),
		        'next_text' => sprintf( esc_html__( 'New Posts %s', 'avery-lite' ), '<span class="screen-reader-text">%title</span>' ),
		    ));

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

<?php
get_footer();
