<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Avery Lite
 */

get_header(); ?>
		
		<div class="swiper-container swiper-coverflow padding-bottom-30">
			<div class="swiper-wrapper">
			    <?php
				$args = array( 					
					'post_type' => 'post',
				    'posts_per_page' => '6',
				    'orderby' => 'date',
				    'order' => 'DESC',
				);
				query_posts($args);
				while ( have_posts() ) : the_post(); ?>
				<div class="swiper-slide">
			    <?php get_template_part('template-parts/content', 'swiper' ); ?>
		        </div>
				<?php endwhile; ?>
		    </div>
		    <div class="swiper-button-next swiper-button-white"></div>
			<div class="swiper-button-prev swiper-button-white"></div>
		</div>
		<?php wp_reset_postdata(); ?>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h2 class="page-title screen-reader-text"><?php single_post_title(); ?></h2>
				</header>

			<?php
			endif;
			$args = array(
			    'post_type'   => 'post',
			    'orderby' => 'date',
			    'order' => 'DESC',
			    'paged' => $paged
			  );
    		query_posts($args); ?>
    		
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
